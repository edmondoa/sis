@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Products</li>
        <li class="active"><i class="fa fa-circle"></i> Stockout</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="stockoutCtrl">
      <a href="#" class='hide refresh' ng-click="getStockins()"></a>
      @include('stockout.create')
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/stockout.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.inventory").addClass('active');
    $("li.stockout").addClass("active");
  })
  var model ={};
  $(function(){
    $(".select2").select2();
  })

  $(document).on("click",'.search-prod',function(e){
    e.preventDefault();

    $.get( "stockout/search", function( data ) {
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
                  $("#price-text").text(row.data('costprice'));
                  $("#qty").val(1);
                  $("#prod_id").val(row.data('prod_id'));
                   $("#available").text(row.data('available'));
                  bootbox.hideAll();
                  $("#qty").focus();
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

  $(document).on('click','.btn-add',function(e){
    e.preventDefault();
     if(!check_number())
        return false;
     if($("#locked").val()==0){
      var param = {
                  id:$("#prod_id").val(),
                  stockout_id:$("#stock_adj_out_id").val(),
                  branch_id:$("#branch_id").val(),
                  qty:$("#qty").val(),
                  available:$("#available").text(),
                  costprice:$("#cprice").val()};
      $.post("stockout-float/items",param, function( data ) {
      if(!data.status)
      {
        message(data);
      } else{
        message(data);
        $("#code").text('');
        $("#name").text('');
        $("#available").text('');
        $("#price-text").text('');
        $("#cprice").val('');
        $("#cost").text('');
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

  $(document).on('keypress','#qty',function(e){
    only_numbers(e);
    if(e.which==13){
      if(!check_number())
         return false;
       if($("#locked").val()==0){
      var param = {
                  id:$("#prod_id").val(),
                  stockout_id:$("#stockout_id").val(),
                  branch_id:$("#branch_id").val(),
                  qty:$("#qty").val(),
                  available:$("#available").text(),
                  costprice:$("#cprice").val()};
      $.post("stockout-float/items",param, function( data ) {
      if(!data.status)
      {
        message(data);
      } else{
        message(data);
        $("#code").text('');
        $("#name").text('');
        $("#available").text('');
         $("#price-text").text('');
        $("#cprice").val('');
        $("#cost").text('');
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


     }

  });

  $(document).on('change','.updated_price',function(e){
    e.preventDefault();
    key = $(this).parent('td').parent('tr').attr('id');

    var updatedprice = $(this).val();
    var quantity = $(this).parent('td').siblings('td').find('input.quantity').val();
    var total = parseFloat(updatedprice) * parseFloat(quantity);
    $(this).parent('td').siblings('td').find('.total').text(total);

    var totalCost = 0;
    $(".total").each(function(){
      totalCost = totalCost + parseFloat($(this).text());
    });
    $("#totalCost").text(parseFloat(totalCost));
    update(key,'updated_price',updatedprice);

  })



  $(document).on("click",".btn-save",function(e){

    var stocks = {};

    $.post('stockout-float/save',{notes:$("#notes").val()},function(data){
      message(data);
      location.reload();
    });

  })

  $(document).on('change','#search',function(e){
    e.preventDefault();

    searchStr = $(this).val();
     var pass_param = {str:searchStr,supplier_id:$("#supplier_id").val(),branch_id:$("#branch_id").val()};
    if(searchStr=='')
      searchStr ='_blank';
    $.post( "stockout/search",pass_param, function( data ) {
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


  function Stockin()
  {

    this.search = function(param){
      var pass_param = {str:param,supplier_id:$("#supplier_id").val(),branch_id:$("#branch_id").val()};
      $.post('stockout/multi_search',pass_param,function(data){
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
  function update(key,row,value)
  {
    var param = {'key':key,'row':row,'value':value};
    $.post( "stockin-float/update",param, function( data ) {
      return false;
     });
  }
</script>
@stop
