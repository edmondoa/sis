(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('branchCtrl', branchCtrl);

    function branchCtrl($scope,$filter, $timeout,$http) {
      $scope.branches = [];
      $scope.currentPage = 1;
      $scope.pageSize = 15;
      var ctrl = this;
      var bsTable     = jQuery('.bsTable');

      bsTable.bootstrapTable({
          responseHandler: function (res) {
              return ctrl.formatter(res);
          },
          queryParams: function(q){
              return q;
          },
          onPostBody: function(data){
          }
      });

      this.formatter = function(res){
            $("div.bs-bars").addClass('col-md-5');
          return {
              "total": res.total,
              "rows": res.rows
          };
      }
      this.filterRecord = function(model)
      {
        var searchStr = (typeof(model['searchStr'])=='undefined') ? '': model['searchStr'];
        var url = '/branches/ng-branch-list?searchStr='+searchStr;
        bsTable.bootstrapTable('refresh', {url: url});
      }

      this.saveCluster = function saveCluster(model){
        service.save(model).then(function (result) {
            $scope.message(result);
        });
      }

      $scope.saveBranch = function(model)
      {
        $http.post('/branches',model)
         .success(function(data) {
            $scope.message(data);
            $("button [type='reset']").trigger('click');

        })
      }




      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.branches = orderBy($scope.branches, predicate, reverse);
      };



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
