<?php	
	Route::get('administracion/permisos', 'Administracion\PermisosController@index');
	Route::post('administracion/permisos/store', 'Administracion\PermisosController@store');
	Route::post('administracion/permisos/lista', 'Administracion\PermisosController@lista');
	Route::post('administracion/permisos/buscar', 'Administracion\PermisosController@buscar');
	Route::post('administracion/permisos/save', 'Administracion\PermisosController@save');
	Route::post('administracion/permisos/getdata', 'Administracion\PermisosController@getdata');