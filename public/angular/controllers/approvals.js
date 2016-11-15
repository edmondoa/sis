(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('approvalCtrl', approvalCtrl);

    function approvalCtrl($scope,$filter, $timeout,$http) {
      $scope.approvals = [];      
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getApproves = function() {
        
        $http.get('approvals/ng-approve-list').
          success(function(data) {
            $scope.approvals = data;         
            console.log($scope.approvals);
          });
      } 

      $scope.approved = function(model)
      {
        $http.post('approvals/update/APPROVED/'+model.approval_id).
        success(function(data) {
         $scope.getApproves();         
         $scope.message(data); 
        });
      }

      $scope.dis_approved = function(model)
      {
        $http.get( "approvals/notes").success(function(data) {
        var dialog = bootbox.dialog({
            title: 'Notes',           
            message: data,
            buttons: {
              confirm: {
                  label: 'GO!',
                  className: 'btn-success',
                  callback:function(){ 
                    if($("[name='notes']").val().trim() =='')
                    {
                      $.notify({       
                          message: "Note's is required"
                        },{
                          type: 'danger',
                          newest_on_top: true,
                        placement: {
                            align: "right",
                            from: "bottom"
                        }                       
                      });  
                      return false;
                    }  
                    var param = {'note':$("[name='notes']").val()};                           
                    $http.post('approvals/update/DECLINED/'+model.approval_id,param).
                      success(function(data) {
                      $scope.getApproves();         
                      $scope.message(data);
                      bootbox.hideAll(); 
                    });
                   
                  }
              },
              cancel: {
                  label: 'Cancel',
                  className: 'btn-danger'
              }
          },
        });
      });  
              
      
        
      }

      
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.approvals = orderBy($scope.approvals, predicate, reverse);
      };
      $scope.getApproves();      
      
     

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