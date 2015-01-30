@extends('layouts.manage')

@section('page-header')
	<h1>Edit Setting</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/settings/edit')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $setting->id) }}

		<div class="form-group">
			<label for="key">Key</label>
			<p class="form-control-static">{{ $setting->key }}</p>
		</div>

		{{ $errors->first('value') }}

		<div class="form-group">
			<label for="value">Value</label>
			{{ Form::textarea('value', $setting->value, array('class'=>'form-control monospace-field')) }}
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('Manage\SettingsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
		
		<hr>

		<p class="text-center">
			{{ link_to_action('Manage\SettingsController@getDelete', 'Delete', $setting->id, array('class' => 'text-danger')) }}
		</p>
	</div>

	{{ Form::close() }}
</div>
@stop