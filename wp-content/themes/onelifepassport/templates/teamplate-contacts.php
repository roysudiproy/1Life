<?php
/*
Template Name: Contacts
*/
session_start();
require_once TEMPLATEPATH. '/templates/user-data/user-data.php';
get_header();


?>

<div class="container">
<div class="cs-cont-wrap">
     <div class="bodycontent">
	    <div class="row">
		   
		  
		   
		   <?php include TEMPLATEPATH.'/templates/user-sidebar/sidebar-userleft.php'?>
		 
<?php if(isset($action) && $action=='add-new'){
include TEMPLATEPATH.'/templates/contacts/cont-add-new.php';

}elseif (isset($action) && $action=='edit'){
    
    include TEMPLATEPATH.'/templates/contacts/cont-edit.php';
    
}elseif (isset($action) && $action=='view'){
    
  include TEMPLATEPATH.'/templates/contacts/cont-view.php';
    
}else{
    
    include TEMPLATEPATH.'/templates/contacts/cont-list.php';
}
?>

		  
 </div>
	 </div>
  </div>
</div>
<?php get_footer(); ?>