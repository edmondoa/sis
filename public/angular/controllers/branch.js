(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('branchCtrl', branchCtrl);

    function branchCtrl($scope,$filter, $timeout,$http) {
      $scope.branches = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getBranches = function() {
        
        $http.get('branches/ng-branch-list').
          success(function(data) {
            $scope.branches = data;         
            console.log($scope.branches);
          });
      }

      $scope.saveBranch = function(model)
      {        
        $http.post('/branches',model)
         .success(function(data) {
            $scope.message(data);
            $("button [type='reset']").trigger('click');
            $scope.getBranches();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.branches = orderBy($scope.branches, predicate, reverse);
      };
      $scope.getBranches();      
      
     

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