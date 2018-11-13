app.controller('bssrCategoryController', function($scope, $http, API_URL) {
    
    //////////////////retrive all for the category ///////////////////
	$scope.bssr = [];
	$scope.lastpage=1;

	$scope.init = function() {
		var urx = API_URL + "categoryviewdata/"+url(5);
		$scope.lastpage=1;
		$http({
				url: urx,
				method: "GET",
				params: {page:  $scope.lastpage}
			}).success(function(data, status, headers, config) {
				$scope.bssr = data.bssr.data;
				$scope.catid = data.catid;
				$scope.cat = data.cat;

				$("#catSelect").remove();

				$scope.currentpage = data.current_page;
				if(data.bssr.current_page >= data.bssr.last_page)
						$("#loadmore").hide();
			});
	}
	
	$scope.init();	
	
    // -- search record --
        $scope.search = function() {
        $('.loading').show();
        var url = API_URL + "bssrfilter1";
		$scope.lastpage=1;

		if($scope.bssrfilter == undefined)
		{
			var para = "category="+ $scope.cat.id;
		}
		else{		
			$scope.bssrfilter.category = $scope.cat.id;
			var para = $.param($scope.bssrfilter);
		}

		console.log(para);
			
        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: para
        }).success(function(data) {
            $scope.bssr = data.data;
			$scope.currentpage = data.current_page;
            
			$('.loading').hide();
			if(data.current_page >= data.last_page)
					$("#loadmore").hide();
            
        }).error(function(response) {
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }
    
    //////////////////Load More Pagination ///////////////////
	    $scope.loadMore = function($catid) {
			$('.loading').show();
			$scope.lastpage +=1;
			
			if($scope.bssrfilter !== undefined)
			{
				$http({
					url: API_URL + "bssrfilter1",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					params: {page:  $scope.lastpage},
					data: $.param($scope.bssrfilter)
				}).success(function (data, status, headers, config) {
					$scope.bssr = $scope.bssr.concat(data.data);
					
					$('.loading').hide();
					if(data.current_page >= data.last_page)
						$("#loadmore").hide();
				
				});	
				
			}
			else
			{
				$('.loading').show();
				var url = API_URL + "categoryviewdata/"+$catid;
				
				$http({
					url: url,
					method: "GET",
					params: {page:  $scope.lastpage}
				}).success(function (data, status, headers, config) {
					$scope.bssr = $scope.bssr.concat(data.bssr.data);
					
					$('.loading').hide();
					if(data.bssr.current_page >= data.bssr.last_page)
						$("#loadmore").hide();
				});		
			}
		
		}
	
	///////////////////Pagination End ////////////////////
});