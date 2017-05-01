
(function(app) {
    'use strict';

app.controller('pStorageCtrl', ['storageService' ,'$scope', function (service ,$scope) {

  var ctrl = this;
  $scope.pr = {};
  this.clusters = [];
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
    var url = '/product-storage/ng-storage-list?searchStr='+searchStr;
    bsTable.bootstrapTable('refresh', {url: url});
  }

  this.saveStorage = function saveStorage(model){
    console.log(model);
    service.saveStorage(model).then(function (result) {
        $scope.message(result);
    });
  }

  $scope.message = function(result)
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
