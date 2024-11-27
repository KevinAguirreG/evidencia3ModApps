<?php

namespace App\Exports;

use App\Models\Delivery;
use App\Models\OrderRow;
use App\Models\Order;
use App\Models\Config;
use App\Models\Confirmation;
use App\Http\Controllers\DeliveryController;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PorteoTemplateExport implements 
WithEvents
{

    public $orders = [];
    public $delivery;
    private $alphabetRange;
    public $table = []; 


    public function __construct($delivery, $department_id){
        
        $this->delivery = Delivery::where("id", $delivery)->first();
        foreach($this->delivery->deliveryRows as $key => $row){
            array_push($this->orders, $row->order);
        }

        $ordersDepartment = [];
        foreach($this->orders as $key => $order){
            if(app(DeliveryController::class)->checkDepartment($order)["department"]->id == $department_id ){
                array_push($ordersDepartment, $order);
            }
        }
        $this->orders = $ordersDepartment;
        //Falta el quey real para obtener las orders
        $zamexco = Config::all()->take(1);
        $zamexco = $zamexco[0];

        $this->alphabetRange = range('A', 'Z');

        $boxes = 0;
        $totalBoxes = 0;
        $weight = 0;

        $date =  date_create_from_format("Y-m-d", $this->delivery->confirmation->date)->format("d/m/Y"); 

        foreach($this->orders as $key => $order){

            foreach($order->orderRows as $key => $row){
                array_push($this->table,
                [
                    $this->delivery->confirmation->confirmation_number,
                    $order->order_number,
                    $row->Product["upc"] ?? "0",
                    $row->amount / $row->Product->pieces,
                    $this->delivery->destinity->warehouse->name,
                    $date . " " . $this->delivery->confirmation->time,
                    $zamexco->company_name,
                    "BIANCA DE LA PAZ (8662060827)",
                    ""
                ]);
            }
        }

    }
    

    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $template = new LocalTemporaryFile(storage_path('templates/TemplateCopiaPorteo.xlsx'));
               
                // $reader = IOFactory::createReader("Xls");
                // $spreadsheet = $reader->load("C:/xampp/htdocs/zamexco/storage/templates/prueba2.xls");

                // dd("Leyó");
                // // $reader            = IOFactory::createReader(Excel::XLSX);
                // // $spreadsheet = $reader->load($template->sync()->getLocalPath());

                // $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
                // $inputFileName = 'C:/xampp/htdocs/zamexco/storage/templates/FORMATO_TEMPLATE_PORTEO.xlsx';
                
                // /**  Create a new Reader of the type defined in $inputFileType  **/
                // $reader = IOFactory::createReader($inputFileType);
                // /**  Load $inputFileName to a Spreadsheet Object  **/
                // $spreadsheet = $reader->load($inputFileName);

                // $reader            = IOFactory::createReader(Excel::XLSX);
                // $this->spreadsheet = $reader->load($template->sync()->getLocalPath());
             
                $event->writer->reopen($template ,Excel::XLSX);
               
                // Insertamos los valores para la tabla del template porteo
                foreach($this->table as $key => $row){
                    $numRow = $key + 7;
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[$key];
                        $event->getWriter()->getSheetByIndex(0)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                }

            },
        ];
    }
}
