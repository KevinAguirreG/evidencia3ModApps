$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	window.showQuickAddModal = (params) => {
		var params = JSON.parse(window.atob(params));
		var cRute = params.route !== undefined ? params.route : params.entity;
		//let entity = params.entity;

		//Esto solo se ejecuta si se pasó parent (que hará que se seleccione el valor correspondiente del select)
		let parentValue = "";
		if(params.parent !== undefined) {
			parentValue = $("#"+params.parent).val();
			params.parent_value = parentValue;
		}

		//Si se indicó un campo parent pero no se ha seleccionado una opción en ese parent no se lanzará el modal
		if(params.parent !== undefined && parentValue == "") {
			alert("Seleccione "+ window.i18n[params.entity_source][params.parent]);
		} else {
			$.ajax({
				url: $('meta[name="app-url"]').attr('content')+"/"+cRute+"/getquickmodalcontent"+(params.id !== undefined ? "/"+params.id : ""),
				type: 'GET',
				data: {params: params},
				dataType: 'json',
				success: function(response) {
					$("."+params.entity+"-modal").remove();
					$("body").append(response);
					
					//Esto solo se ejecuta si se pasó parent
					if(params.parent !== undefined) {
						switch(params.inputType) {
							case "autocomplete":
								//Con el id que tenemos buscamos el input que muestra el texto y lo ponemos como readonly y quitamos clase de atutocomplete
								$("."+params.entity+"-modal #"+params.parent).parent()
									.find("input[type=text]").removeClass("input-autocomplete").attr("readonly", true);

								break;
							case "select":
								$("."+params.entity+"-modal #"+params.parent_target).val(parentValue);
								var textDisplay =$("."+params.entity+"-modal #"+params.parent_target+" option:selected").text();
								$("."+params.entity+"-modal #"+params.parent_target).parent().html(`
									<input type="hidden" name="`+params.parent_target+`" id="`+params.parent_target+`" value="`+parentValue+`" />
									<input type="text"  value="`+textDisplay+`" class="form-control" readonly />
								`);

								break;
							default:
								break;
						}
					}
					
					$("."+params.entity+"-modal").css('z-index', getModalZIndex()).modal('show');
					loadAutocomplete();
				}
			});
		}
	}

	window.getModalZIndex = () => {
		var zindex = 1050;
		$(".modal").each(function(index, el) {
			if($(el).hasClass('show'))
				zindex = $(el).css('z-index');
		});
		return parseFloat(zindex) + 10;
	}

	window.saveQuickAdd = (params) => {
		$("#btnSave").attr("disabled", true);
		$("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'wait');
		params = JSON.parse(window.atob(params));
		let action = params.action ?? $("#"+params.entity+"-quickmodal").prop('action');
		let method = params.method ?? 'POST';

		//Get form data and delete empty fields
		let data = new FormData(document.getElementById(params.entity+"-quickmodal"));
		for (let value of data.entries()) {
			if(value[1] === "") {
				data.delete(value[0]);
			}
		}

		$(`#${params.entity}-quickmodal`).find("input[type=checkbox]").each(function (index, el) {
			data.delete($(this).attr('name'));
			data.append($(this).attr('name'), $(this).is(':checked') ? 1 : 0);
		});

		// for (const pair of data.entries()) {
		// 	console.log(`${pair[0]}, ${pair[1]}`);
		// }
		// return false;
		
		$.ajax({
			url: action,
			type: method,
			data: data,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function(response) {
				if(response.data !== undefined) {

					switch(params.inputType) {
						case "autocomplete":
							$("#"+params.targetInputId).val(response.data.id);
							$("#"+params.targetInputDisplay).val(response.data[params.displayValue]);
							break;
						case "select":
							let result = '<option value="'+response.data.id+'">'+response.data[params.displayValue]+'</option>';
							$("#"+params.targetInputId).append(result);
							$("#"+params.targetInputId).val(response.data.id);
							$("#"+params.targetInputId).trigger('change');
							break;
						default:
							break;
					}

					$("#"+params.entity+"-quickadd").trigger("reset");
					$("."+params.entity+"-modal").modal('hide');
					$("."+params.entity+"-modal").remove();

					displayMessage(response.message, (response.status ? "success" : "danger"));
					if(typeof window[params.saveAditionals] === "function") {						
						if(params.isDatatable){
							location.reload();
						}else{
							window[params.saveAditionals](response.data, params.saveAditionalsParams ?? null);
						}

					}
				} else {
					var el = $("#"+params.entity+"-quickmodal").find(".message-container");
					displayMessage(response.message, (response.status ? "success" : "danger"), el);
					
					$("#btnSave").attr("disabled", false);
					$("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
				}
			}
		}).fail(function(response) {
			//si hubo error en la validación
			if(typeof response.responseJSON.message !== "undefined") {
				var el = $("#"+params.entity+"-quickmodal").find(".message-container");
				displayMessage(response.responseJSON.errors, "danger", el);
			}
			$("#btnSave").attr("disabled", false);
			$("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
		});
	}
});