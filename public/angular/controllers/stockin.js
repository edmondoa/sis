(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('stockinCtrl', stockinCtrl);

    function stockinCtrl($scope,$filter, $timeout,$http) {
      $scope.stockins = [];
       $scope.stock =[];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getStockins = function() {
        
        $http.get('/stockin/ng-stockin-list').
          success(function(data) {
            $scope.stockins = data.prodlist;
            $("#branch_id").val(data.stockin.branch_id);
            $("#supplier_id").val(data.stockin.supplier_id);
            $("#doc_no").val(data.stockin.doc_no);
            $("#amount_due").val(data.stockin.amount_due);
            
            if(data.stockin.branch_id !='')
            {
              $('.btn-save').removeClass('disabled');
              $('.search-prod').removeClass('disabled');
              $("a.stock").addClass('disabled');
              $("input.stock").attr('readonly',true);
              $("select.stock").attr('readonly',true);
            }
                              
            console.log($scope.stockin);
          });
      }

      $scope.saveStockin = function()
      {    
        
        var model = {
              'branch_id':$("#branch_id").val(),
              'supplier_id': $("#supplier_id").val(),
              'doc_no' : $("#doc_no").val(),
              'amount_due':$("#amount_due").val()
        } 
        console.log(model);
        $http.post('/stockin-float',model)
         .success(function(data) {
            $scope.message(data);
            if(data.success)
            {
              $('.btn-save').removeClass('disabled');
              $('.search-prod').removeClass('disabled');
              $("a.stock").addClass('disabled');
              $("input.stock").attr('readonly',true);
              $("select.stock").attr('readonly',true);;
            }            
            $("#branch_id").val(data.stockin.branch_id);
            $("#supplier_id").val(data.stockin.supplier_id);
            $("#doc_no").val(data.stockin.doc_no);
            $("#amount_due").val(data.stockin.amount_due);
        })
      }

      $scope.cancel = function()
      {
        $http.get('/stockin-float/cancel')
         .success(function(data) {
            $scope.message(data);            
            $scope.stockins = data.prodlist;
            $("#branch_id").val(data.stockin.branch_id);
            $("#supplier_id").val(data.stockin.supplier_id);
            $("#doc_no").val(data.stockin.doc_no);
            $("#amount_due").val(data.stockin.amount_due);
            $("#totalQuantity").text(0);    
            $("#totalCost").text(parseFloat(0));
            $('.btn-save').addClass('disabled');
            $('.search-prod').addClass('disabled');
            
            $("a.stock").removeClass('disabled');
            $("input.stock").attr('readonly',false);
            $("select.stock").attr('readonly',false);
            $("div.amount-due").removeClass('has-error');
        })
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