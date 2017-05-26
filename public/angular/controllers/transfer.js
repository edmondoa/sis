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
          then(function(result) {
            $scope.products = result.data.prodlist;
            $scope.transfer = result.data.transfer;          

            if(result.data.transfer.orig_branch_id)
            {
              $("#branch_id_from").val(result.data.transfer.orig_branch_id).trigger("change");
              $("#branch_id_to").val(result.data.transfer.recv_branch_id).trigger("change");
              // $("#supplier_id").val(data.transfers.supplier_id).trigger("change");
              $("#transfer_id").val(result.data.transfer.transfer_id)

              $('#stockin-div :input').attr('disabled',true);
              $('#stockin-div .btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem .btn-add').removeAttr('disabled');
            }else{
             $('#stockin-div :input').removeAttr('disabled');
              $('#stockin-div .btn-proceed').removeAttr('disabled');
              $("select.stock").removeAttr('disabled');
              $("#stockitem-div :input").attr('disabled',true);
              $('#stockitem .btn-add').attr('disabled',true);
           }

            $scope.total(result.data.products);

           // console.log($scope.stockin);
          });
      }

      $scope.saveTranser = function()
      {
        if($("#branch_id_from").val() == $("#branch_id_to").val()){
          var data = {status:false,message:['Originating and Receiving branch should not be the same!']};
           $scope.message(data);
           return false;
        }
        var model = {
              'orig_branch_id':$("#branch_id_from").val(),
              'recv_branch_id':$("#branch_id_to").val()
        }
        console.log(model);
        $http.post('/transfer-float',model)
         .then(function(result) {
            $scope.message(result.data);
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
        console.log(datas);
        var totalQuantity =0;
        var totalCost =0;

        angular.forEach(datas, function(value, key) {

          totalCost = parseFloat(value.total) + parseFloat(totalCost);
          totalQuantity = parseInt(value.quantity) + parseInt(totalQuantity);

        });
        var total = $filter('currency')(totalCost,'₧');
        $("#totalQuantity").text(totalQuantity);
        $("#totalCost").text(total);
      }

      $scope.cancel = function()
      {
        $http.get('transfer-float/cancel')
         .then(function(result) {
            $scope.message(result.data);
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
                  .then(function(res) {
                    $scope.message(res.data);
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
