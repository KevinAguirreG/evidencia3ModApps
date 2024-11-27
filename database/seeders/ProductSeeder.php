<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$params = [
			//"client_id" => 2,
			"description" => NULL,
			"department_id" => 2,
			"unit_code" => "H87",
			"unit" => "PIEZA",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => "0.16",
			"factor_type" => "Tasa",
			//"price" => 0,
			"weight" => 1,
		];
		Product::create(array_merge($params, [
			"name" => "CEPILLO DE BAMBÚ REDONDO",
			"upc" => "7506461700259",
			"pieces" => "24",
			"department_id" => 1,
			"product_code" => "53131604",
			"sat_data_id" => 1,
		]));
		Product::create(array_merge($params, [
			"name" => "CEPILLO DE BAMBÚ GRANDE",
			"upc" => "7500462776312",
			"pieces" => "24",
			"department_id" => 1,
			"product_code" => "53131604",
			"sat_data_id" => 1,
		]));
		Product::create(array_merge($params, [
			"name" => "CEPILLO DE BAMBÚ MEDIANO",
			"upc" => "7500462776329",
			"pieces" => "24",
			"department_id" => 1,
			"product_code" => "53131604",
			"sat_data_id" => 1,
		]));
		Product::create(array_merge($params, [
			"name" => "PEINE DE BAMBÚ MEDIANO",
			"upc" => "7500462776336",
			"pieces" => "30",
			"department_id" => 1,
			"product_code" => "53131604",
			"sat_data_id" => 1,
		]));
		Product::create(array_merge($params, [
			"name" => "CEPILLO DE BAMBU PARA MASCOTAS QUITA NUDOS",
			"upc" => "7506461700037",
			"pieces" => "24",
			"product_code" => "10111302",
			//"price" => 56.8954,
			"sat_data_id" => 2,
		]));
		Product::create(array_merge($params, [
			"name" => "CEPILLO DE BAMBU PARA MASCOTAS DUAL CHICO",
			"upc" => "7506461700167",
			"pieces" => "24",
			"product_code" => "10111302",
			//"price" => 71.1259,
			"sat_data_id" => 2,
		]));

		Product::create(array_merge($params, [
			"name" => "JUGUETE HUESITO PARA PERROS CHICO",
			"upc" => "7506461700273",
			"pieces" => "30",
			"product_code" => "10111301",
			//"price" => 51.2,
			"sat_data_id" => 3,
		]));
		Product::create(array_merge($params, [
			"name" => "JUGUETE HUESITO PARA PERROS MEDIANO",
			"upc" => "7506461700280",
			"pieces" => "20",
			"product_code" => "10111301",
			//"price" => 66.73,
			"sat_data_id" => 3,
		]));
		Product::create(array_merge($params, [
			"name" => "JUGUETE HUESITO PARA PERROS GRANDE",
			"upc" => "7506461700297",
			"pieces" => "15",
			"product_code" => "10111301",
			//"price" => 82.24,
			"sat_data_id" => 3,
		]));


		/** HEB */
		$params = [
			//"client_id" => 1,
			"description" => NULL,
			"capacity" => "1.00 Pieza",
			"pieces" => 24,
			"department_id" => 2,
			"product_code" => "10111302",
			"unit_code" => "H87",
			"unit" => "PIEZA",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => "0.16",
			"factor_type" => "Tasa",
			//"price" => 0,
		];
		Product::create(array_merge($params, [
			"product_number" => "765585", 
			"name" => "CEPILLO DE BAMBU MASCOTAS DUAL", 
			"upc" => "7506461700051",
			//"price" => 92.4571,
		]));
		//Product::create(array_merge($params, ["product_number" => "765587", "name" => "CEPILLO DE BAMBU MASCOTAS QUITANUDOS", "upc" => "7506461700037"]));
		Product::create(array_merge($params, [
			"product_number" => "765588", 
			"name" => "CEPILLO DE BAMBU MASCOTAS QUITAPELO CUADRADO", 
			"upc" => "7506461700006",
			//"price" => 73.4913,
		]));
		Product::create(array_merge($params, [
			"product_number" => "765589", 
			"name" => "CEPILLO DE BAMBU MASCOTAS QUITAPELO OVALADO", 
			"upc" => "7506461700013",
			//"price" => 78.2329,
		]));
		//Product::create(array_merge($params, ["product_number" => "765586", "name" => "CEPILLO DE BAMBU MASCOTAS DUAL CHICO", "upc" => "7506461700167"]));

	}
}
