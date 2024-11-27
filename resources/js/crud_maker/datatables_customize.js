$(function() {
	var entity = $("#entity").val();
	window.isModal = 0;

	window.customizeDatatable = (isModal = 1) => {
		window.isModal = isModal;
		let filter = $(".dataTables_wrapper .dataTables_filter");
		//Customize the search input
		filter.addClass('search-box me-2 mb-2 row');
		filter.find("input[type=search]").closest("label")
			.addClass('position-relative col-12 col-sm-4').append(`<i class="bx bx-search-alt search-icon"></i>`);
		filter.find("input[type=search]").addClass('form-control');

		/*let searchInput = filter.find("input[type=search]")[0];
		filter.find("input[type=search]").closest("label").remove();
		filter.append(`
			<div class="col-12 col-sm-4 section-search">
				<div class="row">
					<label class="col-12 col-sm-4 col-xxl-2 text-end">Buscar:</label>
					<div class="col-12 col-sm-8 col-xxl-10">
						${searchInput.outerHTML ?? ''}
					<div>
				<div>
			<div>
		`);*/

		//Add buttons section
		filter = buildButtonsSection(filter);

		//Add advanced filters section
		//This code copies the section advancedFilters on dtAdvancedFilters to make it look aside the find input in datatable
		if ($(".advancedFilters").length > 0) {
			if ($(".dtAdvancedFilters").length == 0) {
				filter.append(`
					<div class="col-12 mt-4 dtAdvancedFilters">
						${$(".advancedFilters").html() ?? ''}
					<div>
				`);
			}
			$(".advancedFilters").html("");
		}
		
		
		//Change pagination links
		var paginate = $(".dataTables_wrapper .dataTables_paginate");
		paginate.addClass('pagination pagination-rounded justify-content-end mb-2');
		paginate.find(".previous").html(addIcon('<i class="mdi mdi-chevron-left"></i>'));
		paginate.find(".next").html(addIcon('<i class="mdi mdi-chevron-right"></i>'));
		paginate.find("> span").css('display', 'inline-flex');
		paginate.find("span a").each(function(index, el) {
			if ($(el).find(".page-item").length == 0) {
				var classList = el.classList;
				var active = false;
				for (const key in classList) {
					if(classList[key] == 'current') {
						active = true;
					}
				}
				$(el).html(addIcon($(el).html(), active));
			}
		});
	}

	/**
	 * Build the whole button's section we can add more buttons before or after the CRUD add button
	 */
	window.buildButtonsSection = (filter) => {
		if (filter.find('.section-buttons').length == 0) {
			let buttonsContent = `
				<div class="col-12 col-sm-8 section-buttons">
					<div class="${$("#buttonsAlign").val() ?? 'text-end'}">
						${$(".aditionalButtonsBefore").html() ?? ''}
						${$("#allowAdd").val() == "1" ? getAddButton() : ''}
						${$(".aditionalButtonsAfter").html() ?? ''}
					</div>
				</div>`;

			$(".aditionalButtonsBefore").html("");
			$(".aditionalButtonsAfter").html("");
			filter.append(buttonsContent);
		}
		return filter;
	}

	/**
	 * The CRUD add button
	 */
	window.getAddButton = () => {
		var result = '';
		const urlParams = new URLSearchParams(window.location.search);
		var params = window.btoa(JSON.stringify({
			"entity_source": entity,
			"entity": entity, //Este es el nombre que se le dará al quick add modal que se creará
			"saveAditionals": 'reloadDatatable',
			"parent": urlParams.get('parent') ?? false
		}));
		var attr = window.isModal == 1 ? `onclick="showQuickAddModal('${params}')"` : `href="${entity}/create"`;
		
		result = `
				<a class="btn btn-default waves-effect button-add" ${attr}>
					<i class="mdi mdi-plus me-1"></i>
					${window.i18n.es.Add}
				</a>`;
		return result;
	}

	window.addIcon = (p, a) => {
		return `
			<span class='page-item `+(a ? 'active' : '')+`'>
				<span class='page-link'>${p}</span>
			</span>
		`;
	}

	window.reloadDatatable = (response, table = null) => {
		if (table == null) {
			window.LaravelDataTables[entity+"-table"].draw();
		} else {
			window.LaravelDataTables[table].draw();
		}

		if(typeof window["reloadScreen"] === "function") {
			window["reloadScreen"](response);
		}
	}
});