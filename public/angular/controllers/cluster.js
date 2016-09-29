(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('clusterCtrl', clusterCtrl);

    function clusterCtrl($scope,$filter, $timeout,$http) {
      $scope.clusters = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getClusters = function() {
        
        $http.get('clusters/ng-cluster-list').
          success(function(data) {
            $scope.clusters = data;         
            console.log($scope.clusters);
          });
      }

      $scope.saveCluster = function(model)
      {         
        
        $http.post('/clusters',model)
         .success(function(data) {
            $scope.message(data);
            //model.category_name="";
            $scope.getClusters();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.clusters = orderBy($scope.clusters, predicate, reverse);
      };
      $scope.getClusters();      
      
     

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