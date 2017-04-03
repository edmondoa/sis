$("div.search").addClass('col-md-3')
$("div.bs-bars").addClass('col-md-6')
function startLoad()
{
  $("div.loading").removeClass('hide');
}
function stopLoad()
{
  $("div.loading").addClass('hide');
}

function message(data)
{
  if(data.status){
    $.notify({
      message: data.message
    },{
      type: 'success',
      newest_on_top: true,
        placement: {
            align: "right",
            from: "bottom"
        }
    });
  }else{
    var stringBuilder ="<ul class='error'>";
    for (var x in data.message) {
      console.log(x);
      stringBuilder +="<li>"+data.message[x]+"</li>";
    }
    stringBuilder +="</ul>";
     $.notify({
        message: stringBuilder
      },{
        type: 'danger',
        newest_on_top: true,
        placement: {
            align: "right",
            from: "bottom"
        }
      });
  }
}

function validate(){
  if($("#prod_id").val()==''){
    var data = {status:false,message:['Please search for product!']};
    message(data);
    return false;
  }
  return true;

}

function check_number()
{
  if($("#qty").val() == 0){
    var data = {status:false,message:['Quantity should not be less than 1!']};
    message(data);
    return false;
   }
  if(isNaN($("#qty").val())){
    var data = {status:false,message:['Quantity should be a valid number']};
    message(data);
    return false;
   }
  if(isNaN($("#cprice").val())){
    var data = {status:false,message:['Price should be a valid number']};
    message(data);
    return false;
   }
  return true;
}
function only_numbers(event)
{
  console.log(event.keyCode);

  if (event.keyCode == 46 || event.keyCode == 8) {
  }
  else {
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.preventDefault();
    }
  }
}
