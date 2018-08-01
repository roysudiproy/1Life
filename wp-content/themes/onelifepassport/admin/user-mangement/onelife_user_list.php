<?php
function onelife_user_list(){
    global $wpdb;
    
    $query_onelife_user_arr="";
    $orderby="";
    $order="DESC";
    $onelife_pagination_per_page="10";
    
    if(get_option('onelife_pagination_per_page')){
        $onelife_pagination_per_page=get_option('onelife_pagination_per_page');
    }
    
    $redirect=false;
    $redirect_url=admin_url('admin.php?page=onelife-user-manage');
    $delete_msg_suc="";
    if(!isset($_REQUEST['action'])){
        $redirect=1;
        
    }
    elseif(!isset($_REQUEST['del_id'])){
        $redirect=2;
        
    }
    elseif(isset($_REQUEST['action']) && $_REQUEST['action']==""){
        $redirect=3;
    }
    elseif(isset($_REQUEST['action']) && $_REQUEST['action']!="delete"){
        $redirect=4;
    }
    elseif(isset($_REQUEST['del_id']) && $_REQUEST['del_id']==""){
        $redirect=5;
    }else{
        if(wp_delete_user(trim(esc_attr($_REQUEST['del_id'])))){
            $delete_msg_suc="Successfully Deleted the User";
        }
        
        
    }
    
    
    $count_args  = array(
        'role'      => 'onelife_client',
        'fields'    => 'all_with_meta',
        'number'    => 999999
    );
    $user_count_query = new WP_User_Query($count_args);
    $user_count = $user_count_query->get_results();
    
    $total_users = $user_count ? count($user_count) : 1;
    
    $page = isset($_GET['p']) ? $_GET['p'] : 1;
    
    $users_per_page = $onelife_pagination_per_page;
    
    $total_pages = 1;
    $offset = $users_per_page * ($page - 1);
    $total_pages = ceil($total_users / $users_per_page);
    
    if(isset($_REQUEST['orderby'])){
        
        if($_REQUEST['orderby']=='email'){
            $orderby='';
            $meta_value="email";
            
        }else{
            $orderby=$_REQUEST['orderby'];
            $meta_value="meta_value";
        }
    }else{
        
        $orderby='';
        $meta_value="ID";
    }
    
    if(isset($_REQUEST['order'])){
        
        $order=$_REQUEST['order'];
    }
    
    if(isset($orderby) && $orderby!=''){
        
        if($order=='DESC'){
            $order='ASC';
        }else{
            $order='DESC';
        }
    }elseif($orderby=="" && $meta_value=='email'){
        
        if($order=='DESC'){
            $order='ASC';
        }else{
            $order='DESC';
        }
    }else{
        
        $order='ASC';
    }
    
    
    $args = array(
        'blog_id'      => $GLOBALS['blog_id'],
        'role'         => 'onelifepassport_member',
        'role__in'     => array('onelifepassport_member'),
        'role__not_in' => array(),
        'meta_key'     => $orderby,
        'meta_value'   => '',
        'meta_compare' => '',
        'meta_query'   => array(),
        'date_query'   => array(),
        'include'      => array(),
        'exclude'      => array(),
        'orderby'      => $meta_value,
        'order'        => $order,
        'offset'       => $offset,
        'search'       => '',
        'number'       => $users_per_page,
        'count_total'  => false,
        'fields'       => 'all',
        'who'          => '',
    );
    $query_onelife_user_arr=get_users( $args );
    
    ?>
    
    
    <div class="container">
     <div class="bodycontent">
	    <div class="row">
		  
		   <div class="col-sm-12">
		   <h1>User List</h1>
		     <div class="searchbar">
		     <?php if(isset($delete_msg_suc) && $delete_msg_suc!=""):?>
				<div class="alert alert-info-sucess" id="message" >
					<?php echo $delete_msg_suc;?></div>
				<?php endif; ?>
			
				<div class="fromholder">
				    <a class="addcontactbtn" href="<?php echo admin_url('admin.php?page=onelife_user_add')?>">Add new User</a>
				</div>
				
			 </div>
			 <div class="listview">
			     <table class="fullwidth">
			    
					<tr>
					  <td class="top-heading-table">User No<a href="<?php echo admin_url('admin.php?page=onelife-user-manage')?>&orderby=User_No&order=<?php echo $order;?>"><div class="right-arrowholder">&nbsp;</div></a></td>
					  <td class="top-heading-table">User Name<a href="<?php echo admin_url('admin.php?page=onelife-user-manage')?>&orderby=first_name&order=<?php echo $order;?>"><div class="right-arrowholder">&nbsp;</div></a></td>
					  <td class="top-heading-table">User Mobile<a href="<?php echo admin_url('admin.php?page=onelife-user-manage')?>&orderby=Mobile_Number&order=<?php echo $order;?>"><div class="right-arrowholder">&nbsp;</div></a></td>
					  <td class="top-heading-table">User Email<a href="<?php echo admin_url('admin.php?page=onelife-user-manage')?>&orderby=email&order=<?php echo $order;?>"><div class="right-arrowholder">&nbsp;</div></a></td>
					  <td class="top-heading-table">Action</td>
					 
					<tr>
					<?php if(!empty($query_onelife_user_arr)): ?>
		
		
		<?php foreach($query_onelife_user_arr as $query_onelife_user):
		
		?>		
		
					<tr>
					   <td class="userdata"><?php echo get_user_meta($query_onelife_user->ID, 'User_No', true);?></td>
					   <td class="userdata"><?php echo get_user_meta($query_onelife_user->ID, 'first_name', true).' '.get_user_meta($query_onelife_user->ID, 'last_name', true);?></td>
					   <td class="userdata"><?php echo get_user_meta($query_onelife_user->ID, 'Mobile_Number', true);?></td>
					   <td class="userdata"><?php echo $query_onelife_user->user_email;?></td>					  
					   <td class="userdata">					   
					   <a class="iocntable" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=onelife_user_edit&action=edit&user_id='.$query_onelife_user->ID.'');?>"><img src="<?php echo get_template_directory_uri()?>/images/edittable.png" class="img-responsive" alt="edit"/></a>
					   <a class="iocntable" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=onelife-user-manage&action=delete&del_id='.$query_onelife_user->ID.'');?>" Onclick="ConfirmDelete_onelife(event)"><img src="<?php echo get_template_directory_uri()?>/images/deletebtn.png" class="img-responsive" alt="edit"/></a>
					   
					   </td>
					</tr>
					
					<?php endforeach; else:?>
					<tr> <td class="userdata" colspan="5">No User found.</td></tr>
					<?php endif;?>
		
				 </table>
			 </div>
		   </div>
		</div>
	 </div>
  </div>

<?php 
$delete_msg_suc="";

}
?>