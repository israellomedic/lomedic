@extends('master')
<?php
$getAction = Route::currentRouteAction();
$Action = substr($getAction,strpos($getAction,'@')+1,200);

if($Action != 'index')
{
    $datIdusuario = isset($data->id_usuario) ? $data->id_usuario : Null;
    $idUsuario = Form::hidden('id_usuario', $datIdusuario, ['id' => 'id_usuario']);
    
    $datUsuario = isset($data->usuario) ? $data->usuario : '';
	$lblUsuario = Form::label('Usuario', 'Usuario :', null);
	$txtUsuario = Form::text('Usuario', $datUsuario, ['data-length'=>'50','oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);

	if(isset($update))
	{
		$lblPassword = Form::label('Password', 'Contraseña:', null);
		$txtPassword = Form::password('Password', ['data-length'=>'40','oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')']);

		$lblPassword2 = Form::label('Password2', 'Re-Contraseña :', null);
		$txtPassword2 = Form::password('Password2', ['data-length'=>'40','oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')']);
	}
	else
	{
		$lblPassword = Form::label('Password', 'Contraseña:', null);
		$txtPassword = Form::password('Password', ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);

		$lblPassword2 = Form::label('Password2', 'Re-Contraseña :', null);
		$txtPassword2 = Form::password('Password2', ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);
	}

	$datNombre = isset($data->nombre) ? $data->nombre : '';
	$lblNombre = Form::label('Nombre', 'Nombre :', null);
	$txtNombre = Form::text('Nombre', $datNombre, ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required','autocomplete'=>'off']);

	$datPaterno = isset($data->paterno) ? $data->paterno : '';
	$lblPaterno = Form::label('Paterno', 'Apellido Paterno :', null);
	$txtPaterno = Form::text('Paterno', $datPaterno, ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);

	$datMaterno = isset($data->materno) ? $data->materno : '';
	$lblMaterno = Form::label('Materno', 'Apellido Materno :', null);
	$txtMaterno = Form::text('Materno', $datMaterno, ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);

	//CORREOS ELECTRONICOS
	$datCorreoSiil = isset($data->correo_electronico) ? $data->correo_electronico : '';
	$lblCorreoSiil = Form::label('CorreoSiil', 'Correo SIIL :', null);
	$txtCorreoSiil = Form::email('CorreoSiil', $datCorreoSiil, ['oninvalid'=>'setCustomValidity(\'Debe introducir un correo electronico\')', 'oninput'=>'setCustomValidity(\'\')']);
	
	$datCorreoAbisa = isset($data->correo_electronico_abisa) ? $data->correo_electronico_abisa : '';
	$lblCorreoAbisa = Form::label('CorreoAbisa', 'Correo Abisa :', null);
	$txtCorreoAbisa = Form::email('CorreoAbisa', $datCorreoAbisa, ['oninvalid'=>'setCustomValidity(\'Debe introducir un correo electronico\')', 'oninput'=>'setCustomValidity(\'\')']);
	
	$datCorreoQuiro = isset($data->correo_electronico_quiropractico) ? $data->correo_electronico_quiropractico : '';
	$lblCorreoQuiro = Form::label('CorreoQuiro', 'Correo Quiropractico :', null);
	$txtCorreoQuiro = Form::email('CorreoQuiro', $datCorreoQuiro, ['oninvalid'=>'setCustomValidity(\'Debe introducir un correo electronico\')', 'oninput'=>'setCustomValidity(\'\')']);
	//

	$datTipoUsuario = isset($data->id_tipo) ? $data->id_tipo : '';
	$lblTipoUsuario  = Form::label('TipoUsuario', 'Tipo de usuario :', null);
	$cmbTipoUsuario  = Form::select('TipoUsuario', $tipos, $datTipoUsuario, ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);

	$datSucursal = isset($data->id_sucursal) ? $data->id_sucursal : '';
	$lblSucursal  = Form::label('Sucursal', 'Sucursal :', null);
	$cmbSucursal  = Form::select('Sucursal', $sucursales, $datSucursal, ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required']);
	
	$datStatus = isset($data->estatus) ? $data->estatus : '';
	$lblStatus = Form::label('status', 'Estatus :', null);
	$chkStatus = Form::checkbox('status', '1',$datStatus,['id' => 'status','title'=>'Estatus del usuario','class'=>'filled-in']);
}
?>
@section('content')
<div class="row section" style="background: #fdfdfd;">
	@if($Action == 'index')
	@section('navactions')
	<div class="col s12" style="text-align: right; padding: 5px;">
		<a href="{!! url('/administracion/usuarios/nuevo'); !!}" class="btn waves-effect waves-indigo red" title='Nuevo Usuario'>Nuevo</a>
		<a href="{!! url('/administracion/usuarios'); !!}"  class="btn waves-effect waves-indigo blue-grey" title='Actualizar Lista'>Actualizar</a>
		<a href="{!! url('/administracion/usuarios'); !!}"  class="btn waves-effect waves-indigo blue-grey" title='Exportar datos a Excel'>Excel</a>
	</div>
	@stop <!--nav acctions-->
	
	{!! Form::open(['method'=>'get']) !!}
	<table id="rolTable" class="no-padding display responsive-table striped" cellspacing="0" width="100%">
		<thead>
			<tr>
    			<th class="no-padding">USUARIO</th>
				<th class="no-padding">NOMBRE</th>
				<th class="no-padding">CORREO</th>
				<th class="no-padding">TIPO</th>
				<th class="no-padding">SUCURSAL</th>
			    <th class="no-padding">ESTATUS</th>
				<th class="no-padding">ACCIONES</th>
    		</tr>
			<tr>
    			<td class="no-padding">{!! Form::text('usuario','',['id'=>'usuario-input','class'=>'autocomplete']); !!}</td>
    			<td class="no-padding">{!! Form::text('nombre','',[]); !!}</td>
    			<td class="no-padding">{!! Form::text('correo_electronico','',[]); !!}</td>
    			<td class="no-padding">{!! Form::text('tipo','',[]); !!}</td>
    			<td class="no-padding">{!! Form::text('sucursal','',[]); !!}</td>
    			<td class="no-padding">{!! Form::text('estatus','',[]); !!}</td>
    			<td class="no-padding"><input type="submit" value="Buscar" class="btn waves-effect waves-indigo teal lighten-3" /></td>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($Usuarios as $Usuario) 
    			<tr>
    				<td class="no-padding">{{ $Usuario->usuario }}</td>
    				<td class="no-padding">{{ $Usuario->nombre.' '.$Usuario->paterno.' '.$Usuario->materno }}</td>
    				<td class="no-padding">{{ $Usuario->correo_electronico }}</td>
    				<td class="no-padding">{{ $Usuario->tipo }}</td>
    				<td class="no-padding">{{ $Usuario->sucursal }}</td>
    				<td class="no-padding"><i class="material-icons"  style="color:{{ $Usuario->estatus == 1 ? 'green' : 'gray' }}">{{ $Usuario->estatus == 1 ? 'done' : 'not_interested' }}</i></td>
    				<td class="no-padding">
    					<a href="{!! url('/administracion/usuarios/ver?id_usuario='.$Usuario->id_usuario); !!}" class='btn btn-floating blue-grey lighten-3' title='Ver'><i class='material-icons'>visibility</i></a>
    					<a href="{!! url('/administracion/usuarios/editar?id_usuario='.$Usuario->id_usuario); !!}" class='btn btn-floating teal lighten-3' title='Editar'><i class='material-icons'>mode_edit</i></a>
    					<a href="{!! url('/administracion/usuarios/lock?id_usuario='.$Usuario->id_usuario); !!}" class='btn btn-floating blue-grey lighten-3' title='Bloquear - Activar'><i class='material-icons'>{{ $Usuario->estatus == 1 ? 'not_interested' : 'done' }}</i></a>
    				</td>
    			</tr>
    		@endforeach
    	</tbody>
	</table>
	{!!Form::close()!!}
	<div style="text-align: right; border-top: 1px solid #d4d4d4; padding: 5px;">
		{!! $Usuarios->render(); !!}
	</div>
	@endif
</div>

@if($Action != 'index')

{!! Form::open(['id'=>'form','enctype'=>'multipart/form-data','class'=>'section']) !!}
<div class="row">
	{!! $idUsuario !!}
	<div class="input-field col s4">
        {!! $txtUsuario !!}
        {!! $lblUsuario !!}
	</div>
	<div class="input-field col s4">
        {!! $txtPassword !!}
        {!! $lblPassword !!}
	</div>
	<div class="input-field col s4">
        {!! $txtPassword2 !!}
        {!! $lblPassword2 !!}
	</div>
	
	<div class="input-field col s4">
    {!! $txtNombre !!}
    {!! $lblNombre !!}
    </div>
    <div class="input-field col s4">
        {!! $txtPaterno !!}
        {!! $lblPaterno !!}
    </div>
    <div class="input-field col s4">
        {!! $txtMaterno !!}
        {!! $lblMaterno !!}
    </div>

    <div class="input-field col s4">
        {!! $txtCorreoSiil !!}
        {!! $lblCorreoSiil !!}
    </div>
    <div class="input-field col s4">
        {!! $txtCorreoAbisa !!}
        {!! $lblCorreoAbisa !!}
    </div>
    <div class="input-field col s4">
        {!! $txtCorreoQuiro !!}
        {!! $lblCorreoQuiro !!}
    </div>

    <div class="input-field col s4">
        {!! $cmbTipoUsuario !!}
        {!! $lblTipoUsuario !!}
    </div>
    <div class="input-field col s4">
        {!! $cmbSucursal !!}
        {!! $lblSucursal !!}
    </div>
    @if(isset($update))
    <div class="input-field col s4">
        {!! $chkStatus !!}
        {!! $lblStatus !!}
    </div>
    @endif
</div>

<!-- Seccion de botones para guardar y regresar -->
<div class="col s12" style="text-align: right; padding: 5px;">
	<!-- Editar -->
	@if(isset($update))
		<input type="submit" Name="Acction" value="Guardar y Cerrar" class="btn waves-effect waves-indigo red" />
		<input type="submit" Name="Acction" value="Guardar y Nuevo" class="btn waves-effect waves-indigo teal" />
		<input type="submit" Name="Acction" value="Guardar" class="btn waves-effect waves-indigo red lighten-2" />
		<a href="{!! url('/administracion/usuarios'); !!}"  class="btn waves-effect waves-indigo blue-grey">Cancelar</a>
	@else
		<input type="submit" Name="Acction" value="Guardar y Cerrar" class="btn waves-effect waves-indigo red" />
		<input type="submit" Name="Acction" value="Guardar y Nuevo" class="btn waves-effect waves-indigo teal" />
		<a href="{!! url('/administracion/usuarios'); !!}"  class="btn waves-effect waves-indigo blue-grey">Cancelar</a>
	@endif
</div>
<!-- Fin de seccion de botones -->

{!!Form::close()!!}
@endif

{!!  Html::setClosePanelBody('') !!} 
{!!  Html::setClosePanel() !!} 			
@stop <!--content section-->


@section('headjs')

@stop

@section('jsfooter')
<script> $(document).ready(function() { $('select').material_select(); }); </script>

<script>
    $('input.usuario').autocomplete({
        data: {
          "Apple": null,
          "Microsoft": null,
          "Google": 'https://placehold.it/250x250'
        },
        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
          // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });
</script>
@stop
