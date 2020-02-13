/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
    });
});

$(document).ready(function(){
        $("#selsize").change(function(){
             var idsize = $(this).val();
             $.ajax({
                 type:'get',
                 url:'/get-product-price',
                 data:{idsize:idsize},
                 success:function(resp){
                     var arr= resp.split('#');

                     $("#getprice").html("US" + arr[0]);
                     $("#price").val(arr[0]);
                     if(arr[1] == 0){
                         $("#btncart").hide();
                         $("#avail").text('Out Of Stock');
                     }
                     else {
                        $("#btncart").show();
                        $("#avail").text('In Stock');
                     }
                 },error:function(){
                     alert("error");
                 }

             });
        });
    });
    $(document).ready(function(){
        $(".changeImage").change(function(){
             var image = $(this).attr("src");
             $('.mainImage').attr("src",image)
        });
    });
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);

        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });

$('.delCoupon').click(function(){

});

$(document).ready(function(){
  $('#registerForm').validate({
      rules:{
          name:{
              required:true,
              minlength:3,
              accept:"[a-zA-Z]+"
          },
          password:{
            required:true,
            minlength:6
          },
          email:{
              required:true,
              email:true,
              remote:"/check-email"
          },
          messages:{
              name:{
               required:"please enter your name",
                minlength:"Your name must be at least 3 caracaters",
                accept:" Your name must contain only lettre !!"
              },
                password:{
                  required:"Please provide your password ",
                  minlength:"Your password must be at meast 6 caracters"
              },
              email:{
                  required:"Please enter your email",
                  email:"Please enter a valid email",
                  remote: "Email is already Exist!"

              }
          }
      }
    });
    $('#LoginForm').validate({
        rules:{
            email:{
                required:true,
                email:true,

            },
            password:{
              required:true,
              minlength:6
            },


                email:{
                    required:"Please enter your email",
                    email:"Please enter a valid email",


                },
                messages:{

                    password:{
                      required:"Please provide your password ",
                    //  minlength:"Your password must be at meast 6 caracters"
                  },
            }
        }
      });
      $("#passForm").validate({
		rules:{
			c_pass:{
				required: true,
				minlength:6,
				maxlength:20
			},
			n_pass:{
				required:true,
				minlength:6,
				maxlength:20

			},
			con_pass:{
				required:true,
				minlength:6,
				maxlength:20,

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
      $('#accountForm').validate({
        rules:{
            name:{
                required:true,

            },
            adress:{
                required:true,
                minlength:3
            },
            state:{
                required:true,
                minlength:3
            },
            country:{
                required:true,
            },
            pincode:{
                required:true
            },
            mobile:{
                required:true,
                minlength:6
            },
                messages:{

                    name:{
                      required:"Please fill your name ",
                    //  minlength:"Your password must be at meast 6 caracters"
                  },
                  adress:{
                    required:"Please fill your adress ",
                  minlength:"Your password must be at least 6 caracters"
                },  state:{
                    required:"Please fill your state ",
                  //  minlength:"Your password must be at meast 6 caracters"
                },  country:{
                    required:"Please fill your country ",
                  //  minlength:"Your password must be at meast 6 caracters"
                },  pincode:{
                    required:"Please fill your pincode ",
                  //  minlength:"Your password must be at meast 6 caracters"
                },
            mobile:{
                    required:"Please fill your mobile ",
                  //  minlength:"Your password must be at meast 6 caracters"
                }
            }
        }
      });
        $('#myPassword').passtrength({
          minChars: 4,
          passwordToggle: true,
          tooltip: true,
          eyeImg:"/img/frontend_images/eye.svg"
        });
        $('#c_pass').keyup(function(){
            var c_pass =$(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

            type:'post',
            url:'/check-pass',
            data:{c_pass:c_pass},
            success:function(resp) {
                if(resp=="false"){
                    $('#check').html("<font color='red' style='margin-bottom:5px;'>Current Password Incorrect</font> ");
                }
            },
            error:function(resp){
                if(resp=="true"){
                    $('#check').html("<font color='green'>Correct Password </font> ");
                }
            }
            });
        });
        $('#BillToship').click(function(){
           if(this.checked){
               $('#shipping_name').val($('#billing_name').val());
               $('#shipping_adress').val($('#billing_adress').val());
               $('#shipping_city').val($('#billing_city').val());
               $('#shipping_country').val($('#billing_country').val());
               $('#shipping_pincode').val($('#billing_pincode').val());
               $('#shipping_mobile').val($('#billing_mobile').val());
           }
           else{
            $('#shipping_name').val();
            $('#shipping_adress').val();
            $('#shipping_city').val();
            $('#shipping_country').val();
            $('#shipping_pincode').val();
            $('#shipping_mobile').val();
           }

        });

});


