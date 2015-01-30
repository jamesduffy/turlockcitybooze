@extends('layouts.manage')

@section('page-header')
	<h1>
		Edit {{ $venue->name }}
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/venues/edit', 'files' => true)) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $venue->id) }}

		{{ $errors->first('name') }}

		<div class="form-group">
			<label for="name">Name</label>
			{{ Form::text('name', $venue->name, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('body_markdown') }}

		<div class="form-group">
			<label for="body_markdown">Body</label>
			{{ Form::textarea('body_markdown', $venue->body_markdown, array('class'=>'form-control monospace-field')) }}
			<code class="help-block small">
				*italicized*
				**bold**
				[This link](http://example.net/)
				![Alt text](/path/to/img.jpg "Optional title")
			</code>
		</div>

		<hr>

		<h3>
			Happy Hours
			<small class="pull-right">{{ link_to_action('Manage\VenuesController@getAddHappyHour', 'Add Happy Hour', $venue->id) }}</small>
		</h3>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Day</th>
					<th>Start</th>
					<th>End</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@if (count($happy_hours))
					@foreach ($happy_hours as $happy_hour)
					<tr>
						<td> @include('elements.day_processor', array('day' => $happy_hour->day_of_week)) </td>
						<td> @include('elements.hour_processor', array('hour' => $happy_hour->start_hour)) </td>
						<td> @include('elements.hour_processor', array('hour' => $happy_hour->end_hour)) </td>
						<td>{{ link_to_action('Manage\VenuesController@getDeleteHappyHour', 'Delete', array($happy_hour->id)) }}</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('Manage\VenuesController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		<div class="panel panel-default">
			<div class="panel-heading">Location</div>
			
			<div class="panel-body">
				<div class="form-group">
					<div class="form-group">
						<label for="title">Street</label>
						{{ Form::text('street', $venue->street, array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="title">City</label>
						{{ Form::text('city', $venue->city, array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="title">State</label>
						{{ Form::text('state', $venue->state, array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="title">Zip</label>
						{{ Form::text('zip', $venue->zip, array('class'=>'form-control')) }}
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Featured Image</div>
			
			<div class="panel-body">
				@if (isset($venue->feature_image->filename))
					<img src="/files/{{ $venue->feature_image->filename }}" class="img-responsive">
				@endif

				<div class="form-group">
					{{ Form::file('featured_image'); }}
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				Meta
				<span class="pull-right">{{ link_to_action('Manage\VenuesController@getEditMeta', 'Edit Meta', $venue->id) }}</span>
			</div>
			
			<div class="panel-body">
			
				@foreach($venue->meta as $item)
					<span class="label label-default">{{ $item->description }}</span>
				@endforeach
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, $venue->status, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="created_by">Author</label>
					{{ Form::select('created_by', $users, $venue->created_by_id, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

		<hr>

		<p class="text-center">
			{{ link_to_action('Manage\VenuesController@getDelete', 'Delete', $venue->id, array('class' => 'text-danger')) }}
		</p>

	</div>

	{{ Form::close() }}
</div>
@stop