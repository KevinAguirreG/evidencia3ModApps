// require('./bootstrap');
// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

//Layout
require('./theme.js');
require('./layout/cookie.js');
require('./layout/image_preview.js');
require('./layout/sidebar');
require('./layout/var.js');

//Auth
require('./auth/login.js');

//Mod permissions
require('./mod_permissions/roles_permissions.js');

//Mod Crud maker
require('./crud_maker/functions.js');
require('./crud_maker/filters_datatables.js');
require('./crud_maker/input_autocomplete.js');
require('./crud_maker/input_datepicker.js');
require('./crud_maker/multirow_functions.js');
require('./crud_maker/dropdown_fill_child.js');
require('./crud_maker/modal_quick_add.js');
require('./crud_maker/modal_delete.js');
require('./crud_maker/datatables_customize.js');
require('./crud_maker/datatables_sum.js');

//Dashboard
require('./dashboard/collapse_functions.js');
require('./dashboard/charts.js');

//lang files
require('./lang.js');
window.i18n.es = require('./../../lang/es.json');

//Orders
require('./orders/payments_functions.js');
require('./orders/credit_notes_functions.js');

//Buyings
require('./buyings/modal_confirm_status.js');

//Cloud Dirs
require('./cloud_dirs/modal_share_permissions.js');
require('./cloud_dirs/modal_create_folder.js');
//require('./deliveries.js');