<?php

use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ConfigGeneralController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permissions'])->group(function () {
	//Configuration themes
	Route::get('templates/updateTheme/{idTemplate}',  [TemplateController::class, 'updateTheme'])->name('templates.updateTheme');
	Route::put('templates/update',  [TemplateController::class, 'update'])->name('templates.update');
	Route::get('config_general/getPreview/{view}/{idTheme}',  [ConfigGeneralController::class, 'getPartOfPreview'])->name('config_general.getPartOfPreview');
	Route::resource('config_general',  ConfigGeneralController::class);

});