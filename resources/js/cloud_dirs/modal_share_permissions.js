$(function() {
	window.showSharePermissionsModal = (params) => {
		var params = JSON.parse(window.atob(params));
		var cRute = params.route !== undefined ? params.route : params.entity;
		//let entity = params.entity;
		console.log(params.id)
			$.ajax({
				url: $('meta[name="app-url"]').attr('content')+"/cloud_dirs/getsharepermissionsmodal/"+params.id,
				type: 'GET',
				data: {params: params},
				dataType: 'json',
				success: function(response) {
					$("."+params.entity+"-modal").remove();
					$("body").append(response);
					
					$("#sharepermissionModal").modal('show');
					loadAutocomplete();
				}
			});
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
		
	}
});