@extends('layouts.manage')

@section('page-header')
	<h1>
		Pages
		
		<span class="pull-right">
			@if( Auth::user()->can('create_page') )
				{{ link_to_action('Manage\PagesController@getCreate', 'New Page', null, array('class' => 'btn btn-lg btn-primary')) }}
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
					<th>Slug</th>
					<th>Status</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($pages as $page)
				<tr>
					<td>{{ $page->title }}</td>
					<td>{{ $page->slug }}</td>
					<td>{{ $page->status }}</td>
					<td>{{ $page->created_at }}</td>
					<td>{{ $page->updated_at }}</td>
					<td>{{ link_to_action('Manage\PagesController@getEdit', 'Edit', array($page->id)) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop