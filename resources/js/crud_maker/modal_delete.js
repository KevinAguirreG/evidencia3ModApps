$(function() {
	window.showDeleteModal = (entity, id, params = null, isDataTable = true) => {
		//$('#deleterowForm').attr('action', $('meta[name="app-url"]').attr('content')+"/"+entity+"/"+id);
		var title = '';
		var message = '';
		if(window.i18n[entity] !== undefined) {
			title = window.i18n[entity]['title_delete'] ?? '';
			message = window.i18n[entity]['confirm_delete'] ?? '';
		}

		if(title != '') {
			$('#deleterowModal .modal-title').html();
		}
		if(message != '') {
			$('#deleterowModal .alert .alert-message').html(message);
		}

		const params2 = params == null ? null : `'${params }'`;
		$('#deleterowModal .button-delete').attr('onclick', `deleteRow('${entity}', ${id}, ${params2}, ${isDataTable})`);
		$('#deleterowModal').modal('show');

	}

	window.deleteRow = (entity, id, params = null, isDataTable = true) => {
		if (params != null) {
			params = JSON.parse(window.atob(params));
		}
		// console.log($('meta[name="app-url"]').attr('content')+'/'+entity+'/'+id+'/'+isDataTable);
		$.ajax({
			url:  $('meta[name="app-url"]').attr('content')+'/'+entity+'/'+id,
			type: 'DELETE',
			dataType: 'json',
			success: function(response) {
				$('#deleterowModal').modal('hide');
				displayMessage(response.message, (response.status ? "success" : "danger"));
				if (params != null) {
					if(typeof window[params.saveAditionals] === "function") {
						window[params.saveAditionals](response.data);
					}
				}
				if(isDataTable){
					reloadDatatable();
				}else{
					location.reload();
				}
			}
		}).fail(function(response) {
			//si hubo error en la validación
			if(typeof response.responseJSON.message !== "undefined") {
				var el = $(".message-container");
				displayMessage(response.responseJSON.errors, "danger", el);
			}
		});
	}
});