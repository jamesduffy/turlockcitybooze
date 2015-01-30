<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage TCB</title>

    <link href="/css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background:#fff;">

    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><i class="fa fa-arrow-left"></i> Back to site</a>          
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
          @include('elements/admin-menu')
        </div>
      </div>
    </nav>

    <div class="page-header" style="margin-top:-20px;">
      <div class="container-fluid">
        @yield('page-header')
      </div>
    </div>

    <div class="container-fluid" style="margin-top: 15px;">
      @if(Session::has('message'))
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-warning" role="alert">{{ Session::get('message') }}</div>
          </div>
        </div>
      @endif
    
      @yield('main-content')
    </div>

    <footer class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <hr>
          
          <p class="pull-right"><a href="#">Back to top</a></p>
          <p>CafeDuff &copy; {{ date('Y') }}. Confidential.</p>
        </div>
      </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>