(function(app) {
    'use strict';

app.controller('promoCtrl', ['promoService', function (service) {

  var ctrl = this;

  this.promos = [];

  this.callServer = function callServer(tableState) {

    ctrl.isLoading = true;
    var pagination = tableState.pagination;

    var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
    var number = pagination.number || 10;  // Number of entries showed per page.

    service.getPage(start, number, tableState).then(function (result) {
      console.log(result);
      ctrl.promos = result.data.list;
      tableState.pagination.numberOfPages = result.data.numberOfPages / number;//set the number of pages so the pagination can update
      ctrl.isLoading = false;
    });
  };

  this.saveCluster = function saveCluster(model){
    service.save(model).then(function (result) {
        ctrl.message(result);
    });
  }

  this.saveExclude = function saveExclude(param)
  {
    var branch = param.split("=");
    var str = "<a href='javascript:void(0)' data-id='"+branch[0]+"'class='btn btn-sm btn-info m-2'>"+branch[1]+"</a>";

    $(".select.exclude-branch option[value='"+param+"']").remove();
    $("#branch-exclude").append(str);
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
