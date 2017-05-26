(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('discountCtrl', discountCtrl);

    function discountCtrl($scope,$filter, $timeout,$http) {
      $scope.discounts = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getDiscounts = function() {
        
        $http.get('/discounting/ng-discount-list').
          then(function(result) {
            $scope.discounts = result.data;         
            console.log($scope.discounts);
          });
      }

      $scope.saveDiscount = function(model)
      {        
        $http.post('/discounting',model)
         .then(function(result) {
            $scope.message(result.data);
            $("button [type='reset']").trigger('click');
            $scope.getDiscounts();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.discounts = orderBy($scope.discounts, predicate, reverse);
      };
      $scope.getDiscounts();      
      
     

    $scope.message = function(data)
    {
      if(data.status){
        $.notify({       
          message: data.message
        },{
          type: 'success'
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
            type: 'danger'
          });   
      }
    }  
  }
})();