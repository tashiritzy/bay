@extends('./layouts.app')

@section('content')

{{ csrf_field() }}

    <center><font color="green">
	{{ $message }}
      </font>
    </center>

    <div class="panel panel-default">
    <div class="panel-body">
    
    <table>
    <tr>
    	<td width="20%">
    		<font color="#575858" size="5">{{ $bssr->first()->advtopic }}</font> 
		<br/>    		
    		
    	<div class='row'>
    	@if($images->count())
                @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3 mb-2'>
				<a data-fancybox="gallery" href="{{ url('/avatar/') }}/{{ $image->path }}">
						<img height="100px" src="{{ url('/avatar/') }}/{{ $image->path }}">
					</a>
                </div> <!-- col-6 / end -->

                @endforeach
			@endif
			
		 </div>	
    	</td>
    </tr>
    <tr>
    	<td>
		<font color="#2ecc71" size="4"> Nu. {{ $bssr->first()->price }}</font> 
			<br/>
			
		
                <!--div class="panel-heading">Search</div-->

                      <div style="white-space: pre-line">
			{{ $bssr->first()->description }}
                      </div>
			<br/>
			@if ($bssr->first()->email)
			<img src="{{ url('images/email.jpg') }}" height="30px" width="28px" title="Email">{{ $bssr->first()->email }}
			&nbsp;&nbsp;
			@endif
			
			@if ($bssr->first()->phone)
			<img src="{{ url('images/phone.jpg') }}" height="30px" width="28px" title="Phone">{{ $bssr->first()->phone }}
			@endif
                 <br/>
                
                <font color="#1ccfef" size="2">Posted on {{ date('d F, Y', strtotime($bssr->first()->created_at)) }} </font>
                <br/>
                <img src="{{ url('images/location.jpg') }}" height="25px" width="22px"> {{ $bssr->first()->placename }}
				
				<p>
                  Posted By: <b>{{ $bssr->first()->uname }}</b> 
				</p>
				
            <div class="d-block d-sm-none">
            <center>
               <a href="tel:{{$bssr->first()->phone }}">
                    <button type="button" size="30" class="btn btn-success"> 
						<i class="fa fa-phone mr-1"></i>
						Call 
					</button>
               </a>
               &nbsp; &nbsp;
               <a href="sms:{{$bssr->first()->phone }}">
                    <button type="button" size="30" class="btn btn-success"> 
						<i class="fa fa-envelope-open mr-1"></i>	
						Send SMS 
					</button>
               </a>
             </center>
            </div>
        
    	</td>
    </tr>
    
    <tr>
    	<td>
    	<hr>
    	<div class="comments">
    	<h4>Offer/Comments</h4>
    	@foreach($cmmt as $cmmt)
    	<hr>


    		@if (Auth::guest())
		
		@elseif (Auth::user()->id == $cmmt->userid)
			<!--a href="{{ url('commentdelete/'.$cmmt->id) }}"></a-->
			
			<form name="cmmt" action="{{ url('commentdelete/') }}" method="get">
			{{ csrf_field() }}
						
			<button type="submit" class="close" onclick="return confirm('Are you sure you want to delete your comment?');" title="Delete Comment">
			<i class="material-icons">close</i>
			</button>
			
			<input type="hidden" name="cmmtid" value="{{ $cmmt->id }}"/>
			
			</form>
		@endif
		
                
		<font color="#2ecc71">{{ $cmmt->comment }}</font>
                

		<br/>
		<font size="2">Commented by: </font><font color="#1ccfef" size="2">
		<!--------------------------Ajax user profile-----------------------------!-->
		<a href data-id="{{ $cmmt->userid }}" data-toggle="modal" data-target="#uprofile-item" >{{ $cmmt->cname }}</a></font>
		
		<!------------------------------------ajax--------------------------!-->
		<table>
				
		<tr>			
			<td data-id="{{ $cmmt->userid }}">
			<!--button data-toggle="modal" data-target="#uprofile-item" class="btn btn-primary edit-item">
			
			</button-->
			</td>
		</tr>
		</table>
		<!---------------------------------end ajax-------------------------------->
		        
		<!-------------------------ajax user profile Item Modal -------------------------------------->

		<div class="modal fade" id="uprofile-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">{{$cmmt->cname}}</h4>
		       
		      </div>

		      <div class="modal-body">
		      
		      
		        {{ $cmmt->uemail }}
		        <br>
		        {{$cmmt->uphone}}
		      
		      </div>

		    </div>

		  </div>

		</div>
		
		<!-------------------ajax end user profile---------------------------->		
	@endforeach		
	</div>
	<br/>
    	</td>
    </tr>
    
    	<script language="javascript">
	function submitForm(){
	document.cmmt.action="{{ url('commentdelete') }}";
	document.cmmt.submit(); }
	</script>
    
    <tr>
    	<td>
    	@if (Auth::guest())
    		<br/>
    		If you want to communicate, you need to login. Please <a href="../login">click here</a> to login.
    	@else
    		<form class="" method="post" action="{{ url('/bssrcomment') }}">
    		{{ csrf_field() }}
    		<textarea name="comment" class="form-control" rows="5" placeholder="Enter your comment here, {{ Auth::user()->name }}"></textarea>
						
			
			<input type="hidden" value="{{ $bssr->first()->id }}" name="advid">
			<button class="btn btn-success">
				<i class="fa fa-comment mr-1"></i> Enter
			</button>
    		<!--input type="hidden" name="_token" value="{{ csrf_token() }}"-->
    		</form>
    	@endif
    	</td>
    </tr>
    </table>
    
    </div>
    </div>
    
@endsection