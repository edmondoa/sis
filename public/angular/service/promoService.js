(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('promoService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/products-promo';

        function getPage(params, paramsObj) {            
            var config;
            config = {
                method: 'GET',
                url: urlBase+'/ng-promo-list?'+params,
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
      function searchProd(searchStr){        
        var config;
        config = {
            method: 'GET',
            url: '/product/searchProd?search='+searchStr,            
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
    		getPage: getPage,
            savePromo : savePromo,
            searchProd : searchProd
    	};
    }]);

})(App)
