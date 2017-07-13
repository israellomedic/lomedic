<?php
namespace abisa\Http;
use Session;
use DB;

use Illuminate\Database\Eloquent\Model;

class Menu
{
    public function getMenu($Parent = Null)
    {
        $htmlMenu = '';
    
        $Query = DB::table('seg_modulos as M')
            ->leftJoin('seg_parent as P','P.id_modulo', '=', 'M.id_modulo') //->and('P.Activo','=','1')
            ->select('M.*')
            ->where('M.Activo','=','1')
            ->where('M.Menu','=','1')
            ->orderBy('M.id_modulo');
        
        if(empty($Parent))
            $Query->whereRaw('"P"."id_parent" is null');
        else
            $Query->where('P.id_parent','=',$Parent);
            
        $Rows = $Query->get()->toarray();
        
        
        $Children = DB::table('seg_parent')->select('id_parent')->distinct()->whereRaw('id_parent is not null')->get()->toarray();
        $Parents =[];
        foreach($Children as $item)
            array_push($Parents,$item->id_parent);
        
        foreach($Rows as $item)
        {
            $IsParent  = in_array($item->id_modulo,$Parents);
            
            $htmlMenu .= "<li class='no-padding'>
                    <ul ".($IsParent ? "class='collapsible collapsible-accordion'" : '').">
                        <li>
                        	<a class='collapsible-header waves-effect' href='".(!empty($item->Url) ? $item->Url : '#')."'>".(!empty($item->Icon) ? "<i class='material-icons ".(!empty($item->Color) ? $item->Color :'')."'>$item->Icon</i>" :'').$item->Nombre."</a>";
            
            if($IsParent)
                $htmlMenu .= "<div class='collapsible-body'><ul>".
                        	       $this->getMenu($item->id_modulo)
                        	 ."</ul></div>";
            
            $htmlMenu .= "</li>
                    </ul>
                </li>";
        }

        /*   
        if()
        {
        
            $Query = DB::table('adm_menu as M')
            ->select('M.*')
            //->leftJoin('cat_sucursal as S', 'S.id_sucursal', '=', 'U.id_sucursal')
            ->where('M.estatus','=','1')
            ->orderBy('id_modulo')
            ->orderBy('orden');
            
            $Result = $Query->get();
            $Rows = $Result->toarray();
            
            $menu=[];
            foreach($Rows as $row)
            { 
                array_push($menu,[$row->orden,$row->id_menu,$row->id_modulo,$row->modulo,$row->url,$row->descripcion]);
            }
            sort($menu);
            
            
            for ($i = 0; $i < count($menu); $i++)
            {
                if ($menu[$i][1] == $menu[$i][2])
                {
                    $htmlMenu .= "<li class='no-padding'>\n
                        <ul class='collapsible collapsible-accordion'>
                            <li><a class='collapsible-header waves-effect' title='".$menu[$i][5]."' href='javascript:;'>".$menu[$i][3]."</a>\n";
                    $sub_menu = array();
                    sort($sub_menu);
                    for ($j = 0; $j < count($menu); $j++)
                    {
                        if (($menu[$i][1] == $menu[$j][2]) && ($menu[$j][1] != $menu[$j][2]))
                        {
                            array_push ($sub_menu, $menu[$j]);
                        }
                    }
                    if (count($sub_menu))
                    {
                        $htmlMenu .= "<div class='collapsible-body'>\n <ul>\n";
                        for ($j = 0; $j < count($sub_menu); $j++)
                        {
                            $sub_sub_menu = array();
                            for ($k = 0; $k < count($menu); $k++)
                            {
                                if ($sub_menu[$j][1] == $menu[$k][2])
                                    array_push ($sub_sub_menu, $menu[$k]);
                            }
                            sort($sub_sub_menu);
                            if (count($sub_sub_menu))
                            {
                                
                                $htmlMenu .= "<li><a class='waves-effect' title='".$sub_menu[$j][5]."' href='javascript:;'>".$sub_menu[$j][3]."</a>\n";
                                $htmlMenu .= "<ul>\n";
                                for ($l = 0; $l < count($sub_sub_menu); $l++)
                                    $htmlMenu .= "<li><a title=\"".$sub_sub_menu[$l][5]."\" href=\"main.php?opc=".$sub_sub_menu[$l][1]."\" >".$sub_sub_menu[$l][3]."</a></li>\n";
                                    $htmlMenu .= "</ul>\n";
                            }
                            else
                                $htmlMenu .= "<li><a class='waves-effect' title='".$sub_menu[$j][5]."' href='main.php?opc=".$sub_menu[$j][1]."'>".$sub_menu[$j][3]."</a></li>";
                        }
                        $htmlMenu .= "</ul>\n </div>\n";
                    }
                    $htmlMenu .= "</li>\n </ul>\n </li>\n";
                }
            }
        }
        */
        return $htmlMenu;
    }
}