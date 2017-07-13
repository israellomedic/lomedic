<?php
Route::match(['get', 'post'], 'administracion/usuarios',          'Administracion\UsuariosController@index');
Route::match(['get', 'post'], 'administracion/usuarios/nuevo',    'Administracion\UsuariosController@create');
Route::match(['get', 'post'], 'administracion/usuarios/ver',      'Administracion\UsuariosController@view');
Route::match(['get', 'post'], 'administracion/usuarios/editar',   'Administracion\UsuariosController@update');
Route::match(['get', 'post'], 'administracion/usuarios/eliminar', 'Administracion\UsuariosController@delete');

