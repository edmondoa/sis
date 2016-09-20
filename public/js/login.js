$(document).ready(function(){

	$("[name='user_level']").on('change',function(e){		
		if($(this).val()!=1)
			$(".domain_div").removeClass('hide');
		else
			$(".domain_div").addClass('hide');
	})
});