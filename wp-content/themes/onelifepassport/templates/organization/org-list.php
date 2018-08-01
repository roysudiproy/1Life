<?php 
global $wpdb;
$table_organization=$wpdb->prefix.'organisations';
$select_org="";

$orderby="organisation_id";


if(isset($_REQUEST['order'])){
    $order=$_REQUEST['order'];
}else{
    
    $order="ASC";
}

if(isset($_REQUEST['orderby'])){
        $orderby=$_REQUEST['orderby'];
    
}else{
    
    $orderby="organisation_id";
}


if(isset($orderby) && $orderby!=''){
    
    if($order=='DESC'){
        $order='ASC';
    }else{
        $order='DESC';
    }
}


if(isset($_REQUEST['org-id']) && !empty($_REQUEST['org-id']) && isset($_REQUEST['action']) && $_REQUEST['action']=='delete'){
    if($wpdb->delete( $table_organization, array( 'organisation_id' => $_REQUEST['org-id'] ), array( '%d' ) )==FALSE){
         $delete_msg_suc="Delete operation failed";
        
    }else{
        $suc_msg="Successfully deleted Organisation.";
        $_SESSION['delete_org_message']=$suc_msg;
        
        wp_safe_redirect(get_permalink());
        exit();
        
        $delete_msg_suc="Successfully Deleted the Organization";
        
    }
}

$customPagHTML     = "";
$query             = "SELECT * FROM $table_organization";
$total_query     = "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total             = $wpdb->get_var( $total_query );
if(isset($_REQUEST['result_per_page']) && $_REQUEST['result_per_page']!=""){
    $items_per_page=$_REQUEST['result_per_page'];
}elseif(get_option('onelife_per_page_list')!=""){
    $items_per_page=get_option('onelife_per_page_list');
    
}else{
    
    $items_per_page = get_option( 'posts_per_page' );
}
$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset         = ( $page * $items_per_page ) - $items_per_page;
$query_org_arr = $wpdb->get_results( $query . " ORDER BY $orderby $order LIMIT ${offset}, ${items_per_page}", OBJECT );
$totalPage         = ceil($total / $items_per_page);



?>
		   <div class="col-sm-9">
		   <div class="cs-org-wrap">
		     <div class="searchbar">
			 
				<div class="fromholder">
				    <a class="addcontactbtn" href="<?php echo get_permalink()?>?action=add-new">Add new Organisation</a>
				</div>
				<div class="cs-result-per-page-wrap">
			 	<select class="cs-result-per-page form-control " current_page="<?php echo get_permalink();?>">
			 		<option value="">Result Per Page</option>
			 		<option value="5">5</option>
			 		<option value="10">10</option>
			 		<option value="15">15</option>
			 		<option value="30">30</option>
			 		<option value="50">50</option>
			 	</select>
			 	
			 </div>
			 </div>
			 
			 <div class="cs-message-wrap">
			 	<?php if(isset($_SESSION['insert_org_message'])):?><p class="cs-suc-msg"><?php echo $_SESSION['insert_org_message'];?></p><?php endif; ?>
			 	<?php if(isset($_SESSION['update_org_message'])):?><p class="cs-suc-msg"><?php echo $_SESSION['update_org_message'];?></p><?php endif; ?>
			 	<?php if(isset($_SESSION['delete_org_message'])):?><p class="cs-suc-msg"><?php echo $_SESSION['delete_org_message'];?></p><?php endif; ?>			 	
			
			 </div>
			 
			 <div class="listview">
			     <table class="fullwidth tablesorter"  id="orgListTable">
			     <thead> 
					<tr>
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'organisation_name',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Organisation Name <?php if(isset($orderby) && $orderby=='organisation_name') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'email',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Email <?php if(isset($orderby) && $orderby=='email') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'phone',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Phone <?php if(isset($orderby) && $orderby=='phone') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'town',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Town <?php if(isset($orderby) && $orderby=='town') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>  
					  
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'county',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Country <?php if(isset($orderby) && $orderby=='county') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					 
					  <th class="top-heading-table">Action</th>
					  </tr>
					 </thead> 
					 <tbody>
					
					<?php if(!empty($query_org_arr)): foreach ($query_org_arr as $query_org):?>
					<tr>
					   <td class="userdata"><?php echo $query_org->organisation_name;?></td>
					   <td class="userdata"><?php echo $query_org->email;?></td>
					   <td class="userdata"><?php echo $query_org->phone;?></td>
					   <td class="userdata"><?php echo $query_org->town;?></td>
					   <td class="userdata"><?php echo $query_org->county;?></td>
					  
					   <td class="userdata"><a class="iocntable" href="<?php echo get_permalink().'?action=view&org-id='.$query_org->organisation_id;?>"><img class="img-responsive" src="<?php echo get_template_directory_uri()?>/images/viewbttn.png" title="View" alt=""></a><a class="iocntable" href="<?php echo get_permalink().'?action=edit&org-id='.$query_org->organisation_id;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="<?php echo get_permalink().'?action=delete&org-id='.$query_org->organisation_id;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="Delete" Onclick="ConfirmDelete(event)"/></a></td>
					</tr>
					<?php endforeach; ?>
					
					
					<?php else:?>
					<tr><td colspan="6">No Organisation found.</td></tr>
					<?php endif;?>
					</tbody>
					

				 </table>
				 
				 <?php 
				
				if($totalPage > 1){
				    ?><div class="cs-pagination">
				  
				    <?php 
				    $customPagHTML     =  '<div class="simsof-pagi"><span class="pagi-of">Page '.$page.' of '.$totalPage .'</span>&nbsp;'.paginate_links( array(
				        'base' => add_query_arg( 'cpage', '%#%' ),
				        'format' => '',
				        'prev_text' => __('&laquo;'),
				        'next_text' => __('&raquo;'),
				        'total' => $totalPage,
				        'current' => $page,
				        'before_page_number' => '',
				        'after_page_number'  => ''
				    )).'</div>';
				    
				    echo $customPagHTML;
				    ?></div><?php 
				}
				?>
				 
			 </div>
			 </div>
		   </div>
		   
		 	   <?php 
		   if(isset($_SESSION['insert_org_message'])){
		       
		       unset($_SESSION['insert_org_message']);
		   }
		   
		   if(isset($_SESSION['update_org_message'])){
		       
		       unset($_SESSION['update_org_message']);
		   }
		   
		   if(isset($_SESSION['delete_org_message'])){
		       
		       unset($_SESSION['delete_org_message']);
		   }
		   
		   ?>
	