<?php

namespace App\Exports;

use App\Models\CareerApplication;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CareerApplicationExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public $job_id;

    public function __construct($job_id)
    {
        $this->job_id = $job_id;
    }

    public function query()
    {
        return CareerApplication::query()
            ->select('id', 'career_job_id', 'name', 'email', 'mobile_number', 'linkedin_profile', 'created_at')
            ->with('job:id,title')
            ->where('career_job_id', $this->job_id)
            ->orderBy('id', 'desc');
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->job->title,
            $row->name,
            $row->mobile_number,
            $row->email,
            $row->linkedin_profile,
            $row->created_at ? date('d-m-Y g:i A', strtotime($row->created_at)) : '',
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Job', 'Name', 'Phone', 'Email', 'linkedin Profile', 'Applied At'];
    }
}
