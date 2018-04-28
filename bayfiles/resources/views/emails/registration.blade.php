<html>
<head>
 <script src="{{ asset('bootstrap-3.3.6/js/bootstrap.min.js') }}"></script>
 <link href="{{url('css/app.css')}}" rel="stylesheet">
 <link href="{{url('css/tashi.css')}}" rel="stylesheet">
 </head
 <body>

<br><br>

Dear {{ $name }},

<br><br>
We are very pleased to welcome you on our site. <br>

Your account has been successfully created on bay.druklink.net
<br><br>
Your details are as follows:

<br><br>

Your Name:  <b>{{ $name }}</b>


<br><br>

Your Email ID:  <b>{{ $email }}</b>

<br><br>

Your Phone No:  <b>{{ $phone }}</b>
<br><br>

We reach out your advertisements to more users for <b>absolutely no charge</b>. 
So, please take advantage of this <b>free</b> service.

<br><br>

Thank you
<br>
REBS Administration

</body>
</html>