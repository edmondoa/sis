(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('customerCtrl', customerCtrl);

    function customerCtrl($scope,$filter, $timeout,$http,$location) {
      $scope.customers = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;

      $scope.getCustomers = function() {

        $http.get('category/ng-cat-list').
          success(function(data) {
            $scope.customers = data;
            console.log($scope.categories);
          });
      }

      $scope.saveCustomer = function(model)
      {
        $http.post('/customer',model)
         .success(function(data) {
            
            if(data.status){
              location.href = '/customer/'+data.customer_id;
            //  $scope.$apply();
          }else{
            $scope.message(data);
          }
        })
      }




      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.customers = orderBy($scope.customers, predicate, reverse);
      };




    $scope.message = function(data)
    {
      if(data.status){
        $.notify({
          message: data.message
        },{
          type: 'success',
          newest_on_top: true,
          placement: {
              align: "right",
              from: "bottom"
          }
        });
      }else{
        var stringBuilder ="<ul class='error'>";
        for (var x in data.message) {
          console.log(x);
          stringBuilder +="<li>"+data.message[x]+"</li>";
        }
        stringBuilder +="</ul>";
         $.notify({
            message: stringBuilder
          },{
            type: 'danger',
            newest_on_top: true,
          placement: {
              align: "right",
              from: "bottom"
          }
          });
      }
    }
  }
})();
