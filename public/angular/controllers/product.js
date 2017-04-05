(function(app) {

  'use strict';

  app.filter('unsafe', function($sce) {
          return function(val) {
              return $sce.trustAsHtml(val);
          };
      })
      .filter('myFilter', function(){
         return function(products, category_id){
           if(!category_id){
             return [];
           }
           var arr = [];
           angular.forEach(products, function(v){
             if(v.category_id == category_id){
               arr.push(v);
             }
           })

           return arr;
         }});

  app.controller('productCtrl', ['productService','$scope', function (service,$scope) {

      self = this;
      $scope.products = [];
      $scope.product = {};  
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
            return {
                "total": res.total,
                "rows": res.rows
            };
        }

        $scope.filterRecord = function(model)
        {
          var searchStr = (typeof(model['searchStr'])=='undefined') ? '': model['searchStr'];
          var url = '/products-regular-list?searchStr='+searchStr;
          bsTable.bootstrapTable('refresh', {url: url});
        }

      $scope.saveProduct = function(model)
      {

        model['non_book'] = $("#non_book").is(':checked')?1:0;
        model['non_consign'] = $("#non_consign").is(':checked')?1:0;
        model['non_returnable'] = $("#non_returnable").is(':checked')?1:0;
        model['vatable'] = $("#vatable").is(':checked')?1:0;
        model['lock'] = $("#lock").is('checked')?1:0;
        model['suspended'] = $("#suspended").is(':checked')?1:0;

        service.saveProduct(model).then(function(result){
          $("button [type='reset']").trigger('click');
            $scope.message(result.data);
        })
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
