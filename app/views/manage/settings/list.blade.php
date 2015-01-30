@extends('layouts.manage')

@section('page-header')
	<h1>
		Settings
		
		<span class="pull-right">
			@if( Auth::user()->can('create_setting') )
				{{ link_to_action('Manage\SettingsController@getCreate', 'New Setting', null, array('class' => 'btn btn-lg btn-primary')) }}
			@endif
		</span>
	</h1>
@stop

@section('main-content')
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Key</th>
					<th>Value</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($settings as $setting)
				<tr>
					<td>{{ $setting->key }}</td>
					<td>{{ $setting->value }}</td>
					<td>{{ $setting->created_at }}</td>
					<td>{{ $setting->updated_at }}</td>
					<td>{{ link_to_action('Manage\SettingsController@getEdit', 'Edit', array($setting->id)) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop