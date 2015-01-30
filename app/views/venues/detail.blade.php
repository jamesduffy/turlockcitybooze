@extends('layouts.basic', array(
  'title' => $venue->name,
  'description' => substr(strip_tags($venue->body_html),0,150),
  'og_image' => (isset($venue->feature_image->filename) ? $venue->feature_image->filename : null)
))

@section('page-header')
	<h1>{{ $venue->name }}</h1>
@stop

@section('main-content')
  <div class="row">
  	<div class="col-md-8">
  		@include('elements/share-buttons')

		@if (isset($venue->feature_image->filename))
          <img src="/image/cache/large/{{ $venue->feature_image->filename }}" class="featured-image thumbnail">
        @endif

        {{ $venue->body_html }}

        <hr>

        <h4>Location</h4>
        <address>
			{{ $venue->street }},
			{{ $venue->city }}, {{ $venue->state }} {{ $venue->zip }}
		</address>
        @include('elements.map', array('street'=>$venue->street))
    </div>

    <div class="col-md-4">
		@if(count($venue->meta))
	        <h4>Details</h4>
	        
	        <p>
	        @foreach($venue->meta as $meta)
	        	<span class="label label-default">{{ $meta->description }}</span>
	        @endforeach
	        </p>

	        <hr>
        @endif

		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Venue Sidebar -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:250px"
		     data-ad-client="ca-pub-6630597458428556"
		     data-ad-slot="5378730106"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>

		<h4>Happy Hours</h4>

		@if (count($happy_hours))
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Day</th>
						<th>Start</th>
						<th>End</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($happy_hours as $happy_hour)
					<tr>
						<td> @include('elements.day_processor', array('day' => $happy_hour->day_of_week)) </td>
						<td> @include('elements.hour_processor', array('hour' => $happy_hour->start_hour)) </td>
						<td> @include('elements.hour_processor', array('hour' => $happy_hour->end_hour)) </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>No known Happy Hours</p>
		@endif
    </div>

  </div>
@stop
