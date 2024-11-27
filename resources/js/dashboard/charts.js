$(function() {
	window.drawChart = (params) => {
		//Default chart params
		let chart = {
			lang: {
				downloadCSV: "Descargar CSV",
				downloadJPEG: "Descargar imagen JPEG",
				downloadPDF: "Descargar documento PDF",
				downloadPNG: "Descargar imagen PNG",
				downloadSVG: "Descargar imagen SVG",
				downloadXLS: "Descargar XLS",
				viewData: "Ver tabla de datos",
				hideData: "Ocultar tabla de datos",
				viewFullscreen: "Ver en pantalla completa",
				exitFullscreen: "Salir de pantalla completa",
				printChart: "Imprimir gráfica",
			},
			//exporting: { buttons: { contextButton: { menuItems: ["printChart", "downloadPNG", "downloadJPEG", "downloadPDF", "downloadSVG"] } } }
		};

		//Optional params
		if (params.categories ?? false) {
			chart.chart = { type: params.type };
		}

		if (params.title ?? false) {
			chart.title = { text: params.title };
		}

		if (params.subtitle ?? false) {
			chart.subtitle = { text: params.subtitle };
		}

		if (params.categories ?? false) {
			chart.xAxis = { categories: params.categories };
		}

		if (params.title_y_axis ?? false) {
			chart.yAxis = { title: { text: params.title_y_axis } };
		}

		if (params.y_axis ?? false) {
			chart.yAxis = params.y_axis;
		}

		if (params.series ?? false) {
			chart.series = params.series;
		}

		if (params.tooltip ?? false) {
			chart.tooltip = params.tooltip;
		}

		if (params.colors ?? false) {
			chart.colors = params.colors;
		}

		//Aditional params by chart type
		switch (params.type) {
			case "line":
				chart.plotOptions = {
					line: {
						dataLabels: { enabled: true },
						enableMouseTracking: false
					}
				};
				break;
			case "pie":
				chart.chart = {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				}
				chart.legend = {
					backgroundColor: '#4b89a8',
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					enabled: true,
					labelFormatter: function() {
						return this.name +': '+ this.percentage.toFixed(2) +' %';
					},
					useHTML: true
				};
				chart.plotOptions = {
					pie: {
						colors: ['#008000', '#FF0000'],
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
							format: '<b>{point.name}</b>: {point.percentage:.1f} % <br>Total: {point.y}'
						},
						showInLegend: true
					}
				}
				chart.series = [{
					name: params.series_title ?? '',
					colorByPoint: true,
					data: params.series
				}]
				break;
			case "stacked-bars":
				chart.legend = { reversed: true };
				chart.plotOptions = { series: { stacking: 'normal' } };
				break;
			default:
				break;
		}

		console.log(chart);

		//Draw chart
		Highcharts.chart(params.container, chart);
	}
});