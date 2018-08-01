<?php
/*
Template Name: User Dashboard
*/

require_once TEMPLATEPATH. '/templates/user-data/user-data.php';
get_header();
?>

<div class="container">
     <div class="bodycontent">
	    <div class="row">
		   
		   <?php include TEMPLATEPATH.'/templates/user-sidebar/sidebar-userleft.php'?>
		   <div class="col-sm-9">
		     <div class="searchbar">
			 <form name="search_name" id="search_name" action="" method="">
				<div class="fromholder">
					
					   <p class="label">Search by name</p>
					   <input type="text" name="namesearch" id="namesearch" placeholder="Search by name" required/>
					   <input type="button" id="serchname" value=""/>
					
				</div>
				<div class="fromholder">
					
					   <p class="label">Search by interests</p>
					   <input type="text" name="intsearch" id="intsearch" placeholder="Search by interests" required/>
					   <input type="button" id="serchintr" value=""/>
					
				</div>
				</form>
				<div class="fromholder">
				    <a class="addcontactbtn" href="#">Add new contact</a>
				</div>
				
			 </div>
			 <div class="listview">
			     <table class="fullwidth">
					<tr>
					  <td class="top-heading-table">First name<div class="right-arrowholder">&nbsp;</div></td>
					  <td class="top-heading-table">Surname<div class="right-arrowholder">&nbsp;</div></td>
					  <td class="top-heading-table">Position<div class="right-arrowholder">&nbsp;</div></td>
					  <td class="top-heading-table">Organisation Name<div class="right-arrowholder">&nbsp;</div></td>
					  <td class="top-heading-table">Interest<div class="right-arrowholder">&nbsp;</div></td>
					  <td class="top-heading-table">Country<div class="right-arrowholder">&nbsp;</div></td>
					  <td class="top-heading-table">Action</td>
					<tr>
					<tr>
					   <td class="userdata">Mini</td>
					   <td class="userdata">Patrick</td>
					   <td class="userdata">Manager</td>
					   <td class="userdata">T.D Besant.ltd</td>
					   <td class="userdata">n.a</td>
					   <td class="userdata">USA</td>
					  
					   <td class="userdata"><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="edit"/></a></td>
					</tr>
					<tr>
					   <td class="userdata">Mini</td>
					   <td class="userdata">Patrick</td>
					   <td class="userdata">Manager</td>
					   <td class="userdata">T.D Besant.ltd</td>
					   <td class="userdata">n.a</td>
					   <td class="userdata">USA</td>
					  
					   <td class="userdata"><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="edit"/></a></td>
					</tr>
					<tr>
					   <td class="userdata">Mini</td>
					   <td class="userdata">Patrick</td>
					   <td class="userdata">Manager</td>
					   <td class="userdata">T.D Besant.ltd</td>
					   <td class="userdata">n.a</td>
					   <td class="userdata">USA</td>
					  
					   <td class="userdata"><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="edit"/></a></td>
					</tr>
					<tr>
					   <td class="userdata">Mini</td>
					   <td class="userdata">Patrick</td>
					   <td class="userdata">Manager</td>
					   <td class="userdata">T.D Besant.ltd</td>
					   <td class="userdata">n.a</td>
					   <td class="userdata">USA</td>
					  
					   <td class="userdata"><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="edit"/></a></td>
					</tr>
					<tr>
					   <td class="userdata">Mini</td>
					   <td class="userdata">Patrick</td>
					   <td class="userdata">Manager</td>
					   <td class="userdata">T.D Besant.ltd</td>
					   <td class="userdata">n.a</td>
					   <td class="userdata">USA</td>
					  
					   <td class="userdata"><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="edit"/></a></td>
					</tr>
				 </table>
			 </div>
		   </div>
		</div>
	 </div>
  </div>

<?php get_footer(); ?>