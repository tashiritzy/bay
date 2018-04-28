@extends('./layouts.app')

@section('content')


<div class="row" ng-app="bssrFilter" ng-controller="bssrfilterController">

<div class="col-md-3">

@include('bssr.searchfilter') 	  
    
</div>

<!------- ------ loading -------------------------------------->
<style>
    .loading {
        background: url('{{asset('images/loader2.gif')}}') no-repeat center 65%;
        height: 150px;
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
<!-------------------------end loading -------------------->

<div class="col-md-9">

    <!-- LOADING ICON =============================================== -->
    <!-- show loading icon if the loading variable is set to true -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>


    <div class="panel panel-default" ng-repeat="filter in bssr">
       <a href="details/@{{ filter.id }}" class="block-link"> 
	    <div class="panel-body">
		    <div class="row">
		    
		    <div class="col-md-4" ng-if="filter.path !== '' " style="height:200px">
			<img src="avatar/@{{ filter.path }}" style="width: 100%;height: 100%"> &nbsp; &nbsp;&nbsp;
		    </div>
		    <div class="col-md-4" ng-if="filter.path === '' " style="height:200px">
			<img src="images/noimage.png" style="width: 100%;height: 100%"> &nbsp; &nbsp;&nbsp;
		    </div>

			<div class="col-md-8">
			@verbatim
				<font size="5" color="#575858"> {{ filter.advtopic }}</font> 
			{{searchkey}}
			
				<!--div class="panel-heading">Search</div-->
				<br/>
			<p>
                	<font color=" #818282 ">
					
			<img ng-if="filter.email" src="images/email.jpg" height="20px" width="18px" title="Email">{{ filter.email }}
			
			</p>
			<p>
			
			<img ng-if="filter.phone" src="images/phone.jpg" height="20px" width="18px" title="Phone">{{ filter.phone }}
						
			</font>
			</p>
                
		
		<font color="#2ecc71" size="4"> <img src="images/nu.png" width="70"> {{ filter.price }}</font> 
                
		<br/>
                		
		<font color="#a6a9a9" size="2">
                <img src="images/location.jpg" height="20px" width="17px"> {{ filter.placename }}
                
                @endverbatim
                
                <br>
                Posted on @{{ filter.created_at | date: "EEEE, MMMM d, y"}}
                
               
                </font>
 
        <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
        
        <div class="fb-share-button" style="float: right" data-href="details/@{{ filter.id }}" data-layout="button_count"> Share on Facebook</div>
				
					
			</div>
			
		    </div>
	    
	    </div>
	 </a>
    </div>
    <div class="loading"></div>
    <center><button class="btn btn-success" ng-click="loadMore()">&nbsp;&nbsp;&nbsp;Load More &nbsp;&nbsp;&nbsp;</button></center>
</div>
</div>

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
       	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       	<!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/bssrfilter.js') ?>"></script>
        <script src="<?= asset('app/services/bssrService.js') ?>"></script> 

@endsection

