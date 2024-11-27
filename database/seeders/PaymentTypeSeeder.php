<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		PaymentType::create(["name" => "01", "description" => "Efectivo"]);
		PaymentType::create(["name" => "02", "description" => "Cheque nominativo"]);
		PaymentType::create(["name" => "03", "description" => "Transferencia electrónica de fondos"]);
		PaymentType::create(["name" => "04", "description" => "Tarjeta de crédito"]);
		PaymentType::create(["name" => "05", "description" => "Monedero electrónico"]);
		PaymentType::create(["name" => "06", "description" => "Dinero electrónico"]);
		PaymentType::create(["name" => "08", "description" => "Vales de despensa"]);
		PaymentType::create(["name" => "12", "description" => "Dación en pago"]);
		PaymentType::create(["name" => "13", "description" => "Pago por subrogación"]);
		PaymentType::create(["name" => "14", "description" => "Pago por consignación"]);
		PaymentType::create(["name" => "15", "description" => "Condonación"]);
		PaymentType::create(["name" => "17", "description" => "Compensación"]);
		PaymentType::create(["name" => "23", "description" => "Novación"]);
		PaymentType::create(["name" => "24", "description" => "Confusión"]);
		PaymentType::create(["name" => "25", "description" => "Remisión de deuda"]);
		PaymentType::create(["name" => "26", "description" => "Prescripción o caducidad"]);
		PaymentType::create(["name" => "27", "description" => "A satisfacción del acreedor"]);
		PaymentType::create(["name" => "28", "description" => "Tarjeta de débito"]);
		PaymentType::create(["name" => "29", "description" => "Tarjeta de servicios"]);
		PaymentType::create(["name" => "30", "description" => "Aplicación de anticipos"]);
		PaymentType::create(["name" => "31", "description" => "Intermediario pagos"]);
		PaymentType::create(["name" => "99", "description" => "Por definir"]);
	}
}
