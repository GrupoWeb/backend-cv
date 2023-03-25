<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\CuentasCorriente;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportAccount implements FromCollection, WithHeadings, WithStyles
{


    public function headings(): array
    {
        return ['Cuenta','Padre'];
    }


    public function collection(): \Illuminate\Support\Collection
    {
        $data = CuentasCorriente::WhereNull('parent_id')
            ->with('childrenCuenta')->get();
        $data = json_decode($data);
        foreach ($data as $row)
        {
            if(sizeof($row->children_cuenta) > 0)
            {
                $arrayD[] = [
                    "Cuenta"    => $row->title,
                    "Padre"     => ""
                ];
                foreach ($row->children_cuenta as $children)
                {
                    $arrayD[] = [
                        "Cuenta"    => $children->title,
                        "Padre"     => $row->title
                    ];
                }
            }
            else
            {
                $arrayD[] = [
                    "Cuenta"    => $row->title,
                    "Padre"    => sizeof($row->children_cuenta)
                ];

            }

        }
        return collect($arrayD);
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1    => ['font' => ['bold' => true, 'size'  => 12]],
        ];
    }
}
