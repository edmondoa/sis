@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Suppliers     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Settings</li>
        <li class="active"><i class="fa fa-circle"></i>Supplier</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="supplierCtrl">
      <div class='col-md-5'>
        @include('supplier.create')
      </div>
      <div class='col-md-7'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <a href="#" ng-click="getSuppliers()" class="hide refresh"></a>
          
            <!-- /.box-header -->
          <div class="box-body">
             <input type='text' ng-model='searchQry' class='form-control'/>
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>  
                <th>Supplier</th> 
                <th>Contact Person</th>

                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="supplier in suppliers |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>                 
                  <td ng-bind="supplier.supplier_name"></td> 
                  <td ng-bind="supplier.contact_person"></td>               
                  <td>
                    <a href="javascript:void(0)" class='supplier-edit' data-id="@{{supplier.supplier_id}}"><i class="fa fa-pencil"></i></a>
                    <a href="#"><i class="fa fa-trash warning"></i></a>
                  </td>
                </tr>
              </tbody>
              
            </table>
          </div>
            <!-- /.box-body -->
          <div class="box-footer clearfix">            
            <dir-pagination-controls boundary-links="true" template-url="../angular/dirPagination.tpl.html"></dir-pagination-controls>
          </div>
        </div>
      </div>
    </section>  
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/supplier.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });
  $(document).on('click','.supplier-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "suppliers/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Supplier',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-suppliers').serialize()+"&"+$('#sup_cat').serialize();  
                  $.ajax({
                    url: "/suppliers/"+id,
                    method:'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function(result){
                      if (result['status'] == true) {
                        bootbox.hideAll();
                        message(result);                        
                        $(".refresh").trigger('click');
                      } else {    
                        message(result);                      
                        return false;
                      }
                    },
                    
                  });                 
                  
                  return false;
                }
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
      });
          
    });
  })
</script>
@stop
