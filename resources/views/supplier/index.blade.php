@extends('layouts.master')

@section('content')

    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><i class="fa fa-circle"></i>Suppliers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="supplierCtrl as sc">
        <div class="box">
            <!-- /.box-body -->
            <div class="box-body">
              <div class='row'>
                <div class='col-md-5 pull-right'>
                  <div class='col-md-8'>
                    <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="sc.filterRecord(filterBy)"/>
                  </div>
                  <a href="/suppliers/create" class='btn  btn-info'>New Supplier  <span class="glyphicon glyphicon-plus-sign"></span></a>
                </div>
              </div>
              <br>
              <table id="suppliers" class="bsTable table table-striped"
               data-url="/suppliers/ng-supplier-list"
               data-pagination="true"
               data-side-pagination="server"
               data-page-list="[10,20,50]"
               data-sort-order="desc"
               data-show-clear="true"
               js-bootstraptable>
              <thead>
                  <tr>
                      <th style='width:50px' data-field="action" class="action">Action</th>
                      <th class="col-md-6" data-field="supplier_name" >Supplier</th>
                      <th class="col-md-6"data-field="contact_person" >Contact Person</th>

                  </tr>
              </thead>
              </table>
            </div>
        </div>

    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/supplier.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/supplierService.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.settings-product").addClass('active');
    $("li.suppliers").addClass('active');
  });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
  $(document).on('click','.supplier-edit',function(e){
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
                        $(".bsTable").bootstrapTable('refresh');
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
