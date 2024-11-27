<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasFactory;
	
	protected $table = 'orders';
	protected $fillable = ['client_id', 'payment_type_id', 'payment_method_id', 'branch_code', 'order_number', 'order_date', 'shipping_date', 'cancel_date', 'order_type', 'currency_type', 'department', 'promotional_event', 'payment_terms', 'fob', 'fob_details', 'carrier', 'ship_to', 'gln', 'pay_to', 'store', 'supplier_name', 'supplier_number', 'notes', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at', 'fax', 'supplier_phone'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'client_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('App\Models\User', 'created_by');
	}
	public function paymentMethod()
	{
		return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
	}
	public function paymentType()
	{
		return $this->belongsTo('App\Models\PaymentType', 'payment_type_id');
	}
	public function updatedBy()
	{
		return $this->belongsTo('App\Models\User', 'updated_by');
	}
	
	public function orderRows()
	{
		return $this->hasMany('App\Models\OrderRow');
	}
	
	public function stamp()
	{
		return $this->hasOne('App\Models\OrderStamp');
	}

	//Iterar cada uno de los productos de la orden para obtener el total
	public function getTotal()
	{
		$result = 0;
		if ($this->stamp ?? false) {
			$stamp_array = json_decode(json_encode((array) simplexml_load_string(base64_decode($this->stamp->xml), 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			$result = floatval($stamp_array["@attributes"]["Total"]);
		} else {
			foreach ($this->orderRows as $key => $row) {
				$cost = $row->cost ?? $row->product->price;
				$costTotal = floatval($row->amount) * floatval($cost);
				$result += $costTotal;
			}
			$result *= 1.16;
		}
		return $result;
	}

	//Sumar complementos de pago y notas de crédito para obtener el total pagado
	public function getTotalPaid()
	{
		$result = 0;
		foreach ($this->stamp->payments ?? [] as $key => $value) {
			if ($value->payment->cancel_date == null) {
				$result += floatval($value->total);
			}
		}
		foreach ($this->stamp->creditNotes ?? [] as $key => $value) {
			if ($value->cancel_date == null) {
				$result += floatval($value->total);
			}
		}
		return $result;
	}

	public function hasPaymentOrCreditNotes()
	{
		return $this->getTotalPaid() > 0;
	}

	//Obtener la cantidad que resta por cubrir de la factura timbrada
	public function getPendingAmount()
	{
		return floatval($this->getTotal()) - floatval($this->getTotalPaid());
	}
}