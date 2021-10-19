var $ = $.noConflict();
$(document).ready(function() {
	
	//$("#se_frm").submit(function(e) {
		//e.preventDefault(); // avoid to execute the actual submit of the form.
		
	$('body').on('keyup', '#search-input', function(){
		
		var se_sub = $(this).val();
		
		$.ajax({
            type: "POST",
            url: myAjax_new.ajaxurl,
            data: {
                action: 'search_form_header',
                se_sub: se_sub,
            },
            beforeSend: function() {
                $(".post-loader").show();
            },
            complete: function() {
                $(".post-loader").hide();
            },
            success: function(response) {
                var response = $.parseJSON(response);
				$(".search-box-results").css('display', 'block'); 
                $(".search-box-results").html(response.html);                              
            },
        });
	});
	
	// Perform AJAX login on form submit
     $('form#login').on('submit', function (e) {
         $('form#login p.status').removeClass("error");
         $('form#login p.status').show().text(myAjax_new.loadingmessage);

         $.ajax({
             type: 'POST',
             dataType: 'json',
             url: myAjax_new.ajaxurl,
             data: {
                 'action': 'ajax_login',
                 'username': $('form#login #username-login').val(),
                 'password': $('form#login #password-login').val(),
                 'security': $('form#login #security').val()
             },
             success: function (data) {

                 if (data.loggedin == true) {
                     $('form#login p.status').text(data.message);
                     document.location.href = myAjax_new.redirecturl;
                 } else {
                     $('form#login p.status').addClass("error");
                     $('form#login p.status').text(data.message);
                 }
             }
         });
         e.preventDefault();
     });
	
	// Perform AJAX Register on form submit
	 $('form#register').on('submit', function (e) {
		 $('form#register p.status').removeClass("error");
		 $('form#register p.status').show().text(myAjax_new.loadingmessage);

		 var form_var = $("form#register").serialize();
		 // var reg_redirect_url = $("#reg_redirect_url").val(); // by ALex Dashkin
		 var reg_redirect_url = myAjax_new.redirecturl; // by ALex Dashkin
		 $(".error-val").removeClass("error-val");
		 $(".error-msg").remove();

		 $.ajax({
			 type: 'POST',
			 dataType: 'json',
			 url: myAjax_new.ajaxurl,
			 data: {
				 'action': 'ajax_register',
				 'form_var': form_var,
				 'security_register': $('form#register #security_register').val()
			 },
			 success: function (data) {

				 if (data.status == true) {
					 $('form#register p.status').text(data.message);
					 $("#register").trigger("reset");
					 window.location = reg_redirect_url;
				 } else {
					 var user_exists = data.user_exists;
					 if (user_exists == 'yes') {
						 $('form#register p.status').html('')						 						 
						 $('input[id="email_address"]').parent().append('<p class="field-error error-msg">'+data.message+'</p>');						 
					 } else {
						 $('form#register p.status').html('')
						 var error = $.makeArray(data.message);
						 $('form#register p.status').addClass("error");
						 $('form#register p.status').append('Please fill out all required fields.');
						 for (var i = 0; i < error.length; i++) {
							 if ($('input[name="' + error[i] + '"]').length > 0) {
								 $('input[name="' + error[i] + '"]').parent().addClass('error-val');
								 $('input[name="' + error[i] + '"]').parent().append('<span class="error-msg">The field is required.</span>');
							 }
							 if ($('select[name="' + error[i] + '"]').length > 0) {
								 $('select[name="' + error[i] + '"]').parent().addClass('error-val');
								 $('select[name="' + error[i] + '"]').parent().append('<span class="error-msg">The field is required.</span>');
							 }
						 }
					 }
				 }
			 }
		 });
		 e.preventDefault();
	 });
	 
	$('body').on('keyup', '#username-login, #username_login, #email_address, .email_val', function () {
		var $email = this.value;
		var f_id = $(this).attr('id');
		validateEmail($email,f_id);
	});

	function validateEmail(email,f_id) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if (!emailReg.test(email)) {
			$('#'+f_id).parent().parent().find('.error-msg').html('Format not valid');
			$('#'+f_id).parent().addClass('field-error');
			
		} else {
			$('#'+f_id).parent().removeClass('field-error');
			$('#'+f_id).parent().addClass('fields-success');
			$('#'+f_id).parent().parent().find('.error-msg').html('');
		}
	}
	
	/*** Forgot password ***/
	$('form#forgotPass').on('submit', function (e) {
         $('form#forgotPass p.status').removeClass("error-msg");

         $.ajax({
             type: 'POST',
             dataType: 'json',
             url: myAjax_new.ajaxurl,
             data: {
                 'action': 'ajax_forgot_pwd',
                 'username': $('form#forgotPass #username_login').val(),
                 'security_forgot': $('form#forgotPass #security_forgot').val()
             },
             success: function (data) {

                 if (data.status == true) {
                     $('form#forgotPass p.status').text(data.message);
                     $("#forgotPass").trigger("reset");
                 } else {
                     $('form#forgotPass p.status').addClass("error-msg");
                     $('form#forgotPass p.status').text(data.message);
                 }
             }
         });
         e.preventDefault();
     });
	
	$("body").on('click', '#clear_cart',function(){        
		
		$.ajax({
			 type: 'POST',
			 dataType: 'json',
			 url: myAjax_new.ajaxurl,
			 data: {
				 'action': 'wc_woocommerce_clear_cart_url',
			 },
			 success: function (data) {
				if (data.status == 'success') {
					location.reload();
				}
			 }
		 });		
		
	});
	
	$("body").on('click', '#is_subscribe_chk', function(){
		var is_subscribe = $(this).val();
		$.ajax({
			 type: 'POST',
			 dataType: 'json',
			 url: myAjax_new.ajaxurl,
			 data: {
				 'action': 'is_subscribe_update',
				 'is_subscribe': is_subscribe,
			 },
			 success: function (data) {
				if (data.status == 'success') {
					$('.message-cls').html('Successfully updated!');
				}
			 }
		 });	
	});
	
	$('body').on('change', '#ship-checkbox', function(){
		if ($(this).is(':checked')) {
			$('#shipping_result').css('display', 'none');
		}else{
			$('#shipping_result').css('display', 'block');			
		}
	});
	
	$('body').on('click', '.color-attr', function(){
		var var_slug = $(this).attr('data-slug');
		$('#pa_colours option[value="' + var_slug + '"]').prop('selected', true);
		$('#pa_colours option[value="' + var_slug + '"]').trigger('change');
		$('.color-item').removeClass('is-active');
		$(this).parent().addClass('is-active');
		ajax_variation_image();
	});
	
	$('body').on('change', '.variations select', function(){
		ajax_variation_image();
	});
	function ajax_variation_image(){
		var var_id = $('.variation_id').val();
		if(var_id != ''){
			
			$.ajax({
			 type: 'POST',
			 dataType: 'json',
			 url: myAjax_new.ajaxurl,
			 data: {
				 'action': 'update_variation_image',
				 'var_id': var_id,
			 },
			 success: function (data) {
				if (data.status == 'success') {
					$('#gallery-img').html(data.html);
				}
			 }
		 });	
			
		}
	}
	
	/*** Blank email field in close icon click ***/
	$('body').on('click', '.resetTrigger', function(){
		$(this).parent().find('input').val('');
	});
	/*** Blank email field in close icon click ***/
	
	/********** Reload page if cart is empty *********/
	var oldXHR = window.XMLHttpRequest;
     function newXHR() {
         var realXHR = new oldXHR();
         realXHR.addEventListener("readystatechange", function () {
             if (realXHR.readyState == 4) {
                 setTimeout(function () {
                     if ($("body").length == 0) window.location.href = window.location.href;
                     if ($(".woocommerce-cart").length > 0 || $(".woocommerce-checkout").length > 0) {

                     }
					 else if ($(".mini-header-cart1 > .woocommerce").length == 0) {
                         window.location.href = window.location.href;
                     }
                 }, 10);
             }
         }, false);
         return realXHR;
     }
     window.XMLHttpRequest = newXHR;
	 
	 /********** Cart Quantity force to 1 *********/
	 $('body').on('click', '.wac-btn-sub', function(e){		
		var num_val = $(this).parent().parent().parent().find('.qty').val();
		if(num_val == 0){
			$(this).parent().parent().parent().find('.qty').val(1);
			e.preventDefault();
		}
	});
});