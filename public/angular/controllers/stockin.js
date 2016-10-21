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
            $("#branch_id").val(data.stockin.branch_id).trigger("change");
            $("#supplier_id").val(data.stockin.supplier_id).trigger("change");
            $("#doc_no").val(data.stockin.doc_no);
            $("#amount_due").val(data.stockin.amount_due);
            $("#doc_date").val(data.stockin.doc_date);
            $("#arrive_date").val(data.stockin.arrive_date);
            console.log(data.stockin)
            if(data.stockin.branch_id)
            {
              $('.btn-save').removeClass('disabled');
              $('.search-prod').removeClass('disabled');
              $("a.stock").addClass('disabled');
              $("input.stock").attr('readonly',true);
              $("select.stock").attr('disabled',true);
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
              'doc_date' : $("#doc_date").val(),
              'arrive_date' : $("#arrive_date").val(),
              'amount_due':$("#amount_due").val()
        } 
        console.log(model);
        $http.post('/stockin-float',model)
         .success(function(data) {
            $scope.message(data);
            if(data.status)
            {
              $('.btn-save').removeClass('disabled');
              $('.search-prod').removeClass('disabled');
              $("a.stock").addClass('disabled');
              $("input.stock").attr('readonly',true);
              $("select.stock").attr('disabled',true);
            }            
            $("#branch_id").val(data.stockin.branch_id).trigger("change");
            $("#supplier_id").val(data.stockin.supplier_id).trigger("change");
            $("#doc_no").val(data.stockin.doc_no);
            $("#amount_due").val(data.stockin.amount_due);
            $("#doc_date").val(data.stockin.doc_date);
            $("#arrive_date").val(data.stockin.arrive_date);
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
            $("#doc_date").val(data.stockin.doc_date);
            $("#arrive_date").val(data.stockin.arrive_date);
            $("#totalQuantity").text(0);    
            $("#totalCost").text(parseFloat(0));
            $('.btn-save').addClass('disabled');
            $('.search-prod').addClass('disabled');
            
            $("a.stock").removeClass('disabled');
            $("input.stock").attr('readonly',false);
            $("select.stock").attr('disabled',false);
            $("div.amount-due").removeClass('has-error');
        })
      }

      $scope.removeItem = function(index)
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
                 $http.post('/stockin-items-remove/'+index)
                  .success(function(data) {
                    $scope.message(data);
                    $("#"+index).remove();
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