@extends('master')

@section('code_javascript')
	{!!  Html::script('/js/moduls/administracion/permisos.js') !!} 
@stop

@section('opciones_secundarias')
	<div class="wrap">
		<div class="toolbar">
			<button  class="evntMostrarPermisos" id="print">Permisos</button>
			<button class="evntBuscarUsuario" id="undo">Buscar Usuario</button>
			<button id="redo">Nuevo</button>					
		</div>
	</div>
@stop

@section('content')
	<?php
		$lblUsuario = Form::label('txtUsuario', 'Usuario :', null);
		$txtUsuario = Form::text('txtUsuario', '', array('tabindex'=>'1'));

		$lblNombre = Form::label('txtNombre', 'Nombre :', null);
		$txtNombre = Form::text('txtNombre', '', array('tabindex'=>'2'));

		$lblPaterno = Form::label('txtPaterno', 'Paterno :', null);
		$txtPaterno = Form::text('txtPaterno', '', array('tabindex'=>'3'));

		$lblMaterno = Form::label('txtMaterno', 'Materno :', null);
		$txtMaterno = Form::text('txtMaterno', '', array('tabindex'=>'4'));

		$lblEmail   = Form::label('lblMail', 'Correo Elect. :', null);
		$txtEmail   = Form::text('txtEmail', '', array('tabindex'=>'5'));

		$optionsDepto  = array(
									-1 => "Seleccione una opcion",
									 1 => "Almacen",
									 2 => "Captura",
									 3 => "Embarques",
									 4 => "Seguridad"
								);
		$cmbIdDepartamento  = Form::select('cmbIdDepartamento', $optionsDepto, array('tabindex'=>'6'));
		$lblSucursal 		= Form::label('lblSucursal', 'Sucursal :', null);

		$optionsSucursal  = array(
									-1 => "Seleccione una opcion",
									 1 => "GDL",
									 2 => "DF"
								);

		$lblDepto    		= Form::label('lblDepto', 'Depto :', null);
		$cmbIdSucursal 		= Form::select('cmbIdSucursal', $optionsSucursal);

		// Formulario incluido en dialog

		$lblBUscarUSuario = Form::label('lblMail', 'Nombre Usuario', null);
		$txtBuscarUsuario = Form::text('txtNombreUsuario');

		$btnBuscarUsuario  = Form::Button('Buscar', array("class"=>"ui-button ui-widget ui-corner-all"));
		$btnGuardarCambios = Form::Button('Guardar Cambios', array("class"=>"ui-button ui-widget ui-corner-all"));
?>
	<style type="text/css">
		.dataTables_scrollBody{
			height: 400px !important;			
		}
		.tbInfo td{
			font-size: 11px;
			padding-left: 5px;
		}
		.perm{
			width: 30px !important;
		}

	</style>


		<table align="center" class="tbInfo">
			<tr>
				<td> {{ Form::label('', 'ID Usuario')}} </td>
				<td> 459 </td>			
				<td> {{ Form::label('', 'Usuario')}} </td>
				<td> lramirez </td>
				<td> {{ Form::label('', 'Nombre')}} </td>
				<td> LUIS HEVEO RAMIREZ MARTINEZ </td>
			</tr>
			<tr>
				<td> {{ Form::label('', 'Departamento')}} </td>
				<td> Sistemas </td>
				<td> {{ Form::label('', 'Puesto')}} </td>
				<td> Programador </td>
				<td> {{ Form::label('', 'Sucursal')}} </td>
				<td> Jalisco </td>				
			</tr>
		</table>
		<br>

	<table id="dtTableListaModulos" class="display" width="1000px">
	    <thead>
	        <tr>
	        	<th> id_menu </th>
	        	<th> Modulo </th>
	        	<th> ruta </th>
	        	<th> descripcion </th>
				<th> Consulta </th>
				<th> Agregar </th>
				<th> Modificar </th>
				<th> Eliminar </th>
				<th> Localidad </th>
				<th> Cliente </th>
				<th> Sucursal </th>
				<th> Todas </th>
				<th> Privilegio </th>			
			</tr>
	    </thead>
	    <tbody>
	    </tbody>
	</table>

	<div style="margin-top: 10px; text-align: center;">
		{{ $btnGuardarCambios }}
	</div>

	<div id="dialogBuscarUsuario" title="Create new user" style="display: none;">
	  <p class="validateTips">Buscar usuario</p>
	    <fieldset>
			{{ $lblBUscarUSuario }}
			{{ $txtBuscarUsuario }}
			{{ $btnBuscarUsuario }}
	    </fieldset>
	  	<br>
		<table id="tdgBuscarUsuario" class="display" width="500px">
			<thead>
		    	<tr>
			    	<th> Usuario </th>
			    	<th> Nombre </th>
					<th> Departamento </th>
					<th> Puesto </th>
					<th> Estatus </th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

<div id="main-region" class="container">
	<p> ----- </p>
</div>

<script type="text/template" id="contact-template">
	<p><%= firstName %> <%= lastName %></p>
</script>
@stop