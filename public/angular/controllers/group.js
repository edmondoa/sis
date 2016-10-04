(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('pGroupCtrl', pGroupCtrl);

    function pGroupCtrl($scope,$filter, $timeout,$http) {
      $scope.groups = [];
      $scope.pr = {};
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getGroups = function() {
        
        $http.get('product-group/ng-group-list').
          success(function(data) {
            $scope.groups = data;         
            console.log($scope.groups);
          });
      }

      $scope.saveGroup = function(model)
      {          
        
        $http.post('/product-group',model)
         .success(function(data) {
            $scope.message(data);
            $scope.pr = {};
            $scope.getGroups();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.groups = orderBy($scope.groups, predicate, reverse);
      };
      $scope.getGroups();      
      
     

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