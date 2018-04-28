@extends('./layouts.app')

<!--link href="{{url('css/tashi.css')}}" rel="stylesheet"-->

@section('content')

{{ csrf_field() }}

@include('search')

@foreach($bssr as $data)
<a href="{{ url('details/'.$data->id) }}" class="block-link"> 
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    
    	<div class="col-md-4" style="height:200px">
    		<img src="../avatar/{{ $data->path }}" style="width: 100%;height: 100%"> &nbsp; &nbsp;&nbsp;
    		
    	</div>
    	<div class="col-md-8">
		<font size="5" color="#575858">{{$data->advtopic }}</font> 
		
					
                <!--div class="panel-heading">Search</div-->
			<br/>
			<p>
                	<font color=" #818282 ">
					
			@if ($data->email)
			<img src="{{url('images/email.jpg')}}" height="20px" width="18px" title="Email">{{ $data->email }}
			&nbsp;&nbsp;
			@endif
			</p>
			<p>
			@if ($data->phone)
			<img src="{{url('images/phone.jpg')}}" height="20px" width="18px" title="Phone">{{ $data->phone }}
			@endif
			
			</font>
			</p>
                
		
		<font color="#2ecc71" size="4"> Nu. {{ $data->price }}</font> 
                
		<br/>
                		
		<font color="#a6a9a9" size="2">
                <img src="{{url('images/location.jpg')}}" height="20px" width="17px"> {{ $data->placename }}
                
                Posted on {{ date('d F, Y', strtotime($data->created_at)) }} 
                </font>

        <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
        
        <div class="fb-share-button" style="float: right" data-href="{{ url('details/'.$data->id) }}" data-layout="button_count"> Share on Facebook</div>        
        
    	</div>
    </div>
    
    </div>
    </div>
</a>
@endforeach
{{ $bssr->links('vendor.pagination.custom') }}

@endsection
