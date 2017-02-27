@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        InterBranch Transfer
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Products</li>
        <li class="active"><i class="fa fa-circle"></i> Transfer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="transferCtrl">
      <a href="#" class='hide refresh' ng-click="getTransfer()"></a>
      @include('transfer.create')
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/transfer.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.inventory").addClass('active');
    $("li.interbranch-transfer").addClass('active');
    branch1 = $("#branch_id_from").val();
    if(branch1 !=""){
      $("#branch_id_to option[value='"+branch1+"']").attr("disabled","disabled");
      $("#branch_id_to").prop("selectedIndex",-1)
    }

  });

  $(function(){
    $(".select2").select2();

  })
  $(document).on("change",'#branch_id_from',function(e){
      branch1 = $(this).val();
      $("#branch_id_to").val('');
      if(branch1 !=""){
        $("#branch_id_to option[value='"+branch1+"']").attr("disabled","disabled");
        $("#branch_id_to").prop("selectedIndex",-1)
      }
  });
  $(document).on("click",'.search-prod',function(e){
    e.preventDefault();

    $.get( "transfer/search", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Search Products',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){

                  var row = $("#product-search table#products tr.selected");
                  console.log(row);
                  $("#code").text(row.data('catcode'));
                  $("#name").text(row.data('prodname'));
                  $("#cprice").val(row.data('costprice'));
                  $("#cost").text(row.data('costprice'));
                  $("#qty").val(1);
                  $("#prod_id").val(row.data('prod_id'));
                   $("#available").text(row.data('available'));
                  $("#qty").focus();
                  bootbox.hideAll();
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
 $(document).on('change','.searchStr',function(e){
    Stockin().search($(this).val());
  })
  $(document).on('click','#product-search table#products tr',function(){
    cls = $(this).attr('class');
    $("#product-search table#products tr").not('.'+cls).css('background-color','#fff !important');
    $("#product-search table#products tr").not('.'+cls).removeClass('selected');
    $(this).css('background-color','antiquewhite');
    $(this).addClass('selected');

  })
  $(".calendar").datepicker({autoclose:true});
  $(document).on('click','.btn-add',function(e){
    e.preventDefault();
     if($("#locked").val()==0){
      var param = {
                  id:$("#prod_id").val(),
                  transfer_id:$("#transfer_id").val(),
                  branch_id:$("#branch_id_from").val(),
                  qty:$("#qty").val(),
                  available:$("#available").text(),
                  costprice:$("#cprice").val()};
      $.post("transfer/items",param, function( data ) {
      if(!data.status)
      {
        message(data);
      } else{
        message(data);
        $("#code").text('');
        $("#name").text('');
        $("#available").text('');
         $("#cost").text('');
        $("#cprice").val('');
         $("#locked").val('');
        $("#qty").val('');
        $("#prod_id").val('');
        $("#search").val('');
        $("#search").focus();
        $(".refresh").trigger('click');
      }
      });
    }else{
      bootbox.alert({message:"Product is locked!", size: 'small'});
    }

  });

  $(document).on("click",".btn-save",function(e){

    $.post('transfer-float/save',function(data){
      message(data);
      location.reload();
    });

  })

  $(document).on('change','#search',function(e){
    e.preventDefault();
    searchStr = $(this).val();
     var pass_param = {str:searchStr,branch_id:$("#branch_id_from").val()};
    if(searchStr=='')
      searchStr ='_blank';
     console.log(pass_param);
    $.post("transfer/singleSearch",pass_param, function( data ) {
      if(data.status)
      {
        console.log(data.products);
        $("#locked").val(data.products[0].lock);
        $("#code").text(data.products[0].category_code);
        $("#name").text(data.products[0].product_name);
        $("#cprice").val(data.products[0].cost_price);
        $("#cost").text(data.products[0].cost_price);
        $("#available").text(data.products[0].available);
        $("#qty").val(1);
        $("#prod_id").val(data.products[0].product_id);
        $("#qty").focus();
      }
      else{
        $("#code").text('');
        $("#name").text('');
        $("#cprice").val('');
        $("#cost").text('');
        $("#qty").val('');
         $("#locked").val('');
        $("#prod_id").val('');
        $("#search").val('');

        bootbox.alert({message:"Product not found!",
                       size: 'small'
            });
         $("#search").focus();
      }

    });
  });

  $(document).on('keypress','#qty',function(e){

    if(e.which==13){
       if($("#locked").val()==0){
      var param = {
                  id:$("#prod_id").val(),
                  transfer_id:$("#transfer_id").val(),
                  branch_id:$("#branch_id_from").val(),
                  qty:$("#qty").val(),
                  available:$("#available").text(),
                  costprice:$("#cprice").val()};
      $.post("transfer/items",param, function( data ) {
      if(!data.status)
      {
        message(data);
      } else{
        message(data);
        $("#code").text('');
        $("#name").text('');
        $("#available").text('');
         $("#cost").text('');
        $("#cprice").val('');
         $("#locked").val('');
        $("#qtyty").val('');
        $("#prod_id").val('');
        $("#search").val('');
        $("#search").focus();
        $(".refresh").trigger('click');
      }
      });
    }else{
      bootbox.alert({message:"Product is locked!", size: 'small'});
    }


     }

  });

  function Stockin()
  {

    this.search = function(param){
      var pass_param = {str:param,branch_id:$("#branch_id_from").val()};
      console.log(pass_param);
      $.post('transfer/multi_search',pass_param,function(data){
        if(data.status)
        {
          var strBuilder ="";
          for(i=0; i<data.products.length; i++)
          {
            strBuilder += "<tr class='"+data.products[i].product_id+"'"+
                          "data-prod_id ='"+data.products[i].product_id+"'"+
                          "data-prodcode ='"+data.products[i].product_code+"'"+
                          "data-catcode ='"+data.products[i].category_code+"'"+
                          "data-prodname ='"+data.products[i].product_name+"'"+
                          "data-available ='"+data.products[i].available+"'"+
                          "data-barcode ='"+data.products[i].barcode+"'"+
                          "data-costprice ='"+data.products[i].cost_price+"'>";
            strBuilder += "<td>"+data.products[i].category_code+"</td>";
            strBuilder += "<td>"+data.products[i].product_code+"</td>";
            strBuilder += "<td>"+data.products[i].product_name+"</td>";
            strBuilder += "<td>"+data.products[i].barcode+"</td>";
            strBuilder += "<td>"+data.products[i].available+"</td>";
            strBuilder += "<td>"+data.products[i].cost_price+"</td>";
            strBuilder += "</tr>";

          }
          $("#products tbody").html(strBuilder);
        }else
        {
          var strBuilder ="";
          $("#products tbody").html(strBuilder);
          bootbox.alert({message:"Product not found!", size: 'small'});
        }

      });
    }
    return this;
  }
</script>


@stop
