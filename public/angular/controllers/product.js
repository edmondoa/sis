(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('productCtrl', productCtrl);

    function productCtrl($scope,$filter, $timeout,$http) {
      $scope.products = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getProducts = function() {
        
        $http.get('/products-regular-list').
          success(function(data) {
            $scope.products = data;         
            console.log($scope.products);
          });
      }

      $scope.saveProduct = function(model)
      {        
        $http.post('/products-regular',model)
         .success(function(data) {
            $scope.message(data);
            $("button [type='reset']").trigger('click');
            $scope.getProducts();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.products = orderBy($scope.products, predicate, reverse);
      };
      $scope.getProducts();      
      
     

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