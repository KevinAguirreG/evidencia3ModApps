<?php

namespace App\Imports;

use App\Models\Buying;
use App\Models\BuyingRow;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class BuyingRowsImport implements 
    ToCollection, 
    WithHeadingRow,
    WithCalculatedFormulas,
    WithValidation
    // SkipsOnFailure
    
{   
    //SkipsFailures
    use Importable;

    private $products;
    private $buyings;
    public function __construct($buying_id)
    {
        $this->buyings = Buying::where('id', $buying_id)->first();
        $this->products = Product::pluck('id','name');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $rules = [
                'clave_de_producto_zamexco' => ['required', 'integer', 'exists:products,upc'],
                'clave_de_producto_proveedor' => ['required', 'integer'],
                'num_de_piezas_solicitadas' => ['required', 'float'],
                'costo' => ['required', 'float'],
                // Agrega reglas para otros campos aquí
            ];
            
            $validator = Validator::make($row->toArray(), $rules);
            
            if ($validator->fails()) {
                // Puedes manejar los errores aquí, por ejemplo, guardarlos en un registro de errores
                // o mostrar mensajes de error al usuario.
                $errors = $validator->errors()->all();
                // Realiza la lógica para manejar los campos vacíos o inválidos
                // Por ejemplo: Log::error("Errores en la fila: " . json_encode($row));
                // O mostrar un mensaje al usuario con los errores.
            } else {
                $product = Product::where("UPC", $row["clave_de_producto_zamexco"])->first();
                if(isset($product->id)){
                    $buyingrow = BuyingRow::create([
                        'buying_id' => $this->buyings->id,
                        'product_id' => $product->id,
                        'barcode' => $row["clave_de_producto_proveedor"],
                        'UPC' => $row["clave_de_producto_zamexco"],
                        'amount' => $row["num_de_piezas_solicitadas"],
                        'price' => $row["costo"],
                        'total' => $row["precio_total"],
                    ]);
                }
                // Los datos son válidos, procesa la fila aquí
                // Por ejemplo: YourModel::create($row->toArray());
               
            }
        }


        

        // return new BuyingRow([
        //     'buying_id'     => 1, //a
        //     'product_id'     => $this->products[$row['nombre_de_producto']], //b
        //     'barcode'     => $row['clave_de_producto_proveedor'], //c
        //     'UPC'     => $row['clave_de_producto_zamexco'], //c
        //     'amount'     => $row['num_de_piezas_solicitadas'], //d
        //     'price'     => $row['costo'], //e
        //     'total'     => $row['precio_total'], //f
        // ]);
    }

   public function rules(): array
   {
        return[
            '*clave_de_producto_zamexco' => ['required', 'integer', 'exists:products,upc'],
                '*clave_de_producto_proveedor' => ['required', 'integer'],
                '*num_de_piezas_solicitadas' => ['required', 'float'],
                'costo' => ['required', 'float'],
        ];
   }

  
}
