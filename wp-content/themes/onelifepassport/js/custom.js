jQuery(function(){
	
	jQuery("#cs-org-form, #cs-form-login, #cs-interest-form, #cs-cont-form").validationEngine({promptPosition : "topLeft"});
	
	jQuery("#cs-document-file").on("change", function(){	
		jQuery("#cs-upload-file-name").text(jQuery(this).val().split(/\\|\//).pop());
	});
	
	

	
/**************************************/
	 var current = location.pathname;
	 jQuery('.cs-sidebar-list li a:first-child').addClass('activeIndex');
	 jQuery('.cs-sidebar-list li a').each(function(){
	        var $this = jQuery(this);
	        // if the current path is like this link, make it active
	        if($this.attr('href').indexOf(current) !== -1){
	        
	        	$this.addClass('activeIndex');
	        }
	    });
	 
/*************************************/
	 
	 jQuery("#cs-cont-dob").datepicker({	
			changeMonth: true,
		    changeYear: true,
		    dateFormat:'dd/mm/yy',
		    yearRange: "-90:+0"
		});
	 
		jQuery(" #cs_medical_forms_sent, #cs_medical_forms_received, #cs-start_date").datepicker({	
			changeMonth: true,
		    changeYear: true,
		    dateFormat:'dd/mm/yy'
		});
		
/********************Tabs***************************/
		
		jQuery( "#jq-export-tab" ).tabs({
		      collapsible: false
		    });
/*******************Check All**********************************/
		jQuery(".jq-chkbox-all").change(function () {
			jQuery("input:checkbox").prop('checked', jQuery(this).prop("checked"));
		});
		
		/*************Chosen***************/
		
		jQuery("#cs-org-list, #cs-tmp-list").chosen({  allow_single_deselect : true,placeholder_text_single:"Select Client"});
		
	/*****************File & photo upload*****************/
		jQuery("#upload_link").on('click', function(e){
		    e.preventDefault();
		    jQuery("#upload_photo:hidden").trigger('click');
		});
		
		jQuery("#cs-upload-document").on("click", function(event){
			event.preventDefault();
			 jQuery("#cs-document-file:hidden").trigger('click');
			
		})
		
		/**************************/
		
		jQuery("#upload_photo:hidden").change(function () {
		        readURL(this);
		    });
		
		/******************************/
		var cs_sel_org="";
		 cs_sel_org=jQuery(".cs-sel-org").val();
		 if(cs_sel_org!="" && cs_sel_org==1){
			 jQuery(".cs-org-list").fadeIn();
			jQuery('.cs-org-address') .toggleClass("col-md-12 col-md-6");
			 
		 }else{
			
			 jQuery(".cs-org-list").hide();
				jQuery('.cs-org-address').removeClass("col-md-6");
				 jQuery('.cs-org-address').addClass("col-md-12");
			 
		 }
		 
		 jQuery(".cs-sel-org").on("change", function(){
			 
			 cs_sel_org=jQuery(this).val();
			 
			 if(cs_sel_org!="" && cs_sel_org==1){
				 jQuery(".cs-org-list").fadeIn();
				jQuery('.cs-org-address') .toggleClass("col-md-12 col-md-6");
				 
			 }else{
				 
				 jQuery(".cs-org-list").fadeOut();
				 jQuery('.cs-org-address').removeClass("col-md-6");
				 jQuery('.cs-org-address').addClass("col-md-12");
					
			 }
		 })
		 
		 
		 /***********************Auto populate address********************************/
		 
		 var org_id="";
		 var service_url=jQuery("body").attr('service_url');
		 var org="";
		 jQuery('#cs-org-list').chosen().change(function() {
			 org_id=jQuery(this).val();
			 
			 	if(org_id!=""){
			 		jQuery(".cs-loader").fadeIn();
			 		
			 		jQuery(".cs-wrap-opacity").css('opacity', '0.7');
			 		jQuery.ajax({
						type:"get",
						url:service_url,
						data:{type:"get_organisation_data",org_id:org_id},
						dataType:"json",
						
						success:function(data){
							jQuery(".cs-loader").fadeOut();
					 		
					 		jQuery(".cs-wrap-opacity").css('opacity', '1');
							if(data.status == "ok"){
						 		
								if(data.org){
									
									 org=data.org;
									 
									 jQuery("#address1").val(org.address1);
									 jQuery("#address2").val(org.address2);
									 jQuery("#town").val(org.town);
									 jQuery("#county").val(org.county);
									 jQuery("#postcode").val(org.postcode);
									 jQuery("#phone").val(org.phone);
									 jQuery("#emergency_phone1").val(org.emergency_phone1);
									 jQuery("#emergency_phone2").val(org.emergency_phone2);
									 jQuery("#email").val(org.email);
									
								}
									
							}
						}
					});
			 		
			 	}else{
			 		
			 		 jQuery("#address1").val("");
					 jQuery("#address2").val("");
					 jQuery("#town").val("");
					 jQuery("#county").val("");
					 jQuery("#postcode").val("");
					 jQuery("#phone").val("");
					 jQuery("#emergency_phone1").val("");
					 jQuery("#emergency_phone2").val("");
					 jQuery("#email").val("");
			 	}
			 
			});
		 
		 
		 /*************Per page************/
		 var result_per_page="";
		 var current_page="";
		 jQuery(".cs-result-per-page").on('change', function(){
			 result_per_page=jQuery(this).val();
			 current_page=jQuery(this).attr('current_page');
			 if(result_per_page!=""){
				 current_page=current_page+'?result_per_page='+result_per_page;
				 
			 }else{
				 
				 current_page=current_page
			 }
			 
			 window.location=current_page;
		 });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            jQuery('#image_upload_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function ConfirmDelete(event)
{
  
  if (confirm("Are you sure you want to delete?")) {
	  return true;
  }else{
	  event.preventDefault();
	  return false;
  }
  
}