(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('clusterService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/clusters';

        function getPage(params, paramsObj) {
            var config;
            config = {
                method: 'GET',
                url: '/products-regular-list?'+params,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            };
            return HttpRequestFactory.request(config);
    	}

      function saveCluster(product){
        var config;
        config = {
            method: 'POST',
            url: urlBase,
            data:$.param(product),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
    		getPage: getPage,
        saveCluster : saveCluster
    	};
    }]);

})(App)
