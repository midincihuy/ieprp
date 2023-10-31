<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Ticket;

class HelpwaController extends BaseController
{
    public function index(Request $request){
        // return $request->all();
        // Check phone number and status Open ticket exist

        $check = Ticket::where(['phone_number' => $request->phone_number, 'status' => 'Open'])->get();

        if($check->count() > 0){
            // Kalau ada tidak usah reply message
            return "ada ".$request->phone_number;
        }else{
            // kalau tidak ada reply message dan insert ticket
            $msg = $this->replyMessage($request->all());
            $ticket_number = $this->generateTicket($request->phone_number);
            return "tidak ada ".$request->phone_number." generate ticket : ".$this->generateTicket($request->phone_number)." with msg ".$msg;
        }
    }

    public function generateTicket($phone_number){
        $hasil = ""; // YYYYMMDDHHIISS_9999 4 digit phone_number

        $date = date("YmdHi");
        $hasil = $date."_".substr($phone_number,-4);
        return $hasil;
    }

    public function replyMessage($data){
        $msg = "Mohon maaf ya, ".$data['push_name'];
        $response = Http::post('http://172.17.108.23:8100/sendMsg', [
            'text' => $msg,
            'to' => $data['phone_number'],
        ]);
        return $msg;

        /*
$response = Http::post('http://172.17.108.23:8100/sendMsg', [
    'text' => $msg,
    'to' => $data['phone_number'],
]);
        */
    }
}