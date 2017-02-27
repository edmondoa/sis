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
        $("div.loading").removeClass('hide');
        $http.get('/stockout/ng-stockout-list').
          success(function(data) {
            $("div.loading").addClass('hide');
            $scope.stockins = data.prodlist;
            if(data.stockout.branch_id)
            {
              $('#stockout-div :input').attr('disabled',true);
              $('#stockout-div .btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem-div .btn-add').removeAttr('disabled');

              $("#branch_id").val(data.stockout.branch_id).trigger("change");
              $("#supplier_id").val(data.stockout.supplier_id).trigger("change");
              $("#stockout_id").val(data.stockout.stockout_id)
              $("input#branch_id").val(data.stockout.branch_id);
            }else{
              $('#stockout-div :input').removeAttr('disabled');
              $('#stockout-div .btn-proceed').removeAttr('disabled');
              $("select.stock").removeAttr('disabled');
              $("#stockitem-div :input").attr('disabled',true);
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
              'supplier_id': $("#supplier_id").val()
        }
        $http.post('/stockout-float',model)
         .success(function(data) {
            $("div.loading").addClass('hide');
            $scope.message(data);
            if(data.status)
            {
              $('#stockout-div :input').attr('disabled',true);
              $('#stockout-div .btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem .btn-add').removeAttr('disabled');

              $("#stockout_id").val(data.stockout.stockout_id)
              $("input#branch_id").val(data.stockout.branch_id);
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
        var total = $filter('currency')(totalCost,'₧');
        $("#totalQuantity").text(totalQuantity);
        $("#totalCost").text(total);
      }

      $scope.cancel = function()
      {
        $("div.loading").removeClass('hide');
        $http.get('/stockout-float/cancel')
         .success(function(data) {
            $("div.loading").addClass('hide');
            $scope.message(data);
            $scope.stockins = [];
            $("select#branch_id").val('').trigger("change");
            $("select#supplier_id").val('').trigger("change");
            $('#stockout-div :input').removeAttr('disabled');
            $("#search").val('');
            $("#notes").val('');
            $("#qty").val('');
            $("#available").text('');
            $("#total").text('');
            $("#totalQuantity").text(0);
            $("#totalCost").text(parseFloat(0));
            $('#stockout-div .btn-proceed').removeAttr('disabled');
            $("select.stock").removeAttr('disabled');
            $("#stockitem-div :input").attr('disabled',true);
            $('#stockitem-div .btn-add').attr('disabled',true);
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
