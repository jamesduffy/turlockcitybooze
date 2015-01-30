@extends('layouts.basic', array(
  'title' => $event->title,
  'description' => substr(strip_tags($event->body_html),0,150),
  'og_image' => $event->filename
))

@section('page-header')
	<h1>{{ $event->title }}</h1>
	<h4>{{ date('F jS g:ia', $event->start_time) }}&ndash;{{ date('g:ia', $event->end_time) }}</h4>
@stop

@section('main-content')
  <div class="row">
  	<div class="col-md-8">
      @include('elements/share-buttons')

			@if (isset($event->feature_image->filename))
        <img src="/image/cache/medium/{{ $event->feature_image->filename }}" class="featured-image thumbnail">
      @endif

			{{ $event->body_html }}
  	</div>

    <div class="col-md-4">
      @if (isset($event->venue->street))
        @include('elements.map', array('street'=>$event->venue->street))
      @elseif ($event->street !== null)
        @include('elements.map', array('street'=>$event->street))
      @endif

      @if(isset($event->venue->id))
      <address>
        {{ $event->venue->name }}<br>
        {{ $event->venue->street }}<br>
        Turlock, CA {{ $event->venue->zip }}
      </address>
      @endif
    </div>
  </div>
@stop
