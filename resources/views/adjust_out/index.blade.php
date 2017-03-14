@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Adjust Out
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Inventory</li>
        <li class="active"><i class="fa fa-circle"></i> Adjust Out</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="AdjustOutCtrl">
      <a href="#" class='hide refresh' ng-click="getAdjustOut()"></a>
      @include('adjust_out.create')
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/adjustout.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">

  var model ={};
  $(function(){
    $(".select2").select2();

  })

  $(document).ready(function(){
      var date = new Date('{{$post_date}}');

    $('#doc_date').datepicker({
            autoclose: true,
            endDate: date,

    });

  });

  $(document).on("click",'.search-prod',function(e){
    e.preventDefault();
    $.get( "adjust-out/search", function( data ) {
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
                  $("#qty").val(1);
                  $("#prod_id").val(row.data('prod_id'));
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
      if(!validate())
        return false;
      if(!check_number())
        return false;
     if($("#locked").val()==0){
      var param = {
              id:$("#prod_id").val(),
              qty:$("#qty").val(),
              branch_id:$("#branch_id").val(),
              stock_adj_out_id:$("#stock_adj_out_id").val(),
              costprice:$("#cprice").val()};
      $.post("adjust-out-float/items",param, function( data ) {
        $("#code").text('');
        $("#name").text('');
        $("#cprice").val('');
         $("#locked").val('');
        $("#qty").val('');
        $("#prod_id").val('');
        $("#search").val('');
        $("#search").focus();
        $(".refresh").trigger('click');
      });
    }else{
      bootbox.alert({message:"Product is locked!", size: 'small'});
    }

  });
  $(document).on('keypress','#cprice',function(e){
    only_numbers(e);
  });

  $(document).on('keypress','#qty',function(e){
    only_numbers(e);
    if(e.which==13){
      if(!validate())
        return false;
      if(!check_number())
        return false;
      if($("#locked").val()==0){
        var param = {
                    id:$("#prod_id").val(),
                    qty:$("#qty").val(),
                    branch_id:$("#branch_id").val(),
                    stock_adj_out_id:$("#stock_adj_out_id").val(),
                    costprice:$("#cprice").val()};
        $.post("adjust-out-float/items",param, function( data ) {
          $("#code").text('');
          $("#name").text('');
          $("#cprice").val('');
           $("#locked").val('');
          $("#qty").val('');
          $("#prod_id").val('');
          $("#search").val('');
          $("#search").focus();
          $(".refresh").trigger('click');
        });
      }else{
        bootbox.alert({message:"Product is locked!", size: 'small'});
      }


     }

  });

  $(document).on("click",".btn-save",function(e){
      startLoad();
      $.post('adjust-out-float/save',{notes:$("[name='notes']").val()},function(data){
          stopLoad();
          message(data);
          $(".refresh").trigger('click');
          $("select#branch_id").val('').trigger("change");

          $("#totalQuantity").text(0);
          $("#totalCost").text(parseFloat(0));
          $('.btn-save').addClass('disabled');
          $('.search-prod').addClass('disabled');

          $("a.stock").removeClass('disabled');
          $("input.stock").attr('readonly',false);
          $("select.stock").attr('disabled',false);
          $("div.amount-due").removeClass('has-error');
      });

  })

  $(document).on('change','#search',function(e){
    e.preventDefault();
    searchStr = $(this).val();
    if(searchStr=='')
      searchStr ='_blank';
    $.get( "adjust-in/search/"+searchStr, function( data ) {
      if(data.status)
      {
        console.log(data.products);
        $("#locked").val(data.products[0].lock);
        $("#code").text(data.products[0].category_code);
        $("#name").text(data.products[0].product_name);
        $("#cprice").val(data.products[0].cost_price);
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
    AdjustIn().search($(this).val());
  })
  $(document).on('click','#product-search table#products tr',function(){
    cls = $(this).attr('class');
    $("#product-search table#products tr").not('.'+cls).css('background-color','#fff !important');
    $("#product-search table#products tr").not('.'+cls).removeClass('selected');
    $(this).css('background-color','antiquewhite');
    $(this).addClass('selected');

  })
  $(".calendar").datepicker({autoclose:true});


  function AdjustIn()
  {
    this.search = function(param){
      $.post('adjust-in/multi_search',{str:param},function(data){
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
                          "data-costprice ='"+data.products[i].cost_price+"'>";
            strBuilder += "<td>"+data.products[i].category_code+"</td>";
            strBuilder += "<td>"+data.products[i].product_code+"</td>";
            strBuilder += "<td>"+data.products[i].product_name+"</td>";
            strBuilder += "<td>"+data.products[i].barcode+"</td>";
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

  $(document).ready(function(){
    $("li.inventory ").addClass('active');
    $("li.adjustment").addClass("active");
    $("li.adjust-out").addClass("active");

  })
</script>


@stop
