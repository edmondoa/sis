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


      $scope.products = [];
      $scope.product = {};
      $scope.currentPage = 1;
      $scope.pageSize = 15;

      $scope.init = {
        'count': 10,
        'page': 1,
        'sortBy': 'product_id',
        'sortOrder': 'asc',
        'filterBase': 1 // set false to disable
      };
      $scope.filterBy = {
        'searchStr': '',
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
