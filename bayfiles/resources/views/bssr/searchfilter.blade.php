<p>
<button class="visible-xs" data-toggle="collapse" id="filterbutton" data-target="#SearchParameters">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Filter</button>
</p>
   <div class="hidden-xs col-md-12 col-sm-12 SearchParameters" id="SearchParameters">
	
   <form name="frmFilter" class="form-horizontal" ng-submit="search()" novalidate="">
   
	Keyword
	<input type="text" id="search" name="searchkey" ng-model="bssrfilter.searchkey" class="search-query form-control" placeholder="Search..." />
	Category
	<select name="category" ng-model="bssrfilter.category">
		<option value="">Select Category</option>
	@verbatim
		
		<option value="1">Electronics</option>
		<option value="2">Vehicle</option>
		<option value="3">Land & House</option>
                <option value="4">Services</option>
                <option value="5">Retail Goods</option>
		<option value="6">Others</option>
                <option value="7">Freebies</option>
		<option value="8">Jobs</option>

	</select>
	
	Price/Rent/Salary
	<div class="row content">
	  <div class="col-md-6 col-sm-6 col-xs-6">Min
	  <input class="textbox" name="pricemin" ng-model="bssrfilter.pricemin" type="text" placeholder="Min"> 
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">Max
	  <input class="textbox" name="pricemax" ng-model="bssrfilter.pricemax" type="text" placeholder="Max"> 
	</div>
	
	Location
	<select name="place" ng-model="bssrfilter.place">
		<option value="">Select Location</option>
			
				<option value="1">Thimphu</option>
				<option value="2">Paro</option>
                                <option value="3">Punakha</option>
                                <option value="4">Wangdue</option>
                                <option value="5">Phuntsholing/Chukha</option>
                                <option value="6">Gelephu</option>
                                <option value="7">Trongsa</option>
                                <option value="8">Bumthang</option>
                                <option value="9">Trashigang</option>
                                <option value="10">Haa</option>
                                <option value="11">Trashiyangtse</option>
                                <option value="12">Samdrupjongkhar</option>
                                <option value="13">Zhemgang</option>
                                <option value="14">Gasa</option>
                                <option value="15">Mongar</option>
                                <option value="16">Pema Gatshel</option>
                                <option value="17">Lhuntse</option>
			
	</select>
	@endverbatim
	<p>
	
	<center>
		<button type="submit" class="btn btn-success">Search</button>		 
	</center>
	</p>
	</div>
	  
     </form>
     	
  </div>  

                  
                       

  	
<style>
#SearchParameters.in,
#SearchParameters.collapsing {
    display: block!important;
}

@media screen and (min-width:768px) { #SearchParameters{ display: block!important;visibility:visible!important; } }
</style>

