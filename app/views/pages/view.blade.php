@extends('layouts.basic', array(
  'title' => $page->title,
  'description' => substr(strip_tags($page->body_html),0,150)
))

@section('page-header')
  <h1>{{ $page->title }}</h1>
@stop

@section('main-content')
  <div class="row">
    <div class="col-md-8">
      @if ($page->slug == 'terms' OR $page->slug == 'privacy')
        <p><strong>Last Updated At: {{ date('Y-m-d', strtotime($page->updated_at)) }}</strong></p>
      @endif

      {{ $page->body_html }}
    </div>

    <div class="col-md-4 sidebar">
      @include('elements/sidebar')
    </div>
  </div>
@stop
