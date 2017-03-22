(function() {

    'use strict';

    angular.module('SisApp').factory('HttpRequestFactory', HttpRequestFactory);

    function HttpRequestFactory($http) {
        return {
            request: function(config) {
                return $http(config).then((function(promise) {
                    return promise;
                }), (function(error) {
                    return error;
                }));
            }
        }
    }

})();
