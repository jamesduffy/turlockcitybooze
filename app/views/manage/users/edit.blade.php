@extends('layouts.manage')

@section('page-header')
	<h1>Edit {{ $user->first_name }} {{ $user->last_name }}</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/users/edit', 'files' => true)) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $user->id) }}

		{{ $errors->first('email') }}

		<div class="form-group">
			<label for="email">Email</label>
			{{ Form::text('email', $user->email, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('first_name') }}

		<div class="form-group">
			<label for="first_name">First Name</label>
			{{ Form::text('first_name', $user->first_name, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('last_name') }}

		<div class="form-group">
			<label for="last_name">Last Name</label>
			{{ Form::text('last_name', $user->last_name, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('twitter_username') }}

		<div class="form-group">
			<label for="twitter_username">Twitter Username</label>
			{{ Form::text('twitter_username', $user->twitter_username, array('class'=>'form-control')) }}
			<p class="help-block small">Do not include @</p>
		</div>

		{{ $errors->first('about_markdown') }}

		<div class="form-group">
			<label for="value">About</label>
			{{ Form::textarea('about_markdown', $user->about_markdown, array('class'=>'form-control monospace-field')) }}
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
		{{ link_to_action('Manage\UsersController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}

		<div class="panel panel-default">
			<div class="panel-heading">Profile Image</div>
			
			<div class="panel-body">
				@if (count($profile_image))
					<img src="/files/{{ $profile_image->filename }}" class="img-responsive">
				@endif

				<div class="form-group">
					{{ Form::file('profile_image') }}
				</div>
			</div>
		</div>

		<hr>

		<p class="text-center">
			{{ link_to_action('Manage\UsersController@getPasswordUpdate', 'Update Password', $user->id) }}
		</p>

		<p class="text-center">
			{{ link_to_action('Manage\UsersController@getPermissions', 'Update Permissions', $user->id) }}
		</p>

		<p class="text-center">
			{{ link_to_action('Manage\UsersController@getDelete', 'Delete', $user->id, array('class'=>'text-danger')) }}
		</p>
	</div>

	{{ Form::close() }}
</div>
@stop