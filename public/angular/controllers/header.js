(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('headerCtrl', headerCtrl);

    function headerCtrl($scope,$filter, $interval,$http) {
      $scope.task = [];
      $interval(
        function(){
          $scope.getTask()
        },10000);

     $scope.getTask = function()
     {
      // $http.get('/header/task')
      //    .success(function(data) {
      //     $scope.task = data;
      //    });
     }


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
