$(function() {
	window.loadPayment = (data, input) => {
		let row = $(input).closest(".payment-row");
		$(row).find("input#amount").attr({
			"type": "number",
			"placeholder": data.total_pending,
			"max": data.total_pending,
			"step": 100,
			"value": data.total_pending,
		})
	}
	window.addAndNext = (button) => {
		let row = $(button).closest(".payment-row");
		let validate = window.validateRow(row);
		if (validate.status) {
			$(row).addClass("row-checked");
			$(row).find("input#order_input").attr("readonly", true);
			$(row).find("input#amount").attr("readonly", true).val(window.customRound($(row).find("input#amount").val()));
			$(row).find("div.row-check").addClass("d-none");
			$(row).find("div.row-delete").removeClass("d-none");
			calculateTotal();
			addRow();
		} else {
			handleMessage(validate);
		}
	}
	window.addRow = () => {
		$.ajax({
			url: $('meta[name="app-url"]').attr('content')+"/order_payments/add_payment_row",
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				$(".payments-container").append(response);
				loadAutocomplete();
			}
		});
	}
	window.deleteModalRow = (button) => {
		if (confirm("Está seguro que desea eliminar este pago")) {
			$(button).closest(".payment-row").remove();
			window.calculateTotal();
		}
	}
	window.calculateTotal = (row) => {
		let total_payment = parseFloat($("#total").val());
		let total_paid = window.getTotalPaid();

		//$("#display_total_payment").html(moneyFormat(total_payment));
		$("#display_total_paid").html(window.moneyFormat(total_paid));
		//$("#display_total_pending").html(moneyFormat(total_payment-total_paid));
	}

	window.getTotalPaid = () => {
		let total_paid = 0;
		$(".payments-container .payment-row").each(function (index, el) {
			if ($(this).hasClass("row-checked")) {
				total_paid += parseFloat($(this).find("#amount").val());
			}
		});
		return total_paid;
	}
	
	window.availableAmountToAdd = (amount) => {
		let total_payment = parseFloat($("#total").val());
		let total_paid = window.getTotalPaid();
		console.log(total_paid+parseFloat(amount), total_payment);
		return (total_paid+parseFloat(amount) <= total_payment);
	}
	window.customRound = (value, type = "floor", exp = 2) => {
		let temp = Math[type](`${Number(value)}e${Number(exp)}`);
		return Number(`${temp}e${Number(-exp)}`).toFixed(exp);
	}
	window.moneyFormat = (param) => "$ "+parseFloat(param).toFixed(2);

	window.savePayments = (params) => {
		let validate = window.validateForm("#order_payments-quickmodal");
		if (validate.status) {
			$("#btnSave").attr("disabled", true);
			$("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'wait');
			let payments = [];
			$(".payments-container .payment-row").each(function (index, el) {
				if ($(this).hasClass("row-checked")) {
					payments.push({
						"order_id": $(this).find("input#order_id").val(),
						"amount": $(this).find("input#amount").val(),
					});
				}
			});
			$.ajax({
				url: $('meta[name="app-url"]').attr('content')+"/order_payments",
				type: 'POST',
				data: {
					//total: $("form#order_payments-quickmodal #total").val(),
					total: window.getTotalPaid(),
					client_id: $("form#order_payments-quickmodal #client_id").val(),
					payment_date: $("form#order_payments-quickmodal #payment_date").val(),
					payment_type_id: $("form#order_payments-quickmodal #payment_type_id").val(),
					payment_method_id: $("form#order_payments-quickmodal #payment_method_id").val(),
					payments: payments
				},
				dataType: 'json',
				success: function(response) {
					if(response.data !== undefined) {
						$("#order_payments-quickadd").trigger("reset");
						$(".order_payments-modal").modal('hide');
						$(".order_payments-modal").remove();

						displayMessage(response.message, (response.status ? "success" : "danger"));
						
						let dt = window.LaravelDataTables["order_payments-table"];
						dt.ajax.reload();
					} else {
						var el = $("#order_payments-quickmodal").find(".message-container");
						displayMessage(response.message, (response.status ? "success" : "danger"), el);
						
						$("#btnSave").attr("disabled", false);
						$("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
					}
				}
			}).fail(function(response) {
				//si hubo error en la validación
				if(typeof response.responseJSON.message !== "undefined") {
					var el = $("#order_payments-quickmodal").find(".message-container");
					displayMessage(response.responseJSON.errors, "danger", el);
				}
				$("#btnSave").attr("disabled", false);
				$("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
			});
		
		} else {
			handleMessage(validate);
		}
	}

	
	//#region Validations
	window.validateRow = (row) => {
		let result = { status: true, message: "" };
		//clear
		clearErrors();

		if ($(row).find("input#order_id").val() == "") {
			result.status = false;
			result.message = "Necesita seleccionar una factura válida";
			result.target = $(row).find("input#order_input");
		}
		if (result.status && $(row).find("input#amount").val() == "") {
			result.status = false;
			result.message = "Necesita ingresar una cantidad a pagar válida";
			result.target = $(row).find("input#amount");
		}
		if (result.status && $(row).find("input#amount").hasClass("text-danger")) {
			result.status = false;
			result.message = "La cantidad ingresada sobrepasa el saldo insoluto de la factura";
			result.target = $(row).find("input#amount");
		}
		/*if (result.status && !availableAmountToAdd($(row).find("input#amount").val())) {
			result.status = false;
			result.message = "La cantidad ingresada sobrepasa el saldo del complemento";
			result.target = $(row).find("input#amount");
		}*/
		return result;
	}

	window.validateForm = () => {
		let result = { status: true, message: "" };
		
		//clear
		clearErrors();

		/*if ($("form#order_payments-quickmodal").find("#total").val() == "") {
			result.status = false;
			result.message = "Necesita ingresar un total válido";
			result.target = $("form#order_payments-quickmodal").find("#total");
		}*/
		if (result.status && $("form#order_payments-quickmodal").find("#client_id").val() == "") {
			result.status = false;
			result.message = "Necesita seleccionar un cliente válido";
			result.target = $("form#order_payments-quickmodal").find("#client_id");
		}
		if (result.status && $("form#order_payments-quickmodal").find("#payment_date").val() == "") {
			result.status = false;
			result.message = "Necesita ingresar una fecha de pago válida";
			result.target = $("form#order_payments-quickmodal").find("#payment_date");
		}
		if (result.status && $("form#order_payments-quickmodal").find("#payment_type_id").val() == "") {
			result.status = false;
			result.message = "Necesita seleccionar una forma de pago válida";
			result.target = $("form#order_payments-quickmodal").find("#payment_type_id");
		}
		if (result.status && $("form#order_payments-quickmodal").find("#payment_method_id").val() == "") {
			result.status = false;
			result.message = "Necesita seleccionar un método de pago válido";
			result.target = $("form#order_payments-quickmodal").find("#payment_method_id");
		}
		if (result.status && getTotalPaid() == 0) {
			result.status = false;
			result.message = "Necesita ingresar un pago válido";
			result.target = $("form#order_payments-quickmodal").find("input#order_input");
		}
		getTotalPaid
		return result;
	}

	window.validateAmount = (input) => {
		if (parseFloat($(input).val()) > parseFloat($(input).attr("max"))) {
			$(input).addClass("text-danger");
		} else {
			$(input).removeClass("text-danger");
		}
	}
	window.clearErrors = () => {
		let fields = ["#total","#client_id","#payment_date","#payment_type_id","#payment_method_id","#order_input", "input[name=order_input]","input[name=amount]"];
		$.each(fields, function (index, val) { 
			$(val).removeClass("validate-error");
		});
	}
	window.handleMessage = (validate) => {
		alert(validate.message);
		$(validate.target).addClass("validate-error").trigger("focus");
	}
	//#endregion

});