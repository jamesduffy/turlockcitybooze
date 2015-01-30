@extends('layouts.manage')

@section('page-header')
	<h1>
		Events
		
		<span class="pull-right">
			@if( Auth::user()->can('create_event') )
				{{ link_to_action('Manage\EventsController@getCreate', 'New Event', null, array('class' => 'btn btn-lg btn-primary')) }}
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
					<th>Title</th>
					<th>Author</th>
					<th>Start</th>
					<th>End</th>
					<th>Status</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($events as $event)
				<tr>
					<td>{{ $event->title }}</td>
					<td>
						@if(isset($event->author->id))
							{{ $event->author->first_name }} {{ $event->author->last_name }}
						@endif
					</td>
					<td>{{ date('m/j/Y h:ia', $event->start_time) }}</td>
					<td>{{ date('m/j/Y h:ia', $event->end_time) }}</td>
					<td>{{ $event->status }}</td>
					<td>{{ $event->updated_at }}</td>
					<td>
						@if (
							(Auth::user()->can('edit_event') AND $event->status != 'published')
							OR
							(Auth::user()->can('publish_event'))
						)
							{{ link_to_action('Manage\EventsController@getEdit', 'Edit', array($event->id)) }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop