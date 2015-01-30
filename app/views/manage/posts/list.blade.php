@extends('layouts.manage')

@section('page-header')
	<h1>
		Posts
		
		<span class="pull-right">
			@if( Auth::user()->can('create_post') )
				{{ link_to_action('Manage\PostsController@getCreate', 'New Post', null, array('class' => 'btn btn-lg btn-primary')) }}
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
					<th>Status</th>
					<th>Author</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($posts as $post)
				<tr>
					<td>{{ $post->title }}</td>
					<td>{{ $post->status }}</td>
					<td>{{ $post->first_name }} {{ $post->last_name }}</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->updated_at }}</td>
					<td>{{ link_to_action('Manage\PostsController@getEdit', 'Edit', array($post->id)) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop