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
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
            'Duration',
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
        $pic_time = Carbon::parse($ticket->pic_time);
        $created_at = Carbon::parse($ticket->created_at);
        $updated_at = Carbon::parse($ticket->updated_at);
        $duration = "";
        if(isset($ticket->end_time)){
            $end_time = Carbon::parse($ticket->end_time);
            $duration = gmdate("H:i:s", $start_time->diffInSeconds($end_time));
        }
        return [
            $ticket->msg_id,
            $ticket->ticket_number,
            $ticket->phone_number,
            $ticket->push_name,
            Date::dateTimeToExcel($start_time),
            isset($ticket->end_time) ? Date::dateTimeToExcel($end_time) : "",
            $duration,
            $ticket->status,
            $ticket->pic,
            isset($ticket->pic_time) ? Date::dateTimeToExcel($pic_time) : "",
            $ticket->rate,
            $ticket->category,
            Date::dateTimeToExcel($created_at),
            Date::dateTimeToExcel($updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => "#0",
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_TIME4,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
