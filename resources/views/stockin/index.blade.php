@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Stockin     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Products</li>
        <li class="active"><i class="fa fa-circle"></i> Stockin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="stockinCtrl">
      @include('stockin.create')
    </section>  
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/stockin.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(function(){
    $(".select2").select2();
  })

  $(document).on("click",'.search-prod',function(e){
    e.preventDefault();    
    searchStr = $("#search").val();
    supplier = $("#supplier_id").val();
    if(searchStr=='')
      searchStr ='_blank';
    $.get( "products/search/"+supplier+"/"+searchStr, function( data ) {
      var dialog = bootbox.dialog({
          title: 'Search Products',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  
                  var selected = [];
                  $('input:checkbox.selected:checked').each(function () {                    
                    selected = $(this).data('id');                                      
                  }); 
                  //param['ids'] = selected;  
                                                  
                  $.post('stockin-float/items',{'ids[]':selected},function(data){
                     bootbox.hideAll();
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
  });
  $(document).on('change','.all',function(e){
    e.preventDefault();
     $('.selected').not(this).prop('checked', this.checked);
  })
</script>
@stop
