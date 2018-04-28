angular.module('bssrService', [])

.factory('Comment', function($http, API_URL) {

    return {
        // get all the comments
        get : function() {
            return $http.get(API_URL + 'bssrfilter');
        },

        // save a comment (pass in comment data)
        search : function(bssrfilter) {
            return $http({
                method: 'POST',
                url: '/bssrfilter1',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(bssrfilter)
            });
        },

        // destroy a comment
        destroy : function(id) {
            return $http.delete('/api/comments/' + id);
        }
    }

});
