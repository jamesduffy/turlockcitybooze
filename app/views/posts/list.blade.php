@extends('layouts.basic', array(
  'title' => 'Recent Posts'
))

@section('page-header')
	<h1>News</h1>
@stop

@section('main-content')
<div class="row">
	<div class="col-md-8">
		<?php $count = 0; ?>
		
		@foreach($posts as $post)			
			<?php $count++; ?>
			
			@if($count == 6)
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- News List Embedded -->
				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-6630597458428556"
				     data-ad-slot="3489867704"
				     data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				<hr>
			@endif

			<div class="media">
				<a class="feature-image" href="{{ action('PostController@getDetail', array($post->id, urlencode($post->title))) }}">
					@if (isset($post->feature_image->filename))
						<img class="img-responsive" src="/image/cache/medium/{{ $post->feature_image->filename }}">
					@else
						<div class="well no-image-placeholder">
							<i class="fa fa-newspaper-o"></i>
						</div>
					@endif
				</a>
				<div class="media-body">
					<div class="media-heading">
						<h3>{{ link_to_action('PostController@getDetail', $post->title, array($post->id, urlencode($post->title))) }}</h3>
						<p class="text-muted small">
							By {{
								link_to_action(
									'UserController@getDetail',
									$post->author->first_name.' '.$post->author->last_name,
									array($post->author->id, $post->author->first_name, $post->author->last_name)
								)
							}} on
							{{ date('l F j, Y', strtotime($post->created_at)) }}
						</p>
					</div>

				  	<p>{{ substr(strip_tags($post->body_html),0,200) }}</p>
				  	<p>{{ link_to_action('PostController@getDetail', 'Read More', array($post->id, urlencode($post->title))) }}</p>
				</div>
			 </div>
		@endforeach

		{{ $posts->links() }}
	</div>

	<div class="col-md-4">
		@include('elements.sidebar')
	</div>
</div>
@stop
