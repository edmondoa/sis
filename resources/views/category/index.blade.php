@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <style type="text/css">
    .select2{width:100% !important;}
    </style>
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><i class="fa fa-circle"></i>Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="categoryCtrl as cc">
      <div class='col-md-12'>
        <div class="box">
            <!-- /.box-header -->
          <div class="box-body">
            <div class='row'>
              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="cc.filterRecord(filterBy)"/>
                </div>
                <a href="/category/create" class='btn  btn-info'>New Category  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
            </div>
            <br>
            <table id="category" class="bsTable table table-striped"
             data-url="/category/ng-cat-list"
             data-pagination="true"
             data-side-pagination="server"
             data-page-list="[10,20,50]"
             data-sort-order="desc"
             data-show-clear="true"
             js-bootstraptable>
            <thead>
                <tr>                    
                    <th class="col-md-5" data-field="category_name" >Category Name</th>
                    <th class="col-md-4"data-field="category_code" >Category Code</th>
                    <th class="col-md-3"  data-field="count_supplier" >Supplier</th>
                    <th style='width:50px' data-field="action" class="action">Action</th>
                </tr>
            </thead>
            </table>
          </div>
            <!-- /.box-body -->

        </div>
      </div>
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/category.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/categoryService.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.settings-product").addClass('active');
    $("li.category").addClass('active');
  });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
  $(document).on('click','.category-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "category/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Category',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-category').serialize();
                  $.ajax({
                    url: "/category/"+id,
                    method:'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function(result){
                      if (result['status'] == true) {
                        bootbox.hideAll();
                        message(result);
                        $("table#category").bootstrapTable('refresh');
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
