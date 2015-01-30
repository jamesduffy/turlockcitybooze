@extends('layouts.basic', array(
  'title' => $post->title,
  'description' => substr(strip_tags($post->body_html),0,150),
  'og_image' => (isset($post->feature_image->filename) ? $post->feature_image->filename : null) 
))

@section('page-header')
	<h1>{{ $post->title }}</h1>
	<p>
    Posted on {{ 
      link_to_action(
        'PostController@getDetail',
        date('l F j, Y', strtotime($post->created_at)),
        array($post->id,
        urlencode($post->title))
      )
    }}.
    By {{
      link_to_action(
        'UserController@getDetail',
        $post->author->first_name.' '.$post->author->last_name,
        array($post->author->id, $post->author->first_name, $post->author->last_name)
      )
    }}.
  </p>
@stop

@section('main-content')
  <div class="row">
  	<div class="col-md-8">
      @include('elements/share-buttons')
			
      @if (isset($post->feature_image->filename))
				<img src="/image/cache/medium/{{ $post->feature_image->filename }}" class="featured-image thumbnail">
      @endif
			
      {{ $post->body_html }}

        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'turlockcitybooze'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

  	</div>

    <div class="col-md-4">
      @include('elements/sidebar')
    </div>
  </div>
@stop
