<?php
namespace App\Classes;

use Illuminate\Support\Facades\Route as RouteBase;
use Illuminate\Support\Str;

class Route extends RouteBase
{
	static function resourceModals(string $name, string $controller, array $options = [], array $param = [])
	{
		static::addRoute($name, $controller, 'getbyparam', null);
		static::addRoute($name, $controller, 'getquickmodalcontent', $param);
		static::resource($name, $controller, $options)->parameters($param);
	}

	static function addRoute(string $entity, string $controller, string $name, $param = null)
	{
		$routeParams = '';
		$sEntity = Str::snake($entity);

		if ($param !== null) {
			$routeParams = '/{'.($param[$sEntity] ?? Str::singular($sEntity)).'?}';
		}
		

		Route::get($entity.'/'.$name.$routeParams, [$controller, Str::camel($name)])->name($entity.'.'.$name);
	}
}