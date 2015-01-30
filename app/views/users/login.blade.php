@extends('layouts.full-screen-form')

@section('body')
<div class="full-screen-form">
  {{ Form::open(array('url' => 'login', 'class'=>'form-signin')) }}
  	<h2 class="form-signin-heading">Please sign in</h2>
    {{ Form::token() }}
    
    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) }}
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    
    <label class="checkbox">
		{{ Form::checkbox('remember_me', 'value', false) }} Remember Me
	</label>

    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
  {{ Form::close() }}
</div>
@stop
