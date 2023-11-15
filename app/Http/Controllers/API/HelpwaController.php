<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Ticket;
use App\Models\Reference;

class HelpwaController extends BaseController
{
    public function index(Request $request){
        \Log::info($request->all());
        // Check phone number and status Open ticket exist

        $phone_number = explode("@", $request->phone_number);
        $check = Ticket::where(['phone_number' => $phone_number[0], 'status' => 'Open'])->get();
        if(isset($request->message)){
            switch ($request->type) {
                case 'start':   
                    if($check->count() > 0){
                        // Kalau ada tidak usah reply message
                        \Log::info('sudah ada ticket dengan number : '.$check->first()->ticket_number);
                        return "ada ".$phone_number[0];
                    }else{
                        // kalau tidak ada reply message dan insert ticket
                        $ticket_number = $this->generateTicket($phone_number[0]);
                        $insert_ticket = new Ticket();
                        $data_ticket = [
                            "msg_id" => $request->msg_id,
                            "phone_number" => $phone_number[0],
                            "ticket_number" => $ticket_number,
                            "start_time" => date("Y-m-d H:i:s", $request->start_time),
                            "push_name" => $request->push_name,
                        ];
                        $insert_ticket->fill($data_ticket);
                        $insert_ticket->save();
                        $msg = $this->replyMessage($request->all(), $ticket_number);
                        $msg = $this->replyMessageWithCategory($request->all(), $ticket_number);
                        return "tidak ada ".$phone_number[0]." generate ticket : ".$ticket_number." with msg ".$msg;
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
    }

    public function generateTicket($phone_number){
        $hasil = ""; // YYYYMMDDHHIISS_9999 4 digit phone_number

        $date = date("YmdHi");
        $hasil = $date."_".substr($phone_number,-4);
        return $hasil;
    }

    public function replyMessage($request, $ticket_number){
        $phone_number = explode("@", $request['phone_number']);
        // $msg = "Bpk/Ibu ".$request['push_name']." , Ticket terbuat dengan nomor : #".$ticket_number;
        $chk_msg = Reference::where('code', "REPLY")->get();
        $msg = "";
        if($chk_msg->count() > 0){
            $msg = $chk_msg->first()->value;
        }
        if($msg != ""){
            $response = Http::post(config('helpwa.sendwa'), [
                'message' => [
                    'text' => $msg,
                ],
                'to' => $phone_number[0],
            ]);
        }
        return $msg;
        
    }

    public function replyMessageWithCategory($request, $ticket_number){
        $phone_number = explode("@", $request['phone_number']);
        // $msg = "Bpk/Ibu ".$request['push_name']." , Ticket terbuat dengan nomor : #".$ticket_number;
        $rating = Reference::where('code', 'CATEGORY')->get();
        if($rating->count() > 0){
            $poll_name = $ticket_number."|\n".$rating->first()->item;
            $poll_values = $rating->pluck('value')->toArray();
            $response = Http::post(config('helpwa.sendwa'), [
                'message' => [
                    'poll' => [
                        'name' => $poll_name,
                        "values" => $poll_values,
                        "selectableCount" => 1
                    ]
                ],
                'to' => $phone_number[0],
            ]);
        }
        return;        
    }
    public function response(Request $request){
        \Log::info($request->all());
        // Check phone number and status Open ticket exist

        $phone_number = explode("@", $request->phone_number);
        $check = Ticket::where(['phone_number' => $phone_number[0], 'status' => 'Open'])->get();
        
        switch ($request->type) {
            case "all" : 
                // Check all posibility : end / pic / rate from message
                $keyword = "";
                $ref = Reference::whereValue($request->message)->get();
                if($ref->count() == 1){
                    $keyword = $ref->first()->code;
                }
                switch($keyword){
                    case "end" :
                        $update = $check->first();
                        $update->end_time = date("Y-m-d H:i:s", $request->end_time);
                        $update->status = "Close";
                        $update->save();
                        break;  
                    
                    case "pic" :                
                        $update = $check->first();
                        $arr_pic = explode($ref->first()->item, $request->message);
                        $pic = $arr_pic[1];
                        $update->pic = $pic;
                        $update->pic_time = date("Y-m-d H:i:s");
                        $update->save();
                        break;
                        
                    case "rate" :         
                        // Send Poll Message
                        $rating = Reference::where('code', 'RATING')->get();
                        if($rating->count() > 0){
                            $poll_name = $check->first()->ticket_number."|\n".$rating->first()->item;
                            $poll_values = $rating->pluck('value')->toArray();
                            $response = Http::post(config('helpwa.sendwa'), [
                                'message' => [
                                    'poll' => [
                                        'name' => $poll_name,
                                        "values" => $poll_values,
                                        "selectableCount" => 1
                                    ]
                                ],
                                'to' => $phone_number[0],
                            ]);
                        }
                        break;
                        
                    default : 
                        \Log::info("NO Keyword detected, msg : ".json_encode($request->message));
                        break;
                }
                break;
            default:
                # code...
                break;
        }
    }

    public function rate(Request $request){
        \Log::info($request->message);
        // Check phone number and status Open ticket exist

        $result = [];
        foreach($request->message as $index){
            if(count($index['voters']) > 0){
                if($index['voters'][0] != "me"){
                    $result[$index['voters'][0]]= $index['name'];
                }
            }
        }
        \Log::info($result);
        $phone_number = explode("@", $request->phone_number);
        $poll_name = $request->poll_name;
        $arr_ticket = explode("|", $poll_name);
        $ticket_number = $arr_ticket[0];
        $poll_name = trim($arr_ticket[1]);
        \Log::info(json_encode($poll_name));
        $check = Ticket::where([
            'phone_number' => $phone_number[0], 
            'status' => 'Open', 
            "ticket_number" => $ticket_number])
            ->get();
        if($check->count() == 1){
            switch ($request->type) {
                case "rate" :
                    $rate_type = Reference::whereItem($poll_name)->get();
                    if($rate_type->count() > 0){
                        $type = $rate_type->first()->code;
                        switch($type){
                            case "RATING":
                                $update = $check->first();
                                $update->rate = $result[$request->phone_number];
                                $update->save();
                                break;
                            case "CATEGORY":
                                $update = $check->first();
                                $update->category = $result[$request->phone_number];
                                $update->save();
                        }
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
    
}
