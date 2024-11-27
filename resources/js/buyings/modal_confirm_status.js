$(function() {
	window.showConfirmStatusModal = (entity, id, params = null) => {
		//$('#deleterowForm').attr('action', $('meta[name="app-url"]').attr('content')+"/"+entity+"/"+id);
		var title = '';
		var message = '';

		title = window.i18n.es['title_confirm_status'] ?? '';
		message = window.i18n.es['confirm_status'] ?? '';
		
		if(title != '') {
			$('#confirmrowModal .modal-title').html(title);
		}
		if(message != '') {
			$('#confirmrowModal .alert .alert-message').html(message);
		}
		const params2 = params == null ? null : `'${params }'`;
		
		$('#confirmrowModal .button-delete').attr('onclick', `updateValue('${entity}', ${id}, ${params2})`);
		$('#confirmrowModal').modal('show');
	}


	window.updateValue = (entity, id, params = null) => {
		if (params != null) {
			params = JSON.parse(window.atob(params));
		}
		window.location.href = $('meta[name="app-url"]').attr('content')+'/'+entity+'/changeStatus/'+id;
		
	}
});