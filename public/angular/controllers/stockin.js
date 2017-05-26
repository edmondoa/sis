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
        $("div.loading").removeClass('hide');
        $http.get('/stockin/ng-stockin-list').
          then(function(result) {            
            $scope.stockins = result.data.prodlist; 
            $("div.loading").addClass('hide');         
            if(result.data.stockin.branch_id)
            {             
              $('#stockin-div :input').attr('disabled',true);
              $('#stockin-div .btn-proceed').attr('disabled',true);
              $('.btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem-div .btn-add').removeAttr('disabled');

              $("select#branch_id").val(result.data.stockin.branch_id).trigger("change");
              $("input#branch_id").val(result.data.stockin.branch_id);
              $("#supplier_id").val(result.data.stockin.supplier_id).trigger("change");
              $("#doc_no").val(result.data.stockin.doc_no);
              $("#amount_due").val(result.data.stockin.amount_due);
              $("#doc_date").val(result.data.stockin.doc_date);
              $("#arrive_date").val(result.data.stockin.arrive_date);
              
            }else{
              $("#stockin-div :input").removeAttr('disabled');             
              $("select.stock").removeAttr('disabled');
              $('#stockin-div .btn-proceed').removeAttr('disabled');
              $('#stockitem-div :input').attr("disabled",true)
              $('#stockitem-div .btn-add').attr('disabled',true);
             
            }

            $scope.total(result.data.prodlist);                              
           
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
         .then(function(result) {
            $("div.loading").addClass('hide');
            $scope.message(result.data);
            if(result.data.status)
            {
              $("div.loading").addClass('hide');
              $('#stockin-div :input').attr('disabled',true);
              $('#stockin-div .btn-proceed').attr('disabled',true);
              $('.btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem-div .btn-add').removeAttr('disabled');
            }            
            $("#branch_id").val(result.data.stockin.branch_id).trigger("change");
            $("#supplier_id").val(result.data.stockin.supplier_id).trigger("change");
            $("#doc_no").val(result.data.stockin.doc_no);
            $("#amount_due").val(result.data.stockin.amount_due);
            $("#doc_date").val(result.data.stockin.doc_date);
            $("#arrive_date").val(result.data.stockin.arrive_date);
           
        })
      }

      $scope.total = function(datas)
      {

        var totalQuantity =0;
        var totalCost =0;
        var regex = new RegExp(',', 'g');
        angular.forEach(datas, function(value, key) {
          
          totalCost = parseFloat(value.total.replace(regex,'')) + parseFloat(totalCost);          
          totalQuantity = parseInt(value.quantity) + parseInt(totalQuantity); 
                  
        });
        console.log(datas);
        var total = $filter('currency')(totalCost,'₧');
        $("#totalQuantity").text(totalQuantity);    
        $("#totalCost").text(total);
      }

      $scope.cancel = function()
      {
        $("div.loading").removeClass('hide');
        $http.get('/stockin-float/cancel')
         .then(function(result) {  
            $("div.loading").addClass('hide');          
            $scope.message(result.data);            
            $scope.stockins = result.data.prodlist;
            $("select#branch_id").val('').trigger("change");
            $("select#supplier_id").val('').trigger("change");         
            $("#search").val('');
            $("#doc_no").val('');
            $("#cprice").val('');
            $("#qty").val('');
            $("#amount_due").val('');
            $("#doc_date").val('');
            $("#arrive_date").val('');
            $("#notes").val(''); 
            $("#name").text(''); 
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
                  .then(function(res) {
                    $scope.message(res.data);
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