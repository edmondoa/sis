(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('stockinCtrl', stockinCtrl);

    function stockinCtrl($scope,$filter, $timeout,$http) {
      $scope.stokins = [];
      $scope.stockin ={};
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getStockins = function() {
        
        $http.get('/stockin/ng-pgroup-list').
          success(function(data) {
            $scope.stokins = data;         
            console.log($scope.groups);
          });
      }

      $scope.saveStockin = function(model)
      {        
        $http.post('/stockin-float',model)
         .success(function(data) {
            $scope.message(data);            
            
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.stokins = orderBy($scope.stokins, predicate, reverse);
      };
     // $scope.getGroups();      
      
     

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