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
		Product::create([
			"client_id" => 1, 
			"name" => "CEPILLO DUAL GRANDE", 
			"upc" => "7506461700051", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 1, 
			"name" => "CEPILLO DE BAMBU MASCOTAS DUAL CHICO", 
			"upc" => "7506461700167", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 1, 
			"name" => "CEPILLO QUITA NUDOS", 
			"upc" => "7506461700037", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 1, 
			"name" => "CEPILLO QUITA PELO CUADRADO", 
			"upc" => "7506461700006", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 1, 
			"name" => "CEPILLO QUITA PELO OVALADO", 
			"upc" => "7506461700013", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);


		Product::create([
			"client_id" => 2, 
			"name" => "CEPILLO DE BAMBU GRANDE", 
			"upc" => "7500462776312", 
			"pieces" => 24, 
			"area" => "SALUD Y BELLEZA",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "CEPILLO DE BAMBU MEDIANO", 
			"upc" => "7500462776329", 
			"pieces" => 24, 
			"area" => "SALUD Y BELLEZA",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "PEINE DE BAMBU MEDIANO", 
			"upc" => "7500462776336", 
			"pieces" => 24, 
			"area" => "SALUD Y BELLEZA",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "CEPILLO DE BAMBU REDONDO", 
			"upc" => "7506461700259", 
			"pieces" => 24, 
			"area" => "SALUD Y BELLEZA",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "CEPILLO DE BAMBU PARA MASCOTA QUITA NUDOS", 
			"upc" => "7506461700037", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "CEPILLO DE BAMBU MASCOTAS DUAL CHICO", 
			"upc" => "7506461700167", 
			"pieces" => 24, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "JUGUETE HUESITO PARA PERROS CHICO", 
			"upc" => "7506461700273", 
			"pieces" => 30, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "JUGUETE HUESITO PARA PERROS MEDIANO", 
			"upc" => "7506461700280", 
			"pieces" => 20, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);
		Product::create([
			"client_id" => 2, 
			"name" => "JUGUETE HUESITO PARA PERROS GRANDE", 
			"upc" => "7506461700297", 
			"pieces" => 15, 
			"area" => "MASCOTAS",
			"product_code" => "53131604",
			"unit_code" => "H87",
			"unit" => "Pieza",
			"gtin_type" => "GTIN-13",
			"tax_id" => 2,
			"tax_type" => "IVA",
			"tax_rate" => 0.160000,
			"factor_type" => "Tasa",
		]);

	}
}
