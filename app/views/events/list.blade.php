@extends('layouts.basic', array(
  'title' => 'Upcoming Events'
))

@section('page-header')
	<div class="inner-padding">
		<h1>Events</h1>
	</div>
@stop

@section('main-content')
<div class="row">
	<div class="col-md-8">
		<?php $count = 0; ?>
		
		@foreach($events as $event)
		
		<?php $count++; ?>
		@if($count == 6)
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Event List Embedded -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-6630597458428556"
			     data-ad-slot="6443334104"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			<hr>
		@endif

		<div class="media">
			<a class="feature-image" href="{{ action('EventController@getDetail', array($event->id, urlencode($event->title))) }}">
				@if (isset($event->feature_image->filename))
					<img class="img-responsive" src="/image/cache/medium/{{ $event->feature_image->filename }}">
				@else
					<div class="well no-image-placeholder">
						<i class="fa fa-calendar-o"></i>
					</div>
				@endif
			</a>
			<div class="media-body">
				<div class="media-heading">
					<h3>{{ link_to_action('EventController@getDetail', $event->title, array($event->id, urlencode($event->title))) }}</h3>
					<p class="text-muted small">
						Shared
						@if(isset($event->author->id))
							by {{
								link_to_action(
									'UserController@getDetail',
									$event->author->first_name.' '.$event->author->last_name,
									array($event->author->id, $event->author->first_name, $event->author->last_name)
								)
							}}
						@endif
						on
						{{ date('l F j, Y', strtotime($event->created_at)) }}
					</p>
				</div>

				<p>{{ date('F jS g:ia', $event->start_time) }}&ndash;{{ date('g:ia', $event->end_time) }}</p>
				<p>{{ substr(strip_tags($event->body_html),0,200) }}</p>
				<p>{{ link_to_action('EventController@getDetail', 'More Information', array($event->id, urlencode($event->title))) }}</p>
			</div>
		</div>
		@endforeach

	    {{ $events->links() }}
	</div>

	<div class="col-md-4">
		@include('elements.sidebar')
	</div>
</div>
@stop
