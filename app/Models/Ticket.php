<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'msg_id', // From wa baileys
        'ticket_number',
        'phone_number',
        'push_name',
        'start_time',
        'end_time',
        'status', // Open / Close
        'pic',
        'pic_time',
        'rate',
        'category',
        'source',
    ];

    public function getDurationStartEndAttribute(){
        $duration = 0;
        if($this->end_time != ""){
            $start_time = Carbon::parse($this->start_time);
            $end_time = Carbon::parse($this->end_time);
            $duration = $start_time->diffInSeconds($end_time);
        }
        return $duration;
    }
    
    public function getDurationStartPicAttribute(){
        $duration = 0;
        if($this->pic_time != ""){
            $start_time = Carbon::parse($this->start_time);
            $pic_time = Carbon::parse($this->pic_time);
            $duration = $start_time->diffInSeconds($pic_time);
        }
        return $duration;
    }

    public function getDurationPicEndAttribute(){
        $duration = 0;
        if($this->pic_time != "" && $this->end_time != ""){
            $end_time = Carbon::parse($this->end_time);
            $pic_time = Carbon::parse($this->pic_time);
            $duration = $pic_time->diffInSeconds($end_time);
        }
        return $duration;
    }
}

