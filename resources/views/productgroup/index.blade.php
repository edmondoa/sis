@extends('layouts.master')

@section('content')

    <section class="content-header">

      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><i class="fa fa-circle"></i>Product Groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="pGroupCtrl as pg">
        <div class="box">

            <!-- /.box-header -->
          <div class="box-body">
            <div class='row'>
              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="pg.filterRecord(filterBy)"/>
                </div>
                <a href="/product-group/create" class='btn  btn-info'>New Groups  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
            </div>
            <br>
            <table id="product-group" class="bsTable table table-striped"
             data-url="/product-group/ng-pgroup-list"
             data-pagination="true"
             data-side-pagination="server"
             data-page-list="[10,20,50]"
             data-sort-order="desc"
             data-show-clear="true"
             js-bootstraptable>
            <thead>
                <tr>
                    <th style='width:50px' data-field="action" class="action">Action</th>
                    <th class="col-md-6" data-field="group_name" >Group Name</th>
                    <th class="col-md-6" data-field="notes" >Notes</th>
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
<script src="/angular/controllers/group.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/groupService.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.product-group").addClass('active');
  });
  $(document).on('click','.group-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "product-group/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Group',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-product-group').serialize();
                  $.ajax({
                    url: "/product-group/"+id,
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
