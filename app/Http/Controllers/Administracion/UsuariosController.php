<?php
/*

*/
namespace abisa\Http\Controllers\Administracion;
use Session;
use Validator;
use Input;
use Crypt;
use Request;
use Url;
use Form;
use DB;

use abisa\Http\Requests;
use abisa\Http\Controllers\Controller;
use abisa\Modelos\adm_tipo;
use abisa\Modelos\adm_usuario;
use abisa\Modelos\adm_menu;
use abisa\Modelos\cat_sucursal;

class UsuariosController extends Controller
{
    public function index() //Vista principal
    {		
        $Params = Request::all();
        
        $Alias =['tipo'=>'T.descripcion','sucursal'=>'S.descripcion'];
        
        $Query = DB::table('adm_usuario as U')
        ->select('U.*','T.descripcion as tipo', 'S.descripcion as sucursal')
        ->leftJoin('adm_tipo as T', 'T.id_tipo', '=', 'U.id_tipo')
        ->leftJoin('cat_sucursal as S', 'S.id_sucursal', '=', 'U.id_sucursal')
        ->orderBy('estatus','desc')
        ->orderBy('usuario');
        $Querys = Null;
        
        $AllUsers = $this->dbsearch($Query,$Params,$Alias)->paginate(30);
        
        $idModulo = 2;
        $modulo = adm_menu::first()->where('id_menu','=',$idModulo)->value('descripcion');

        return view('Administracion.Usuarios.index', ['title'=>$modulo,'Usuarios'=>$AllUsers]);
    }

    public function create()//Vista para crear un nuevo usuario
    {
        $Params = Request::all();
        
        if(isset($Params['Acction']))
        {
            print_r($Params); exit();
            $isCreate = $this->create($Params);
            
            if($isCreate == true)
            {
                switch ($Params['Acction'])
                {
                    case "Guardar y Cerrar":
                        return redirect('/administracion/usuarios');
                        break;
                    case "Guardar y Nuevo":
                        return redirect('/administracion/usuarios/nuevo');
                        break;
                    default:
                        echo "Los datos se guardaron correctamente";
                        break;
                }
            }
            else
            { print_r("error: ".$isUpdate); }
        }
        
        if(!isset($Params['Acction']) || $Params['Acction'] == 'Guardar')
        {
            $IdUsuario = isset($Params['id_usuario']) ? $Params['id_usuario'] : 0;
            
            $Query = DB::table('adm_usuario as U')
            ->select('U.*')
            ->leftJoin('adm_tipo as T', 'T.id_tipo', '=', 'U.id_tipo')
            ->leftJoin('cat_sucursal as S', 'S.id_sucursal', '=', 'U.id_sucursal')
            ->where('U.id_usuario','=',$IdUsuario);
            
            $User = $Query->first();
            
            $tipos = adm_tipo::pluck('descripcion', 'id_tipo')->sort();
            $sucursales = cat_sucursal::pluck('descripcion', 'id_sucursal')->sort();
            
            return view('Administracion.Usuarios.index',['title'=>'Nuevo Usuario','tipos'=>$tipos,'sucursales'=>$sucursales]);
        }
    }

    public function view()//Vista para viasualizar los datos de un usuario
    {
        $Params = Request::all();
        
        unset($Params['Acction']);
        unset($Params['_token']);
        unset($Params['id_usuario']);
        
        if(isset($Params['Acction']))
        {
            $isUpdate = $this->update($Params);
            
            if($isUpdate === true)
            {
                switch ($Params['Acction']) {
                    case "Guardar y Cerrar":
                        return redirect('/administracion/usuarios');
                        break;
                    case "Guardar y Nuevo":
                        return redirect('/administracion/usuarios/nuevo');
                        break;
                    default:
                        echo "Los datos se guardaron correctamente";
                        break;
                }
            }
            else
            { print_r($isUpdate); }
        }
        
        if(!isset($Params['Acction']) || $Params['Acction'] == 'Guardar')
        {
            $IdUsuario = isset($Params['id_usuario']) ? $Params['id_usuario'] : 0;
            
            $Query = DB::table('adm_usuario as U')
            ->select('U.*')
            ->leftJoin('adm_tipo as T', 'T.id_tipo', '=', 'U.id_tipo')
            ->leftJoin('cat_sucursal as S', 'S.id_sucursal', '=', 'U.id_sucursal')
            ->where('U.id_usuario','=',$IdUsuario);
            
            $User = $Query->first();
            
            $tipos = adm_tipo::pluck('descripcion', 'id_tipo')->sort();
            $sucursales = cat_sucursal::pluck('descripcion', 'id_sucursal')->sort();
            
            return view('Administracion.Usuarios.index',['title'=>'Ver Usuario','data'=>$User,'tipos'=>$tipos,'sucursales'=>$sucursales,'update'=>true]);
        }
    }
    
    public function update()//Vista para actualizar un usuario
    {   
        $Params = Request::all();
    
        if(isset($Params['Acction']))
        {
            $Values['usuario'] = $Params['Usuario'];
            $Values['nombre'] = $Params['Nombre'];
            $Values['paterno'] = $Params['Paterno'];
            $Values['materno'] = $Params['Materno'];
            $Values['correo_electronico'] = $Params['CorreoSiil'];
            $Values['correo_electronico_abisa'] = $Params['CorreoAbisa'];
            $Values['correo_electronico_quiropractico'] = $Params['CorreoQuiro'];
            $Values['id_tipo'] = $Params['TipoUsuario'];
            $Values['id_sucursal'] = $Params['Sucursal'];
            $Values['estatus'] = $Params['status'];
            
            $isUpdate = $this->dbupdate('adm_usuario',$Values,['id_usuario'=>$Params['id_usuario']]);
            
            if($isUpdate == true)
            {
                switch ($Params['Acction']) {
                    case "Guardar y Cerrar":
                        return redirect('/administracion/usuarios');
                    break;
                    case "Guardar y Nuevo":
                        return redirect('/administracion/usuarios/nuevo');
                    break;
                    default:
                        echo "Los datos se guardaron correctamente";
                    break;
                }
            }
            else
            { print_r($isUpdate); }
        }
        
        if(!isset($Params['Acction']) || $Params['Acction'] == 'Guardar')
        {
            $IdUsuario = isset($Params['id_usuario']) ? $Params['id_usuario'] : 0;
            
            $Query = DB::table('adm_usuario as U')
            ->select('U.*')
            ->leftJoin('adm_tipo as T', 'T.id_tipo', '=', 'U.id_tipo')
            ->leftJoin('cat_sucursal as S', 'S.id_sucursal', '=', 'U.id_sucursal')
            ->where('U.id_usuario','=',$IdUsuario);
            
            $User = $Query->first();
            
            $tipos = adm_tipo::pluck('descripcion', 'id_tipo')->sort();
            $sucursales = cat_sucursal::pluck('descripcion', 'id_sucursal')->sort();
            
            return view('Administracion.Usuarios.index',['title'=>'Editar Usuario','data'=>$User,'tipos'=>$tipos,'sucursales'=>$sucursales,'update'=>true]);
        }
    }

    public function delete()//Vista para actualizar un usuario
    {
        $Params = Request::all();
        
        if(isset($Params['Acction']))
        {
            $isUpdate = $this->update($Params);
            
            if($isUpdate === true)
            {
                switch ($Params['Acction']) {
                    case "Guardar y Cerrar":
                        return redirect('/administracion/usuarios');
                        break;
                    case "Guardar y Nuevo":
                        return redirect('/administracion/usuarios/nuevo');
                        break;
                    default:
                        echo "Los datos se guardaron correctamente";
                        break;
                }
            }
            else
            { print_r($isUpdate); }
        }
        
        if(!isset($Params['Acction']) || $Params['Acction'] == 'Guardar')
        {
            $IdUsuario = isset($Params['id_usuario']) ? $Params['id_usuario'] : 0;
            
            $Query = DB::table('adm_usuario as U')
            ->select('U.*')
            ->leftJoin('adm_tipo as T', 'T.id_tipo', '=', 'U.id_tipo')
            ->leftJoin('cat_sucursal as S', 'S.id_sucursal', '=', 'U.id_sucursal')
            ->where('U.id_usuario','=',$IdUsuario);
            
            $User = $Query->first();
            
            $tipos = adm_tipo::pluck('descripcion', 'id_tipo')->sort();
            
            return view('Administracion.Usuarios.index',['title'=>'Editar Usuario','data'=>$User,'tipos'=>$tipos,'update'=>true]);
        }
    }
    
    
    
    
    
    public function Xcreate($request) //CREAR USUARIO
    {
        //Se pone un alias a los request del form
        $attributeNames = [ 
            'Usuario' => 'Usuario',
            'Password' => 'Contraseña',
            'Password2' => 'Re-Contraseña',
            'Nombre' => 'Nombre',
            'Paterno' => 'Apellido Paterno',
            'Materno' => 'Apellido Materno',
            'TipoUsuario' => 'Tipo de Usuario',     
        ];

        //regex:/(^[A-Za-z0-9 ]+$)+/ - //LETRAS NUMEROS Y ESPACIOS;
        //regex:/^[\pL\s\-]+$/u      - // SOLO LETRAS Y ESPACIOS;
        $validator = Validator::make($request, [  
            'Usuario' => 'required|between:1,50|alpha_num',
            'Password' => 'required|between:4,40|same:Password2|alpha_num',
            'Password2' => 'required|alpha_num',
            'Nombre' => 'required|regex:/^[\pL\s\-]+$/u|between:1,100',
            'Paterno' => 'required|regex:/^[\pL\s\-]+$/u|between:1,100',
            'Materno' => 'required|regex:/^[\pL\s\-]+$/u|between:1,100',
            'TipoUsuario' => 'required|integer|exists:adm_tipo,id_tipo',
            'CorreoSiil' => 'email',
            'CorreoAbisa' => 'email',
            'CorreoQuiro' => 'email'
        ]);

        $validator->setAttributeNames($attributeNames); //Se renombran a los atributos
        
        //OBTENGO LOS ERRORES Y LOS MUESTRO
        $messages =  $validator->errors()->all();
        $errores ="";
        foreach ($messages as $message) {
        $errores.='<li>'.$message.'</li>';
        }
        if ($validator->fails()) {
        return response($errores,400);
        }
        
        $users = DB::SELECT("SELECT id_usuario FROM adm_usuario 
        WHERE usuario = ?",[$request['Usuario']]);
        
        if(sizeof($users) != 0){
        return response('Ese usuario existe en la base de datos',400);
        }
        
        $fecha_captura = date('Y-m-d H:i:s');
        $usuario =  $request['Usuario'];
        $password = sha1($request['Password']);
        $nombre = strtoupper($request['Nombre']);
        $paterno = strtoupper($request['Paterno']);
        $materno = strtoupper($request['Materno']);
        $id_tipo = $request['TipoUsuario'];
        
        $correo_siil  = $request['CorreoSiil'];
        $correo_abisa = $request['CorreoAbisa'];
        $correo_quiro = $request['CorreoQuiro'];
        
        $usuario_captura = $_SESSION['idUser'];
        
        $db = DB::connection('alpha');
        
        $isInsert = $db->insert("insert into adm_usuario (usuario, password, nombre, id_tipo, fecha_captura, paterno, materno, estatus, correo_electronico, correo_electronico_abisa, correo_electronico_quiropractico, id_usuario_captura ) values ('$usuario','$password','$nombre','$id_tipo','$fecha_captura','$paterno','$materno',1,'$correo_siil','$correo_abisa','$correo_quiro','$usuario_captura')");
        
        return $isInsert === true ? $isInsert : response('El usuario ha sido creado'.$isInsert);
    }

    

	public function Xupdate($request) //ACTUALIZAR USUARIOS
	{	
        //DESENCRIPTO LOS DATOS DEL USUARIO ID
        $id_usuario = (INT) $request['id_usuario'];
        
        //SI NO SE HA SELECCIONADO UN USUARIO
        if (empty($id_usuario))
        { return response('Tiene que buscar un usuario',400); }
        
        $attributeNames = [//CAMBIO NOMBRE DE LOS INPUT DE LAS VARIABLES PARA QUE SE MUESTREN CON ESE NOMBRE SI HAY ERROR
            'Usuario' => 'Usuario',
            'Password' => 'Contraseña',
            'Password2' => 'Re-Contraseña',
            'Nombre' => 'Nombre',
            'Paterno' => 'Apellido Paterno',
            'Materno' => 'Apellido Materno',
            'TipoUsuario' => 'Tipo de Usuario',     
        ];
        
        $val1="";
        $val2="";
        
        //SI LA CONTRASEÑAS SE QUIEREN ACTUALIZAR
        if ($request['Password'] != '' || $request['Password2'] != '')
        {
            $val1="required|between:4,40|same:Password2|alpha_num";
            $val2="required|alpha_num";
        }
        //regex:/(^[A-Za-z0-9 ]+$)+/ - //LETRAS NUMEROS Y ESPACIOS;
        //regex:/^[\pL\s\-]+$/u      - // SOLO LETRAS Y ESPACIOS;
        $validator = Validator::make($request, [
            'Usuario' => 'required|between:1,50|alpha_num',
            'Password' => $val1,
            'Password2' => $val2,
            'Nombre' => 'required|regex:/^[\pL\s\-]+$/u|between:1,100',
            'Paterno' => 'required|regex:/^[\pL\s\-]+$/u|between:1,100',
            'Materno' => 'required|regex:/^[\pL\s\-]+$/u|between:1,100',
            'TipoUsuario' => 'required|integer|exists:adm_tipo,id_tipo',
            'status' => 'boolean',
            'id_usuario' => 'required',
            'CorreoSiil' => 'email',
            'CorreoAbisa' => 'email',
            'CorreoQuiro' => 'email'
        ]);
        
        $validator->setAttributeNames($attributeNames);
        $messages =  $validator->errors()->all();
        $errores ="";
        foreach ($messages as $message) {
          $errores.='<li>'.$message.'</li>';
        }
        if ($validator->fails()) {
          return response($errores,400);
        }
        
        // SE BUSCA EL USUARIO QUE SE QUIERE MODIFICAR Y SE ACTUALIZA
        $fecha_modificacion = date('Y-m-d H:i:s');
        $id_usuario = $request['id_usuario'];
        $usuario = $request['Usuario'];
        $nombre = strtoupper($request['Nombre']);
        $paterno = strtoupper($request['Paterno']);
        $materno = strtoupper($request['Materno']);
        $tipo = $request['TipoUsuario'];
        
        $password = sha1($request['Password']);
        
        $status = isset($request['status']) ? $request['status'] : 0;

        $pass='';
        if ($request['Password'] != '') { // SI SE ACTUALIZA LA CONTRASEÑA
         $pass = ",password = '$password'";
        }
        
        $correo_siil  = $request['CorreoSiil'];
        $correo_abisa = $request['CorreoAbisa'];
        $correo_quiro = $request['CorreoQuiro'];
        
        $usuario_modifacion = $_SESSION['idUser'];
        
        $update = DB::connection('pgsql');
        
        $isUpdate = $update->update("update adm_usuario set usuario = '$usuario', nombre = '$nombre', paterno = '$paterno', materno = '$materno', id_tipo = '$tipo', estatus = '$status', correo_electronico = '$correo_siil', correo_electronico_abisa = '$correo_abisa',correo_electronico_quiropractico = '$correo_quiro', id_usuario_modificacion = '$usuario_modifacion' ,fecha_modificacion = '$fecha_modificacion'".$pass."where id_usuario = '$id_usuario'");

        return $isUpdate === 1 ? true : response('Los datos no se pudieron actualizar. '.$isUpdate['exception']);
    }
}