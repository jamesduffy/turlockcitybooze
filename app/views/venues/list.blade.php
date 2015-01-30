@extends('layouts.basic', array(
  'title' => 'Venues in Turlock'
))

@section('page-header')
  <h1>Venues</h1>
@stop

@section('main-content')
  <div class="row">
    <div class="col-md-8">
      <?php $count = 0; ?>
      @foreach($venues as $venue)
        
        <?php $count++; ?>
        @if($count == 6)
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- Venue List Embedded -->
          <ins class="adsbygoogle"
               style="display:block"
               data-ad-client="ca-pub-6630597458428556"
               data-ad-slot="1873533709"
               data-ad-format="auto"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
          <hr>
        @endif

        <div class="media">
          <a class="feature-image" href="{{ action('VenueController@getDetail', array($venue->id, urlencode($venue->name))) }}">
            @if (isset($venue->feature_image->filename))
              <img class="img-responsive" src="/image/cache/medium/{{ $venue->feature_image->filename }}">
            @else
              <div class="well no-image-placeholder">
                <i class="fa fa-building-o"></i>
              </div>
            @endif
          </a>
          <div class="media-body">
            <div class="media-heading">
              <h3>{{ link_to_action('VenueController@getDetail', $venue->name, array($venue->id, urlencode($venue->name))) }}</h3>
              <p class="text-muted small">
                Reviewed
                @if (isset($venue->author->id))
                  by {{
                    link_to_action(
                      'UserController@getDetail',
                      $venue->author->first_name.' '.$venue->author->last_name,
                      array($venue->author->id, $venue->author->first_name, $venue->author->last_name)
                    )
                  }}
                @endif
                on
                {{ date('l F j, Y', strtotime($venue->updated_at)) }}
              </p>
            </div>

            <p>{{ substr(strip_tags($venue->body_html),0,200) }}</p>
            <p>{{ link_to_action('VenueController@getDetail', 'Read more', array($venue->id, urlencode($venue->name))) }}</p>
          </div>
        </div>
      @endforeach

      {{ $venues->links() }}
    </div>

    <div class="col-md-4">
      @include('elements.sidebar')
    </div>
  </div>
@stop
