(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('categoryCtrl', categoryCtrl);

    function categoryCtrl($scope,$filter, $timeout,$http) {
      $scope.categories = [];      
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getCategories = function() {
        
        $http.get('category/ng-cat-list').
          success(function(data) {
            $scope.categories = data;         
            console.log($scope.categories);
          });
      }

      $scope.saveCategory = function(model)
      {   
       
        model['category_name'] = $(".category_name").val();     
       
        
        $http.post('/category',model)
         .success(function(data) {
            $scope.message(data);
            //model.category_name="";
            $scope.getCategories();
        })
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.categories = orderBy($scope.categories, predicate, reverse);
      };
      $scope.getCategories();      
      
     

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