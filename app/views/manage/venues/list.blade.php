@extends('layouts.manage')

@section('page-header')
	<h1>
		Venues
		
		<span class="pull-right">
			@if( Auth::user()->can('create_venue') )
				{{ link_to_action('Manage\VenuesController@getCreate', 'New Venue', null, array('class' => 'btn btn-lg btn-primary')) }}
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
					<th>Name</th>
					<th>Author</th>
					<th>Status</th>
					<th>Address</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($venues as $venue)
				<tr>
					<td>{{ $venue->name }}</td>
					<td>{{ $venue->first_name}} {{ $venue->last_name }}</td>
					<td>{{ $venue->status }}</td>
					<td>{{ $venue->street }}</td>
					<td>{{ $venue->updated_at }}</td>
					<td>
						@if (
							(Auth::user()->can('edit_venue') AND $venue->status != 'published')
							OR
							(Auth::user()->can('publish_venue'))
						)
							{{ link_to_action('Manage\VenuesController@getEdit', 'Edit', array($venue->id)) }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $venues->links() }}
	</div>
</div>
@stop