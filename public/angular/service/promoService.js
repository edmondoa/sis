(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('promoService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/products-promo';

        function getPage(start, number, params) {
            console.log(params);
            var config;
            config = {
                method: 'POST',
                url: urlBase+'/ng-promo-list',
                data:$.param(params),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            };
            return HttpRequestFactory.request(config);
    	}

      function savePromo(promo,need,branch){
        var datum = {promo:promo,need:need,branch:branch};
        var config;
        config = {
            method: 'POST',
            url: urlBase,
            data:$.param(datum),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
    		getPage: getPage,
        savePromo : savePromo
    	};
    }]);

})(App)
