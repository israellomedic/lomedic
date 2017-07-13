@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body" style="text-align: center;">
                    {!! Form::open(['id'=>'form','enctype'=>'multipart/form-data','class'=>'section','style'=>'width:600px;']) !!}
                    <div class="row">
                    	<div class="input-field col s12">
                            {!! Form::text('Usuario', '', array('oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')','required' => 'required')); !!}
                            {!! Form::label('Usuario', 'Usuario :', null); !!}
                    	</div>
                    	<div class="input-field col s12">
                            {!! Form::password('Password', ['oninvalid'=>'setCustomValidity(\'Completa este campo\')', 'oninput'=>'setCustomValidity(\'\')']); !!}
                            {!! Form::label('Password', 'Password:', null); !!}
                    	</div>
                    	<div class="input-field col s12">
                            {!! Form::submit('Enviar',['class'=>'btn waves-effect waves-indigo red']); !!}
                    	</div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
