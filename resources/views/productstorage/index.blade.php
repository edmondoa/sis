@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">

      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><i class="fa fa-circle"></i>Product Storages</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="pStorageCtrl as ps">

        <div class="box">
            <!-- /.box-header -->
          <div class="box-body">
            <div class='row'>
              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="ps.filterRecord(filterBy)"/>
                </div>
                <a href="/product-storage/create" class='btn  btn-info'>New Storage  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
            </div>
            <br>
            <table id="product-group" class="bsTable table table-striped"
             data-url="/product-storage/ng-storage-list"
             data-pagination="true"
             data-side-pagination="server"
             data-page-list="[10,20,50]"
             data-sort-order="desc"
             data-show-clear="true"
             js-bootstraptable>
            <thead>
                <tr>                    
                    <th class="col-md-6" data-field="branch_name" >Branch Name</th>
                    <th class="col-md-6" data-field="storage_name" >Storage Name</th>
                    <th style='width:50px' data-field="action" class="action">Action</th>
                </tr>
            </thead>
            </table>
          </div>
            <!-- /.box-body -->
        </div>
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/storage.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/storageService.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.settings-product").addClass("active");
    $("li.product-storage").addClass("active");
  });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
  $(document).on('click','.storage-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "product-storage/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Product Storage',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-product-storage').serialize();
                  $.ajax({
                    url: "/product-storage/"+id,
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
