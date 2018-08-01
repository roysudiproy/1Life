<?php
/*
 * Template Name: Sign Up
 */
$roles="";
require_once(ABSPATH.'wp-admin/includes/user.php');
if(is_user_logged_in()){
    $user_id=get_current_user_id();
   // $roles=onelifepassport__get_user_role($user_id);
    
    if($roles=='onelifepassport_member'){
        
       // wp_safe_redirect(site_url().'/member-dashboard');
       // exit;
    }else{
       // wp_safe_redirect(site_url().'/information');
       // exit;
        
    }
    
}

$err_msg="";
$suc_msg="";
$member_login_url=site_url().'/login/';

if(isset($_POST['add_member'])){
    
    $member_first_name="";
    $member_last_name="";
    $member_email="";
    $member_password="";
    
    
    
    
    if(empty(trim($_POST['member_first_name']))){
        $err_msg .="Please enter the first name.<br>";
    }
    if(empty(trim($_POST['member_last_name']))){
        $err_msg .="Please enter the last name.<br>";
    }
       
    if(empty(trim($_POST['member_email']))){
        $err_msg .="Please enter the email address.<br>";
    }
    
    if(!empty(trim($_POST['member_email'])) && !is_email(trim($_POST['member_email']))){
        $err_msg .="Please enter valid email address.<br>";
    }
    
    
    if ( isset($_POST['member_email']) && filter_var($_POST['member_email'], FILTER_VALIDATE_EMAIL) ) {
        
        if ( email_exists($_POST['member_email']) ) {
         //   $exist_user= get_user_by('email', $_POST['member_email']);
            
            
            $roles=onelife__get_user_role($exist_user->ID);
            if(!$roles){
                $roles="User";
            }
            $err_msg .="Duplicate Email, This email address is already used for another <strong>".$roles."</strong>.<br>";
        }
        
    }
   
    if(empty(trim($_POST['member_password']))){
        $err_msg .="Please enter the staff Password.<br>";
    }
    
    if(empty(trim($_POST['member_confirm_password']))){
        $err_msg .="Please enter the Confirm Password.<br>";
    }
    if(!empty(trim($_POST['member_password'])) && strlen(trim($_POST['member_password']))<6){
        $err_msg .="Password length should be minimum 6.<br>";
    }
    if(!empty(trim($_POST['member_password'])) && !empty(trim($_POST['member_confirm_password'])) && trim($_POST['member_password'])!=trim($_POST['member_confirm_password'])){
        $err_msg .="Password does not match.<br>";
    }
    
    
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //your site secret key
             // $secret = $simsof_recaptcha_secret_key;
       
        $secret = '6Lc3bEsUAAAAABrjfcZH9ddWHyz_KzoFWkEWzQu5';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse, true   );
        
        if($responseData["success"] != 1){
            $err_msg .="Robot verification failed, please try again.<br>";
        }
    }else{
        
        $err_msg .='Please click on the reCAPTCHA box.<br>';
    }
    
    
    if(empty($err_msg)){   
        
        $member_first_name=wp_strip_all_tags(trim(esc_sql($_POST['member_first_name'])));
        $member_last_name=wp_strip_all_tags(trim(esc_sql($_POST['member_last_name'])));
        $member_email=wp_strip_all_tags(trim(esc_sql($_POST['member_email'])));
        $member_password=wp_strip_all_tags(trim(esc_sql($_POST['member_password']))); 
        
        $la_user_data = array (
            
            "user_login" =>trim(preg_replace('/\s+/', '',$member_first_name)).'_'.time(),
            "user_email" =>$member_email,
            "nickname"  =>  $member_first_name,
            "user_nicename"  =>  $member_first_name,
            "display_name"=>$member_first_name,
            "first_name" => $member_first_name,
            "last_name" => $member_last_name,
            "user_pass" =>$member_password,
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
            
            update_user_meta($user_id, "Registered_IP", onelifepassport_get_the_user_ip());
            
            
            $ls_from_email = get_option ( 'nelifepassport_email_from' );
            
            if ($ls_from_email == "") {
                
                $ls_from_email = get_option ( 'admin_email' );
            }
            
            $ls_from_name = get_option ( 'nelifepassport_email_form_name' );
            
            if ($ls_from_name == "") {
                
                $ls_from_name = get_option ( 'blogname' );
            }
            
           
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            $subject = get_option ( 'nelifepassport_email_subject' );
            
            if ($subject == "") {
                
                $subject = "Welcome Email";
            }
                   
            
           
                
                $ls_mail_content = "<html><body><p>Your Account has been created, Here is your login details below: <br> <br> Email: ".$member_email." <br> Password:".$member_password." <br></p></body></html>";
                
                
                wp_mail('sudip.brainium@gmail.com', 'Hi', 'Hello');
                echo $member_email.'<br>';
                echo $subject.'<br>';
                echo $ls_mail_content.'<br>';
                echo $headers.'<br>';
              
            
                if(wp_mail ( strtolower($member_email), $subject, $ls_mail_content, $headers )){
                    wp_new_user_notification($user_id);
                  
                    $suc_msg .="Successfully Added New Member, Click <a href='".$member_login_url."'><strong>here</strong></a> to got to Staff List";
                    wp_safe_redirect($member_login_url);
                    exit();
                    
                    
                }else{
                    $err_msg .="Email service not working, contact to your hosting support.";
                    if($user_id):
                    
                    wp_delete_user($user_id);
                   
                    endif;
                    
                }
            
            
        } else {
            
            $err_msg .= $user_id->get_error_message ();
        }
        
        
    }
    
    
}



get_header();
?>

<div class="container">
	<div class="bodycontent">
		<div class="row">

			<div class="col-sm-12 imageback">
				<h1>Member Sign Up</h1>
				<div class="col-sm-12 ">
					<div class="login-plate">
						<div class="whiteplate">
							<div class="formholder">
							<?php 
							if($err_msg!=""){
							    
							    echo '<div class="cs-form-err">'.$err_msg.'</div>';
    
							}
							?>
								<form id="cs-signip" name="signup" action="" method="POST">
									<div class="form-body">
										<div class="row">
											<div class="form-group col-lg-6">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-pencil" aria-hidden="true"></i>
													</div>
													<input name="member_first_name" type="text"
														class="form-control validate[required]"
														placeholder="First Name" class="validate[required]" value="<?php if(isset($_POST['member_first_name'])) { echo $_POST['member_first_name'];}?>" data-validation="required">
												</div>
												<span class="help-block" id="error"></span>
											</div>
											<div class="form-group col-lg-6">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-pencil" aria-hidden="true"></i>
													</div>
													<input name="member_last_name" type="text"
														class="form-control validate[required]"
														placeholder="Last Name" class="validate[required]" value="<?php if(isset($_POST['member_last_name'])) { echo $_POST['member_last_name'];}?>">
												</div>
												<span class="help-block" id="error"></span>
											</div>
										</div>
										<div class="row">
    										<div class="form-group col-lg-12">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-envelope" aria-hidden="true"></i>
    													</div>
    													<input name="member_email" type="email"
    														class="form-control validate[required]"
    														placeholder="Email" class="validate[required, custom[email]]" value="<?php if(isset($_POST['member_email'])) { echo $_POST['member_email'];}?>">
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>										
										</div>
										
										<div class="row">
											<div class="form-group col-lg-6">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-key" aria-hidden="true"></i>
													</div>
													<input name="member_password" type="password" 
														class="form-control validate[required]"
														placeholder="Password" id="member_password" value="<?php if(isset($_POST['member_password'])) { echo $_POST['member_password'];}?>">
												</div>
												<span class="help-block" id="error"></span>
											</div>
											<div class="form-group col-lg-6">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-key" aria-hidden="true"></i>
													</div>
													<input name="member_confirm_password" type="password"
														class="form-control validate[required,equals[member_password]]"
														placeholder="Confirm Password" value="<?php if(isset($_POST['member_confirm_password'])) { echo $_POST['member_confirm_password'];}?>">
												</div>
												<span class="help-block" id="error"></span>
											</div>
										</div>
										
										<div class="row">
    										<div class="form-group col-lg-12">
    												<div class="input-group">
    												
    													<div class="g-recaptcha" data-sitekey="6Lc3bEsUAAAAANqa9qte6Kth5eALxBATBleVGnt3"></div>
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>										
										</div>
										
										
									</div>

									<div class="form-footer">
										<div class="buttonholder">						
											
											<input type="submit" class="cs-button-left" name="add_member"
												value="Sign Up" />
										</div>
										<div class="buttonholder">											
											<a href="<?php echo site_url();?>/login/" class="cs-button-right" >Sign In</a>
										</div>
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

<?php get_footer(); ?>