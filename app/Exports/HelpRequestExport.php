<?php

namespace App\Exports;

use App\Models\CardHelpRequest;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class HelpRequestExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public $date_range;

    public function __construct($date_range)
    {
        $this->date_range = $date_range;
    }

    public function query()
    {
        $from_date = $to_date = date('Y-m-d');
        if (!empty($this->date_range)) {
            $dates_from_function = getDateDBFormatFromDateRange($this->date_range);
            $from_date           = $dates_from_function['from_date'];
            $to_date             = $dates_from_function['to_date'];
        }

        return CardHelpRequest::query()
                              ->select('id', 'name', 'mobile_number', 'city', 'profession', 'created_at')
                              ->where('created_at', '>=', $from_date)
                              ->where('created_at', '<=', $to_date . ' 23.59.59')
                              ->orderBy('id', 'desc');
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->city,
            $row->profession,
            $row->mobile_number,
            $row->created_at ? date('d-m-Y g:i A', strtotime($row->created_at)) : '',
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'City', 'Profession','Mobile No', 'Created At'];
    }
}
