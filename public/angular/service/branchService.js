(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('branchService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/branches';

      function saveBranch(model){
        console.log(model)
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
        saveBranch : saveBranch
    	};
    }]);

})(App)
