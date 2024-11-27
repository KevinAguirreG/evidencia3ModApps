<?php
return [
	//Titles
	"title_index" => "Órdenes de compra",
	"title_add" => "Agregar orden de compra",
	"title_show" => "Ver orden de compra",
	"title_edit" => "Modificar orden de compra",
	"title_delete" => "Eliminar orden de compra",

	//Fields
	"id" => "Folio",
	"client_id" => "Cliente",
	"order_number_dates" => "Numero De Oc Y Fechas",
	"order_number" => "Número de orden",
	"order_date" => "Fecha de orden",
	"shipping_date" => "Fecha de envío",
	"cancel_date" => "Fecha de cancelación",

	
	"aditional_details" => "Detalles Adicionales",
	"branch_code" => "Código de CEDIS",
	"order_type" => "Tipo de orden",
	"currency_type" => "Moneda",
	"payment_type" => "Forma Pago",
	"payment_method" => "Método de Pago",
	"payment_type_id" => "Forma Pago",
	"payment_method_id" => "Método de Pago",
	"department" => "Department",
	"promotional_event" => "Promotional Event",
	"payment_terms" => "Payment Terms",
	"fob" => "F.O.B.",
	"fob_details" => "F.O.B. Punto DeEntrega Punto De Embarque",
	"carrier" => "Portador",

	"ship_to" => "Enviar a",
	"pay_to" => "Pagar a",
	"store" => "Formato De Tienda",

	"supplier" => "Proveedor",
	"supplier_name" => "Nombre De Proveedor",
	"supplier_number" => "Supplier Number",
	"addenda" => "Addenda",
	
	"subtotal" => "subtotal",
	"discount" => "discount",
	"total" => "Total",
	"notes" => "Notas",
	"is_stamp" => "Timbrado",
	"is_active" => "Activo",
	"created_by" => "Creado por",
	"updated_by" => "Modificado por",
	"created_at" => "Fecha creado",
	"updated_at" => "Fecha modificado",
	"download_files" => "Descargar facturas",
	"select_invoices" => "Seleccione las facturas a descargar",


	//PDF
	"regime" => "Regimen Fiscal",
	"amount_letter" => "CANTIDAD CON LETRA",
	"aditional_data" => "DATOS COMPLEMENTARIOS DE PAGO",
	"subtotal" => "SUBTOTAL",
	"discount" => "DESCUENTO",
	"taxes" => "IMPUESTOS",
	"invoice_total" => "TOTAL",

	"complements_title" => "DATOS COMPLEMENTARIOS CFDI",
	"folio" => "Folio Fiscal",
	"no_cert" => "CSD del Emisor",
	"exp" => "Lugar Expedición",
	"exp_date" => "Fecha Emisión",
	"cert_date" => "Fecha Certificación",
	"cfdi_type" => "Tipo de CFDI",
	"rows" => "Artículos",

	"order" => "Pegue aquí el contenido de la orden de compra",
	"order_header" => "Encabezado de la orden",
	"order_content" => "Detalles de la orden",
	
	"order_param_not_found" => "No se encontró el dato :param",
	"order_product_not_found" => "No se encontró el producto :product",
	"product_does_not_have_a_price" => "El producto :product no tiene un precio válido",

	"stamp" => "Timbrar factura",
	"invoicexml" => "Descargar XML",
	"invoicepdf" => "Descargar PDF",
	"save_and_stamp" => "Guardar y timbrar",
	"xml_file_not_found" => "No se encontró un archivo XML para descargar.",
	"original_string" => "Cadena Original del complemento de certificación digital del SAT",
	"digital_seal" => "Sello digital",
	"digital_seal_pac" => "Sello digital PAC",
	"rfc_provider" => "RFC Proveedor",
	"cert_date" => "Fecha y Hora de certificación",
	"no_serie" => "No. Serie CSD SAT",
	"footer_disclaimer" => "ESTE DOCUMENTO ES UNA REPRESENTACIÓN IMPRESA DE UN CFDI 4.0",

	//Confirm
	"confirm_stamp" => "¿Está seguro que desea timbrar la factura :param?",
	"confirm_cancel_cfdi" => "¿Está seguro que desea cancelar la factura :param?",
	"confirm_payment" => "¿Está seguro que desea generar el complemento de pago de la factura :param?",

	//Cancel
	"cancel_cfdi" => "Cancelar Factura",
	"successfully_canceled" => "Factura cancelada correctamente",
	"is_canceled" => "Cancelado",

	//Payments
	"payment" => "Generar complemento de pago",
	"successfully_generated_payment" => "Complemento de pago generado correctamente",
	"has_payment" => "Pagado",
	"paymentxml" => "Descargar XML de complemento de pago",
	"order_credit_notes" => [
		"index" => "Ver notas de crédito y pagos",
	],

	//Action messages
	"confirm_delete" => "Se borrará la orden de la base de datos. ¿Desea continuar?",
	"Successfully created" => "Orden creada correctamente",
	"Successfully updated" => "Orden modificada correctamente",
	"Successfully deleted" => "Orden eliminada correctamente",
	"Successfully stamped" => "Orden timbrada correctamente",
	"delete_error_message" => "Error al intentar eliminar la orden de la base de datos",
	"delete_error_message_constraint" => "No se puede eliminar la orden, hay tablas que dependen de este",
];