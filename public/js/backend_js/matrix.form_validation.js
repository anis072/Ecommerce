$(document).ready(function(){
    $("#pwd").keyup(function(){
	var current_pwd=$("#pwd").val();
	$.ajax({
		type:'get',
		url:'/admin/check_pwd',
		data:{current_pwd:current_pwd},
		success:function (resp) {
		if (resp=="false") {
			$("#chkpwd").html("<font color='red'> Current password Is Incorrect</font>");
		}
		else{
				$("#chkpwd").html("<font color='green'> Cuurent password Is correct</font>");

		}
		},error:function (){

		}
    });
});


	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();

	$('select').select2();

	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });
    //add_category Validation
    $("#add_category").validate({
		rules:{
            name:{
				required:true
			},
			desc:{
				required:true,

			},

			url:{
				required:true,

			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });
    //add_category Validation
    $("#add_product").validate({
		rules:{
            name:{
				category_id:true
			},
            name:{
				required:true
			},
			code:{
				required:true,

            },
            color:{
				required:true,

            },

            price:{
				required:true,

            },
            image:{
				required:true,

            }
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required:true,
				minlength:6,
				maxlength:20

			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwdc"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });
    $("#dele").click(function(){

            if(confirm('Are you sure to Delete Category?'))
            return true;
            else
            return false;


});
  $(".deleteRecord").click(function(){

       var id = $(this).attr('rel');
       var functiondelete=$(this).attr('rel1');
       swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
          },
       function(){
        window.location.href="/admin/"+functiondelete+"/"+id;

   });
});
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrmargin-top: 3px;apper
    var fieldHTML = '<div style="margin-left:180px; margin-top: 3px;"><input type="text" name="sku[]" style="width:120px; margin-top: 3px;"/> <input type="text" name="size[]" style="width:120px;margin-top: 3px;"/> <input type="text" name="price[]" style="width:120px;margin-top: 3px;"/> <input type="text" name="stock[]" style="width:120px; margin-top:3px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

});
