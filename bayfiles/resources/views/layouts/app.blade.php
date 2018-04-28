<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Your Business') }}</title>

    <!-- Styles -->
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('css/tashi.css')}}" rel="stylesheet">

    <!--link href="{{ asset('bootstrap-3.3.6/css/bootstrap.min.css') }}" rel="stylesheet"-->
    
     <!-- Latest compiled and minified CSS -->
     
     <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
     <script src="{{ asset('bootstrap-3.3.6/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="row content">
    
            	<div class="visible-xs col-xs-3">
		    <a class="navbar-toggle" href="{{ url('/') }}"><img src="{{url('images/home.png')}}" height="20px"></a>
		</div>
                            
		<div class="navbar-header col-xs-9">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <!-- Branding Image -->
                    <!--a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Your Business') }}
                    </a-->


		 
                </div>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    
                        <ul class="nav navbar-nav navbar-left">
                            <li class="visible-lg visible-md"><a href="{{ url('/') }}"><img src="{{url('images/home.png')}}" height="20px"></a></li>
                            <li><a href="{{ url('categoryview/electronics') }}">Electronics</a></li>
                            <li><a href="{{ url('categoryview/vehicle') }}">Vehicle</a></li>
                            <li><a href="{{ url('categoryview/house') }}">Land & House</a></li>
                            <li><a href="{{ url('categoryview/retail') }}">Retail Goods</a></li>
                            <li><a href="{{ url('categoryview/services') }}">Services</a></li>
                            <li><a href="{{ url('categoryview/jobs') }}">Jobs</a></li>
                            <li><a href="{{ url('categoryview/freebies') }}">Freebies</a></li>
                            <li><a href="{{ url('categoryview/others') }}">Others</a></li>
			
                        </ul>
                    
                    <!-- /.navbar-collapse -->
                     
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                       
                        <!-- Authentication Links -->
                        <li><a href="{{ url('bssr/create') }}" class="btn btn-success">POST YOUR ADVERTISEMENT</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="userhome" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">
                                
                                     <li>
                                        <a href="{{ url('/userhome') }}"> My Home </a>
                                    </li>	
                                
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
                
    </div>

<div class="container">

  <!--  Content Area-->
  <div class="row content">
    
    <div class="col-md-10">
      
    
      <p>@yield('content')</p>
    
      </div>
    <div class="col-md-2">
      <p> </div>
  </div>
  
  <!--  Footer Area-->
  <div class="row footer">
    
  <div class="col-xs-12 text-center">
      <p>Best Viewed on Mobile Devices.</p>
      <p>&copy; 2017 Tashi</p>
      About us | Contact Us | Privacy Policy
    </div>
  </div>
  
</div>

</body>
</html>
