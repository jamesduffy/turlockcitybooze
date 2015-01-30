<ul class="nav navbar-nav">
  <li @if (Request::segment(2) === '/') class="active" @endif>
      {{ link_to_action('Manage\DashboardController@getIndex', 'Dashboard') }}</li>

  @if(Auth::user()->can('list_beers'))
    <li @if (Request::segment(2) === 'beers') class="active" @endif>
      {{ link_to_action('Manage\BeersController@getIndex', 'Beers') }}</li>
  @endif

  @if(Auth::user()->can('list_events'))
    <li @if (Request::segment(2) === 'events') class="active" @endif>
      {{ link_to_action('Manage\EventsController@getIndex', 'Events') }}</li>
  @endif

  @if(Auth::user()->can('list_venues'))
    <li @if (Request::segment(2) === 'venues') class="active" @endif>
      {{ link_to_action('Manage\VenuesController@getIndex', 'Venues') }}</li>
  @endif

  @if(Auth::user()->can('list_pages'))
    <li @if (Request::segment(2) === 'pages') class="active" @endif>
      {{ link_to_action('Manage\PagesController@getIndex', 'Pages') }}</li>
  @endif

  @if(Auth::user()->can('list_posts'))
    <li @if (Request::segment(2) === 'posts') class="active" @endif>
      {{ link_to_action('Manage\PostsController@getIndex', 'Posts') }}</li>
  @endif

  @if(Auth::user()->can('list_files'))
    <li @if (Request::segment(2) === 'files') class="active" @endif>
      {{ link_to_action('Manage\FilesController@getIndex', 'Files') }}</li>
  @endif
  
  @if(Auth::user()->can('list_users'))
    <li @if (Request::segment(2) === 'users') class="active" @endif>
      {{ link_to_action('Manage\UsersController@getIndex', 'Users') }}</li>
  @endif

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      External Tools <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="https://www.google.com/adsense/app#home" target="_blank"><i class="fa fa-external-link"></i> AdSense</a></li>
      <li><a href="https://www.google.com/analytics/web/" target="_blank"><i class="fa fa-external-link"></i> Analytics</a></li>
      <li><a href="https://www.cloudflare.com/my-websites" target="_blank"><i class="fa fa-external-link"></i> CloudFlare</a></li>
      <li><a href="https://hootsuite.com/dashboard" target="_blank"><i class="fa fa-external-link"></i> Hootsuite</a></li>
      <li><a href="https://support.google.com/analytics/answer/1033867?hl=en" target="_blank"><i class="fa fa-external-link"></i> URL Builder</a>
      <li><a href="https://www.google.com/webmasters/tools/home?hl=en" target="_blank"><i class="fa fa-external-link"></i> Webmaster Tools</a></li>
    </ul>
  </li>
</ul>

<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
      @if(Auth::user()->can('list_settings'))
        <li @if (Request::segment(2) === 'settings') class="active" @endif>
          {{ link_to_action('Manage\SettingsController@getIndex', 'Settings') }}</li>
      @endif

      <li>{{ link_to_action('UserController@getLogout', 'Logout') }}</li>
    </ul>
  </li>
</ul>