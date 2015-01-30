@extends('layouts.manage')

@section('page-header')
	<h1>
		Edit Post: {{ $post->title }}
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/posts/edit', 'files' => true)) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $post->id) }}

		{{ $errors->first('title') }}

		<div class="form-group">
			<label for="title">Title</label>
			{{ Form::text('title', $post->title, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('body_markdown') }}

		<div class="form-group">
			<label for="body_markdown">Body</label>
			{{ Form::textarea('body_markdown', $post->body_markdown, array('class'=>'form-control monospace-field')) }}
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
		{{ link_to_action('Manage\PostsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		<div class="panel panel-default">
			<div class="panel-heading">Featured Image</div>
			
			<div class="panel-body">
				@if (count($featured_image))
					<img src="/files/{{ $featured_image->filename }}" class="img-responsive">
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
					{{ Form::select('status', $statuses, $post->status, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="created_by">Author</label>
					{{ Form::select('created_by_id', $users, $post->created_by_id, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	{{ Form::close() }}
</div>
@stop