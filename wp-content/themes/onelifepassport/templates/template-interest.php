<?php
/*
 Template Name: Interest
 
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
include TEMPLATEPATH.'/templates/interest/int-add-new.php';

}elseif (isset($action) && $action=='edit'){
    
    include TEMPLATEPATH.'/templates/interest/int-edit.php';
    
}else{
    
    include TEMPLATEPATH.'/templates/interest/int-list.php';
}
?>

	</div>
	 </div>
  </div>

<?php 
get_footer();
?>