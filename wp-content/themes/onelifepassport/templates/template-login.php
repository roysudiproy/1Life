<?php
/*
 * Template Name: Login
 */
error_reporting(E_ALL & ~E_NOTICE);
$roles="";
if(is_user_logged_in()){
    $user_id=get_current_user_id();
    $roles=onelife__get_user_role($user_id);
    
    if($roles=='onelifepassport_member'){
        
        wp_safe_redirect(site_url().'/contacts/');
        exit;
    }else{
        wp_safe_redirect(site_url().'/information');
        exit;
        
    }
    
}



$onelife_staff_dashboard_page="";
$err_msg="";
$suc_msg="";

$onelife_recaptcha_site_key="";
$onelife_recaptcha_secret_key="";

$onelife_recaptcha_site_key=get_option('onelife_google_site_key');
$onelife_recaptcha_secret_key=get_option('onelife_google_secret_key');
if($onelife_recaptcha_site_key=="" || $onelife_recaptcha_secret_key==""){
    
    $err_msg .="Please set up your google recaptcha site/secret key";
}
    
    

$onelife_staff_dashboard_page='user-dashboard';

if(is_user_logged_in()){
    $onelife_user_role= onelife__get_user_role();
    if($onelife_user_role=='onelife_staff' && $onelife_staff_dashboard_page!=""){
        
        wp_safe_redirect(get_permalink($onelife_staff_dashboard_page));
        exit();
    }else{
        wp_safe_redirect(site_url());
        exit();
    }
}


if(isset($_POST['onelife_login_submit'])){
    // validate required fields
    
    
    if (trim($_POST['onelife_user_email'])== "") {
        
        $err_msg .= "Email can not be blank.<br/>";
    }
    
    if ($_POST ['onelife_user_email']!="" && !is_email($_POST ['onelife_user_email'])) {
        
        $err_msg .= "Please enter a valid email.<br/>";
    }
    
    
    
    if (trim ( $_POST ['onelife_user_password'] ) == "") {
        
        $err_msg .= "Password can not be blank.<br/>";
    }
    
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //your site secret key
        $secret = $onelife_recaptcha_secret_key;
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse, true   );
        
        if($responseData["success"] != 1){
            $err_msg .="Robot verification failed, please try again.<br>";
        }
    }else{
        
        $err_msg .='Please click on the reCAPTCHA box.<br>';
    }
    
    if ($err_msg == "") {
        
        $user_onelife_user_email=(esc_sql(sanitize_text_field($_POST ['onelife_user_email'])));
        
        $onelife_user_password=(esc_sql(sanitize_text_field($_POST ['onelife_user_password'])));
        $remember=($_REQUEST['remember']);
        if($remember) $remember = "true";
        else $remember = "false";
        
        
        
        
        $login_data = array();
        $login_data['user_login'] = $user_onelife_user_email;
        $login_data['user_password'] = $onelife_user_password;
        $login_data['remember'] = false;
        
        $user_verify = wp_signon( $login_data, true );
        
        
        
        if ( is_wp_error($user_verify) )
        {
            //header("Location: " . home_url() . "/login/error/");
            // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.
            
            $err_msg .='Invalid Email address or Password';
        } else {
            wp_safe_redirect(site_url().'/contacts/');
            exit();
        }
        
        
    }
    
    
}
get_header();
?>

<div class="container">
	<div class="bodycontent">
		<div class="row">

			<div class="col-sm-12 imageback">
				<h1>Secure Login</h1>
				<div class="col-sm-12 ">
					<div class="login-plate">
						<div class="whiteplate">
							<div class="formholder">
							<?php 
							if($err_msg!=""){
							    
							    echo '<div class="cs-form-err">'.$err_msg.'</div>';
    
							}
							?>
								<form id="cs-form-login" name="login" action="" method="POST">
									<div class="formfieldholder">
										<input type="email" name="onelife_user_email" id="onelife_user_email" class="validate[required, custom[email]]"
											placeholder="Email" />
										<div class="icondiv">
											<img
												src="<?php echo get_template_directory_uri(); ?>/images/user.png"
												alt="icon" />
										</div>
									</div>

									<div class="formfieldholder">
										<input type="password" name="onelife_user_password" id="pass"
											placeholder="Password" class="validate[required]"/>
										<div class="icondiv">
											<img
												src="<?php echo get_template_directory_uri(); ?>/images/pass.png"
												alt="icon" />
										</div>
									</div>	
									
									<div class="formfieldholder">
										<div class="input-group">
    												
    													<div class="g-recaptcha" data-sitekey="<?php echo $onelife_recaptcha_site_key;?>"></div>
    												</div>
										
									</div>
									
									<div class="form-footer">
										<div class="buttonholder">						
											
											<input type="submit" class="cs-button-left" name="onelife_login_submit"
												value="sign in" />
										</div>
										<!-- <div class="buttonholder">											
											<a href="<?php echo site_url();?>/sign-up/" class="cs-button-right" >Sign Up</a>
										</div> -->
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