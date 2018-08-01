jQuery(function(){
	
	jQuery("#onelife-user-form").validationEngine();
	jQuery("#user_date_started, #user_date_record_added ").datepicker({	
		changeMonth: true,
	    changeYear: true,
	    dateFormat:'dd/mm/yy',
	    
	});
	
	
});


function ConfirmDelete_onelife(event)
{
  
  if (confirm("Are you sure you want to delete?")) {
	  return true;
  }else{
	  event.preventDefault();
	  return false;
  }
  
}
