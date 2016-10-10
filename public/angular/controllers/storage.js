(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('pStorageCtrl', pStorageCtrl);

    function pStorageCtrl($scope,$filter, $timeout,$http) {
      $scope.storages = [];
      $scope.storage ={};
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.Storages = function() {
        
        $http.get('/product-storage/ng-storage-list').
          success(function(data) {
            $scope.storages = data;         
            console.log($scope.storages);
          });
      }

      $scope.saveStorage = function(model)
      {        
        $http.post('/product-storage',model)
         .success(function(data) {
            $scope.message(data);
            $scope.storage ={};
            $scope.Storages();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.storages = orderBy($scope.storages, predicate, reverse);
      };
      $scope.Storages();      
      
     

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