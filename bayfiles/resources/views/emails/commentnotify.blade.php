<html>
<head>
 <script src="{{ asset('bootstrap-3.3.6/js/bootstrap.min.js') }}"></script>
 <link href="{{url('css/app.css')}}" rel="stylesheet">
 <link href="{{url('css/tashi.css')}}" rel="stylesheet">
 </head
 <body>

You have a notification on your account in bay.druklink.net
<br><br>

You received a new comment on your advertisement <h3>{{ $madvtopic }}</h3>

The comment reads:
<br>
<font color="green">

{{ $mcomment }}

</font>
<br>
 Posted By: <font color="green">{{ $poster }}</font>
<br>
<br>

<a href ="http://bay.druklink.net/details/{{ $madvid }}" class="btn btn-primary edit-item">
			View your ad
			</a>
</body>
</html>
