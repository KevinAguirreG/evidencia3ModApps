<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CfdiUse;

class CfdiUseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		CfdiUse::create(["name" => "G01", "description" => "Adquisición de mercancías."]);
		CfdiUse::create(["name" => "G02", "description" => "Devoluciones, descuentos o bonificaciones."]);
		CfdiUse::create(["name" => "G03", "description" => "Gastos en general."]);
		CfdiUse::create(["name" => "I01", "description" => "Construcciones."]);
		CfdiUse::create(["name" => "I02", "description" => "Mobiliario y equipo de oficina por inversiones."]);
		CfdiUse::create(["name" => "I03", "description" => "Equipo de transporte."]);
		CfdiUse::create(["name" => "I04", "description" => "Equipo de computo y accesorios."]);
		CfdiUse::create(["name" => "I05", "description" => "Dados, troqueles, moldes, matrices y herramental."]);
		CfdiUse::create(["name" => "I06", "description" => "Comunicaciones telefónicas."]);
		CfdiUse::create(["name" => "I07", "description" => "Comunicaciones satelitales."]);
		CfdiUse::create(["name" => "I08", "description" => "Otra maquinaria y equipo."]);
		CfdiUse::create(["name" => "D01", "description" => "Honorarios médicos, dentales y gastos hospitalarios."]);
		CfdiUse::create(["name" => "D02", "description" => "Gastos médicos por incapacidad o discapacidad."]);
		CfdiUse::create(["name" => "D03", "description" => "Gastos funerales."]);
		CfdiUse::create(["name" => "D04", "description" => "Donativos."]);
		CfdiUse::create(["name" => "D05", "description" => "Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)."]);
		CfdiUse::create(["name" => "D06", "description" => "Aportaciones voluntarias al SAR."]);
		CfdiUse::create(["name" => "D07", "description" => "Primas por seguros de gastos médicos."]);
		CfdiUse::create(["name" => "D08", "description" => "Gastos de transportación escolar obligatoria."]);
		CfdiUse::create(["name" => "D09", "description" => "Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones."]);
		CfdiUse::create(["name" => "D10", "description" => "Pagos por servicios educativos (colegiaturas)."]);
		CfdiUse::create(["name" => "S01", "description" => "Sin efectos fiscales."]);
		CfdiUse::create(["name" => "CP01", "description" => "Pagos."]);
		CfdiUse::create(["name" => "CN01", "description" => "Nómina."]);
	}
}
