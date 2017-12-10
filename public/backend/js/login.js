$(document).ready(function(){

});

function forgot()
{
	swal({
		title: 'Forgot Password',
		text : 'Input Your E-mail',
		html :true,
		type : "input" ,
		animation: "slide-from-top",
  		inputPlaceholder: "E-mail",
  		showCancelButton: true,
  		closeOnConfirm: false,
  		showLoaderOnConfirm: true,
	},
	function(inputValue){
	  if (inputValue === false) return false;
	  
	  if (inputValue === "") {
	    swal.showInputError("You need to write something!");
	    return false;
	  
	  }else{

	  	$.ajax({

	  		type : 'get',
	  		url : url('login/forgot'),
	  		'_token': $("meta[name='_token']").attr('content'),
	  		data : {
	  			email : inputValue,
	  		},
	  		success : function(data){

	  			if(data == 'false')
	  			{
	  				swal.showInputError("Email Not Found !");
	  				return false;
	  			
	  			}else if(data == 'true'){
	  				swal("Sent", "New password has been sent to your email", "success")
	    		}

	  		},

	  	});
	  
	  }
	  


	}
	);
}