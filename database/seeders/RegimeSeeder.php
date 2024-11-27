<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regime;

class RegimeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Regime::create(["name" => "601", "description" => "General de Ley Personas Morales", "is_physical" => 0, "is_moral" => 1]);
		Regime::create(["name" => "603", "description" => "Personas Morales con Fines no Lucrativos", "is_physical" => 0, "is_moral" => 1]);
		Regime::create(["name" => "605", "description" => "Sueldos y Salarios e Ingresos Asimilados a Salarios", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "606", "description" => "Arrendamiento", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "607", "description" => "Régimen de Enajenación o Adquisición de Bienes", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "608", "description" => "Demás ingresos", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "610", "description" => "Residentes en el Extranjero sin Establecimiento Permanente en México", "is_physical" => 1, "is_moral" => 1]);
		Regime::create(["name" => "611", "description" => "Ingresos por Dividendos (socios y accionistas)", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "612", "description" => "Personas Físicas con Actividades Empresariales y Profesionales", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "614", "description" => "Ingresos por intereses", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "615", "description" => "Régimen de los ingresos por obtención de premios", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "616", "description" => "Sin obligaciones fiscales", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "620", "description" => "Sociedades Cooperativas de Producción que optan por diferir sus ingresos", "is_physical" => 0, "is_moral" => 1]);
		Regime::create(["name" => "621", "description" => "Incorporación Fiscal", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "622", "description" => "Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras", "is_physical" => 0, "is_moral" => 1]);
		Regime::create(["name" => "623", "description" => "Opcional para Grupos de Sociedades", "is_physical" => 0, "is_moral" => 1]);
		Regime::create(["name" => "624", "description" => "Coordinados", "is_physical" => 0, "is_moral" => 1]);
		Regime::create(["name" => "625", "description" => "Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas", "is_physical" => 1, "is_moral" => 0]);
		Regime::create(["name" => "626", "description" => "Régimen Simplificado de Confianza", "is_physical" => 1, "is_moral" => 1]);
	}
}
