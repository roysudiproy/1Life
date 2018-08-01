<?php
/*
 Template Name: Organization
 
 */
session_start();
error_reporting(E_ALL & ~ E_NOTICE);
$action="";
require_once TEMPLATEPATH. '/templates/user-data/user-data.php';

get_header();
?>
<div class="container">
     <div class="bodycontent">
	    <div class="row">
		   <?php include TEMPLATEPATH.'/templates/user-sidebar/sidebar-userleft.php'?>
<?php if(isset($action) && $action=='add-new'){
include TEMPLATEPATH.'/templates/organization/org-add-new.php';

}elseif (isset($action) && $action=='edit'){
    
    include TEMPLATEPATH.'/templates/organization/org-edit.php';
    
}elseif (isset($action) && $action=='view'){
    
    include TEMPLATEPATH.'/templates/organization/org-view.php';
    
}else{
    
    include TEMPLATEPATH.'/templates/organization/org-list.php';
}
?>

	</div>
	 </div>
  </div>

<?php 
get_footer();
?>