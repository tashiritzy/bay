@extends('./layouts.app')

@section('content')

@if (Auth::guest())
 <center>Please <a href="{{ url('login') }} "> login</a> to view your advertisements or <br/><a href="{{url('register')}}"> register</a> to post advertisements </center>
@else

{{ csrf_field() }}

	<center>
		<font color="green">
			
			{{ $message or " " }}
			
		</font>
	</center>

<div class="container-fluid">
    <div class="row">	
	
		<div class="left">
			<div class="item">
			<span class="glyphicon glyphicon-th-large"></span>
			</div>
			<div class="item active">
				<a href="javascript:ajaxLoad('{{url('useradvs')}}')">
					<span class="glyphicon glyphicon-th-list"><i class="icon fa fa-globe"></i></span>
					My Advertisements
				</a>
			</div>
			<div class="item">
				<a href="javascript:ajaxLoad('{{url('usercomment')}}')">
					<span class="glyphicon glyphicon-log-out"><i class="icon fa fa-comments-o"></i></span>
					My Commented Ads
				</a>
			</div>
			<div class="item">
				<a href="javascript:ajaxLoad('{{url('myaccount')}}')">
					<span class="glyphicon glyphicon-log-in"><i class="icon fa fa-user"></i></span>
					My Account
				</a>
			</div>     
		</div>
		<div class="right m-3" id="content">
		   
		</div>
		
	</div>
    <div class="row">
		<div class="loading"></div>
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
	
	
	// SideNav Button Initialization
	$(".button-collapse").sideNav();
	// SideNav Scrollbar Initialization
	var sideNavScrollbar = document.querySelector('.custom-scrollbar');
	Ps.initialize(sideNavScrollbar);
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
	
	
.left, .right {
        float:left;
        height:100vh;
    }
    
.left {
        background: #f8f9fa;
        display: inline-block;
        white-space: nowrap;
        width: 45px;
        transition: width 1s ;
    }

.right {
        background: #fff;
        max-width: 70%;
        transition: width 1s;
    }    

.left:hover {
        width: 250px;
    }    
    
.item:hover {
        background-color:#ccc;
        }
        
.left .glyphicon {
        margin:15px;
        width:20px;
        color: green;
    }
    
.right .glyphicon {
        color:#a9a9a9;
    }
span.glyphicon.glyphicon-refresh{
    font-size:17px;
    vertical-align: middle !important;
    }
    
.item {
        height:50px;
        overflow:hidden;
        color:#fff;
    }

</style>
@endif

@endsection
