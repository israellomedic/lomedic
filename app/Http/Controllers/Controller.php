<?php
namespace abisa\Http\Controllers;
use DB;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function dbsearch($Query,$Request,$Alias=[]) //BUSCAR USUARIOS
    {
        $Result = !empty($Query) ? $Query : DB::table('adm_usuario');
        if(!empty($Query) && !empty($Request))
        {
            foreach ($Request as $column => $value) {
                if ($column != 'page' && !empty($value))
                {
                    $realcol = isset($Alias[$column]) ? $Alias[$column] : $column;
                    $Result = $Query->where($realcol,'ILIKE',"%$value%");
                }
            }
        }
        return $Result;
    }
    
    public function dbinsert($Table,$Request)
    {
        $Result = DB::table($Table)->insert($Request);
        
        return $Result;
    }
    
    public function dbupdate($Table,$Request,$where)
    {
        $Result = DB::table($Table)->where($where)->update($Request);
        
        return $Result;
        
    }
    
    public function dblogicaldelete($Table,$where)
    {
        $Request = ['eliminado'=>'1','id_usuarioelimino'=>1,'fecha_elimino'=>time()];
        $Result = $this->dbupdate($Table,$Request,$where);
        
        return $Result;
    }
}
