@extends('layouts.manage')

@section('page-header')
	<h1>
		Edit {{ $event->title }} Event
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/events/edit', 'files' => true)) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $event->id) }}

		{{ $errors->first('title') }}

		<div class="form-group">
			<label for="title">Title</label>
			{{ Form::text('title', $event->title, array('class'=>'form-control')) }}
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="start_time">Start</label>
					{{ Form::text('start_time', date('m/j/Y h:ia', $event->start_time), array('class'=>'form-control')) }}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="end_time">End</label>
					{{ Form::text('end_time', date('m/j/Y h:ia', $event->end_time), array('class'=>'form-control')) }}
				</div>
			</div>
		</div> 

		{{ $errors->first('Body') }}

		<div class="form-group">
			<label for="body_markdown">Body</label>
			{{ Form::textarea('body_markdown', $event->body_markdown, array('class'=>'form-control monospace-field')) }}
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
		{{ link_to_action('Manage\EventsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		<div class="panel panel-default">
			<div class="panel-heading">Location</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="venue_id">Venue</label>
					@if (isset($event->venue->id))
						{{ Form::select('venue_id', $venues, $event->venue->id, array('class'=>'form-control')) }}
					@else
						{{ Form::select('venue_id', $venues, '', array('class'=>'form-control')) }}
					@endif
				</div>

				<hr>

				<div class="form-group">
					<label for="title">Street</label>
					{{ Form::text('street', $event->street, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="title">City</label>
					{{ Form::text('city', $event->city, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="title">State</label>
					{{ Form::text('state', $event->state, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="title">Zip</label>
					{{ Form::text('zip', $event->zip, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Featured Image</div>
			
			<div class="panel-body">
				@if (isset($event->feature_image->filename))
					<img src="/files/{{ $event->feature_image->filename }}" class="img-responsive">
				@endif

				<div class="form-group">
					{{ Form::file('featured_image'); }}
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, $event->status, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="created_by">Author</label>
					{{ Form::select('created_by', $users, $event->author->id, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

	</div>

	{{ Form::close() }}
</div>
@stop