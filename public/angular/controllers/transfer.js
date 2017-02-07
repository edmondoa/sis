(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('transferCtrl', transferCtrl);

    function transferCtrl($scope,$filter, $timeout,$http,$window) {
      $scope.transfer = [];
       $scope.products =[];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getTransfer = function() {
        
        $http.get('/transfer/ng-transfer-list').
          success(function(data) {
            $scope.products = data.prodlist;
            $scope.transfer = data.transfer;
           
            $("#branch_id_from").val(data.transfer.orig_branch_id).trigger("change");
            $("#branch_id_to").val(data.transfer.recv_branch_id).trigger("change");
            // $("#supplier_id").val(data.transfers.supplier_id).trigger("change");
             $("#transfer_id").val(data.transfer.transfer_id)
            console.log(data.transfers)
            if(data.transfer != null)
            {
              $("#stockin-div").attr('disabled',true);
              $("#stockitem-div").attr('disabled',false);              
               $("select.stock").attr('disabled',true);
            }else{
              $("#stockin-div").attr('disabled',false);

              $(':input','a','#stockitem-div').attr("disabled",true)
              $("#stockitem-div").attr('disabled',true);
           }

            $scope.total(data.products);
                              
           // console.log($scope.stockin);
          });
      }

      $scope.saveTranser = function()
      {    
        
        var model = {
              'orig_branch_id':$("#branch_id_from").val(),
              'recv_branch_id':$("#branch_id_to").val()             
        } 
        console.log(model);
        $http.post('/transfer-float',model)
         .success(function(data) {
            $scope.message(data);
            if(data.status)
            {
              $window.location.reload();
            }            
            // $("#branch_id").val(data.stockin.branch_id).trigger("change");
            // $("#supplier_id").val(data.stockin.supplier_id).trigger("change");
            // $("#doc_no").val(data.stockin.doc_no);
            // $("#amount_due").val(data.stockin.amount_due);
            // $("#doc_date").val(data.stockin.doc_date);
            // $("#arrive_date").val(data.stockin.arrive_date);
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
        $http.get('transfer-float/cancel')
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
                 $http.post('transfer-items-remove/'+model.transfer_item_id)
                  .success(function(data) {
                    $scope.message(data);
                    $scope.getTransfer();
                  });
              }
          }
      });
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.transfers = orderBy($scope.transfers, predicate, reverse);
      };
      $scope.getTransfer();      
      
     

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