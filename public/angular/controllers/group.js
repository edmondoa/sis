(function(app) {
    'use strict';

app.controller('pGroupCtrl', ['groupService' ,'$scope', function (service ,$scope) {
      var ctrl = this;
     var group = {};
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
        var url = '/product-group/ng-pgroup-list?searchStr='+searchStr;
        bsTable.bootstrapTable('refresh', {url: url});
      }

      this.saveGroup = function saveGroup(){
        group['group_name'] = $("#group_name").val();
        group['notes'] = $("#notes").val();

        service.saveGroup(group).then(function (result) {
            $scope.message(result.data);
        });
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
}])
})(App)
