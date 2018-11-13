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
    <!--link href="{{url('css/app.css')}}" rel="stylesheet"-->
    <!--link href="{{url('css/tashi.css')}}" rel="stylesheet"-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Load AngularJS Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
    <script src="<?= asset('app/app.js') ?>"></script>
    <script src="<?= asset('app/services/bssrService.js') ?>"></script> 
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular-route.js"></script>
    
</head>
<body>
    <div id="app">
        
        <!--Main Navigation-->
        <header>

        <nav class="navbar navbar-expand-lg navbar-dark default-color">
            <div class="col-xs-3 d-block d-sm-none navbar-brand">
		        <a class="navbar-toggle" href="{{ url('/') }}"><i class="material-icons mt-1">home</i></a>
		    </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto d-flex">
                    <li class="d-none d-sm-block nav-item active"><a href="{{ url('/') }}"><i class="material-icons mt-1">home</i></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/electronics') }}"> Electronics <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/vehicle') }}"> Vehicle </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/house') }}"> Land & House </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/retail') }}"> Retail Goods </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/jobs') }}">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/freebies') }}">Freebies</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('categoryview/others') }}">Others</a></li>
                </ul>
                <ul class="navbar-nav nav-flex-icons navbar-right d-flex align-items-center">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('bssr/create') }}" class="btn btn-success">POST YOUR ADVERTISEMENT</a></li>
                    @if (Auth::guest())
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li> |
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="userhome" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            
                            <div class="dropdown-menu">
                            
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/userhome') }}"> 
                                        <i class="material-icons">settings</i>
                                         | My Home 
                                    </a>
                                
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="material-icons">power_settings_new</i> | Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        </header>
        <!--Main Navigation-->
    </div>

    <div class="container-fluid">
        <!--  Content Area-->
        <div class="row content">      
            <div class="col-md-10">
            
                <p>@yield('content')</p>
            
            </div>
            <div class="col-md-2">
                <p>
            </div>
        </div>
        
        <!--  Footer Area-->
        <div class="row footer">
            <div class="col-12 text-center">
                <p>Best Viewed on Mobile Devices.</p>
                <p>&copy; 2017 Tashi</p>
                About us | Contact Us | Privacy Policy
            </div>
        </div>
    </div>

<!-- jQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>

<script src="<?= asset('js/url.js') ?>"></script>

<!-- fancyBox files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

<script>
// MDB Lightbox Init
$(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});
</script>
</body>
</html>
