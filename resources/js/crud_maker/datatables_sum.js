jQuery.fn.dataTable.Api.register( 'sum()', function (column, format) {
	var parseNumber = function ( i ) {
		return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
	};

	var total = column.data().reduce(function (a, b) {
		return parseNumber(a) + parseNumber(b);
	}, 0);

	//Write the total
	let totalFormat = total;
	if (["number", "money"].includes(format)) {
		totalFormat = totalFormat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
	}
	totalFormat = (format == "money" ? '$ ' : '')+totalFormat;
	//$(column.footer()).html('<span>'+totalFormat+'</span>');

	return totalFormat;
});

$(function() {
	window.addDatatableFooter = (param = null) => {
		window.setTimeout(() => {
			param = param ?? "#"+$("#entity").val()+"-table";
			var footer = "<tfoot><tr>";
			$(`table${param} thead`).find("th").each(function(index, el) {
				footer += `<th class="${el.getAttribute("class")}"></th>`;
			});
			footer += "</tr></tfoot>";
			$(`table${param}`).append(footer);
		}, 100);
	}
});