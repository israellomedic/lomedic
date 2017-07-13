<?php 
use abisa\Http\Menu;

$Menu = New Menu();
$MainMenu = $Menu->getMenu();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SIIA::{{ $title or 'Sistema Integral de Informacion Lomedic' }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--meta para caracteres especiales-->
        <meta charset="UTF-8">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import Google Icon Font-->
      	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      	
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
        <!--Import materialize.css-->
        <!--<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
        <!--estilo css personal-->
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        @yield('headjs')
    </head>
    <body> 
    	
    	<div class="row">
    	
    		<div class="col s2">
    			
        		<ul id="slide-out" class="side-nav fixed">
                    <li>
                    	<div class="user-view red">
                            <a href="/"><img class="circle" src="/img/abisa.png"></a>
                            <a href="/"><span class="white-text name">{{ isset($_SESSION['name']) ? $_SESSION['name']: 'NOMBRE' }}</span></a>
                    	</div>
                    </li>
                    <li class="no-padding buttom"><a class="waves-effect" href="/seguridad/logout"><i class="material-icons red-text">settings_power</i>SALIR</a></li>
                    <li class="no-padding"><div class="divider"></div></li>
                    <!--
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons blue-text">settings</i>GESTION DE SISTEMA</a>
                                <div class="collapsible-body">
                                    <ul>
                                    	<li><a class="waves-effect" href="#!"><i class="material-icons">business</i>Datos de la Empresa</a></li>
                                        <li class="no-padding">
                                            <ul class="collapsible collapsible-accordion">
                                                <li>
                                                	<a class="collapsible-header waves-effect"><i class="material-icons">class</i>DATOS GENERALES</a>
                                                    <div class="collapsible-body">
                                                        <ul>
                                                        	<li><a class="waves-effect" href="#!"><i class="material-icons"></i>Localidades</a></li>
                                                            <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Sucursales</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons deep-orange-text">verified_user</i>SEGURIDAD</a>
                                <div class="collapsible-body">
                                    <ul>
                                    	<li><a class="waves-effect" href="/administracion/usuarios"><i class="material-icons deep-orange-text text-darken-2">supervisor_account</i>Usuarios</a></li>
                                        <li><a class="waves-effect" href="/administracion/perfiles"><i class="material-icons deep-orange-text text-darken-2">recent_actors</i>Perfiles</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons teal-text">work</i>FINANZAS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Activo Fijo</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Contabilidad Costos</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Presupuestos</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Finanzas</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons amber-text">store</i>VENTAS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Licitaciones</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Pedido de Venta</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Ventas</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons light-green-text">shopping_cart</i>COMPRAS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Solicitud Pedido</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Pedido de Compra</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Compras</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons indigo-text">supervisor_account</i>SOCIOS DE NEGOCIO</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Clientes</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Proveedores</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Socio de Negocio</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons brown-text">view_carousel</i>INVENTARIOS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Productos</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Almacenes</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Ubicaciones</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Operaciones de Stock</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Inventarios</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons cyan-text">business</i>BANCOS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Cuentas Bancarias</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Pagos Recibidos</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Pagos Efectuados</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes Bancarios</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons lime-text">assignment_late</i>SERVICIOS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Mantenimiento</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Orden de Servicio</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Servicios</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons purple-text">assignment_ind</i>RECURSOS HUMANOS</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Empleados</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Horarios</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons"></i>Departamentos</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de RH</a></li>
                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                            	<a class="collapsible-header waves-effect"><i class="material-icons orange-text">assessment</i>INFORMES</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Finanzas</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Ventas</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Compras</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Socio de Negocio</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de Inventarios</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes Bancarios</a></li>
                                        <li><a class="waves-effect" href="#!"><i class="material-icons">assessment</i>Informes de RH</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                
                </ul>
                <ul id="slide-out" class="side-nav fixed"> 
                	<li class="no-padding"><div class="divider"></div></li> -->
                	<?php echo $MainMenu; ?>
                </ul>
            </div>

            <div class="col s10">
                @section('nombre_modulo')
                <div class="flow-text card-panel" style="text-align: center; font-weight: bold; font-size: 16px; background: #f4f4f4; padding: 15px; color:#f44336; overflow: hidden;">
                	<!-- <a href="#" data-activates="slide-out" class="button-collapse" style="float:left;"><i class="material-icons">menu</i></a> -->
                    {{ $title or 'SIIA' }}
                   <a class="btn btn-floating waves-effect right light-blue" href="/seguridad/login" title="Iniciar Sesion"><i class="material-icons yellow-text">vpn_key</i></a>
                </div>
                @yield('navactions')
                @show
                
                <div class="containers" style="padding: 0 10px; background: #fcfcfc; text-align: center;">
                	{!! isset($content) ? $content : '' !!}
                    @yield('content')
                </div>
            </div>
        </div>
        
        <!--Import jQuery before materialize.js-->
        <!--Script para hacer los datos ordenarse-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
        <script type="text/javascript"> $('select').material_select('destroy'); </script>
        
        <script>
            $(".button-collapse").sideNav({
            	draggable: true,
            	closeOnClick: false,
            	edge: 'right',
				menuWidth: 200, // Default is 300
			});// Inicia sideNav para navegación izquierdo
      </script>
      @yield('jsfooter')  
    </body>
</html>