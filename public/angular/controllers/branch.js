(function(app) {

  'use strict';

  app.controller('branchCtrl', ['branchService','$scope', function (service,$scope) {

      var ctrl = this;
      $scope.branch = {};
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

      this.saveBranch = function(model){
        var fbranch = $("form[name='branch-form']").serializeArray();
        for(var i=0; i<fbranch.length; i++){
          if(fbranch[i]['value']=='? undefined:undefined ?'){
            model[fbranch[i]['name']] = '';
          }else{
            model[fbranch[i]['name']] = fbranch[i]['value'];
          }

        }
        service.saveBranch(model).then(function (result) {
            $scope.message(result);
            $("button [type='reset']").trigger('click');
        });
      }



    $scope.message = function(data)
    {
      console.log(data);
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
