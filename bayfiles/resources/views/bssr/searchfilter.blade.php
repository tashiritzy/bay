
<button class="d-block d-sm-none mb-2" data-toggle="collapse" aria-controls="SearchParameters" aria-expanded="false" id="filterbutton" data-target="#SearchParameters">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Filter</button>

<div class="col-md-12 col-sm-12 SearchParameters collapse show" id="SearchParameters">
	
   <form name="frmFilter" class="form-horizontal" ng-submit="search()" novalidate="">
   <div class="md-form">
		<input type="text" id="search" name="searchkey" ng-model="bssrfilter.searchkey" class="search-query form-control" />
		<label for="search">Search  ... </label>
	</div>
	<div id="catSelect" class="md-form">
		<select name="category" class="mdb-select colorful-select dropdown-primary form-control" ng-model="bssrfilter.category">
			<option value="">Category</option>
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
	</div>	
	<div class="row">
		<div class="col-6 md-form">
			<input id="pricemin" name="pricemin" ng-model="bssrfilter.pricemin" type="text" class="form-control"> 
			<label for="pricemin" class="pl-3"> Nu. Min </label>
		</div>
		<div class="col-6 md-form">
			<input id="pricemax" name="pricemax" ng-model="bssrfilter.pricemax" type="text" class="form-control"> 
			<label for="pricemax" class="pl-3"> Nu. Max </label>
		</div>
	</div>
	
	<div class="md-form">
		<select name="place" class="mdb-select colorful-select dropdown-primary form-control" ng-model="bssrfilter.place">
			<option value="">Location</option>
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
	</div>
	@endverbatim
		<p>
		
		<center>
			<button type="submit" class="btn btn-success">Search</button>		 
		</center>
		</p>
     </form>
     	
  </div>  

                  
                       


