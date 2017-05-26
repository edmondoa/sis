(function() {

  'use strict';

  angular
    .module('SisApp')
    .controller('journalCtrl', journalCtrl);

    function journalCtrl($scope,$filter, $timeout,$http) {
      $scope.journals = [];      
      $scope.currentPage = 1;
      $scope.pageSize = 15;  

      $scope.getJournals = function() {
        
        $http.get('request/ng-journal-list').
          then(function(result) {
            $scope.journals = result.data;         
            console.log($scope.journals);
          });
      } 

      $scope.cancel = function(model)
      {
        $http.get( "approvals/notes").then(function(result) {
        var dialog = bootbox.dialog({
            title: 'Notes',           
            message: result.data,
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
                    $http.post('approvals/update/CANCELLED/'+model.approval_id,param).
                      then(function(result) {
                      $scope.getJournals();         
                      $scope.message(result.data);
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

      $scope.gen_class = function(cls){
        if(cls == 'PENDING')
          return "text-info";
        else if(cls == 'APPROVED')
          return "text-success";

        return "text-danger";
      }
      

      $scope.order = function(predicate, reverse) {
        console.log("dd");
         $scope.journals = orderBy($scope.journals, predicate, reverse);
      };
      $scope.getJournals();      
      
     

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