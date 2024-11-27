<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CloudController;
use App\Http\Controllers\CloudDirController;
use App\Http\Controllers\CloudFileController;
use App\Http\Controllers\CloudSharePermissionController;

use App\Http\Controllers\OtherMovementController;
use App\Classes\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/web/permissions.php';
require __DIR__.'/web/themes.php';

Route::middleware('auth')->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/', [HomeController::class, 'index'])->name('');
	
	

	Route::middleware('permissions')->group(function () {
		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

		//Cloud
		Route::get('clouds/index', [CloudController::class, 'index'])->name('clouds.index');
		Route::get('cloud_dirs/show/{cloud_dir}', [CloudDirController::class, 'show'])->name('cloud_dirs.show');
		Route::get('cloud_dirs/getCreateFolderModal/{parent}', [CloudDirController::class, 'getCreateFolderModal'])->name('cloud_dirs.getCreateFolderModal');
		Route::post('cloud_dirs/fileStore', [CloudDirController::class, 'fileStore'])->name('cloud_dirs.fileStore');
		Route::get('cloud_files/downloadCloudFile/{cloud_file}', [CloudFileController::class, 'downloadCloudFile'])->name('cloud_files.downloadCloudFile');
		Route::get('cloud_share_permissions/index_param', [CloudSharePermissionController::class, 'indexParam'])->name('cloud_share_permissions.indexParam');
		Route::resourceModals('cloud_dirs', CloudDirController::class);
		Route::resourceModals('cloud_files', CloudFileController::class);
		Route::resourceModals('cloud_share_permissions', CloudSharePermissionController::class);


	});

});

