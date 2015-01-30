@extends('layouts.basic', array(
  'title' => 'Happy Hours Right Now'
))

@section('page-header')
  <h1>Happy Hours Right Now</h1>
@stop

@section('main-content')
  <div class="row venue-tiles">
    @if (count($curr_happy_hours))
      @foreach ($curr_happy_hours as $venue)
        <a href="{{ action('VenueController@getDetail', array($venue->id, urlencode($venue->name))) }}" class="col-sm-12 col-md-4 thumbnail">
          <h3>{{ $venue->name }}</h3>

          @if ($venue->filename !== null)
            <img class="img-responsive" src="/image/cache/medium/{{ $venue->filename }}" width="100%">
          @endif

          <div class="caption">
            <small>
              Happy hour:
              @include('elements.hour_processor', array('hour' => $venue->start_hour))-
              @include('elements.hour_processor', array('hour' => $venue->end_hour))
            </small>

            <div class="progress">
              {{--*/ $progress = round((time() - strtotime($venue->start_hour.':00')) / (strtotime($venue->end_hour.':00') - strtotime($venue->start_hour.':00')), 2) * 100 /*--}}
              <div
                class="progress-bar @if($progress > 90) progress-bar-warning @endif @if($progress > 95) progress-bar-warning @endif"
                role="progressbar"
                style="width: {{ $progress }}%;">

                {{ $progress }}%
              </div>
            </div>
            <p>{{ substr(strip_tags($venue->body_html),0,100) }}...</p>
          </div>
        </a>
      @endforeach
    @else
      <div class="col-md-12">
        <h4>Looks like there are no happy hours right now. :(</h4>
      </div>
    @endif
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3>Recent News</h3>
    </div>
  </div>

  <div class="row">
    @foreach($recent_news as $post)
      <div class="col-md-4">
        <div class="media">
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
      </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3>Reviewed Beers</h3>
    </div>
  </div>

  <div class="row">
    @foreach($reviewed_beers as $beer)
      <div class="col-md-4">
        <div class="media">
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
      </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3>Upcoming Events</h3>
    </div>
  </div>

  <div class="row">
    @foreach($upcoming_events as $event)
      <div class="col-md-4">
        <div class="media">
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
      </div>
    @endforeach
  </div>

@stop
