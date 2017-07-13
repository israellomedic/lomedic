<?php	
Route::get('seguridad/login', 'Seguridad\LoginController@showLogin'); // Mostrar login
Route::post('seguridad/login', 'Seguridad\LoginController@postLogin'); // Verificar datos
Route::get('seguridad/logout', 'Seguridad\LoginController@logOut'); // Finalizar sesión

Route::get('/', function () {
    return view('master',['content'=>'Bienvenido']);
});


Auth::routes();