<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'msg_id', // From wa baileys
        'ticket_number',
        'phone_number',
        'start_time',
        'end_time',
        'status', // Open / Close
        'pic',
    ];
}
