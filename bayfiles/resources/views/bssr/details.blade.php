@extends('./layouts.app')

@section('content')

<!--script>

$(document).ready(function() {
  
$(".carousel").swiperight(function() {
    $(this).carousel('prev');
});
$(".carousel").swipeleft(function() {  
    $(this).carousel('next');
});
 
}); 

</script>

    
<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });   
  
    $(".carousel").on("touchstart", function(event){
	var xClick = event.originalEvent.touches[0].pageX;
    $(this).one("touchmove", function(event){
	var xMove = event.originalEvent.touches[0].pageX;
	if( Math.floor(xClick - xMove) > 5 ){
	    $(".carousel").carousel('next');
	}
	else if( Math.floor(xClick - xMove) < -5 ){
	    $(".carousel").carousel('prev');
	}
    });
    $(".carousel").on("touchend", function(){
	    $(this).off("touchmove");
    });
});
    
 /*
    $("#.carousel").swipe( {
            swipe:function(event, direction, distance, duration, fingerCount, fingerData) {

                if(direction=='left'){
                    $(this).carousel('next');
                }else if(direction=='right'){
                    $(this).carousel('prev');
                }

            }
        });
    */
</script-->

{{ csrf_field() }}

@include('search')

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
    		
    	<div class='list-group gallery'>
    	@if($images->count())
                @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <!--a class="thumbnail fancybox" id="myCarousal" rel="ligthbox" href="{{ url('/avatar/'.$image->path) }}">
                        <img class="img-responsive" alt="" src="{{ url('/avatar/'.$image->path) }}" />
                        <div class='text-center'>
                            <small class='text-muted'> </small>
                        </div> 
                    </a-->

                    
			<!--a class="fancybox" rel="gallery" href="{{ url('/avatar/'.$image->path) }}"><img class="img-responsive" src="{{ url('/avatar/'.$image->path) }}" alt=""/></a-->
			
			
			<!--a class="fancybox" rel="gallery" href="http://fancyapps.com/fancybox/demo/2_b.jpg">
			    <img src="{{ url('/avatar/'.$image->path) }}" class="img-responsive" alt="" />
			    </a-->
					    
					    
			    <!--script>
			    
			    jQuery(document).ready(function () {
			    jQuery(".fancybox").fancybox({
				maxWidth: 1600,
				maxHeight: 1000,
				fitToView: false,
				width: '50%',
				height: '50%',
				autoSize: false,
				padding: '0',
				closeClick: true,
				afterShow: function () {
				    jQuery('.fancybox-wrap').swipe({
					swipe: function (event, direction) {
					    if (direction === 'left' || direction === 'up') {
						jQuery.fancybox.prev(direction);
					    } else {
						jQuery.fancybox.next(direction);
					    }
					}
				    });
				}
			    });
			});
			    
			    </script-->
         
   
                    
     <!---------------------------------------fancybox touch start--------------------------------------------->
                    
                    <div class="gallery-outer" style="background-image: url('/avatar/'.$image->path)">
		    <a href="{{ url('/avatar/'.$image->path) }}" class="js-fancybox" data-fancybox-group="js-fancybox-button">
		      <div class="gallery-inner">
		      
		        <img class="img-responsive thumbnail fancybox" alt="" src="{{ url('/avatar/'.$image->path) }}" />
                        
		      </div>
		    </a>
		    </div>
		    
		    
			<script>
			$(document).ready(function() {
			
			    $('.js-fancybox').fancybox({
				width: "100%",
				margin: [0, 0, 0, 0],
				padding: [5, 5, 5, 5],
				openEffect  : 'none',
				closeEffect : 'none',
				prevEffect : 'fade',
				nextEffect : 'fade',
				closeBtn  : true,
				arrows : true,
				helpers : {
				    title : null,
				    overlay : {
					css : {
					    'background' : 'rgba(0, 0, 0, 0.95)' 
					}
				    },
				    buttons : {
				    }
			
				},
				afterShow: function() {
				    $('.fancybox-wrap').swipe({
					swipe : function(event, direction) {
					    if (direction === 'left' || direction === 'up') {
						$.fancybox.prev( direction );
					    } else {
						$.fancybox.next( direction );
					    }
					}
				    });
			
				},
			
				afterLoad : function() {
				}
			    });
			    
			});
			
			</script>
			
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.js"></script>
			  
			<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js"></script>
			
			<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-buttons.js"></script>
    <!---------------------------------------fancybox touch end--------------------------------------------->
                    
                </div> <!-- col-6 / end -->

                @endforeach
            @endif
     </div> <!-- list-group / end -->	
    		
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
                  Posted By: <b>{{ $bssr->first()->name }}</b> 
                </p>
            <div class="visible-xs visible-sm">
            <center>
               <a href="tel:{{$bssr->first()->phone }}">
                    <button type="button" size="30" class="btn btn-success"> Call </button>
               </a>
               &nbsp; &nbsp;
               <a href="sms:{{$bssr->first()->phone }}">
                    <button type="button" size="30" class="btn btn-success"> Send SMS </button>
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
						
			<button type="submit" class="close" onclick="return confirm('Are you sure you want to delete your comment?');" title="Delete Comment"><font color="red">x</font></button>
			
			<input type="hidden" name="cmmtid" value="{{ $cmmt->id }}"/>
			
			</form>
		@endif
		
                
		<font color="#2ecc71">{{ $cmmt->comment }}</font>
                

		<br/>
		<font size="2">Commented by: </font><font color="#1ccfef" size="2">
		<!--------------------------Ajax user profile------------------------------->
		<a href data-id="{{ $cmmt->userid }}" data-toggle="modal" data-target="#uprofile-item" >{{ $cmmt->name }}</a></font>
		
		<!------------------------------------ajax---------------------------->
		<table>
				
		<tr>			
			<td data-id="{{ $cmmt->userid }}">
			<!--button data-toggle="modal" data-target="#uprofile-item" class="btn btn-primary edit-item">
			
			</button-->
			</td>
		</tr>
		</table>
		<!---------------------------------end ajax-------------------------------->
		
        <script type="text/javascript">

    	   var url = "<?php echo route('item-ajax.index')?>";

        </script>

        <script src="/js/item-ajax.js"></script> 
        
		<!-------------------------ajax user profile Item Modal -------------------------------------->

		<div class="modal fade" id="uprofile-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">{{$cmmt->name}}</h4>
		       
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
    		<textarea name="comment" placeholder="Enter your comment here, {{ Auth::user()->name }}"></textarea>
    		<input type="hidden" value="{{ $bssr->first()->id }}" name="advid">
    		<input type="submit" value="Enter">
    		<!--input type="hidden" name="_token" value="{{ csrf_token() }}"-->
    		</form>
    	@endif
    	</td>
    </tr>
    </table>
    
    </div>
    </div>
    
@endsection