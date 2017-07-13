@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body" style="text-align: center;">
                    {!! Form::open(['url' => '/Seguridad/login','id'=>'form','enctype'=>'multipart/form-data','class'=>'section','style'=>'width:600px;']) !!}
                    <div class="row">
                    	<div class="input-field col s12">
                            @if(isset($errors) && $errors->any())
                            <ul class="alert alert-danger" style="list-style-type: none">
                                @foreach($errors->all() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                 
                        <h2>Log in</h2>
                        
             			<div class="input-field col s12">
                            {{ Form::text('usuario') }}
                            {{ Form::label('usuario', 'Usuario') }}
             			</div>
             			<div class="input-field col s12">
                            {{ Form::password('password') }}
                            {{ Form::label('password', utf8_encode('Contraseña')) }}
                        </div>
             			<div class="input-field col s6">
                            {{ Form::checkbox('remember', '1',1,['title'=>"Recordar Sesion"]) }}
                            {{ Form::label('remember', 'Recordar', null) }}
						</div>
						<div class="input-field col s6">
                        	{{ Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) }}
                		</div>
                    </div>
                    {{ Form::close() }}
                    
                </div>
                @if(Session::has('error_message'))
                	{{ Session::get('error_message') }}
            	@endif
            </div>
        </div>
    </div>
</div>
@endsection
