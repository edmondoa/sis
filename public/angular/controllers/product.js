(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('productCtrl', productCtrl);

    function productCtrl($scope,$filter, $timeout,$http) {
      $scope.products = [];
      $scope.product = {};
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
        model['non_book'] = $("input[name=non_book]:checked").val();    
        model['non_consign'] = $("input[name=non_consign]:checked").val();
        model['non_returnable'] = $("input[name=non_returnable]:checked").val();
        model['vatable'] = $("input[name=vatable]:checked").val();
        model['lock'] = $("input[name=lock]:checked").val();
        model['suspended'] = $("input[name=suspended]:checked").val();         
        $http.post('/products-regular',model)
         .success(function(data) {
          $("button [type='reset']").trigger('click');
            $scope.message(data);            
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