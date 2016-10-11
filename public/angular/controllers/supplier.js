(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('supplierCtrl', supplierCtrl);

    function supplierCtrl($scope,$filter, $timeout,$http) {
      $scope.suppliers = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getSuppliers = function() {
        
        $http.get('suppliers/ng-supplier-list').
          success(function(data) {
            $scope.suppliers = data;         
            console.log($scope.suppliers);
          });
      }

      $scope.saveSupplier = function(model)
      {   
        if (model !== undefined && model !== null) {
          model['suspended'] = ($("#suspended").is(":checked"))?'1':'0';
          model['lock'] = ($("#lock").is(":checked"))?'1':'0';
        }
        //
        
        $http.post('/suppliers',model)
         .success(function(data) {
            $scope.message(data);
            //model.category_name="";
            $scope.getSuppliers();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.suppliers = orderBy($scope.suppliers, predicate, reverse);
      };
      $scope.getSuppliers();      
      
     

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