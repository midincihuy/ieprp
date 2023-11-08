<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Carbon\Carbon;
class TicketsExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize, withMapping, WithColumnFormatting
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

    public function headings(): array
    {
        return [
            // '#',
            'MSG ID', // From wa baileys
            'Ticket Number',
            'Phone Number',
            'Push Name',
            'Start Time',
            'End Time',
            'Duration (Seconds)',
            'Status', // Open / Close
            'PIC',
            'PIC Assign Time',
            'Rating',
            'Category',
            'Created At',
            'Updated At',
        ];
    }

    public function map($ticket): array
    {
        $start_time = Carbon::parse($ticket->start_time);
        $end_time = Carbon::parse($ticket->end_time);
        $duration = $start_time->diffInSeconds($end_time);
        return [
            $ticket->msg_id,
            $ticket->ticket_number,
            "'".$ticket->phone_number,
            $ticket->push_name,
            $ticket->start_time,
            $ticket->end_time,
            $duration,
            $ticket->status,
            $ticket->pic,
            $ticket->pic_time,
            $ticket->rate,
            $ticket->category,
            $ticket->created_at,
            $ticket->updated_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_TIME4,
            'M' => NumberFormat::FORMAT_DATE_DATETIME,
            'N' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
