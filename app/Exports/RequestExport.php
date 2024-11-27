<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Delivery;
use App\Models\Branch;
use App\Models\Config;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Concerns\WithEvents;




class RequestExport implements 
WithEvents
{
    private $orders = [];
    private $delivery;
    private $calledByEvent;
    private $requestTable = [];
    private $cardTable = [];
    private $alphabetRange;
    


    public function __construct($delivery)
    {
        $this->delivery = Delivery::where("id", $delivery)->first();
        foreach($this->delivery->deliveryRows as $key => $row){
            array_push($this->orders, $row->order);
        }
        $this->calledByEvent = false; 

        $zamexco = Config::all()->take(1);
        $zamexco = $zamexco[0];

        $this->alphabetRange = range('A', 'Z');

        $boxes = 0;
        $totalBoxes = 0;
        $weight = 0;

        foreach($this->orders as $key => $row){

            foreach($row->orderRows as $key => $orderRow){
                $totalBoxes += $orderRow->amount;
            };
        };

        foreach($this->orders as $key => $row){

            $boxes = 0; 
            $weight = 0;
            $differentProducts = 0;
            $products = [];
            $branch = Branch::where('branch_number', $row->branch_code)->first();

            foreach($row->orderRows as $key => $orderRow){
                $boxes += $orderRow->amount / $orderRow->Product->pieces;
                $weight += $orderRow->Product->weight * $boxes;
                if(!in_array($orderRow->product, $products) ){
                    array_push($products, $orderRow->product);
                    $differentProducts++;
                }
            };


            array_push($this->requestTable, 
            [
                    "ZAMEXCO INTERNATIONAL S. DE R.L. DE C.V.",
                    "Bianca de la Paz Leija",
                    $branch->branch_number. " ". $branch->name,
                    $row->order_number,
                    "PLT",
                    $boxes,
                    "1",
                    "PROPIO",
                    "1"
            ]);

            array_push($this->cardTable, 
            [
                $row->order_number,
                $zamexco->rfc,
                $totalBoxes,
                $row->orderRows[0]->product->satData->number,
                $row->orderRows[0]->product->satData->description,
                $differentProducts ,
                $row->orderRows[0]->product->satData->code,
                "0",
                "",
                "",
                "",
                $weight,
                $weight,
                "KG",
                $row->branch_code,
                "1",
                ""

            ]);
        };

    }
    

    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $template = new LocalTemporaryFile(storage_path('templates/Solicitud_porteo.xlsx'));
                $event->writer->reopen($template ,Excel::XLSX);
               
                // Insertamos los valores en la Solicitud
                foreach($this->requestTable as $key => $row){
                    $numRow = $key + 7;
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[$key];
                        $event->getWriter()->getSheetByIndex(0)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                }

                //Insertamos los valores en la Carta Porte
                foreach($this->cardTable as $key => $row){
                    $numRow = $key + 3;
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[$key];
                        $event->getWriter()->getSheetByIndex(1)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                }


            },
        ];
    }

    
}
