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
      <a href="#" class='hide refresh' ng-click="getStockins()"></a>
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
                    selected.push($(this).data('id'));                                      
                  }); 
                  //param['ids'] = selected;  
                  if(selected.length==0)
                  {
                    bootbox.hideAll();
                    return true;
                  }                               
                  $.post('stockin-float/items',{'ids[]':selected},function(data){
                    $(".refresh").trigger('click');
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

  $(document).on('change','.quantity',function(e){
    e.preventDefault();
    key = $(this).parent('td').parent('tr').attr('id');
    var updatedprice = $(this).parent('td').siblings('td').find('input.updated_price').val();
    var total = updatedprice * $(this).val();
    $(this).parent('td').next('td').find('span').text(total);
    var totalQuantity = 0;
    $(".quantity").each(function(){
      totalQuantity = totalQuantity + parseInt($(this).val());
    })
    var totalCost = 0;
    $(".total").each(function(){
      totalCost = totalCost + parseFloat($(this).text());
    })
   
    $("#totalQuantity").text(totalQuantity);    
    $("#totalCost").text(parseFloat(totalCost));

    update(key,'quantity',parseInt($(this).val()));
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
    var totalCost =  $("#totalCost").text();
    var amount = $("#amount_due").val();
    if(totalCost != amount)
    {
      bootbox.alert({
          message: "Please check the Total amount it doesn't match to the amount due",
          size: 'small'
      });
      $("div.amount-due").addClass('has-error');
    }else{
      var stocks = {};
      var quantity = [];
      var prod_id = [];
      var costprice = [];
      var updated_price = [];
      $('.quantity').each(function () { 
        quantity.push($(this).val());
        prod_id.push($(this).data('prodid'));
        costprice.push($(this).data('costprice')) ;
        updated_price.push($(this).parent('td').siblings('td').find('input.updated_price').val());
      }); 
      stocks = {'quantity':quantity,'prod_id':prod_id,'costprice':costprice,'updated_price':updated_price};
      console.log(stocks);
      $.post('stockin-float/save',stocks,function(data){
        message(data);
        $(".refresh").trigger('click');       
      });
    }
  })
  $(".calendar").datepicker({autoclose:true});

  function update(key,row,value)
  {
    var param = {'key':key,'row':row,'value':value};
    $.post( "stockin-float/update",param, function( data ) {
      return false;
     });
  }
</script>
@stop
