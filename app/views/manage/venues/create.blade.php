@extends('layouts.manage')

@section('page-header')
	<h1>
		Create Venue
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/venues/create')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ $errors->first('name') }}

		<div class="form-group">
			<label for="name">Name</label>
			{{ Form::text('name', null, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('body_markdown') }}

		<div class="form-group">
			<label for="body_markdown">Body</label>
			{{ Form::textarea('body_markdown', null, array('class'=>'form-control monospace-field')) }}
			<code class="help-block small">
				*italicized*
				**bold**
				[This link](http://example.net/)
				![Alt text](/path/to/img.jpg "Optional title")
			</code>
		</div>
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
						{{ Form::text('street', null, array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="title">City</label>
						{{ Form::text('city', 'Turlock', array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="title">State</label>
						{{ Form::text('state', 'California', array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="title">Zip</label>
						{{ Form::text('zip', null, array('class'=>'form-control')) }}
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, 'draft', array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="created_by">Author</label>
					{{ Form::select('created_by', $users, Auth::id(), array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

	</div>

	{{ Form::close() }}
</div>
@stop