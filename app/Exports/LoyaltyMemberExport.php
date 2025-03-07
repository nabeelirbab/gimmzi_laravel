<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoyaltyMemberExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $datas;
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function headings():array{
        return[
            'Member Name',
            'BirthDate',
            'Name Of program',
            'Enrollment Date',
            'Location Enrolled',
        ];
    } 

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Set background color for the first row
            1    => ['fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00']
            ]]
        ];
    }

    public function collection()
    {
        // dd(collect($this->datas));
        return collect($this->datas);
    }
}
