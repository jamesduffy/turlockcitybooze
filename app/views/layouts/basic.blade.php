<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{{ isset($title) ? $title.' - Turlock City Booze' : 'Turlock City Booze' }}}</title>

    <link rel="icon" type="image/png" href="/img/beer36x36.png">

    <link rel="apple-touch-icon" href="/img/beers72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/beers72x72.png">

    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="description" content="{{{ isset($description) ? $description : 'We help you find Happy Hours happening right now in Turlock. Find reviews of beers, bars, restaurants and more.' }}}">
    <meta name="keywords" content="turlock,beer,bar,bars,booze,happy,hour,hours,drink,events,upcoming,review,reviews">
    <meta name="author" content="{{{ isset($author) ? $author : 'Turlock City Booze' }}}">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@turlockbooze"/>
    <meta name="twitter:creator" content="{{{ isset($og_creator) ? '@'.$og_creator : '' }}}"/>
    <meta name="twitter:url" content="{{ Request::url() }}" />
    <meta name="twitter:title" content="{{{ isset($title) ? $title : 'Turlock City Booze' }}}">
    <meta name="twitter:description" content="{{{ isset($description) ? $description : 'We help you find Happy Hours happening right now in Turlock. Find reviews of beers, bars, restaurants and more.' }}}" />
    <meta name="twitter:image" content="https://turlockcitybooze.com/files/{{{ isset($og_image) ? $og_image : 'SrxxLNhtS0oW.png' }}}">

    @if (isset($og_image))
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:image:src" content="https://turlockcitybooze.com/files/{{{ isset($og_image) ? $og_image : 'SrxxLNhtS0oW.png' }}}">
      <meta property="og:image" content="https://turlockcitybooze.com/files/{{{ isset($og_image) ? $og_image : 'SrxxLNhtS0oW.png' }}}">
    @else
      <meta name="twitter:card" content="summary"/>
      <meta property="og:image" content="https://turlockcitybooze.com/files/SrxxLNhtS0oW.png" />
    @endif

    <meta name="twitter:site" content="@turlockbooze"/>
    <meta name="twitter:creator" content="{{{ isset($og_creator) ? '@'.$og_creator : '' }}}"/>
    <meta name="twitter:url" content="{{ Request::url() }}" />
    <meta name="twitter:title" content="{{{ isset($title) ? $title : 'Turlock City Booze' }}}">
    <meta name="twitter:description" content="{{{ isset($description) ? $description : 'We help you find Happy Hours happening right now in Turlock. Find reviews of beers, bars, restaurants and more.' }}}" />

    <meta property="og:site_name" content="Turlock City Booze"/>
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:title" content="{{{ isset($title) ? $title : 'Turlock City Booze' }}}" />
    <meta property="og:description" content="{{{ isset($description) ? $description : 'We help you find Happy Hours happening right now in Turlock. Find reviews of beers, bars, restaurants and more.' }}}" />

    <link href="/css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1516407621937745&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <header class="container">
      <div class="jumbotron hidden-xs">
        <h1><a href="/"><i class="fa fa-beer"></i> Turlock City Booze</a></h1>
        <p>Explore the best watering holes in Turlock</p>
      </div>

      <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse-1">Turlock City Booze</span>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li @if (Request::segment(1) === '/') class="active" @endif>
                {{ link_to_action('HomeController@getIndex', 'Home') }}</li>
              <li @if (Request::segment(1) === 'news') class="active" @endif>
                {{ link_to_action('PostController@getIndex', 'News') }}</li>
              <li @if (Request::segment(1) === 'beers') class="active" @endif>
                {{ link_to_action('BeerController@getIndex', 'Beers') }}</li>
              <li @if (Request::segment(1) === 'events') class="active" @endif>
                {{ link_to_action('EventController@getIndex', 'Events') }}</li>
              <li @if (Request::segment(1) === 'venues') class="active" @endif>
                {{ link_to_action('VenueController@getIndex', 'Venues') }}</li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>{{ link_to_action('PageController@getIndex', 'About', 'about') }}</li>
                  <li>{{ link_to_action('PageController@getIndex', 'Terms of Service', 'terms') }}</li>
                  <li>{{ link_to_action('PageController@getIndex', 'Privacy Policy', 'privacy') }}</li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="container">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Above content (responsive) -->
      <ins class="adsbygoogle"
           style="display:block;margin-bottom:15px;"
           data-ad-client="ca-pub-6630597458428556"
           data-ad-slot="6522876100"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>

    <div class="main-container container">
      <div class="page-header">
        @yield('page-header')
      </div>

      <div class="container-fluid">
        @yield('main-content')
      </div>
    </div>

    <div class="container">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Below content (responsive) -->
      <ins class="adsbygoogle"
           style="display:block;margin-top:15px;margin-bottom:15px;"
           data-ad-client="ca-pub-6630597458428556"
           data-ad-slot="7999609309"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>

    <footer class="container">
        <div class="text-center">
          <p>
            <a href="#"><i class="fa fa-arrow-up"></i> Back to Top</a>
          </p>
          <ul class="nav nav-pills nav-stacked">
            <li>{{ link_to_action('HomeController@getIndex', 'Current Happy Hours') }}</li>
            <li>{{ link_to_action('PostController@getIndex', 'News') }}</li>
            <li>{{ link_to_action('EventController@getIndex', 'Events') }}</li>
            <li>{{ link_to_action('VenueController@getIndex', 'Venues') }}</li>
            <li>{{ link_to_action('PageController@getIndex', 'About', 'about') }}</li>
            <li>{{ link_to_action('PageController@getIndex', 'Terms of Service', 'terms') }}</li>
            <li>{{ link_to_action('PageController@getIndex', 'Privacy Policy', 'privacy') }}</li>
          </ul>
          <hr>
          <h4>Connect with us on</h4>
          <p>
            <a href="http://twitter.com/TurlockBooze" style="margin-right:15px;"><i class="fa fa-2x fa-twitter"></i></a>
            <a href="http://facebook.com/turlockcitybooze" style="margin-right:15px;"><i class="fa fa-2x fa-facebook"></i></a>
            <a href="http://instagram.com/turlockcitybooze"><i class="fa fa-2x fa-instagram"></i></a>
          </p>
          <hr>
          <p>CafeDuff &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    @if (Auth::check())
    <style type="text/css">
      body { padding-top: 70px; }
    </style>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="navbar-brand visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse-2">TCB Admin</span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
          @include('elements/admin-menu')
        </div>
      </div>
    </nav>
    @endif

    @section('javascript')
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

      <!-- Facebook -->
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '1516407621937745',
            xfbml      : true,
            version    : 'v2.1'
          });
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>

      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-23906018-4', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
      </script>

      <script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
      <script type="text/javascript">
      twttr.conversion.trackPid('l4yw9');
      </script>
      <noscript>
      <img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l4yw9&p_id=Twitter" />
      <img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l4yw9&p_id=Twitter" />
      </noscript>

      <script src="/js/modernizr-min.js"></script>
      <script src="/js/fastclick-min.js"></script>
    @show
  </body>
</html>
