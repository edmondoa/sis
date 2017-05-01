(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('groupService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/product-group';

      function saveGroup(model){
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
        saveGroup : saveGroup
    	};
    }]);

})(App)
