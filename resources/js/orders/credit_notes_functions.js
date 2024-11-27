$(function() {
	window.calculateTotal = (input) => {
		const totalBase = parseFloat($(input).val());
		let iva = parseFloat((totalBase * 0.16).toFixed(6));
		let total = (totalBase+iva).toFixed(6);
		let totalDisplay = window.customRound(total, "ceil", 2);

		$(input).closest("form").find("#iva").val(iva.toFixed(6));
		$(input).closest("form").find("#total").val(total);
		$(input).closest("form").find("#total_display").val(parseFloat(totalDisplay).toFixed(6));
	}
});