const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
	/** Scripts */
		//Jquery
		.scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery/jquery.js')
		//Jquery UI
		.scripts('node_modules/jquery-ui-dist/jquery-ui.js', 'public/js/jquery/jquery-ui.js')
		
		//Bootstrap
		.scripts('node_modules/@popperjs/core/dist/umd/popper.js', 'public/js/popperjs/popper.js')
		.copy('node_modules/@popperjs/core/dist/umd/popper.js.map', 'public/js/popperjs/popper.js.map')
		.scripts('node_modules/bootstrap/dist/js/bootstrap.js', 'public/js/bootstrap/bootstrap.js')
		.copy('node_modules/bootstrap/dist/js/bootstrap.js.map', 'public/js/bootstrap/bootstrap.js.map')
		
		//Highcharts
		.scripts('node_modules/highcharts/highcharts.js', 'public/js/highcharts/highcharts.js')
		.copy('node_modules/highcharts/highcharts.js.map', 'public/js/highcharts/highcharts.js.map')
		.scripts('node_modules/highcharts/modules/exporting.js', 'public/js/highcharts/exporting.js')
		.copy('node_modules/highcharts/modules/exporting.js.map', 'public/js/highcharts/exporting.js.map')
		.scripts('node_modules/highcharts/highcharts-more.js', 'public/js/highcharts/highcharts-more.js')
		.copy('node_modules/highcharts/highcharts-more.js.map', 'public/js/highcharts/highcharts-more.js.map')
		.scripts('node_modules/highcharts/modules/accessibility.js', 'public/js/highcharts/accessibility.js')
		.copy('node_modules/highcharts/modules/accessibility.js.map', 'public/js/highcharts/accessibility.js.map')
		.scripts('node_modules/highcharts/modules/export-data.js', 'public/js/highcharts/export-data.js')
		.copy('node_modules/highcharts/modules/export-data.js.map', 'public/js/highcharts/export-data.js.map')

		//Datatables
		.scripts('node_modules/datatables.net/js/jquery.dataTables.js', 'public/js/datatables/jquery.dataTables.js')
		
		//Datatables buttons
		.scripts('node_modules/datatables.net-buttons/js/dataTables.buttons.js', 'public/js/datatables/dataTables.buttons.js')
		.scripts('node_modules/datatables.net-buttons/js/buttons.colVis.js', 'public/js/datatables/buttons.colVis.js')
		.scripts('node_modules/datatables.net-buttons/js/buttons.flash.js', 'public/js/datatables/buttons.flash.js')
		.scripts('node_modules/datatables.net-buttons/js/buttons.html5.js', 'public/js/datatables/buttons.html5.js')
		.scripts('node_modules/datatables.net-buttons/js/buttons.print.js', 'public/js/datatables/buttons.print.js')
		.scripts('node_modules/datatables.net-buttons-bs5/js/buttons.bootstrap5.js', 'public/js/datatables/buttons.bootstrap5.js')
		.copy('resources/js/datatables_Spanish.json', 'public/js/datatables/datatables_Spanish.json')

		//Datatables responsive
		.scripts('node_modules/datatables.net-responsive/js/dataTables.responsive.min.js', 'public/js/datatables/dataTables.responsive.min.js')
		//Moment
		.scripts('node_modules/moment/min/moment-with-locales.js', 'public/js/moment/moment-with-locales.js')
		.copy('node_modules/moment/min/moment-with-locales.min.js.map', 'public/js/moment/moment-with-locales.js.map')

		//Calendar
		.scripts('resources/js/tempusdominus-bootstrap-4.min.js', 'public/js/tempusdominus-bootstrap-4.js')
		.scripts('node_modules/jszip/dist/jszip.js', 'public/js/datatables/jszip.js')

		.scripts('node_modules/metismenu/dist/metisMenu.js', 'public/js/metismenu/dist/metisMenu.js')
		.copy('node_modules/metismenu/dist/metisMenu.js.map', 'public/js/metismenu/dist/metisMenu.js.map')
		.scripts('node_modules/simplebar/dist/simplebar.js', 'public/js/simplebar/dist/simplebar.js')
		.scripts('node_modules/node-waves/dist/waves.js', 'public/js/node-waves/dist/waves.js')

		//Highcharts
		.js('node_modules/highcharts/highstock.js', 'public/js/highcharts/highstock.js')
		.copy('node_modules/highcharts/highstock.js.map', 'public/js/highcharts/highstock.js.map')
		.js('node_modules/highcharts/modules/exporting.js', 'public/js/highcharts/modules/exporting.js')
		.copy('node_modules/highcharts/modules/exporting.js.map', 'public/js/highcharts/exporting.js.map')
		.js('node_modules/highcharts/modules/export-data.js', 'public/js/highcharts/modules/export-data.js')
		.copy('node_modules/highcharts/modules/export-data.js.map', 'public/js/highcharts/export-data.js.map')
		.js('node_modules/highcharts/modules/accessibility.js', 'public/js/highcharts/modules/accessibility.js')
		.copy('node_modules/highcharts/modules/accessibility.js.map', 'public/js/highcharts/accessibility.js.map')

		//Configuration themes
		.scripts('resources/js/configuration/config_general.js', 'public/js/configuration/config_general.js')
		.scripts('resources/js/configuration/config_tables.js', 'public/js/configuration/config_tables.js')
		
		.scripts('resources/js/dataTables.select.min.js', 'public/js/dataTables.select.min.js')
		
		.scripts('resources/js/deliveries.js', 'public/js/deliveries.js')
		
		.js('resources/js/app.js', 'public/js')
	/** Scripts */
	
	/** CSS */
		//Jquery UI
		.styles('node_modules/jquery-ui-dist/jquery-ui.min.css', 'public/css/jquery/jquery-ui.css')
		//Font awesome
		.styles('node_modules/@fortawesome/fontawesome-free/css/fontawesome.css', 'public/css/fontawesome/fontawesome.css')
		.styles('node_modules/@fortawesome/fontawesome-free/css/all.css', 'public/css/fontawesome/all.css')
		//Datatables bootstrap
		.styles('node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css', 'public/css/datatables/dataTables.bootstrap5.css')
		.styles('node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.css', 'public/css/datatables/buttons.bootstrap5.css')
		.styles('node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'public/css/datatables/responsive.bootstrap5.min.css')

		//Highcharts
		.styles('node_modules/highcharts/css/highcharts.css', 'public/css/highcharts/highcharts.css')

		
		//Waves
		.styles('node_modules/node-waves/dist/waves.css', 'public/css/node-waves/dist/waves.css')

		/*.postCss('resources/css/app.css', 'public/css', [
			require('postcss-import'),
			require('tailwindcss'),
			require('autoprefixer'),
		])*/
		.sass('resources/scss/bootstrap.scss', 'public/css/bootstrap/bootstrap.css')
		.sass('resources/scss/icons.scss', 'public/css/icons.css')
		.styles('resources/css/select.dataTables.min.css', 'public/css/select.dataTables.min.css')
		.sass('resources/scss/app.scss', 'public/css/app.css')
	/** CSS */

	/** Directories */
	.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/css/webfonts')
	.copy('resources/fonts', 'public/fonts')
	.copy('resources/images', 'public/images')
	.copy('resources/cert', 'public/cert')
	.copy('resources/uploads', 'public/uploads')
/** Directories */

	/**
	* processCssUrls por default busca las urls definidas en el css y las procesa
	* lo ponemos false para que no cambie la url definida y copiamos directorio de images de resources a public
	*/
	.options({ processCssUrls: false });
