<?php

namespace App\Exports;

use App\Models\Buying;
use App\Models\BuyingRow;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BuyingsExport implements 
    FromCollection, 
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents
{
    private $buying;
    public function __construct($buying_id = null)
    {
        if($buying_id != null)
        {
            $this->buying = Buying::where('id', $buying_id)->first();
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        if ($this->buying == null)
        {
            return BuyingRow::with('product', 'buying')->get();
        }else
        {
            return BuyingRow::where('buying_id', $this->buying->id)->with('product')->get();
        }
    }


    public function map($buyimgRow): array
    {
        return [
            $buyimgRow->id,
            $buyimgRow->buying->date,
            $buyimgRow->buying->seller->name,
            $buyimgRow->product->name,
            $buyimgRow->barcode,
            $buyimgRow->zamexco_code,
            $buyimgRow->amount,
            $buyimgRow->price,
            $buyimgRow->total,
        
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Fecha',
            'Vendedor',
            'Producto',
            'Clave de producto proveedor',
            'Clave de producto Zamexco',
            'Num de piezas solicitadas',
            'Costo',
            'Precio total',

        ];
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                    ]);
            }
        ];
    }
    // public function view(): View
    // {
    //     return view('exports/exportBuyings', [
    //         'buyingRows' => BuyingRow::all()
    //     ]);
    // }
}
