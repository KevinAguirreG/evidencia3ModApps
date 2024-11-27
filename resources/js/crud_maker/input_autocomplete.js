$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	window.inputAutocomplete = function(input) {
		let inputId = $(input).attr("data-hidden-id");
		let source = $(input).attr("data-source");
		let filter = $(input).attr("data-filter");

		$(input).autocomplete({
			source: function( request, response ) {
				//Verificar si se agregará filtro de parent
				var data = new Object();
				if($(input).attr("data-parent") !== undefined) {
					data[$(input).attr("data-parent")] = $("#"+$(input).attr("data-parent")).val();
					//data.parent = $(input).attr("data-parent");
					//data.parent_value = $("#"+$(input).attr("data-parent")).val();
				}
				var filters = [];
				if (filter ?? false) {
					$.each(filter.split(","), function(index, val) {
						data[val] = request.term;
					});
				} else {
					data["param"]  = request.term;
				}
				data['type'] = 'or';
				//data[inputId] = request.term;
				$.ajax({
					url: $('meta[name="app-url"]').attr('content')+"/"+source,
					type: 'GET',
					data: data,
					dataType: 'json',
					success: function(data) {
						response(data);
					}
				});
			},
			minLength: 3,
			open: function() {},
			close: function() {},
			focus: function(event,ui) {},
			select: function(event, ui) {
				$(input).parent().find("#"+inputId).val(ui.item.id);
				if(typeof window[$(input).attr("data-aditionals")] === "function") {
					window[$(input).attr("data-aditionals")](ui.item, input);
				}
			}
		}).keyup(function() {
			if($(this).val().length == 0)
				$(input).parent().find("#"+inputId).val("");
		});
	}

	window.loadAutocomplete = () => {
		$(".input-autocomplete").each(function(index, el) {
			inputAutocomplete($(el));
		});
	}
	loadAutocomplete();
});
