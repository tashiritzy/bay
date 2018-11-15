@extends('./layouts.app')

@section('content')


<div class="row" ng-app="bssrApp" ng-controller="bssrfilterController">

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
    <p class="text-center" ng-show="loading"><span class="fa fa-spinner"></span></p>

    <div class="panel panel-default" ng-repeat="filter in bssr">
		    <div class="row">
				<div class="col-md-4 view overlay justify-content-center align-self-center" ng-if="filter.path != null " style="height:200px">
					<img src="{{ url('/avatar/') }}/@{{ filter.path }}" style="width: 100%;height: 100%"> &nbsp; &nbsp;&nbsp;
					<a href="{{ url('details') }}/@{{ filter.id }}" class="block-link">
						<div class="mask rgba-white-slight"></div>
					</a>
				</div>
				<div class="col-md-4" ng-if="filter.path == null " style="height:200px">
					<img src="{{ url('images/noimage.png') }}" style="width: 100%;height: 100%"> &nbsp; &nbsp;&nbsp;
					<a>
						<div class="mask rgba-white-slight"></div>
					</a>
				</div>

				<div class="col-md-8 card-body">
					<div class="row">
						<div class="col-10">
							<a href="{{ url('details') }}/@{{ filter.id }}" class="mt-2"> 
								<h4 class="card-title"> @{{ filter.advtopic }}</h4> 
							</a>
						</div>
						<div class="col-2">
							<a id="watchlist" title="Add to watchlist">
								<i class="material-icons">star_border</i>
							</a>
						</div>
					</div>
					@verbatim
					{{searchkey}}

					<font color=" #818282 ">
						<p ng-if="filter.email" class="d-flex align-items-center">				
							<i class="material-icons">email</i>{{ filter.email }}
						</p>
						<p ng-if="filter.phone" class="d-flex align-items-center">
							<i class="material-icons">phone</i> {{ filter.phone }}
						</p>
					</font>
		
					<font color="#2ecc71" size="4"> <img src="images/nu.png" width="70"> {{ filter.price }}</font> 
							
														
					<font color="#a6a9a9" size="2">
						<p class="d-flex align-items-center">
							<i class="material-icons">location_on</i>  {{ filter.placename }}
						</p>	
						@endverbatim
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
	 	<hr/>
    </div>
    <div class="loading"></div>
    <center><button class="btn btn-success" id="loadmore" ng-click="loadMore()">&nbsp;&nbsp;&nbsp;Load More &nbsp;&nbsp;&nbsp;</button></center>
</div>
</div>

<!-- AngularJS Application Scripts -->
<script src="<?= asset('app/controllers/bssrfilter.js') ?>"></script>

@endsection

