<?php

namespace App\Exports;

use App\Models\Delivery;
use App\Models\Config;
use App\Http\Controllers\DeliveryController;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;




class DeliveriesExport implements 
WithEvents,
ShouldAutosize
{
    //Dios se apiade de la pobre alma que decida tocar este código

    private $alphabetRange;
    private $delivery;
    public $beautyTable = []; 
    public $petsTable = []; 
    public $firstTableBeauty = [];
    public $firstTablePets = [];
    public $secondTableBeauty = [];
    public $secondTablePets = [];
    public $thirdTableBeauty = [];
    public $thirdTablePets = [];

    public function __construct($delivery)
    {
        $this->delivery = Delivery::where("id", $delivery)->first();
        $orders = [];
        foreach($this->delivery->deliveryRows as $key => $row){
            array_push($orders, $row->order);
        }
        $zamexco = Config::all()->take(1);
        $zamexco = $zamexco[0];
        $this->alphabetRange = range('A', 'Z');

        // $this->firstTableBeauty = $this->firstTable($splitOrders["beautyOrders"], 1);
        // $this->firstTablePets = $this->firstTable($splitOrders["petOrders"], 2);

        $this->firstTableBeauty =  $this->firstTable($orders, 1);
        $this->firstTablePets =  $this->firstTable($orders, 2);

        $this->secondTablePets =  $this->secondTable($orders)["petTable"];
        $this->secondTableBeauty =  $this->secondTable($orders)["beautyTable"];

        $this->thirdTableBeauty =  $this->thirdTable($orders)["beautyTable"];
        $this->thirdTablePets =  $this->thirdTable($orders)["petTable"];

    }

    public function firstTable($orders, $departmentId){
        $table = [];
        foreach($orders as $key => $order){

            $total = 0;

            foreach($order->orderRows as $key => $row){
                $total += $row->cost_total;
            }
            $import = $total - ($total * 0.16);
            if(app(DeliveryController::class)->checkDepartment($order)["department"]->id == $departmentId){
                array_push($table,
                [
                    //Determinante
                    $order->branch_code,
                    //Orden de compra
                    $order->order_number,
                    //Importe (Total sin IVA 16%)
                    $import,
                    //Costo total
                    $total,
                ]);    
            }else{
                array_push($table,
                [
                    //Determinante
                    $order->branch_code,
                    //Orden de compra
                    "",
                    //Importe (Total sin IVA 16%)
                    "",
                    //Costo total
                    "",
                ]); 
            }
            
        }
        return $table;
    }

    public function secondTable($orders){
        $result = ["petTable", "beautyTable"];
        
        $petProducts = [];
        $beautyProducts = [];

        $petTable = [];
        $beautyTable = [];

        $petTableCount = [];
        $beautyTableCount = [];

        $determinants = ["7464" => [], "7471"  => [], "4188" => [], "4640" => [], "4924" => [], "7468" => [], "7487" => [], "7490" => [], "7493" => []];

        
        $headings = [];

        //Obtenemos los productos que habrá en la tabla
        foreach($orders as $key => $order){
            foreach($order->orderRows as $key => $row){
                //Si el producto no está en ninguno de los dos arrays de productos
                if(!in_array($row->Product, $beautyProducts) && !in_array($row->Product, $petProducts)){
                    //Hacemos push al array correspondiente
                    if($row->Product->department_id == 1){
                        array_push($beautyProducts, $row->Product);
                    }else if($row->Product->department_id == 2){
                        array_push($petProducts, $row->Product);
                    }
                }
            }
        }

        //Agrupamos las ordenes por determinante
        foreach($orders as $key => $order){
            //Si existe la key(determinante) en el array
            if(array_key_exists($order->branch_code, $determinants)){
               array_push($determinants[$order->branch_code], $order); 
            }else{
                $determinants[$order->branch_code] = [];
                array_push($determinants[$order->branch_code], $order); 
            }
        }

        //Tabla de conteo de productos de mascotas 
        $petTableCount = $this->countProducts($petProducts, $determinants);
        // $petTableCount = $this->test($petProducts, $determinants);
        $beautyTableCount = $this->countProducts($beautyProducts, $determinants);

        //Asignamos los headers de las tablas
         $headings = [""]; 
        foreach(array_keys($determinants) as $key => $determinant){
            array_push($headings, $determinant);
        }
        array_push($headings, "TOTAL POR PRODUCTO");


        //Juntamos la tabla de mascotas
        $petTable = [$headings];
        foreach($petTableCount as $key => $row){
            array_push($petTable, $row);
        } 
        $result["petTable"] = $petTable;
        //Juntamos la tabla de belleza
        $beautyTable = [$headings];
        foreach($beautyTableCount as $key => $row){
            array_push($beautyTable, $row);
        } 
        $result["beautyTable"] = $beautyTable;

        return $result;
    }


    public function thirdTable($orders){

        $result = ["petTable", "beautyTable"];

        $petProducts = [];
        $beautyProducts = [];
        
        $petHeadings = [];
        $beautyHeadings = [];

        $determinants = [];

        //Obtenemos los productos que habrá en la tabla
        foreach($orders as $key => $order){
            foreach($order->orderRows as $key => $row){
                //Si el producto no está en ninguno de los dos arrays de productos
                if(!in_array($row->Product, $beautyProducts) && !in_array($row->Product, $petProducts)){
                    //Hacemos push al array correspondiente
                    if($row->Product->department_id == 1){
                        array_push($beautyProducts, $row->Product);
                    }else if($row->Product->department_id == 2){
                        array_push($petProducts, $row->Product);
                    }
                }
            }
        }
        foreach($orders as $key => $order){
            //Si existe la key(determinante) en el array
            if(array_key_exists($order->branch_code, $determinants)){
               array_push($determinants[$order->branch_code], $order); 
            }else{
                $determinants[$order->branch_code] = [];
                array_push($determinants[$order->branch_code], $order); 
            }
        }

        $petHeadings = $this->getHeadings($petProducts);
        $beautyHeadings = $this->getHeadings($beautyProducts);

        $petData = $this->getDataThirdTable($orders, 2, $petProducts);
        $beautyData = $this->getDataThirdTable($orders, 1, $beautyProducts);

         //Juntamos la tabla de mascotas
        $result["petTable"] = [$petHeadings];
         foreach($petData as $key => $row){
             array_push($result["petTable"], $row);
         } 

         $result["beautyTable"] = [$beautyHeadings];
         foreach($beautyData as $key => $row){
             array_push($result["beautyTable"], $row);
         } 

         return $result; 
    }

    public function getHeadings($products){
        $headings = ["Orden de Compra", "Determinante", "#Entrega", "Fecha de Entrega", "Horario de Entrega"];
        foreach($products as $key => $product){
            array_push($headings, $product->name);
        }
        return $headings;
    }

    public function getDataThirdTable($orders, $departmentId, $products){
        $table = [];
        $productHeadings = [];
        $date =  date_create_from_format("Y-m-d", $this->delivery->confirmation->date)->format("d/m/Y"); 

        foreach($products as $key => $product){
            $productHeadings[$product->name] = 0; 
        }
        foreach($orders as $key => $order){
            $tableRow = [];
            if(app(DeliveryController::class)->checkDepartment($order)["department"]->id == $departmentId){
                $tableRow =
                [
                    "Orden de Compra" => $order->order_number,
                    "Determinante" => $order->branch_code,
                    "#Entrega" => $this->delivery->confirmation->confirmation_number.' ',
                    "Fecha de Entrega" => $date,
                    "Horario de Entrega" => $this->delivery->confirmation->time,
                ];
                foreach($productHeadings as $key => $heading){
                    $tableRow[$key] = 0; 
                }

                foreach($order->orderRows as $key => $row){
                    if(array_key_exists($row->Product->name,  $productHeadings)){
                        $tableRow[$row->Product->name] = $row->amount / $row->Product->pieces;
                    }
                }
            array_push($table, $tableRow);

            }
        }

        return $table;
    }

    public function countProducts($products, $determinants){

        $table = [];
        $baseRow["name"] = "";
        $totalCountDeterminants["title"] = "TOTAL POR OC";
        foreach($determinants as $key => $determinant){
            $totalCountDeterminants[$key] = 0;
            $baseRow[$key] = 0;
        }
        foreach($products as $key => $product){
            $tableRow = $baseRow;
            $tableRow["name"] = $product->name;
            $totalProduct = 0;
            foreach($determinants as $key => $orders){
                $determinant = $key;
                $productCount = 0;
                foreach($orders as $key => $order){
                    foreach($order->orderRows as $key => $row){
                        if($product == $row->Product){
                            $productCount += $row->amount / $row->Product->pieces;
                        }
                    }
                }
                $tableRow[$determinant] = $productCount;
                $totalProduct += $productCount;
                $totalCountDeterminants[$determinant] += $productCount;

            }
            $tableRow["total"] = $totalProduct;
            array_push($table, $tableRow);

        }
        array_push($table, $totalCountDeterminants);
        
        return $table;
    }

    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $template = new LocalTemporaryFile(storage_path('templates/Entregas.xlsx'));
                $event->writer->reopen($template ,Excel::XLSX);
                
                $lastRow = 3;

                // Insertamos los valores de la pirmer tabla de belleza
                foreach($this->firstTableBeauty as $key => $row){
                    $numRow = $key + 3;
                    if($numRow > $lastRow){
                        $lastRow++;
                        $event->getWriter()->getSheetByIndex(0)->insertNewRowBefore($numRow);
                    }
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[$key];
                        $event->getWriter()->getSheetByIndex(0)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                }

                // Insertamos los valores de la pirmer tabla de mascotas
                foreach($this->firstTablePets as $key => $row){
                    $numRow = $key + 3;
                    if($numRow > $lastRow){
                        $lastRow++;
                        $event->getWriter()->getSheetByIndex(0)->insertNewRowBefore($numRow);
                    }
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[$key+6];
                        $event->getWriter()->getSheetByIndex(0)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                }

                $lastRow += 3;
                $numRow = $lastRow;
                $lastRow += 1;

                // Insertamos los valores de la segunda tabla de belleza
                foreach($this->secondTableBeauty as $key => $row){
                    if($numRow > $lastRow){
                        $lastRow++;
                        $event->getWriter()->getSheetByIndex(0)->insertNewRowBefore($numRow);
                    }
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[array_search($key, array_keys($row))];
                        $event->getWriter()->getSheetByIndex(0)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                    $numRow ++;
                }

                $lastRow += 2;
                $numRow = $lastRow;
                $lastRow += 1;

                // Insertamos los valores de la segunda tabla de mascotas
                foreach($this->secondTablePets as $key => $row){
                    if($numRow > $lastRow){
                        $lastRow++;
                        $event->getWriter()->getSheetByIndex(0)->insertNewRowBefore($numRow);
                    }
                    foreach($row as $key => $value){
                        $letterCol = $this->alphabetRange[array_search($key, array_keys($row))];
                        $event->getWriter()->getSheetByIndex(0)->setCellValue(''.$letterCol.$numRow, $value);
                    }
                    $numRow ++;
                }
                
                // Insertamos los valores de la tarcer tabla de belleza

                $event->getWriter()->getSheetByIndex(1)->setCellValue('A1', $this->delivery->Destinity->name.' Belleza'); 
                $this->insertLastTable($event, $this->thirdTableBeauty, 3);

                $numRow =  2 + ((count($this->thirdTableBeauty) > 0 ? count($this->thirdTableBeauty) : 1)  * 2);

                $event->getWriter()->getSheetByIndex(1)->setCellValue('A'.$numRow, $this->delivery->Destinity->name. ' Mascotas'); 
                $this->insertLastTable($event, $this->thirdTablePets, $numRow+2);

                // $laluzRowsBeauty = [];
                

                // $chalcoRowsBeauty = [];
                

                // $laluzRowsBeauty = $this->splitLastTable([7464], $this->thirdTableBeauty);
                // $chalcoRowsBeauty = $this->splitLastTable([7471], $this->thirdTableBeauty);
                // $porteoRowsBeauty =  $this->splitLastTable([4188, 4640, 4924, 7468, 7487, 7490, 7493], $this->thirdTableBeauty);
                

                // $numRowLaluzBeauty = 3;
                // $this->insertLastTable($event, $laluzRowsBeauty, $numRowLaluzBeauty);
                // $numRowChalco = $numRowLaluzBeauty + ((count($laluzRowsBeauty) > 0 ? count($laluzRowsBeauty) : 1)  * 2);
                // $this->insertLastTable($event, $chalcoRowsBeauty, $numRowChalco);
                // $numRowPorteo = $numRowChalco + ((count($chalcoRowsBeauty) > 0 ? count($chalcoRowsBeauty) : 1) * 2);
                // $this->insertLastTable($event, $porteoRowsBeauty, $numRowPorteo);

                // $laluzRowsPets = $this->splitLastTable([7464], $this->thirdTablePets);
                // $chalcoRowsPets = $this->splitLastTable([7471], $this->thirdTablePets);
                // $porteoRowsPets = $this->splitLastTable([4188, 4640, 4924, 7468, 7487, 7490, 7493], $this->thirdTablePets);
                
                // $numRowLaluzPets = $numRowPorteo + ((count($porteoRowsBeauty) > 0 ? count($porteoRowsBeauty) : 1)  * 2) + 4;
                // $this->insertLastTable($event, $laluzRowsPets, $numRowLaluzPets);
                // $numRowChalcoPets = $numRowLaluzPets + ((count($laluzRowsPets) > 0 ? count($laluzRowsPets) : 1) * 2);
                // $this->insertLastTable($event, $chalcoRowsPets, $numRowChalcoPets);
                // $numRowPorteoPets = $numRowChalcoPets + ((count($chalcoRowsPets)  > 0 ? count($chalcoRowsPets) : 1) * 2);
                // $this->insertLastTable($event, $porteoRowsPets, $numRowPorteoPets);



                // foreach($this->thirdTableBeauty as $key => $row){
                //     // $numRow = $key + 3;
                //     // if($numRow > $lastRow){
                //     //     $lastRow++;
                //     //     $event->getWriter()->getSheetByIndex(0)->insertNewRowBefore($numRow);
                //     // }
                //     if($key != 0){
                //         foreach($row as $key => $value){
                //             if($row["Determinante"] == 7464){
                //                 if($key == "CEPILLO DE BAMBÚ REDONDO"){
                //                     $event->getWriter()->getSheetByIndex(2)->setCellValue('F:'.$numRow, $value); 
                //                 }elseif($key == "CEPILLO DE BAMBÚ GRANDE"){
                //                     $event->getWriter()->getSheetByIndex(2)->setCellValue('G:'.$numRow, $value); 
                //                 }elseif($key == "CEPILLO DE BAMBÚ MEDIANO"){
                //                     $event->getWriter()->getSheetByIndex(2)->setCellValue('H:'.$numRow, $value); 
                //                 }elseif($key == "PEINE DE BAMBÚ MEDIANO"){
                //                     $event->getWriter()->getSheetByIndex(2)->setCellValue('I:'.$numRow, $value); 
                //                 }else{
                //                     $event->getWriter()->getSheetByIndex(2)->setCellValue(''.$letterCol.$numRow, $value);     
                //                 }
                                
                //             }
                //             dd($row);
                //             $letterCol = $this->alphabetRange[$key];
                //             $event->getWriter()->getSheetByIndex(1)->setCellValue(''.$letterCol.$numRow, $value);         
                //         }
                //     }
                    
                // }


            },


        ];
    }

    public function splitLastTable($determinant, $table){
        $result = [];
        foreach($table as $key => $row){
            if($key != 0 && in_array($row["Determinante"], $determinant) ){
                array_push($result, $row);
            }
        }
        return $result;
    }
    public function insertLastTable($event, $table, $numRow){
        $headers = array_shift($table);
        $len = count($table);
        $alphabetRange = range('A', 'Z');
                    // $colLimit = $alphabetRange[count($row)];
        foreach($headers as $key => $cell){
            $event->getWriter()->getSheetByIndex(1)->setCellValue($alphabetRange[$key].$numRow-1, $cell); 
            $event->getWriter()->getSheetByIndex(1)->getColumnDimension($alphabetRange[$key])->setWidth(25);
        }
        foreach($table as $key => $row){
            //empezamos en la columna F
            $numCol = 0;
            foreach($row as $key => $value){
                if($headers[$numCol] == $key){
                    $event->getWriter()->getSheetByIndex(1)->setCellValue($alphabetRange[$numCol].$numRow, $value); 
                }
                // elseif($key == "CEPILLO DE BAMBÚ REDONDO" || $key == "CEPILLO DE BAMBU PARA MASCOTAS QUITA NUDOS"){
                //     $event->getWriter()->getSheetByIndex(1)->setCellValue('F'.$numRow, $value); 
                // }elseif($key == "CEPILLO DE BAMBÚ GRANDE" || $key == "CEPILLO DE BAMBU PARA MASCOTAS DUAL CHICO"){
                //     $event->getWriter()->getSheetByIndex(1)->setCellValue('G'.$numRow, $value); 
                // }elseif($key == "CEPILLO DE BAMBÚ MEDIANO" || $key == "CEPILLO DE BAMBU MASCOTAS QUITAPELO OVALADO"){
                //     $event->getWriter()->getSheetByIndex(1)->setCellValue('H'.$numRow, $value); 
                // }elseif($key == "PEINE DE BAMBÚ MEDIANO" || $key == "JUGUETE HUESITO PARA PERROS CHICO"){
                //     $event->getWriter()->getSheetByIndex(1)->setCellValue('I'.$numRow, $value); 
                // }elseif($key == "JUGUETE HUESITO PARA PERROS MEDIANO"){
                //     $event->getWriter()->getSheetByIndex(1)->setCellValue('J'.$numRow, $value); 
                // }elseif($key == "JUGUETE HUESITO PARA PERROS GRANDE"){
                //     $event->getWriter()->getSheetByIndex(1)->setCellValue('K'.$numRow, $value); 
                else{
                    $letterCol = $this->alphabetRange[array_search($key, array_keys($row))];
                    $event->getWriter()->getSheetByIndex(1)->setCellValue(''.$letterCol.$numRow, $value);                                 
                }
                $numCol++;
                // $event->getWriter()->getSheetByIndex(1)->setCellValue(''.$letterCol.$numRow, $value);         
            }
            if($row != end($table)){
                for($i = 0; $i<2; $i++){
                    $event->getWriter()->getSheetByIndex(1)->insertNewRowBefore($numRow+1);
                    // $alphabetRange = range('A', 'Z');
                    // $colLimit = $alphabetRange[count($row)];
                    // $range = "A".($numRow+2).":".$colLimit.($numRow+2);
                    // $event->getWriter()->getSheetByIndex(1)->getStyle($range)->applyFromArray(array(
                    //     'borders' => array(
                    //         'allborders' => array(
                    //             'borderStyle' => Border::BORDER_THIN,
                    //             'color' => ['argb' => '000000'],
                    //         )
                    //     )
                    // ));
                    $numRow++;
                }
            }
            // if($row == $table[0]){
            //     $numRow--;
            // }
        }
    }
}
