@extends('layouts.manage')

@section('page-header')
	<h1>
		Edit {{ $page->title }} Page
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/pages/edit')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $page->id) }}

		{{ $errors->first('title') }}

		<div class="form-group">
			<label for="title">Title</label>
			{{ Form::text('title', $page->title, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('slug') }}

		<div class="form-group">
			<label for="slug">Slug</label>
			{{ Form::text('slug', $page->slug, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('Body') }}

		<div class="form-group">
			<label for="body_markdown">Body</label>
			{{ Form::textarea('body_markdown', $page->body_markdown, array('class'=>'form-control monospace-field')) }}
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
		{{ link_to_action('Manage\PagesController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, $page->status, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	{{ Form::close() }}
</div>
@stop