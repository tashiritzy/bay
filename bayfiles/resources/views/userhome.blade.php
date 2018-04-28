@extends('./layouts.app')

@section('content')

@if (Auth::guest())
 <center>Please <a href="{{ url('login') }} "> login</a> to view your advertisements or <br/><a href="{{url('register')}}"> register</a> to post advertisements </center>
@else

{{ csrf_field() }}

@include('search')

	<center>
	<font color="green">
	
	
	{{ $message or " " }}
	
	
	</font>
	</center>

<div class="container-fluid">
    <div class="row"></div>
    <div class="row">
        
        <div class="col-md-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Your Posts and Comments</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="javascript:ajaxLoad('{{url('useradvs')}}')">My Advertisements</a></li>
                            <li><a href="javascript:ajaxLoad('{{url('usercomment')}}')">My Commented Ads</a></li>
                            <li><a href="javascript:ajaxLoad('{{url('myaccount')}}')">My Account</a></li>
                            
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
            <div id="content"> Click the above menu.</div>
            <div class="loading"></div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!-- JavaScripts -->

<script>
    function ajaxLoad(filename, content) {
        content = typeof content !== 'undefined' ? content : 'content';
        $('.loading').show();
        $.ajax({
            type: "GET",
            url: filename,
            contentType: false,
            success: function (data) {
                $("#" + content).html(data);
                $('.loading').hide();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
</script>



<style>
    .loading {
        background: lightgoldenrodyellow url('{{asset('images/processing.gif')}}') no-repeat center 65%;
        height: 80px;
        width: 100px;
        position: fixed;
        border-radius: 4px;
        left: 50%;
        top: 50%;
        margin: -40px 0 0 -50px;
        z-index: 2000;
        display: none;

    }
</style>
@endif

@endsection
