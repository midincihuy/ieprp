<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Ticket;

class HelpwaController extends BaseController
{
    public function index(Request $request){
        \Log::info($request->all());
        // Check phone number and status Open ticket exist

        $phone_number = explode("@", $request->phone_number);
        $check = Ticket::where(['phone_number' => $phone_number[0], 'status' => 'Open'])->get();

        if($check->count() > 0){
            // Kalau ada tidak usah reply message
            return "ada ".$phone_number[0];
        }else{
            // kalau tidak ada reply message dan insert ticket
            $ticket_number = $this->generateTicket($phone_number[0]);
            $msg = $this->replyMessage($request->all(), $ticket_number);
            return "tidak ada ".$phone_number[0]." generate ticket : ".$ticket_number." with msg ".$msg;
        }
    }

    public function generateTicket($phone_number){
        $hasil = ""; // YYYYMMDDHHIISS_9999 4 digit phone_number

        $date = date("YmdHi");
        $hasil = $date."_".substr($phone_number,-4);
        return $hasil;
    }

    public function replyMessage($request, $ticket_number){
        $phone_number = explode("@", $request->phone_number);
        $msg = "Bpk/Ibu ".$request->push_name." , Ticket terbuat dengan nomor : #".$ticket_number;
        $response = Http::post(config('helpwa.sendWa'), [
            'text' => $msg,
            'to' => $phone_number[0],
        ]);
        return $msg;
    }
}