// (function() {
//
//   'use strict';
//
//   angular
//     .module('SisApp')
//     .controller('clusterCtrl', clusterCtrl);
//
//     function clusterCtrl($scope,$filter, $timeout,$http) {
//       $scope.clusters = [];
//       $scope.cluster = {};
//       $scope.currentPage = 1;
//       $scope.pageSize = 2;
//
//       $scope.getClusters = function() {
//
//         $http.get('clusters/ng-cluster-list').
//           success(function(data) {
//             $scope.clusters = data;
//             console.log($scope.clusters);
//           });
//       }
//
//       $scope.saveCluster = function(model)
//       {
//
//         $http.post('/clusters',model)
//          .success(function(data) {
//             $scope.message(data);
//             $scope.cluster = {};
//             $scope.getClusters();
//         })
//       }
//
//
//
//
//       $scope.order = function(predicate, reverse) {
//         console.log("dd");
//          $scope.clusters = orderBy($scope.clusters, predicate, reverse);
//       };
//
//
//
//
//     $scope.message = function(data)
//     {
//       if(data.status){
//         $.notify({
//           message: data.message
//         },{
//           type: 'success',
//           newest_on_top: true,
//           placement: {
//               align: "right",
//               from: "bottom"
//           }
//         });
//       }else{
//         var stringBuilder ="<ul class='error'>";
//         for (var x in data.message) {
//           console.log(x);
//           stringBuilder +="<li>"+data.message[x]+"</li>";
//         }
//         stringBuilder +="</ul>";
//          $.notify({
//             message: stringBuilder
//           },{
//             type: 'danger',
//             newest_on_top: true,
//             placement: {
//                 align: "right",
//                 from: "bottom"
//             }
//           });
//       }
//     }
//   }
// })();
(function(app) {
    'use strict';

app.controller('clusterCtrl', ['clusterService', function (service) {

  var ctrl = this;

  this.clusters = [];

  this.callServer = function callServer(tableState) {

    ctrl.isLoading = true;
    var pagination = tableState.pagination;

    var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
    var number = pagination.number || 10;  // Number of entries showed per page.

    service.getPage(start, number, tableState).then(function (result) {
      console.log(result);
      ctrl.clusters = result.data.list;
      tableState.pagination.numberOfPages = result.data.numberOfPages / number;//set the number of pages so the pagination can update
      ctrl.isLoading = false;
    });
  };

  this.saveCluster = function saveCluster(model){
    service.save(model).then(function (result) {
        ctrl.message(result);
    });
  }

  this.message = function(result)
    {
      console.log(result);
        if(result.data.status){
          $.notify({
            message: result.data.message
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
          for (var x in result.data.message) {
            console.log(x);
            stringBuilder +="<li>"+result.data.message[x]+"</li>";
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

}])
})(App)
