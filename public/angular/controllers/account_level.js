(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('accLevelCtrl', accLevelCtrl);

    function accLevelCtrl($scope,$filter, $timeout,$http) {
      $scope.acc_levels = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getAccountLevel = function() {
        
        $http.get('acc_levels/ng-acc_levels-list').
          success(function(data) {
            $scope.acc_levels = data;         
            console.log($scope.acc_levels);
          });
      }

      $scope.saveAccountLevel = function(model)
      {        
        $http.post('/acc_levels',model)
         .success(function(data) {
            $scope.message(data);
            $("button [type='reset']").trigger('click');
            $scope.getAccountLevel();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.acc_levels = orderBy($scope.acc_levels, predicate, reverse);
      };
      $scope.getAccountLevel();      
      
     

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