(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('promoService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/clusters';

        function getPage(start, number, params) {
            console.log(params);
            var config;
            config = {
                method: 'POST',
                url: urlBase+'/ng-cluster-list',
                data:$.param(params),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            };
            return HttpRequestFactory.request(config);
    	}

      function save(model){
        console.log(model);
        var config;
        config = {
            method: 'POST',
            url: urlBase,
            data:$.param(model),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
    		getPage: getPage,
        save : save
    	};
    }]);

})(App)
