<?php
ob_start();
function onelife_user_add(){
    
    
    global $wpdb;
    
    $err_msg="";
    $suc_msg="";
    $insert_user=false;
    $users_User_No_exists="";
    $ls_from_email="";
    $ls_from_name="";
    $ls_mail_content="";
    $subject="";
    $date_format="";
    $date_format="d/m/Y";
    $onelife_user_email_setting="";
    $onelife_user_email_setting=esc_attr( get_option('onelife_user_email_setting') );
    
    if($onelife_user_email_setting==""){
        $onelife_user_email_setting=1;
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
        $user_Password="";
        $user_Confirm_Password="";
        
        
        if(empty(trim($_POST['User_No']))){
            $err_msg .="Please enter the user Number.<br>";
        }
        
        if ( isset($_POST['User_No']) && filter_var($_POST['User_No']) ) {
            
            $users_User_No_exists = get_users(array(
                'meta_key'     => 'User_No',
                'meta_value'   => trim($_POST['User_No']),
                'meta_compare' => '=',
            ));
            
            if (!empty($users_User_No_exists)) {
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
            //$err_msg .="Please enter the user address.<br>";
        }
        
        if(empty(trim($_POST['user_Post_Code']))){
            // $err_msg .="Please enter the user post code.<br>";
        }
        if(empty(trim($_POST['user_Phone_Number']))){
            // $err_msg .="Please enter the user phone number.<br>";
        }
        if(empty(trim($_POST['user_Mobile_Number']))){
            //$err_msg .="Please enter the user mobile number.<br>";
        }
        
        if(empty(trim($_POST['user_Email_Address']))){
            $err_msg .="Please enter the user email address.<br>";
        }
        
        if(!empty(trim($_POST['user_Email_Address'])) && !is_email(trim($_POST['user_Email_Address']))){
            $err_msg .="Please enter valid email address.<br>";
        }
        
        
        if ( isset($_POST['user_Email_Address']) && filter_var($_POST['user_Email_Address'], FILTER_VALIDATE_EMAIL) ) {
            
            if ( email_exists($_POST['user_Email_Address']) ) {
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
        
        if(empty(trim($_POST['user_Password']))){
            $err_msg .="Please enter the user Password.<br>";
        }
        
        if(empty(trim($_POST['user_Confirm_Password']))){
            $err_msg .="Please enter the user Confirm Password.<br>";
        }
        if(!empty(trim($_POST['user_Password'])) && strlen(trim($_POST['user_Password']))<6){
            $err_msg .="Password length should be minimum 6.<br>";
        }
        if(!empty(trim($_POST['user_Password'])) && !empty(trim($_POST['user_Confirm_Password'])) && trim($_POST['user_Password'])!=trim($_POST['user_Confirm_Password'])){
            $err_msg .="Password does not match.<br>";
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
            $user_Password=wp_strip_all_tags(trim(esc_sql($_POST['user_Password'])));
            
            $user_Registered_Date_Time=date('Y/d/m H:i:s');
            
            $la_user_data = array (
                
                "user_login" =>trim(preg_replace('/\s+/', '',$user_First_Name)).'_'.time(),
                "user_email" =>$user_Email_Address,
                "nickname"  =>  $user_First_Name,
                "user_nicename"  =>  $user_First_Name,
                "display_name"=>$user_First_Name,
                "first_name" => $user_First_Name,
                "last_name" => $user_Last_Name,
                "user_pass" =>$user_Password,
                "user_registered" => date ( "Y-m-d H:i:s", time () ),
                "show_admin_bar_front"=>false,
                
                "role" =>'onelifepassport_member'
            );
            
            $user_id = wp_insert_user ( $la_user_data );
            
            if (! is_wp_error ( $user_id )) {
                
                
                do
                
                {
                    
                    $ls_activation_key = wp_generate_password ( 25, false, false );
                    
                    $args = array (
                        
                        'search' => $ls_activation_key,
                        
                        'search_columns' => array (
                            'activation_key'
                        ),
                        
                        'role' => get_option('default_role')
                    );
                    
                    $user_query = new WP_User_Query ( $args );
                } while ( ! empty ( $user_query->results ) );
                
                update_user_meta($user_id, "user_activation_status", 0);
                
                update_user_meta($user_id, "activation_key", $ls_activation_key);
                
                update_user_meta($user_id, "User_No", $User_No);
                
                update_user_meta($user_id, "Address_1", $user_Address_1);
                update_user_meta($user_id, "Address_2", $user_Address_2);
                update_user_meta($user_id, "Address_3", $user_Address_3);
                update_user_meta($user_id, "Address_4", $user_Address_4);
                update_user_meta($user_id, "Post_Code", $user_Post_Code);
                update_user_meta($user_id, "Phone_Number", $user_Phone_Number);
                update_user_meta($user_id, "Mobile_Number", $user_Mobile_Number);
                update_user_meta($user_id, "Date_Started", $user_Date_Started);
                update_user_meta($user_id, "Date_Record_Added", $user_Date_Record_Added);
                
                update_user_meta($user_id, "Registered_IP", onelife_get_the_user_ip());
              
                
                if($onelife_user_email_setting==1 && $user_id){
                
                wp_safe_redirect(admin_url('admin.php?page=onelife-user-manage'));
                exit();
                
                }
                
            } else {
                
                $err_msg .= $user_id->get_error_message ();
            }
            
            
        }
        
        
    }
    ?>
    
    <div class="container">
	<div class="bodycontent">
		<div class="row">

			<div class="col-sm-12 imageback">
				<h1>User Sign Up</h1>
				<div class="col-sm-12 ">
					<div class="login-plate">
						<div class="whiteplate">
							<div class="formholder">
						<form method="post" role="form"  autocomplete="off"
			action="" id="onelife-user-form">

			<div class="form-header">
				

				<div class="pull-right">
					<h3 class="form-title">
						<span class="glyphicon glyphicon-pencil"></span>
					</h3>
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
								class="form-control validate[required, minSize[1], maxSize[10], custom[onlyLetterNumber]]" placeholder="User No" value="<?php if(isset($_POST['User_No'])) {echo $_POST['User_No'];}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user" aria-hidden="true"></i>

							</div>
							<input name="user_First_Name" type="text"
								class="form-control validate[required, custom[onlyLetterSp]]" placeholder="First Name" value="<?php if(isset($_POST['user_First_Name'])) {echo $_POST['user_First_Name'];}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user" aria-hidden="true"></i>

							</div>
							<input name="user_Last_Name" type="text"
								class="form-control validate[required, custom[onlyLetterSp]]" placeholder="Last Name" value="<?php if(isset($_POST['user_Last_Name'])) {echo $_POST['user_Last_Name'];}?>">
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
							
								<textarea maxlength="200" class="form-control validate[maxSize[200]]" name="user_Address_1" placeholder="Address 1"><?php if(isset($_POST['user_Address_1'])) {echo $_POST['user_Address_1'];}?></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-address-book" aria-hidden="true"></i>

							</div>
							<textarea maxlength="200" class="form-control validate[ maxSize[200]]" name="user_Address_2" placeholder="Address 2"><?php if(isset($_POST['user_Address_2'])) {echo $_POST['user_Address_2'];}?></textarea>
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
							
								<textarea maxlength="200" class="form-control validate[ maxSize[200]]" name="user_Address_3" placeholder="Address 3"><?php if(isset($_POST['user_Address_3'])) {echo $_POST['user_Address_3'];}?></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-address-book" aria-hidden="true"></i>
							</div>
							<textarea maxlength="200" class="form-control validate[maxSize[200]]"  name="user_Address_4" placeholder="Address 4"><?php if(isset($_POST['user_Address_4'])) {echo $_POST['user_Address_4'];}?></textarea>
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
								class="form-control validate[minSize[3], maxSize[8]]"  placeholder="Post Code" value="<?php if(isset($_POST['user_Post_Code'])) {echo $_POST['user_Post_Code'];}?>" >
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-phone-square" aria-hidden="true"></i>

							</div>
							<input name="user_Phone_Number" type="text" minlength="8" maxlength="16"
								class="form-control validate[minSize[8], maxSize[16], custom[onlyNumberSp]]" placeholder="Phone Number" value="<?php if(isset($_POST['user_Phone_Number'])) {echo $_POST['user_Phone_Number'];}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-mobile " aria-hidden="true"></i>

							</div>
							<input name="user_Mobile_Number" type="text" minlength="8" maxlength="16"
								class="form-control validate[minSize[8], maxSize[16], custom[onlyNumberSp]]" placeholder="Mobile Number" value="<?php if(isset($_POST['user_Mobile_Number'])) {echo $_POST['user_Mobile_Number'];}?>" >
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
								class="form-control validate[required, custom[email]]" placeholder="Email" value="<?php if(isset($_POST['user_Email_Address'])) {echo $_POST['user_Email_Address'];}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar" aria-hidden="true"></i>

							</div>
							<input name="user_Date_Started" type="text" id="user_date_started" min="2011-01-01"
								class="form-control text-input datepicker" placeholder="Date Started" value="<?php if(isset($_POST['user_Date_Started'])) {echo $_POST['user_Date_Started'];}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-4">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar" aria-hidden="true"></i>

							</div>
							
							<input name="user_Date_Record_Added" type="text" min="2011-01-01"
								class="form-control text-input datepicker" id="user_date_record_added" placeholder="Date Record Added" value="<?php if(isset($_POST['user_Date_Record_Added'])) {echo $_POST['user_Date_Record_Added'];}?>">
						</div>
						<span class="help-block" id="error"></span>
					</div>

				</div>
				
				<div class="row">

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-lock" aria-hidden="true"></i>


							</div>
							<input name="user_Password" type="password" 
								class="form-control validate[required, minSize[6],maxSize[50]]" id="user_Password" placeholder="Password" value="<?php if(isset($_POST['user_Password'])) {echo $_POST['user_Password'];}?>" autocomplete="off">
						</div>
						<span class="help-block" id="error"></span>
					</div>

					<div class="form-group col-lg-6">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-lock" aria-hidden="true"></i>


							</div>
							
							<input name="user_Confirm_Password" type="password"
								class="form-control validate[required, equals[user_Password]]" id="user_Confirm_Password" placeholder="Confirm Password" value="<?php if(isset($_POST['user_Confirm_Password'])) {echo $_POST['user_Confirm_Password'];}?>" autocomplete="off">
						</div>
						<span class="help-block" id="error"></span>
					</div>

				</div>


			</div>

			<div class="form-footer">
				<button type="submit" name="user_submit" class="btn btn-info">
					<span class="glyphicon glyphicon-log-in"></span> Submit
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