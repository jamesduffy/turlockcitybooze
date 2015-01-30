@extends('layouts.manage')

@section('page-header')
	<h1>Upload File</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/files/upload', 'files' => true)) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ $errors->first('file') }}

		{{ Form::file('file') }}
	</div>

	<div class="col-md-3">
		{{ Form::submit('Upload', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('Manage\SettingsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	</div>

	{{ Form::close() }}
</div>
@stop