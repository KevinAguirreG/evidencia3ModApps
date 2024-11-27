<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style as DefaultStyle;



class ProductExport implements 
    FromArray,
    ShouldAutoSize,
    WithStrictNullComparison,
    WithHeadings,
    WithEvents,
    WithDefaultStyles
    {

        private $products;
        private $attributes;
        private $col_limit;
        private $row_limit;
        private $range_limit;
        private $range;


        public function __construct()
        {
            $this->products = Product::all();
            $this->attributes = [
                'Nombre de Producto',
                'Código de barras (13 dígitos)',
                'Clave de Producto Zamexco',
                'Num de Piezas Solicitadas',
                'Costo',
                'Precio Total'
            ];

            $alphabetRange = range('A', 'Z');
            $cols = count($this->attributes) -1;
            $this->row_limit = count($this->products) + 1;
            $this->col_limit = $alphabetRange[$cols];
            $this->range_limit = $this->col_limit.$this->row_limit;
            $this->range = 'A1:'.$this->range_limit;
        }
   
    public function array(): array
    {
        $table = [];
        foreach($this->products as $key => $row){
            array_push($table, 
            [
                    $row->name,
                    $row->upc,
                    substr($row->upc, -5),
                    0,
                    0,
                    '=D'.$key+2 .'*E'.$key+2
            ]);
                    
        };

        return  $table;
    }

    public function headings(): array
    {
        return $this->attributes;
    }


    public function registerEvents(): array
    {

        return[
            AfterSheet::class => function (AfterSheet $event) {
                    $event->sheet->getStyle('A1:F1')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ]
                        ]);

                    $event->sheet->getStyle($this->range)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ])->getAlignment()->setWrapText(true);

                    // Background color header
                    $event->sheet->getDelegate()->getStyle('A1:F1')
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('7FC7D9');

                    for($i = 2; $i <= $this->row_limit; $i++){
                        if($i % 2 == 0){
                            $event->sheet->getDelegate()->getStyle('A'.$i.':'.$this->col_limit.$i)
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('DCF2F1');
                        }
                    }
                    
                
            }
        ];
    }

    public function defaultStyles(DefaultStyle $defaultStyle)
    {
        return [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
    }
}
