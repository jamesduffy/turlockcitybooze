@extends('layouts.basic', array(
  'title' => $user->first_name.' '.$user->last_name,
  'description' => substr(strip_tags($user->about_html),0,150),
  'og_image' => $user->filename
))

@section('page-header')
	<h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
  @if ($user->twitter_username !== '')
    <h4><a href="http://twitter.com/{{ $user->twitter_username }}">{{ '@'.$user->twitter_username }}</a></h4>
  @endif
@stop

@section('main-content')
  <div class="row">
  	<div class="col-md-8">
			@if ($user->filename !== null)
        <img src="/image/cache/profile/{{ $user->filename }}" class="featured-image thumbnail">
      @endif
			
			{{ $user->about_html }}
  	</div>

    <div class="col-md-4">
      @include('elements/sidebar')
    </div>
  </div>
@stop
