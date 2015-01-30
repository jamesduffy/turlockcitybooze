@extends('layouts.manage')

@section('page-header')
	<h1>
		Users
		
		<span class="pull-right">
			@if( Auth::user()->can('edit_users') )
			 {{ link_to_action('Manage\UsersController@getCreate', 'New User', null, array('class' => 'btn btn-lg btn-primary')) }}
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
					<th>Email</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->first_name }} {{ $user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->created_at }}</td>
					<td>{{ $user->updated_at }}</td>
					<td>
						@if( Auth::user()->can('edit_users') OR Auth::id() == $user->id )
							{{ link_to_action('Manage\UsersController@getEdit', 'Edit', array($user->id)) }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop