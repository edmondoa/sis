(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('pStorageCtrl', pStorageCtrl)
    .filter('myFilter', function(){
         return function(storages, branch_id){
           if(!branch_id){
             return storages;
           }
           var arr = [];
           angular.forEach(storages, function(v){
             if(v.branch_id == branch_id){
               arr.push(v);
             }
           })

           return arr;
         }});

    function pStorageCtrl($scope,$filter, $timeout,$http) {
      $scope.storages = [];
      $scope.pr ={};
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
            $scope.pr ={};
            $scope.Storages();
        })
      }

      $scope.branchMatch = function(branch)
      {
        return function( storage ) {
          return storage.branch_id === branch;
        };
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