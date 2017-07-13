<?php

namespace abisa\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use abisa\Http\Requests;
use abisa\Http\Controllers\Controller;
use DB;


class PermisosController extends Controller
{
    public function index()
	{
		$idModulo = 3;
		$modulo = DB::table('adm_menu')->where('id_menu', $idModulo)->value('descripcion');	
		$arreglo = ['title' => 'Permisos', 'nombreModulo' => $modulo];
		return view('Administracion.Permisos.index', $arreglo);
	}

	public function store(){

	}

	public function lista(){

		$users = DB::SELECT("SELECT	COALESCE(m3.id_menu, m2.id_menu) id_menu,
									m1.modulo,
									COALESCE(m2.modulo,'') || COALESCE(' / '||m3.modulo,'')  as ruta,		
									COALESCE(m3.descripcion, COALESCE(m2.descripcion,'')) as descripcion,
									'<input type=checkbox>' AS consulta,
									'<input type=checkbox>' AS agregar,
									'<input type=checkbox>' AS modificar,
									'<input type=checkbox>' AS eliminar,
									'<input type=checkbox>' AS localidad,
									'<input type=checkbox>' AS cliente,
									'<input type=checkbox>' AS sucursal,
									'<input type=checkbox>' AS todas,
									'<input type=text class=perm>'     AS privilegio

								FROM   adm_menu m1

									LEFT JOIN  adm_menu m2 ON
										m2.id_modulo = m1.id_menu
									AND m2.id_modulo != m2.id_menu

									LEFT JOIN  adm_menu m3 ON
										m3.id_modulo = m2.id_menu
									AND m3.id_modulo != m3.id_menu

								WHERe m1.id_menu = m1.id_modulo

								ORDER BY m1.modulo, m2.modulo, m3.modulo");

		return array('data' => $users);
	}

	public function buscar(Request $request){
		
		print_r($request);

	}

	public function save(Request $request){


		return "1";

	}

	public function getdata(Request $request){
		$users       = '';
		$idUsuario   = session()->get('id_usuario');
		$adm_usuario = DB::table('adm_usuario')
						   ->join('adm_tipo', 'adm_usuario.id_tipo', '=', 'adm_tipo.id_tipo')
						   ->join('cat_sucursal', 'cat_sucursal.id_sucursal', '=', 'adm_usuario.id_sucursal')
					       ->select('usuario',
					       			'nombre',
					       			'paterno',
					       			'materno',
					       			'adm_usuario.id_tipo as id_departamento',
					       			'adm_tipo.descripcion as departamento',
					       			'adm_usuario.id_puesto',
					       			'adm_usuario.id_sucursal')
					       ->where('id_usuario', $idUsuario)
					       ->limit(1)
					       ->get();

		$adm_usuario = $adm_usuario[0];

		$users = array (    "id_usuario"      => $idUsuario,
							"usuario"         => $adm_usuario->usuario,
							"nombre"          => $adm_usuario->nombre,
							"paterno"         => $adm_usuario->paterno,
							"materno"         => $adm_usuario->materno,
							"id_departamento" => $adm_usuario->id_departamento,
							"departamento"    => $adm_usuario->departamento,
							"id_puesto"       => $adm_usuario->id_puesto,
							"id_sucursal"     => $adm_usuario->id_sucursal,
							"permisos"     => array(array("agregar" => 2, "cliente" => "23"), array("agregar" => 2, "cliente" => "23")));
		return  $users;
	}

}