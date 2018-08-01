<?php
ob_start();
function onelife_user_pass_change(){
    
    global $wpdb;
    $err_msg="";
    $suc_msg="";
    $new_password="";
    $confirm_password="";
    $update_user=false;
    $exists_user_id="";
    $redirect_url=admin_url('admin.php?page=onelife-user-manage');
    $redirect=false;
    $request_user_ID="";
    $get_user="";
    $date_format="";
    $date_format="d/m/Y";
    $get_date_record="";
    $get_date_started="";
    
    
    if(!isset($_REQUEST['action'])){
        $redirect=true;
        
    }
    if(!isset($_REQUEST['user_id'])){
        $redirect=true;
        
    }
    if(isset($_REQUEST['action']) && $_REQUEST['action']==""){
        $redirect=true;
    }
    if(isset($_REQUEST['action']) && $_REQUEST['action']!="pass_change"){
        $redirect=true;
    }
    if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']==""){
        $redirect=true;
    }
    
    if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
        
        $exists_user_id=get_userdata($_REQUEST['user_id']);
        
        
        if(!$exists_user_id ) {
            $redirect=true;
        }
        
    }
    
    
    
    if($redirect==true){
        wp_safe_redirect($redirect_url);
        exit();
    }
    
    $request_user_ID=trim($_REQUEST['user_id']);
    
    $get_user=get_userdata($_REQUEST['user_id']);
    
    if(empty($get_user)){
        
        wp_safe_redirect($redirect_url);
        exit();
    }


if(isset($_POST['user_pass_submit'])){
    
    
    if(empty(trim($_POST['new_password']))){
        $err_msg .="Please enter the New Password.<br>";
    }
    
    if(empty(trim($_POST['confirm_password']))){
        $err_msg .="Please enter the Confirm Password.<br>";
    }
    
    if(!empty(trim($_POST['new_password'])) && strlen(trim($_POST['new_password']))<6){
        $err_msg .="Password length should be minimum 6.<br>";
    }
    if(!empty(trim($_POST['new_password'])) && !empty(trim($_POST['confirm_password'])) && trim($_POST['new_password'])!=trim($_POST['confirm_password'])){
        $err_msg .="Password does not match.<br>";
    }
    
    if($err_msg==""){
    $new_password=wp_strip_all_tags(trim(esc_sql($_POST['new_password'])));
    
           wp_set_password($new_password, $request_user_ID);                
           wp_safe_redirect(admin_url('admin.php?page=onelife-user-manage'));
           exit();
              
           
    }
    
    
}    


?>


<div class="container">
	<div class="bodycontent">
		<div class="row">

			<div class="col-sm-12 imageback">
				<h1>Change Password</h1>
				<div class="col-sm-12 ">
					<div class="login-plate">
						<div class="whiteplate">
							<div class="formholder">
							
							
							<form method="post" role="form"  autocomplete="off"
			action="" id="onelife-user-form">

			<div class="form-header">
			
			</div>

			<div class="form-body">
				<?php if(isset($err_msg) && $err_msg!=""):?>
				<div class="alert alert-info-error" id="message" >
					<?php echo $err_msg;?></div>
				<?php endif; ?>
				
				<?php if(isset($suc_msg) && $suc_msg!=""):?>
				<div class="alert alert-info-sucess" id="message" >
					<?php echo $suc_msg;?></div>
				<?php endif; ?>
				
				
				<div class="row">

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
									<i class="fa fa-key" aria-hidden="true"></i>
									
							</div>
							<input name="new_password"  id="new_password" type="password"
								class="form-control validate[required, minSize[6], maxSize[20]]" placeholder="New Password" value="">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
									<i class="fa fa-key" aria-hidden="true"></i>

							</div>
							<input name="confirm_password" type="password"
								class="form-control validate[required, equals[new_password]]" placeholder="Confirm Password" value="">
						</div>
						<span class="help-block" id="error"></span>
					</div>
				</div>
			</div>

			<div class="form-footer">
				<button type="submit" name="user_pass_submit" class="btn btn-info">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Password
				</button>
				
			</div>
			

		</form>
							
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
