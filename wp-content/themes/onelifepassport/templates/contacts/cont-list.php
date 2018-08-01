<?php 
global $wpdb;
$table_contacts = $wpdb->prefix .'contacts';

$table_organization=$wpdb->prefix.'organisations';

$table_interests=$wpdb->prefix.'interests';
$select_interests="";
$interests_lists="";
$orderby="";

if(isset($_REQUEST['order'])){
    $order=$_REQUEST['order'];
}else{
    
    $order="ASC";
}

$organisation_id_orderby="";
$temp_interest_orderby="";
if(isset($_REQUEST['orderby'])){
    
    if($_REQUEST['orderby']=='organisation_id'){
        $orderby='';
        $organisation_id_orderby="organisation_id";
        
    }else if($_REQUEST['orderby']=='temp_interest'){
        $orderby='';
        $temp_interest_orderby="temp_interest";
        
    }else{
        
        $orderby=$_REQUEST['orderby'];
    }
    
   
}else{
    
    $orderby="contact_id";
}
if(isset($orderby) && $orderby!=''){
    
    if($order=='DESC'){
        $order='ASC';
    }else{
        $order='DESC';
    }
}


if(isset($_REQUEST['cont-id']) && !empty($_REQUEST['cont-id']) && isset($_REQUEST['action']) && $_REQUEST['action']=='delete'){
    if($wpdb->delete( $table_contacts, array( 'contact_id' => $_REQUEST['cont-id'] ), array( '%d' ) )==FALSE){
         $delete_msg_suc="Delete operation failed";
        
    }else{
        
        $suc_msg="Successfully deleted Contact";
        $_SESSION['delete_contact_message']=$suc_msg;
        wp_safe_redirect(get_permalink());
        exit();
        
        $delete_msg_suc="Successfully Deleted the Contact";
        
    }
}

$customPagHTML     = "";
$order_by_query="";
$query             = "SELECT * FROM $table_contacts";
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

if($orderby!=""){
$order_by_query="ORDER BY $orderby $order";
}

if($organisation_id_orderby!=""){
    
    if($order=='DESC'){
        $order='ASC';
    }else{
        $order='DESC';
    }
    
    $query="select t2.* from $table_contacts t2 order by (select t1.organisation_id from  $table_organization t1 where t1.organisation_id = t2.organisation_id) $order";
    
    $query_contact_arr = $wpdb->get_results( $query . " LIMIT ${offset}, ${items_per_page}", OBJECT );
}elseif ($temp_interest_orderby!=""){
    if($order=='DESC'){
        $order='ASC';
    }else{
        $order='DESC';
    }
    
    $query="select t2.* from $table_contacts t2 order by (select t1.interest_id from  $table_interests t1 where t1.interest_id = t2.temp_interest) $order";
    
    $query_contact_arr = $wpdb->get_results( $query . " LIMIT ${offset}, ${items_per_page}", OBJECT );
    
}else{
$query_contact_arr = $wpdb->get_results( $query . " $order_by_query LIMIT ${offset}, ${items_per_page}", OBJECT );
}
$totalPage         = ceil($total / $items_per_page);

$query="select t2.* from Lp18_contacts t2 order by (select t1.organisation_id from  Lp18_organisations t1 where t1.organisation_id = t2.organisation_id) $order;";
//echo $query;
$results=$wpdb->get_results($query);

foreach ($results as $res):
if(isset($res->organisation_id) && $res->organisation_id!=0){ //echo get_organisation_name_from_id($res->organisation_id).'<br>';
}
endforeach;
//echo '<pre>';
//print_r($results);
//echo '</pre>';
?>
		   <div class="col-sm-9">
		   <div class="cs-int-wrap">
		     <div class="searchbar">
			 
				<div class="fromholder">
				    <a class="addcontactbtn" href="<?php echo get_permalink()?>?action=add-new">Add New Contact</a>
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
			 	<?php if(isset($_SESSION['insert_contact_message'])):?><p class="cs-suc-msg"><?php echo $_SESSION['insert_contact_message'];?></p><?php endif; ?>
			 	<?php if(isset($_SESSION['update_contact_message'])):?><p class="cs-suc-msg"><?php echo $_SESSION['update_contact_message'];?></p><?php endif; ?>
			 	<?php if(isset($_SESSION['delete_contact_message'])):?><p class="cs-suc-msg"><?php echo $_SESSION['delete_contact_message'];?></p><?php endif; ?>			 	
			
			 </div>
			 
			
			 
			 <div class="listview table-responsive">
			 
			     <table class="fullwidth tablesorter table"  id="ContListTable">
			     <thead> 
					<tr>
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'first_name',
    'order' => $order,
					  ), getCurrentURL() ); ?>">First Name <?php if(isset($orderby) && $orderby=='first_name') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'surname',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Surname <?php if(isset($orderby) && $orderby=='surname') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  
					  
					  
					  <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'phone',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Phone <?php if(isset($orderby) && $orderby=='phone') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  
					  
					   <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'mobile',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Mobile <?php if(isset($orderby) && $orderby=='mobile') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  
		
		
		 <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'email',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Email <?php if(isset($orderby) && $orderby=='email') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					  			  
					
					 <!--   <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'organisation_id',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Organisation Name <?php if(isset($organisation_id_orderby) && $organisation_id_orderby=='organisation_id') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>-->
					 
					  <!-- <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'temp_interest',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Interest <?php if(isset($temp_interest_orderby) && $temp_interest_orderby=='temp_interest') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					   -->
					   
					   <th class="top-heading-table ">Interests</th>
					  
					   <!-- <th class="top-heading-table"><a href="<?php echo add_query_arg( array(
    'orderby' => 'county',
    'order' => $order,
					  ), getCurrentURL() ); ?>">Country <?php if(isset($orderby) && $orderby=='county') {?> <span class="<?php if($order=='DESC') { echo 'spn-asc';}else{ echo 'spn-desc';} ?>"></span><?php }?></a></th>
					 -->
					 
					  <th class="top-heading-table">Action</th>
					  </tr>
					 </thead> 
					 <tbody>
					
					<?php if(!empty($query_contact_arr)): foreach ($query_contact_arr as $query_contact):?>
					<tr>
					   <td class="userdata"><?php echo $query_contact->first_name;?></td>
					   <td class="userdata"><?php echo $query_contact->surname;?></td>	
					   
					     <td class="userdata"><?php echo $query_contact->phone;?></td>		
					     
					       <td class="userdata"><?php echo $query_contact->mobile;?></td>		
					       
					         <td class="userdata cs-no-break"><?php echo $query_contact->email;?></td>						
					 <!--  <td class="userdata"><?php if(isset($query_contact->organisation_id) && $query_contact->organisation_id!=0){ echo get_organisation_name_from_id($query_contact->organisation_id);}?></td> --> 
					   <td class="userdata cs-no-break"><?php if($query_contact->temp_interest){
					       
					      $interests_lists=maybe_unserialize($query_contact->temp_interest);
					      
					      if(!empty($interests_lists) && is_array($interests_lists)){
					          
					          print_r(get_interest_name_from_id_multiple(implode(',',$interests_lists)));
					      }
					       
					   }?></td>
					  <!-- <td class="userdata"><?php echo $query_contact->county;?></td> --> 
					   
					  
					   <td class="userdata"><a class="iocntable" href="<?php echo get_permalink().'?action=view&cont-id='.$query_contact->contact_id;?>"><img class="img-responsive" src="<?php echo get_template_directory_uri()?>/images/viewbttn.png" title="View" alt=""></a><a class="iocntable" href="<?php echo get_permalink().'?action=edit&cont-id='.$query_contact->contact_id;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edittable.png" class="img-responsive" alt="edit"/></a><a class="iocntable" href="<?php echo get_permalink().'?action=delete&cont-id='.$query_contact->contact_id;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/deletebtn.png" class="img-responsive" alt="Delete" Onclick="ConfirmDelete(event)"/></a></td>
					</tr>
					<?php endforeach; else:?>
					<tr><td colspan="2">No Contact found.</td></tr>
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
		   if(isset($_SESSION['insert_contact_message'])){
		       
		       unset($_SESSION['insert_contact_message']);
		   }
		   
		   if(isset($_SESSION['update_contact_message'])){
		       
		       unset($_SESSION['update_contact_message']);
		   }
		   
		   if(isset($_SESSION['delete_contact_message'])){
		       
		       unset($_SESSION['delete_contact_message']);
		   }
		   
		   ?>
	