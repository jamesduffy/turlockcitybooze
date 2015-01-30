@extends('layouts.manage')

@section('page-header')
	<h1>
		Beers
		
		<span class="pull-right">
			@if( Auth::user()->can('create_beer') )
				{{ link_to_action('Manage\BeersController@getCreate', 'New Beer', null, array('class' => 'btn btn-lg btn-primary')) }}
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
					<th>Brewery</th>
					<th>Author</th>
					<th>Status</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($beers as $beer)
				<tr>
					<td>{{ $beer->name }}</td>
					<td>{{ $beer->brewery }}</td>
					<td>{{ $beer->first_name }} {{ $beer->last_name }}</td>
					<td>{{ $beer->status }}</td>
					<td>{{ $beer->updated_at }}</td>
					<td>
						@if (
							(Auth::user()->can('edit_beer') AND $beer->status != 'published')
							OR
							(Auth::user()->can('publish_beer'))
						)
							{{ link_to_action('Manage\BeersController@getEdit', 'Edit', array($beer->id)) }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop