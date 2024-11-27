$(function() {
	const wait = m => new Promise(r => setTimeout(r, m));
	//#region Ajax calls
		window.addOrder = () => {
			let validated = true;
			if (!($("#order_id").val() ?? false)) {
				alert("Seleccione una orden válida");
			}
		
			if (validated) {
				$.ajax({
					url: $('meta[name="app-url"]').attr('content') + "/deliveries/addOrder",
					type: 'GET',
					data: { order_id: $("#order_id").val(), delivery_id: $("#delivery_id").val() },
					success: function(response) {
						displayMessage(response.message, (response.status ? "success" : "danger"));
						if (response.status) {
							window.LaravelDataTables["delivery_rows-table"].draw();
						}
					}
				});
			}
		}
		
		window.updateDeliveryStatus = async (delivery_id, delivery_status_id) => {
			let displayTab = true;
			const result = await $.ajax({
				url: $('meta[name="app-url"]').attr('content')+`/deliveries/${delivery_id}/updateDeliveryStatus`,
				type: 'GET',
				data: { delivery_id: delivery_id, delivery_status_id: delivery_status_id },
			});
			if (!(result.status ?? false)) {
				console.log(result.message);
				displayTab = false;
			} else {
				$("#delivery_status_id").val(delivery_status_id);
			}
			return displayTab;
		}
		
		
		window.displayConfirmationModal = async () => {
			const result = await $.ajax({
				url: $('meta[name="app-url"]').attr('content')+`/confirmations/getquickmodalcontent`,
				type: 'GET',
				data: { params: {
					entity_source: "confirmations",
					entity: "confirmations",
					saveAditionals: 'setConfirmated',
					delivery_id: $("#delivery_id").val()
				}},
			});
			
			if (result != "") {
				$(".confirmations-modal").remove();
				$("body").append(result);
				$(".confirmations-modal").css('z-index', getModalZIndex()).modal('show');
				loadAutocomplete();
			}
		}
	//#endregion Ajax calls
	
	
	//#region Tabs
		let tabsEntity = "delivery";
		window.deliveryMoveStep = async (delivery_status_id, doAction) => {
			let updateStatus = delivery_status_id != $("#delivery_status_id").val();
			//$("#delivery_status_id").val(delivery_status_id);
			let displayTab = true;
		
			//Set active only the current tab
			switch (parseInt(delivery_status_id)) {
				case 1:
					disableAllTabs();
					enableTab("order", true, true);
					break;
				case 2:
					if (updateStatus ?? false) {
						if (window.LaravelDataTables["delivery_rows-table"].data().count() > 0) {
							displayTab = await updateDeliveryStatus($("#delivery_id").val(), delivery_status_id);
						} else {
							displayTab = false;
							enableTab("order", true, true);
							alert("Agregue una orden");
							$("#order_input").trigger("focus");
						}
					}
					if (displayTab) {
						disableAllTabs();
						enableTab("order-request", true, true);
						enableTab("wb", false, true);
					}
					break;
				case 3:
					if (updateStatus) {
						await displayConfirmationModal();
					} else {
						disableAllTabs();
						enableTab("order-request");
						enableTab("wb");
						enableTab("confirmation");
						enableTab("template", true, true);
						enableTab("delivery", false, true);
					}
					break;
				case 4:
					if (updateStatus ?? false) {
						displayTab = await updateDeliveryStatus($("#delivery_id").val(), delivery_status_id);
					}
					if (displayTab) {
						disableAllTabs();
						enableTab("order-request");
						enableTab("wb");
						enableTab("confirmation");
						enableTab("template");
						enableTab("delivery");
						enableTab("proof", true, true);
					}
					break;
				case 5:
					if (updateStatus ?? false) {
						displayTab = await updateDeliveryStatus($("#delivery_id").val(), delivery_status_id);
					}
					if (displayTab) {
						disableAllTabs();
						enableTab("order-request");
						enableTab("wb");
						enableTab("confirmation");
						enableTab("template");
						enableTab("delivery");
						enableTab("proof", true);
					}
					break;
				default:
					break;
			}
		}
		
		window.setConfirmated = async (data) => {
			//disableAllTabs();
			$("#deliveryTabContent #confirmation").html(data);
			let displayTab = await updateDeliveryStatus($("#delivery_id").val(), 3);
			deliveryMoveStep($("#delivery_status_id").val());
		}
		
		window.disableAllTabs = () => {
			//Clear all tabs
			$(`#${tabsEntity}-tabs button.nav-link`).each(function (index, el) {
				$(el).removeClass("active").addClass("disabled");
			});
			$(`#${tabsEntity}TabContent > .tab-pane`).each(function (index, el) {
				$(el).removeClass("show active");
			});
		}
		
		//Enable the given tab and makes it active
		window.enableTab = async (name, activeTab = false, activeButton = false) => {
			const t = $(`#${tabsEntity}-tabs button#${name}-tab`);
			const ct = $(`#${tabsEntity}TabContent > div#${name}`);
			t.removeClass("disabled");
			if (activeTab) {
				t.addClass("active");
				ct.addClass("show active");
				t.trigger('click');

				
				await loadDatatableData(ct.find("input.datatableName").val());
			}
			
			if (activeButton) {
				ct.find("button.action-button").addClass("d-inline-block");
			} else {
				ct.find("button.action-button").addClass("d-none");
			}
		}

		window.loadDatatableData = async (name) => {
			await wait(200);
			if (name ?? false) {
				if (window?.LaravelDataTables?.[`${name}-table`] ?? false) {
					window.LaravelDataTables[`${name}-table`].draw();
				} else {
					window["tab-dt"][name]();
				}
			}
		}
		
		//Enable the given tab and makes it active
		
		
		$("button[data-bs-toggle='tab']").on("click", async function(e) {
			const ct = $(`#${tabsEntity}TabContent > div${$(this).attr("data-bs-target")}`);
			await loadDatatableData(ct.find("input.datatableName").val());
		});
	//#endregion Tabs

	//#region Upload Files
		window.addNewDeliveryFileRow = async () => {
			const response = await $.ajax({
				url: $('meta[name="app-url"]').attr('content') + "/deliveries/add_file_row",
				type: 'GET',
			});

			if(response !== "") {
				$("#files-container").append(response);
			}
		}

		window.deleteDeliveryFileRow = (param) => {
			$(param).closest(".container-row").remove();
		}

		window.uploadDeliveryFile = (button) => {
			const row = $(button).closest(".container-row");

			//Validate
			let validated = true;
			if ($(row).find("#file_path").val() == "") {
				alert("Seleccione un archivo correcto");
				$(row).find("#file_path").trigger("focus");
				validated = false;
			}

			if (validated) {
				const data = new FormData();

				//Add file to formdata
				var files = $(row).find("#file_path")[0].files;
				if (files.length > 0) {
					data.append('file_path', files[0]);
				}
				data.append('description', $(row).find("#description").val());
				data.append('delivery_id', $("#delivery_id").val());



				$.ajax({
					url: $('meta[name="app-url"]').attr('content')+'/delivery_files',
					type: 'POST',
					data: data,
					dataType: 'json',
					contentType: false,
					processData: false,
					success: function(response) {
						if(response.status) {
							$("#deliveryTabContent #proof").html(response.data);
						}
					}
				}).fail(function(response) {
					//si hubo error en la validación
					if(typeof response.responseJSON.message !== "undefined") {
						var el = $("form#"+form+"-edit").closest("li.accordion-item").find(".message-container");
						displayMessage(response.responseJSON.errors, "danger", el);
					}
				});
			}
			

		}
	//#endregion Upload Files
	
	deliveryMoveStep($("#delivery_status_id").val());
});