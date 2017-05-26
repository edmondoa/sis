(function(app) {
    'use strict';
app.filter('unsafe', function($sce) {
        return function(val) {
            return $sce.trustAsHtml(val);
        };
    });
app.controller('promoCtrl', ['promoService','$scope','$http', function (service,$scope,$http) {

  var ctrl = this;
  $scope.promo ={};
  $scope.promos = [];
  $scope.need = [];
  $scope.branch = [];
  var bsTable     = jQuery('.bsTable');

  bsTable.bootstrapTable({
      responseHandler: function (res) {
          return $scope.formatter(res);
      },
      queryParams: function(q){
          return q;
      },
      onPostBody: function(data){
      }
  });

  $scope.formatter = function(res){
        $("div.bs-bars").addClass('col-md-5');
      return {
          "total": res.total,
          "rows": res.rows
      };
  }
  $scope.filterRecord = function(model)
  {
    var searchStr = (typeof(model['searchStr'])=='undefined') ? '': model['searchStr'];
    var url = '/products-promo/ng-promo-list?status='+model['status']+'&searchStr='+searchStr;
    bsTable.bootstrapTable('refresh', {url: url});
  }

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

  $scope.savePromo = function()
  {

    var x = $("#promoForm").serializeArray();
    var promo = {};
    $.each(x, function(i, field){
        promo[field.name] = (field.value ==='? undefined:undefined ?') ?'':field.value;
    });
    promo['non_book'] = ($("#non_book").is(':checked'))?1:0;
    promo["non_consign"] = $("#non_consign").is(':checked')?1:0;
    promo['lock'] = $("#lock").is('checked')?1:0;
    promo['suspended'] = $("#suspended").is(':checked')?1:0;
    promo['description'] = $("#description").val();
   
    service.savePromo(promo, this.need, this.branch).then(function (result) {
      $scope.message(result);
    });
  }

  $scope.searchProd = function()
  {
    var search = $("#searchStr").val();
    service.searchProd(search).then(function(result){
      if(result.data.status)
        {
          console.log(result.data.products[0].retail_price)
          $scope.promo.price = result.data.products[0].retail_price;
          $("#description").text(result.data.products[0].description);
          

        }else{
          bootbox.alert({message:"Product not found!",
                       size: 'small'
            });
        }
    })
    // $http.get('/product/searchProd?search='+search).
    //       success(function(data) {
    //         $("#search").val(data.products[0].product_id);         
    //         $("#description").text(data.products[0].description);
    //         $scope.promo.price = data.products[0].retail_price;
    //       })  
    // $.get('/product/searchProd?search='+search,function(data){
    //     if(data.status)
    //     {
    //       console.log(data.products);  
    //       $("#search").val(data.products[0].product_id);         
    //       $("#description").text(data.products[0].description);
    //       $("#price").text(data.products[0].retail_price);

    //     }else{
    //       bootbox.alert({message:"Product not found!",
    //                    size: 'small'
    //         });
    //     }

    // });
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
