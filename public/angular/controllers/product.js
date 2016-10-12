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

        model['non_book'] = $("#non_book").is(':checked')?1:0;    
        model['non_consign'] = $("#non_consign").is(':checked')?1:0;
        model['non_returnable'] = $("#non_returnable").is(':checked')?1:0;
        model['vatable'] = $("#vatable").is(':checked')?1:0;
        model['lock'] = $("#lock").is('checked')?1:0;
        model['suspended'] = $("#suspended").is(':checked')?1:0;         
        
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