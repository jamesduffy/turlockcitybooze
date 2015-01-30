@extends('layouts.basic', array(
  'title' => 'Reviewed Beers'
))

@section('page-header')
	<div class="inner-padding">
		<h1>Reviewed Beers</h1>
	</div>
@stop

@section('main-content')
<div class="row">
	<div class="col-md-8">
		<?php $count = 0; ?>
		@foreach($beers as $beer)
			<?php $count++; ?>

			@if($count == 6)
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Beer List Embedded -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-6630597458428556"
			     data-ad-slot="2013134507"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			<hr>
			@endif

			<div class="media">
				<a class="feature-image" href="{{ action('BeerController@getDetail', array($beer->id, urlencode($beer->name))) }}">
					@if (isset($beer->feature_image->filename))
						<img class="img-responsive" src="/image/cache/medium/{{ $beer->feature_image->filename }}">
					@else
						<div class="well no-image-placeholder">
							<i class="fa fa-beer"></i>
						</div>
					@endif
				</a>
				<div class="media-body">
					<div class="media-heading">
						<h3>
							{{ link_to_action('BeerController@getDetail', $beer->name, array($beer->id, urlencode($beer->name))) }}<br>
                			<span class="small">{{ $beer->brewery }}</span>
                		</h3>
						<p class="text-muted small">
							Reviewed by {{
								link_to_action(
									'UserController@getDetail',
									$beer->author->first_name.' '.$beer->author->last_name,
									array($beer->author->id, $beer->author->first_name, $beer->author->last_name)
								)
							}} |
							{{ date('l F j, Y', strtotime($beer->created_at)) }}
						</p>
					</div>

					<p>{{ substr(strip_tags($beer->body_html),0,200) }}</p>
					<p>{{ link_to_action('BeerController@getDetail', 'Read More', array($beer->id, urlencode($beer->name))) }}</p>
				</div>
			</div>
		@endforeach

		{{ $beers->links() }}
	</div>

	<div class="col-md-4">
		@include('elements.sidebar')
	</div>
</div>
@stop
