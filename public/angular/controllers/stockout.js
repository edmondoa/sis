(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('stockoutCtrl', stockoutCtrl);

    function stockoutCtrl($scope,$filter, $timeout,$http,$window) {
      $scope.stockins = [];
       $scope.stock =[];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getStockins = function() {
        
        $http.get('/stockout/ng-stockout-list').
          success(function(data) {
            $scope.stockins = data.prodlist;
            console.log(data.stockout)
            $("#branch_id").val(data.stockout.branch_id).trigger("change");
            $("#supplier_id").val(data.stockout.supplier_id).trigger("change");
            $("#stockout_id").val(data.stockout.stockout_id)
            console.log(data.stockout)
            if(data.stockout.branch_id)
            {
              $("#stockin-div").attr('disabled',true);
              $("#stockitem-div").attr('disabled',false);              
               $("select.stock").attr('disabled',true);
            }else{
              $("#stockin-div").attr('disabled',false);

              $(':input','a','#stockitem-div').attr("disabled",true)
              $("#stockitem-div").attr('disabled',true);
            }

            $scope.total(data.prodlist);
                              
            console.log($scope.stockin);
          });
      }

      $scope.saveStockin = function()
      {    
        
        var model = {
              'branch_id':$("#branch_id").val(),
              'supplier_id': $("#supplier_id").val()             
        } 
        console.log(model);
        $http.post('/stockout-float',model)
         .success(function(data) {
            $scope.message(data);
            if(data.status)
            {
              $window.location.reload();
            }            
            $("#branch_id").val(data.stockin.branch_id).trigger("change");
            $("#supplier_id").val(data.stockin.supplier_id).trigger("change");           
        })
      }

      $scope.total = function(datas)
      {
        var totalQuantity =0;
        var totalCost =0;
        angular.forEach(datas, function(value, key) {
          
          totalCost = parseFloat(value.total) + parseFloat(totalCost);          
          totalQuantity = parseInt(value.quantity) + parseInt(totalQuantity); 
                  
        });
        $("#totalQuantity").text(totalQuantity);    
        $("#totalCost").text(parseFloat(totalCost));
      }

      $scope.cancel = function()
      {
        $http.get('/stockout-float/cancel')
         .success(function(data) {
            $scope.message(data);            
            $window.location.reload();
        })
      }

      $scope.removeItem = function(model)
      {
        bootbox.confirm({
          title: "Remove Item",
          message: "Are you sure you want to remove this item?",
          size: 'small',
          buttons: {
              cancel: {
                  label: '<i class="fa fa-times"></i> Cancel',
                  className: 'btn-danger'
              },
              confirm: {
                  label: '<i class="fa fa-check"></i> Confirm',
                  className: 'btn-success'
              }
          },
          callback: function (result) {
              if(result)
              {
                 $http.post('stockout-items-remove',model)
                  .success(function(data) {
                    $scope.message(data);
                    $scope.getStockins();
                  });
              }
          }
      });
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.stockins = orderBy($scope.stockins, predicate, reverse);
      };
      $scope.getStockins();      
      
     

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