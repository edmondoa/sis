(function(app) {
    'use strict';
app.filter('unsafe', function($sce) {
        return function(val) {
            return $sce.trustAsHtml(val);
        };
    });
app.controller('promoCtrl', ['promoService','$scope', function (service,$scope) {

  var ctrl = this;

  $scope.promos = [];
  $scope.need = [];
  $scope.branch = [];
  $scope.init = {
    'count': 10,
    'page': 1,
    'sortBy': 'promo_id',
    'sortOrder': 'asc',
    'filterBase': 1 // set false to disable
  };
  $scope.filterBy = {
  'searchStr': '',
  'status' :''
}
  $scope.callServer = function(params, paramsObj) {
    return service.getPage(params, paramsObj).then(function (result) {

      return {
      'rows': result.data.list,
      'header': result.data.header,
      'pagination': result.data.pagination

      }
    });
  };

  $scope.saveExclude = function(param)
  {
    var branch = param.split("=");
    var str = "<a href='javascript:void(0)' style='margin:5px' data-id='"+branch[0]+"'class='btn btn-sm btn-info btn-exclude' ng-click='pc.removeExclude(\'"+branch[0]+"\')'>"+branch[1]+"</a>";
    console.log(param);
    $scope.branch.push({branch_id:branch[0]});
    if($("select.exclude-branch").text() != 'Select' ){
        $("select.exclude-branch option[value='"+param+"']").remove();
        $("#branch-exclude").append(str);
    }
  }

  $scope.savePromoNeed = function(need)
  {
    console.log(need.product);
    var product = need.product.split("=");
    var action = "<a ng-click='pc.remove(need)'><i class='fa fa-times text-danger'></i></a>"
    $scope.need.push({pid:product[0],category:product[1],name:product[2],qty:need.qty,action:action});
  }

  $scope.savePromo = function(promo)
  {

    promo['non_book'] = $("#non_book").is(':checked')?1:0;
    promo['non_consign'] = $("#non_consign").is(':checked')?1:0;
    promo['lock'] = $("#lock").is('checked')?1:0;
    promo['suspended'] = $("#suspended").is(':checked')?1:0;
    promo['description'] = $("#description").val();
    console.log(promo)
    service.savePromo(promo, this.need, this.branch).then(function (result) {
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
