(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('stockinCtrl', stockinCtrl);

    function stockinCtrl($scope,$filter, $timeout,$http,$window) {
      $scope.stockins = [];
       $scope.stock =[];
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getStockins = function() {
        
        $http.get('/stockin/ng-stockin-list').
          success(function(data) {
            $scope.stockins = data.prodlist;          
            if(data.stockin.branch_id)
            {             
              $('#stockin-div :input').attr('disabled',true);
              $('#stockin-div .btn-proceed').attr('disabled',true);
              $('.btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem .btn-add').removeAttr('disabled');

              $("select#branch_id").val(data.stockin.branch_id).trigger("change");
              $("input#branch_id").val(data.stockin.branch_id);
              $("#supplier_id").val(data.stockin.supplier_id).trigger("change");
              $("#doc_no").val(data.stockin.doc_no);
              $("#amount_due").val(data.stockin.amount_due);
              $("#doc_date").val(data.stockin.doc_date);
              $("#arrive_date").val(data.stockin.arrive_date);
              
            }else{
              $("#stockin-div :input").removeAttr('disabled');             
              $("select.stock").removeAttr('disabled');
              $('#stockin-div .btn-proceed').removeAttr('disabled');
              $('#stockitem-div :input').attr("disabled",true)
              $('#stockitem-div .btn-add').attr('disabled',true);
             
            }

            $scope.total(data.prodlist);
                              
            console.log($scope.stockin);
          });
      }

      $scope.saveStockin = function()
      {    
        $("div.loading").removeClass('hide');
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
              $("div.loading").addClass('hide');
              $('#stockin-div :input').attr('disabled',true);
              $('#stockin-div .btn-proceed').attr('disabled',true);
              $('.btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem .btn-add').removeAttr('disabled');
            }            
            $("#branch_id").val(data.stockin.branch_id).trigger("change");
            $("#supplier_id").val(data.stockin.supplier_id).trigger("change");
            $("#doc_no").val(data.stockin.doc_no);
            $("#amount_due").val(data.stockin.amount_due);
            $("#doc_date").val(data.stockin.doc_date);
            $("#arrive_date").val(data.stockin.arrive_date);
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
        $("#totalCost").text(totalCost.toFixed(2));
      }

      $scope.cancel = function()
      {
        $("div.loading").removeClass('hide');
        $http.get('/stockin-float/cancel')
         .success(function(data) {
            $("div.loading").addClass('hide');
            $scope.message(data);            
            $scope.stockins = data.prodlist;
            $("#branch_id").val();
            $("#supplier_id").val();
            $("#doc_no").val();
            $("#amount_due").val();
            $("#doc_date").val();
            $("#arrive_date").val();
            $("#totalQuantity").text(0);    
            $("#totalCost").text(parseFloat(0));
            $("#stockin-div :input").removeAttr('disabled');             
            $("select.stock").removeAttr('disabled');
            $('#stockin-div .btn-proceed').removeAttr('disabled');
            $('#stockitem-div :input').attr("disabled",true)
            $('#stockitem-div .btn-add').attr('disabled',true);
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