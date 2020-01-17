// JavaScript Document

//this blocks of code validates the register inputs
$('#form-register').on('submit',function(e){
	
 	//this method validate register form
	validate_register(e)

 });
 
 
 //this blocks of code validates the login inputs
$('#form_login').on('submit',function(e){
	
	//caling validates function for login
	validate_login(e);
	
});
 
 
 //this blocks of code validates
$('#form-step-first').on('submit', function(e){
	  
	  //this method validates step_1 post ads
	validate_step_1(e)
	 
});
 

$('#location').on('change', function(e){
	
	//this method show form for upload
	show_upload_form(e);
	
});
 
 
$('#form-step-second').on('submit', function(e){
	
  if($('#file').val()===''){
	  
  	e.preventDefault();
  	$('#feedback_upload_foto').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning (alias)"></i> You did Not Select Any Image</div>');
  
  
  	} else {
		  
		var form = $(this);
		var formdata = new FormData($(this)[0]);
		e.preventDefault();
		
		$.ajax({
			
			url:form.attr('action'),
			method:form.attr('method'),
			data: formdata,
			contentType: false,
			cache:false,
			processData:false,
			//async:false,
			success: function(data){
				   
				if(data === 'error'){
					  
				} else {
				   console.log(data);
			       $('#feed_back_second_step').html('<div class="alert alert-success" role="alert">'+ data +'</div>');
				   
				   
				   $('#form-step-second').addClass('show_upload_form');
				   $('#option_link').removeClass('show_upload_form');
	            }
			}
		});  
	}
});
 
 /* all functions  */
 
  
function validate_step_1(e)
{

	if($('#product_title').val()==='' || $('#product_desc').val()==='' || $('#price').val()==='' || $('#category').val()==='Choose Category'){
		 
		 e.preventDefault();
		 $('#feedback_step_first').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning (alias)"></i> please all field are required</div>');
		
	}

}
 
//this method validates login
function validate_login(e)
{

	if($('#email').val()==='' || $('#password').val()===''){
		
	    e.preventDefault();
		$('#feedback_login').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning (alias)"></i> please all field are required</div>');
			
	}else{
			   
			   //allowing registration
	}
}
 
 
 //this method validates register
 
function validate_register(e)
{ 
   
   if($('#name').val()==='' || $('#email').val()==='' || $('#password').val()===''){
		
	    e.preventDefault();
		$('#feedback_register').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning (alias)"></i> please all field are required</div>');
			
	} else {
			   
			   //allowing registration
	}
}

 //this blocks of code addsccategory with ajax
  
/*@
 * //this method adds cost into the database
 * using ajax
 */
  
$('#form_add_category').on('submit', function(e){
   
    if($('#category_name').val() === '' || $('#category_desc').val() === ''){
	      
	    e.preventDefault();
	    $('#feedback_add_category').html('<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> please all field are required</div>');
		
	} else {
		    
			e.preventDefault();
			$.ajax({
				
				url : baseURL + 'admin/dashboard/add_category',
				type: 'POST',
				data : {
					
					category_name : $('#category_name').val(),
					category_desc        : $('#category_desc').val()
					
				},
				success: function(data){
					
				    if(data === 'added'){
					      
						  
					   $('#form_add_category').trigger('reset');
					   $('#feedback_add_category').html('<div class="alert alert-success" role="alert"> Category Added Successfuly</div>');
					   setTimeout("$('#modal_add_category').modal('hide')", 3000);
					   
					} else {
						   
					     $('#feedback_add_category').html('Sorry Error occured');
					}
				 }
			});
		  } 
})

var repair_options;
var service_options;
var req_array = [];
var post_data = {};
var repair_options_cnt = 10;
$( function() {
	var device_model = $("#device_model").text();
	var total_price;
	var current_category = $("#sel_category").find("option:selected").text();

  	$("#sel_category").selectmenu({
    	change: function( event, data ) {
    	current_category = $(this).find("option:selected").text();
		$.ajax({
    		
    		url : baseURL + 'product/get_subcategories/' + current_category,
    		type: 'GET',
    		success: function(data){

    		   var obj = JSON.parse(data);

    		   var html_str = '';
    		   $.each(obj, function(i, $val)
    		   {
    		      html_str+= '<option value="'+ $val.product_id +'">'+ $val.product_title +'</option>' + "<br>";
    		   });	
    		   refresh_menu($("#sel_model"),html_str); 	
    		   document.location.href = baseURL + 'r/' + current_category + '?product_id='+ $("#sel_model").find("option:selected").val();   
    		 }
    	});
      } 	
    } );

    // current_category = $(this).find("option:selected").text();

  	$( "#sel_model" ).selectmenu({
  	  change: function( event, data ) {
  	  		// event.preventDefault();
  	  		$(".ww-start-shopping-wrapper").hide();
  	  		$(".ww-product-detail-wrapper").html('');
  	  		$("#cart_count").text('');
  	  		document.location.href = baseURL + 'r/' + current_category + '?product_id='+ $("#sel_model").val();
  	  		// refresh_product_info();
  	  } 
    });

    $("#cell_provider").selectmenu({
  	  change: function( event, data ) {
  	  		// event.preventDefault();
  	  } 
    });

    $( ".repairtoggles input" ).checkboxradio({
       icon: false
    });

    $( ".servicetoggles input" ).checkboxradio({
       icon: false
    });

    for (var i = 1; i <= repair_options_cnt; i++) {
    		var selector = "[name = 'repair_id_" + i + "']";
    		if ($(selector).attr('state') == 1)
    		{
    			var chkboxid = '#repair_id_' + i;
    			$(chkboxid).prop("checked", true);
    			$(selector).addClass('ui-checkboxradio-checked ui-state-active');
    			updateorderform();
    		}
    		$(selector).on("change",updateorderform);
    }
    // $( "[name='repair_options']").on( "change", updateorderform );
    $("#showdevinfo").click(show_deviceinfo);

    $("#print_invoice").click(function(){
    	var printContents = document.getElementById("print_view").innerHTML;
    	var originalContents = document.body.innerHTML;
    	document.body.innerHTML = printContents;
    	window.print();
    	document.body.innerHTML = originalContents;
    });

    function refresh_product_info(){

	  	$.ajax({
	  		url : baseURL + 'product/get_one_product/' + current_category + '/'+ $("#sel_model").val(),
	  		type: 'GET',
	  		success: function(data){

	  		   var obj = JSON.parse(data);

	  		   $('#phone_img').prop('src',baseURL + '/' + obj['product_details'][0]['image_url']);
	  		   device_model = obj['product_details'][0]['product_title'];
	  		   console.log(device_model);
	  		   $('#pro_title').text(device_model);

	  		   repair_options = obj['repair_options'];
	  		   var repair_str= '<h4>Reparaturen:</h4>';
	  		   if(repair_options.length > 0){
  	  		   		$.each(repair_options, function(i, $val)
	  	  		   	{
	  	  		   		repair_str += '<label for="repair_id_'+ $val['repair_id'] +'" name="repair_id_' + $val['repair_id'] + '" state = "' + $val['selected'] + '">' +
		  		     						'<div style="margin-top: 3px;">';
		  		     		if($val['sub_type'] == 1)
		  		     		{
		  		     			repair_str += '<i class="fa fa-fw fa-mobile-phone"></i>';
		  		     		} else 
		  		     		{
		  		     			repair_str += '<i class="glyphicon glyphicon-flash"></i>';
		  		     		}
		  		     		repair_str += '<span>' + $val['repair_title'] +'</span>' +
					  	  		      '</div>' +
					  	  		      '<div style="margin-top: 5px; margin-bottom: 5px;">' + 
					  	  		      '<span>(' + $val['repair_summary'] + ')</span>' + 
					  	  		      '<span style="float: right;">'+ $val['repair_price']+'€</span></div></label><input class="toggle repair-toggle" type="checkbox" name="repair_id_'+ $val['repair_id'] + '" id="repair_id_'+ $val['repair_id'] + '"' + 
					  	  		      ' repair_id="' + $val['repair_id'] +'"' + 
					  	  		      ' category_id="' + $val['category_id'] +'"' + 
					  	  		      ' product_id="' + $val['product_id'] +'"' + 
					  	  		      ' repair_price="' + $val['repair_price'] +'"' + 
					  	  		      ' repair_title="' + $val['repair_title'] +'"' + 
					  	  		      '>';
	  	  		   	});

	  		   } else {
	  		   		repair_str = '';
	  		   }

	  		   service_options = obj['service_options'];
	  		   var service_str= '<h4>Dienstleistungen:</h4>';
 	  		   if(service_options.length > 0){
	  	  		   	$.each(service_options, function(i, $val)
	  	  		   	{
	  	  		   		service_str += '<label for="repair_id_'+ $val['repair_id'] +'" name="repair_id_' + $val['repair_id'] + '" state = "' + $val['selected'] + '"> <div>';
 	  		     						
 	  		     		if($val['sub_type'] == 1)
 	  		     		{
 	  		     			service_str += '<span class="glyphicon glyphicon-saved"></span>' + $val['repair_title'] ;
 	  		     		} else 
 	  		     		{
 	  		     			service_str += '<span class="glyphicon glyphicon-exclamation-sign"></span>' + $val['repair_title'] ;
 	  		     		}
 	  		     		service_str += '<span style="float:right;">' + $val['repair_price'] +'€</span>' +
					  	  		      '</div>' +
					  	  		      '</label><input class="toggle repair-toggle" type="checkbox" name="repair_id_'+ $val['repair_id'] + '" id="repair_id_'+ $val['repair_id'] + '"'+ 
					  	  		      ' repair_id="' + $val['repair_id'] +'"' + 
					  	  		      ' category_id="' + $val['category_id'] +'"' + 
					  	  		      ' product_id="' + $val['product_id'] +'"' + 
					  	  		      ' repair_price="' + $val['repair_price'] +'"' + 
					  	  		      ' repair_title="' + $val['repair_title'] +'"' + 
					  	  		      '>';
	  	  		   	});
	  	  		   	
 	  		   } else {
 	  		   		service_str = '';
 	  		   }

			   $('.repairtoggles').html(repair_str);
			   $(".repairtoggles").controlgroup( {
			     direction: "vertical"
			   } );
			   $( ".repairtoggles input" ).checkboxradio({
			      icon: false
			   });

			   $('.servicetoggles').html(service_str);
			   $(".servicetoggles").controlgroup( {
			      direction: "vertical"
			   } );
			   $( ".servicetoggles input" ).checkboxradio({
			      icon: false
			   });
			   for (var i = 1; i <= repair_options_cnt; i++) {
			   		var selector = "[name = 'repair_id_" + i + "']";
			   		$(selector).click(updateorderform);
			   }
	  		 }
	  		});
  	}

  	$("#regdevinfo").click(function(e){
  		e.preventDefault();
  		post_data['repair_options'] = req_array;
  		post_data['imei_no'] = $('#imei_no').val();
  		post_data['telephone_no'] = $('#telephone_no').val();
  		post_data['extra_error'] =  $('#extra_error').val();
  		post_data['phone_provider'] = 'richard stewart';
  		$.ajax({
  		  url : baseURL + '/d/reginfo', 
  		  type: 'post',
  		  data: {
  		  	insertData : post_data
  		  },
  		  success: function(data){
  		  		var obj = JSON.parse(data);
  		  }
  		});
  	});
  	
  	function refresh_menu($selector,$value)
  	{
  	   // $selector.selectmenu('destroy');     
  	   // $selector.selectmenu();
  	   // $selector.selectmenu('enable');      
  	   $selector.html($value);
  	   $selector.selectmenu('refresh',true);
  	   // refresh_product_info();
  	}

	
  	function updateorderform()
  	{	
  		total_price = 0;
  		var cartcnt = 0;
  		$( ".repair-toggle" ).each( function() {
	  		  var checked = $(this).is(":checked");
	  		  if(checked){
	  		  	cartcnt += 1;
	  		  	var item_price = parseInt($(this).attr('repair_price'));
	  		  	total_price += item_price;
	  		  } 
  		} );

  		var html_str = '';
  		if(total_price > 0) 
  		{
			html_str =  '<ul>' +
							'<li>' +
	  							'<div class="row">' +
	      							'<div class="col-md-8 ww-right-align">Zwischensumme:</div>' +
	         						'<div class="col-md-4 ww-right-align">' +
	           						total_price +
		  		                '€</div>' +
		  		            '</div>' +
		  		        '</li>'+
		  		        '<li>' +
		  		            '<div class="row">' +
		  		          	  '<div class="col-md-8 ww-right-align">Erstattung der Einsendekosten:</div>' +
		  		              '<div class="col-md-4 ww-right-align">-5€</div>' +      
		  		            '</div>' +  
		  		        '</li>' +
		  		        '<li>' +
	         					'<div class="row">' + 
		  		            	'<div class="col-md-8 ww-right-align">Rückversand:</div>' + 
		  		            	'<div class="col-md-4 ww-right-align">0€</div>' +
		  		            '</div>' +
		  		        '</li>' +
		  		        '<li>' +
		  		            '<div class="row">' +
		  		            '<div class="col-md-8 ww-right-align">esamt:<br/>' +
		  		               '<span class="total-price">' + (total_price - 5) + '€' +'</span>' +
		  		            '</div>' +
		  		          '</div>' +
		  		        '</li>' +
		  		    '</ul>';
		  	$(".ww-start-shopping-wrapper").show();	   
		  	$("#cart_count").text(cartcnt);
  		} else {
       		$(".ww-start-shopping-wrapper").hide();
       		$("#cart_count").text('');
  		}
        $(".ww-product-detail-wrapper").html(html_str);
  	}



  	function show_deviceinfo(){
  		var repair_content='';
  		$(".repair-toggle").each( function() {
	  		  var checked = $(this).is(":checked");
	  		  if(checked){
	  		  	var repair_item = new Array ({
	  		  	    category_id : $(this).attr('category_id'),
	  		  	    repair_id: $(this).attr('repair_id'),
	  		  	    product_id: $(this).attr('product_id'),
	  		  	    repair_price: $(this).attr('repair_price'),
	  		  	    repair_title: $(this).attr('repair_title')
	  		  	});
	  		  	repair_content += '•&nbsp;&nbsp;' + $(this).attr('repair_title') + '<br/>';
                req_array.push(repair_item);
	  		  } 
  		} );
  		
  		$("#device_model").text(device_model);
  		$("#repair_price").text(total_price + '€');
  		$("#device_error").html(repair_content);
  		$("#main_content").hide();
  		$(".ww-device-section").show();
  		}
  	
  });
   
	
function show_product(product_id)
{    
 console.log(product_id);
	
 $.ajax({
		  
		  url  : baseURL + 'admin/dashboard/get_unique_product_admin',
		  type : 'POST',
		  data :{product_id:product_id}, 
		  dataType:"json",
		  success: function(data){
			    var image_addr =  baseURL+data.image_url;
			    var img = '';
	            img +=' <img src="'+image_addr+'" class="product"><br>';
		        $('#image-modal').html(img);
				 
			    var details = '';
                details += '<div class="product_lebel">  ';
			    details += '<h4>'+data.product_title+'</h4>';
			    details += '<h5 class="text-yellow">₦'+data.product_price+'</h5></div>';
		        $('#image-details').html(details);
		 
				$("#display_product").on("hidden.bs.modal", function(){
					$("#image-modal").html("");
					$('#image-details').html("");
				});
		  }
		});
	
}
	
//this function validates the search area in the home page
$('#form-search-term').on('submit', function(e){

if($('#term').val()===''){
   
      e.preventDefault();
	  $('#term').addClass('error'); 
   
   }

});
	 
/*select brand for header_home.php*/
$( function() {

	var datepickerDivSelector = '.datepicker';

	$('#datepicker').datepicker();
	//Date picker
	$('#datepicker').datepicker({
	  autoclose: true
	})

	//there should be one datepicker initiated so that means one hidden .datepicker div
	equal($(datepickerDivSelector).length, 1);
	this.component.datepicker('destroy');
	equal($(datepickerDivSelector).length, 0);//hidden HTML should be gone


  	// Initalize widgets
	$( ".brand-controls input" ).checkboxradio({
	 icon: false
	});

	function updateBrand() {
		$("#cart_count").text('');
	    var e = $( "[name='brand']:checked" );
	    if (e.preventDefault) { 
	        e.preventDefault(); 
	    } else { 
	        e.returnValue = false;
	    }
		var requrl = e.attr('url');

	    $.ajax({
	        type: "get",
	        url: requrl,
	        success: function( data) {
	                    
                    var obj = JSON.parse(data);
                    var products = obj['featured_products'];
                    var first_html = 
                        '<div class="container popular-products-content">' +
                          '<div class="row">' +
                            '<div class="panel-body">';
                    var last_html =
                            '</div>' +
                          '</div>' +
                        '</div>';
                      
                    if(products.length > 0){
                    	var content_html = '';
                    	$.each(products, function(i, $val)
                    	{
                    	   content_html += '<div class="col-md-3 col-sm-6 col-6">'+
                    	   		'<div class="ww-products-wrapper">' + 
                    	   		'<a href="'+ baseURL + 'home/product/' + $val['category_id'] + '/' + $val['product_id'] + '">' +
                             '<img src="' + baseURL + '/' + $val['image_url'] + '" class="product">' +
                             '<div class="box_round_symboll">' +
                                '<h5>' + $val['product_price'] + '€</h5>' +
                                '<h4>' + $val['new_product_price'] + '€</h4>' +
                             '</div>' +
                          	'</a>' +
                              '<div class="pro_title">' +
                                '<h4>' + $val['product_title'] + '</h4>' +
                                '<h5>' + $val['product_desc'] + '</h5>' +
                              '</div>' +    
                           '</div>'+
                           '<hr/>'+
                        '</div>' 
                    	});
                    	
                    }
                    // $('.popular-products').remove();
                    $('#main_content').html(first_html + content_html + last_html);
	             },
	    //If there was no resonse from the server
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log("Something really bad happened " + textStatus);
	        $("#error").html(jqXHR.responseText);
	    },
	    });
	}

  $( "[name='brand']").on( "change", updateBrand );

  // Set initial values
  updateBrand();

});

/*select repair option for product_page.php*/
$(".repairtoggles").controlgroup( {
  direction: "vertical"
} );
$(".servicetoggles").controlgroup( {
  direction: "vertical"
} ); 

// geri butonunu yakalama
// $(document).ready(function(){
//   $(window).on('hashchange', function(){
//       console.log( 'location.hash: ' + location.hash );
//       console.log( 'globalCurrentHash: ' + globalCurrentHash );

//       if (location.hash == globalCurrentHash) {
//           console.log( 'Going fwd' );
//       }
//       else {

//           console.log( 'Going Back' );
//           // loadMenuSelection(location.hash);
//       }
//     });

// });






	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 	
	