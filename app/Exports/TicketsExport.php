<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
 
class TicketsExport implements FromQuery, Responsable
{
    use Exportable;
    private $fileName = 'ticket.xlsx';
    public function __construct(string $start_periode, string $end_periode)
    {
        $this->start_periode = $start_periode;
        $this->end_periode = $end_periode;
    }
    public function query()
    {
        return Ticket::query()->whereBetween('start_time', [$this->start_periode, $this->end_periode]);
    }
}
