<?php
ob_start();
function onelife_user_edit(){
    
    global $wpdb;
    $err_msg="";
    $suc_msg="";
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
    if(isset($_REQUEST['action']) && $_REQUEST['action']!="edit"){
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
    
    if(isset($_POST['user_submit'])){
        
        $User_No="";
        $user_First_Name="";
        $user_Last_Name="";
        $user_Address_1="";
        $user_Address_2="";
        $user_Address_3="";
        $user_Address_4="";
        $user_Post_Code="";
        $user_Phone_Number="";
        $user_Mobile_Number="";
        $user_Email_Address="";
        $user_Date_Started="";
        $user_Date_Record_Added="";
        $exists_email="";
        $exists_User_No="";
        
        if(empty(trim($_POST['User_No']))){
            $err_msg .="Please enter the user Number.<br>";
        }
        
        if ( isset($_POST['User_No']) && filter_var($_POST['User_No']) ) {
            
            
            $args = array(
                'meta_query' => array(
                    'relation'=>'AND',
                    array(
                        'key' => 'User_No',
                        'value' => trim($_POST['User_No']),
                        'compare' => '='
                    ),
                    array(
                        'key' => 'User_No',
                        'value' =>$get_user->User_No,
                        'compare' => '!='
                    )
                )
            );
            
            $exists_User_No=get_users($args);
            if ( $exists_User_No ) {
                $err_msg .="Duplicate User Number.<br>";
            }
            
        }
        
        if(empty(trim($_POST['user_First_Name']))){
            $err_msg .="Please enter the user first name.<br>";
        }
        if(empty(trim($_POST['user_Last_Name']))){
            $err_msg .="Please enter the user last name.<br>";
        }
        if(empty(trim($_POST['user_Address_1']))){
            // $err_msg .="Please enter the user address.<br>";
        }
        
        if(empty(trim($_POST['user_Post_Code']))){
            // $err_msg .="Please enter the user post code.<br>";
        }
        if(empty(trim($_POST['user_Phone_Number']))){
            // $err_msg .="Please enter the user phone number.<br>";
        }
        if(empty(trim($_POST['user_Mobile_Number']))){
            //  $err_msg .="Please enter the user mobile number.<br>";
        }
        
        if(empty(trim($_POST['user_Email_Address']))){
            $err_msg .="Please enter the user email address.<br>";
        }
        
        if(!empty(trim($_POST['user_Email_Address'])) && !is_email(trim($_POST['user_Email_Address']))){
            $err_msg .="Please enter valid email address.<br>";
        }
        
        
        if ( isset($_POST['user_Email_Address']) && filter_var($_POST['user_Email_Address'], FILTER_VALIDATE_EMAIL) ) {
            
            
            if($get_user->user_email!=trim($_POST['user_Email_Address']) && email_exists(trim($_POST['user_Email_Address']))){
                
                $exist_user= get_user_by('email', $_POST['user_Email_Address']);
                
                
                $roles=onelife__get_user_role($exist_user->ID);
                if(!$roles){
                    $roles="User";
                }
                $err_msg .="Duplicate Email, This email address is already used for another <strong>".$roles."</strong>.<br>";
            }
            
        }
        
        
        if(empty(trim($_POST['user_Date_Started']))){
            //$err_msg .="Please enter the user date started.<br>";
        }
        
        if(empty(trim($_POST['user_Date_Record_Added']))){
            // $err_msg .="Please enter the user date record added.<br>";
        }
        
        if(empty($err_msg)){
            
            $User_No=wp_strip_all_tags(trim(esc_sql($_POST['User_No'])));
            $user_First_Name=wp_strip_all_tags(trim(esc_sql($_POST['user_First_Name'])));
            $user_Last_Name=wp_strip_all_tags(trim(esc_sql($_POST['user_Last_Name'])));
            $user_Address_1=wp_strip_all_tags(trim(esc_sql($_POST['user_Address_1'])));
            $user_Address_2=wp_strip_all_tags(trim(esc_sql($_POST['user_Address_2'])));
            $user_Address_3=wp_strip_all_tags(trim(esc_sql($_POST['user_Address_3'])));
            $user_Address_4=wp_strip_all_tags(trim(esc_sql($_POST['user_Address_4'])));
            $user_Post_Code=wp_strip_all_tags(trim(esc_sql($_POST['user_Post_Code'])));
            $user_Phone_Number=wp_strip_all_tags(trim(esc_sql($_POST['user_Phone_Number'])));
            $user_Mobile_Number=wp_strip_all_tags(trim(esc_sql($_POST['user_Mobile_Number'])));
            $user_Email_Address=wp_strip_all_tags(trim(esc_sql($_POST['user_Email_Address'])));
            $user_Date_Started=wp_strip_all_tags(trim(esc_sql($_POST['user_Date_Started'])));
            $user_Date_Started= strtotime(str_replace('/','-',$user_Date_Started));
            $user_Date_Record_Added=wp_strip_all_tags(trim(esc_sql($_POST['user_Date_Record_Added'])));
            $user_Date_Record_Added= strtotime(str_replace('/','-',$user_Date_Record_Added));
            
            $la_user_data = array (
                "ID"=>$get_user->ID,
                "user_email" =>$user_Email_Address,
                "nickname"  =>  $user_First_Name,
                "user_nicename"  =>  $user_First_Name,
                "display_name"=>$user_First_Name,
                "first_name" => $user_First_Name,
                "last_name" => $user_Last_Name,
                
            );
            
            if(wp_update_user ( $la_user_data )){
                update_user_meta($get_user->ID, "User_No", $User_No);
                
                update_user_meta($get_user->ID, "Address_1", $user_Address_1);
                update_user_meta($get_user->ID, "Address_2", $user_Address_2);
                update_user_meta($get_user->ID, "Address_3", $user_Address_3);
                update_user_meta($get_user->ID, "Address_4", $user_Address_4);
                update_user_meta($get_user->ID, "Post_Code", $user_Post_Code);
                update_user_meta($get_user->ID, "Phone_Number", $user_Phone_Number);
                update_user_meta($get_user->ID, "Mobile_Number", $user_Mobile_Number);
                update_user_meta($get_user->ID, "Date_Started", $user_Date_Started);
                update_user_meta($get_user->ID, "Date_Record_Added", $user_Date_Record_Added);
                
                
                $user_list_url=admin_url('admin.php?page=onelife-user-manage');
                $suc_msg .="Successfully Updated User, Click <a href='".$user_list_url."'><strong>here</strong></a> to got to User List";
                wp_safe_redirect(admin_url('admin.php?page=onelife-user-manage'));
                exit();
            }else{
                
                $err_msg .="Something went wrong, Please try again later";
            }
        }
        
        
    }
    
    if($get_user->Date_Started){
        if(is_numeric($get_user->Date_Started)){
            $get_date_started= date($date_format, $get_user->Date_Started);
        }else{
            
            $start_date_arr = explode("/", $get_user->Date_Started);
            $get_date_started = $start_date_arr[1]."/".$start_date_arr[0]."/".$start_date_arr[2];
            
        }
        
        
    }
    
    if($get_user->Date_Record_Added){
        
        
        if(is_numeric($get_user->Date_Record_Added)){
            $get_date_record= date($date_format, $get_user->Date_Record_Added);
        }else{
            
            $record_date_arr = explode("/", $get_user->Date_Record_Added);
            $get_date_record = $record_date_arr[1]."/".$record_date_arr[0]."/".$record_date_arr[2];
            
        }
    }
  
   ?>
    <div class="container">
	<div class="bodycontent">
		<div class="row">

			<div class="col-sm-12 imageback">
				<h1>User Edit</h1>
				<div class="col-sm-12 ">
					<div class="login-plate">
						<div class="whiteplate">
							<div class="formholder">
							
							
							<form method="post" role="form"  autocomplete="off"
			action="" id="onelife-user-form">

			<div class="form-header">
			
			<div class="head-right">
				<a class="cs-pass-change-btn" href="<?php echo admin_url();?>?page=onelife_user_pass_change.php&action=pass_change&user_id=<?php echo $request_user_ID;?>">
					<i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a>
				</div>
				

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
				
				<?php  if( $suc_msg==""): ?>
				<div class="row">

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
									<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
									
							</div>
							<input name="User_No"  type="text"
								class="form-control validate[required, minSize[1], maxSize[10], custom[onlyLetterNumber]]" placeholder="User No" value="<?php if(isset($_POST['User_No'])) {echo $_POST['User_No'];}else{ echo $get_user->User_No;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user" aria-hidden="true"></i>

							</div>
							<input name="user_First_Name" type="text"
								class="form-control validate[required, custom[onlyLetterSp]]" placeholder="First Name" value="<?php if(isset($_POST['user_First_Name'])) {echo $_POST['user_First_Name'];}else{ echo $get_user->first_name;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user" aria-hidden="true"></i>

							</div>
							<input name="user_Last_Name" type="text"
								class="form-control validate[required, custom[onlyLetterSp]]" placeholder="Last Name" value="<?php if(isset($_POST['user_Last_Name'])) {echo $_POST['user_Last_Name'];}else{ echo $get_user->last_name;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

				</div>
				
				
				<div class="row">

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
							<i class="fa fa-address-book" aria-hidden="true"></i>
							</div>
							
								<textarea maxlength="200" class="form-control validate[ maxSize[200]]" name="user_Address_1" placeholder="Address 1"><?php if(isset($_POST['user_Address_1'])) {echo $_POST['user_Address_1'];}else{ echo $get_user->Address_1;}?></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-address-book" aria-hidden="true"></i>

							</div>
							<textarea maxlength="200" class="form-control validate[ maxSize[200]]" name="user_Address_2" placeholder="Address 2"><?php if(isset($_POST['user_Address_2'])) {echo $_POST['user_Address_2'];}else{ echo $get_user->Address_2;}?></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>		

				</div>
				
				<div class="row">

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-address-book" aria-hidden="true"></i>
							</div>
							
								<textarea maxlength="200" class="form-control validate[ maxSize[200]]" name="user_Address_3" placeholder="Address 3"><?php if(isset($_POST['user_Address_3'])) {echo $_POST['user_Address_3'];}else{ echo $get_user->Address_3;}?></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-address-book" aria-hidden="true"></i>
							</div>
							<textarea maxlength="200" class="form-control validate[maxSize[200]]"  name="user_Address_4" placeholder="Address 4"><?php if(isset($_POST['user_Address_4'])) {echo $_POST['user_Address_4'];}else{ echo $get_user->Address_4;}?></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>		

				</div>

				
				<div class="row">

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-map-pin" aria-hidden="true"></i>

							</div>
							<input name="user_Post_Code"  type="text" minlength="3" maxlength="8"
								class="form-control validate[ minSize[3], maxSize[8]]" placeholder="Post Code" value="<?php if(isset($_POST['user_Post_Code'])) {echo $_POST['user_Post_Code'];}else{ echo $get_user->Post_Code;}?>" >
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-phone-square" aria-hidden="true"></i>

							</div>
							<input name="user_Phone_Number" type="text" minlength="8" maxlength="16"
								class="form-control validate[ minSize[8], maxSize[16], custom[onlyNumberSp]]" placeholder="Phone Number" value="<?php if(isset($_POST['user_Phone_Number'])) {echo $_POST['user_Phone_Number'];}else{ echo $get_user->Phone_Number;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-mobile " aria-hidden="true"></i>

							</div>
							<input name="user_Mobile_Number" type="text" minlength="8" maxlength="16"
								class="form-control validate[minSize[8], maxSize[16], custom[onlyNumberSp]]" placeholder="Mobile Number" value="<?php if(isset($_POST['user_Mobile_Number'])) {echo $_POST['user_Mobile_Number'];}else{ echo $get_user->Mobile_Number;}?>" >
						</div>
						<span class="help-block" id="error"></span>
					</div>

				</div>
				
				<div class="row">

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-envelope" aria-hidden="true"></i>

							</div>
							<input name="user_Email_Address"  type="email"
								class="form-control validate[required, custom[email]]" placeholder="Email" value="<?php if(isset($_POST['user_Email_Address'])) {echo $_POST['user_Email_Address'];}else{ echo $get_user->user_email;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar" aria-hidden="true"></i>

							</div>
							<input name="user_Date_Started" type="text" id="user_date_started" min="2011-01-01"
								class="form-control text-input datepicker" placeholder="Date Started" value="<?php if(isset($_POST['user_Date_Started'])) {echo $_POST['user_Date_Started'];}else{ echo $get_date_started;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar" aria-hidden="true"></i>

							</div>
							
							<input name="user_Date_Record_Added" type="text" min="2011-01-01"
								class="form-control text-input datepicker" id="user_date_record_added" placeholder="Date Record Added" value="<?php if(isset($_POST['user_Date_Record_Added'])) {echo $_POST['user_Date_Record_Added'];}else{ echo $get_date_record;}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

				</div>


			</div>

			<div class="form-footer">
				<button type="submit" name="user_submit" class="btn btn-info">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update
				</button>
			</div>
			<?php endif; $suc_msg="";?>

		</form>
							
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
   
   <?php  
}

?>