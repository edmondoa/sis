(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('AdjustOutCtrl', AdjustOutCtrl);

    function AdjustOutCtrl($scope,$filter, $timeout,$http,$window) {
      $scope.stockins = [];
       $scope.stock =[];
      $scope.currentPage = 1;
      $scope.pageSize = 15;

      $scope.getAdjustOut = function() {
        $("div.loading").removeClass('hide');
        $http.get('/adjust-out/ng-adjustout-list').
           then(function(result) {
            $scope.stockins = result.data.prodlist;
            $("div.loading").addClass('hide');
            console.log(result.data);
            if(result.data.adjustout.branch_id)
            {
              $('#stockin-div :input').attr('disabled',true);
              $('#stockin-div .btn-proceed').attr('disabled',true);
              $('.btn-proceed').attr('disabled',true);
              $("select.stock").attr('disabled',true);

              $("#stockitem-div :input").removeAttr('disabled');
              $('#stockitem-div .btn-add').removeAttr('disabled');

              $("select#branch_id").val(result.data.adjustout.branch_id).trigger("change");
              $("input#branch_id").val(result.data.adjustout.branch_id);
              $("#stock_adj_out_id").val(result.data.adjustout.stock_adj_out_id);
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

      $scope.saveAdjustOut = function()
      {
        $("div.loading").removeClass('hide');
        var model = {
              'branch_id':$("#branch_id").val()
        }
        console.log(model);
        $http.post('/adjust-out-float',model)
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
            $("#branch_id").val(result.data.adjustout.branch_id).trigger("change");


        })
      }

      $scope.total = function(datas)
      {

        var totalQuantity =0;
        var totalCost =0;
        var regex = new RegExp(',', 'g');
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
        $http.get('/adjust-out-float/cancel')
         .then(function(result) {
            $("div.loading").addClass('hide');
            $scope.message(result.data);
            $scope.stockins = result.data.prodlist;
            $("select#branch_id").val('').trigger("change");
            $("#search").val('');
            $("#cprice").val('');
            $("#qty").val('');
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
                 $http.post('/adjust-in-items-remove/'+index)
                  .then(function(res) {
                    $scope.message(res.data);
                    $scope.getAdjustOut();
                  });
              }
          }
      });
      }




      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.stockins = orderBy($scope.stockins, predicate, reverse);
      };
      $scope.getAdjustOut();



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
