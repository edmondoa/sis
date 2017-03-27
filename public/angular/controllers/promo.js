(function(app) {
    'use strict';
app.filter('unsafe', function($sce) {
        return function(val) {
            return $sce.trustAsHtml(val);
        };
    });
app.controller('promoCtrl', ['promoService', function (service) {

  var ctrl = this;

  this.promos = [];
  this.need = [];
  this.branch = [];
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
  
  this.saveExclude = function saveExclude(param)
  {
    var branch = param.split("=");
    var str = "<a href='javascript:void(0)' style='margin:5px' data-id='"+branch[0]+"'class='btn btn-sm btn-info btn-exclude' ng-click='pc.removeExclude(\'"+branch[0]+"\')'>"+branch[1]+"</a>";
    console.log(param);
    this.branch.push({branch_id:branch[0]});
    if($("select.exclude-branch").text() != 'Select' ){
        $("select.exclude-branch option[value='"+param+"']").remove();
        $("#branch-exclude").append(str);
    }
  }

  this.savePromoNeed = function savePromoNeed(need)
  {
    console.log(need.product);
    var product = need.product.split("=");
    var action = "<a ng-click='pc.remove(need)'><i class='fa fa-times text-danger'></i></a>"
    ctrl.need.push({pid:product[0],category:product[1],name:product[2],qty:need.qty,action:action});
  }

  this.savePromo = function savePromo(promo)
  {

    promo['non_book'] = $("#non_book").is(':checked')?1:0;
    promo['non_consign'] = $("#non_consign").is(':checked')?1:0;
    promo['lock'] = $("#lock").is('checked')?1:0;
    promo['suspended'] = $("#suspended").is(':checked')?1:0;
    promo['description'] = $("#description").val();
    console.log(promo)
    service.savePromo(promo, this.need, this.branch).then(function (result) {
      this.message(result);
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
