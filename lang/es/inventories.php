<?php
use Illuminate\Support\Carbon;
$initialDate = $initialDate ?? new Carbon('first day of January 2024');
$finalDate = $finalDate ?? (new Carbon(now()->subMonth()->endOfMonth()->toDateString()))->endOfDay();
$months =  $initialDate->diff($finalDate->addMonth())->format("%m");
if($months >= 12){
	$initialDate = $initialDate ?? new Carbon(now()->subMonths(12)->startOfMonth()->toDateString());
	$months = 12;
}
return [
	//Titles
	"title_index" => "Inventarios",
	"title_add" => "Agregar inventario",
	"title_show" => "Ver inventario",
	"title_edit" => "Modificar inventario",
	"title_delete" => "Eliminar inventario",

	//Fields
	"id" => "Id",
	"product_id" => "Producto",
	"product_name" => "Producto",
	"upc" => "UPC",
	"department" => "Departamento",
	"amount" => "Cantidad disponible",
	"is_notifiable" => "Notificaciones",
	"is_critical" => "Crítico",
	"notes" => "Notas",
	"is_active" => "Activo",
	"created_by" => "Creado por",
	"updated_by" => "Modificado por",
	"created_at" => "Fecha creado",
	"updated_at" => "Fecha modificado",
	"count_sales" => "Facturas timbradas <br /> (Últimos $months meses)",
	"amount_sold" => "Cantidad vendida <br /> (Últimos $months meses)",
	"avg_sold" => "Promedio vendido <br /> (Últimos $months meses)",
	"inventory_months" => "Meses de inventario",
	"export_count_sales" => "Facturas timbradas (Últimos $months meses)",
	"export_amount_sold" => "Cantidad vendida (Últimos $months meses)",
	"export_avg_sold" => "Promedio vendido (Últimos $months meses)",

	"download_inventories" => "Descargar inventarios",
	"inventory_does_not_exist" => "No existe el producto :product en inventario",
	"product_does_not_exist" => "No existe el producto :product en inventario",
	"inventory_empty" => "El producto :product no tiene existencias en inventario",
	"inventory_decrease_error" => "La cantidad de :product que desea descontar es mayor a la existencia en inventario",
	"inventory_downloaded_successfully" => "Compras sincronizadas correctamente",

	//Action messages
	"confirm_delete" => "Se borrará el inventario de la base de datos. ¿Desea continuar?",
	"Successfully created" => "Inventario creado correctamente",
	"Successfully updated" => "Inventario modificado correctamente",
	"Successfully deleted" => "Inventario eliminado correctamente",
	"delete_error_message" => "Error al intentar eliminar el inventario de la base de datos",
	"delete_error_message_constraint" => "No se puede eliminar el inventario, hay tablas que dependen de este",
];