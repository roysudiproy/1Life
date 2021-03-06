<?php 
global $wpdb;

$table_organization=$wpdb->prefix.'organisations';

$insert_org="";
$err_msg="";
$suc_msg="";

$organisation_name="";
$address1="";
$address2="";
$town="";
$county="";
$postcode="";
$phone="";
$emergency_phone1="";
$emergency_phone2="";
$email="";
$notes="";
$loadkey="0";
$temp_contact="0";
$registered_datetime="";
$registered_ip="";

$exists_Org_Email="";

if(isset($_POST['submit_add_org'])){
    
    
    if(empty(trim($_POST['organisation_name']))){
        $err_msg .="Please Enter Organisation Name.<br>";
        
    }
    
    if(empty(trim($_POST['address1']))){
        $err_msg .="Please Enter Your Address.<br>";
        
    }
    
    if(empty(trim($_POST['town']))){
        $err_msg .="Please Enter Town Name.<br>";
        
    }
    
    if(empty(trim($_POST['county']))){
      //  $err_msg .="Please Enter County Name.<br>";
        
    }
   
    if(empty(trim($_POST['phone']))){
        $err_msg .="Please Enter Phone Number.<br>";
        
    }
    if(empty(trim($_POST['email']))){
        $err_msg .="Please Enter Your Email Address.<br>";
        
    }
    
    if(isset($_POST['email']) && !is_email($_POST['email'])){
        
        $err_msg .="Email Address Invalid.<br>";
    }
    

    
    if($err_msg==""){
        
        $organisation_name=wp_strip_all_tags(trim($_POST['organisation_name']));
        $address1=wp_strip_all_tags(trim(stripslashes_deep($_POST['address1'])));
        $address2=wp_strip_all_tags(trim(stripslashes_deep($_POST['address2'])));
        $town=wp_strip_all_tags(trim($_POST['town']));
        $county=wp_strip_all_tags(trim($_POST['county']));
        $postcode=wp_strip_all_tags(trim($_POST['postcode']));
        $phone=wp_strip_all_tags(trim($_POST['phone']));
        $emergency_phone1=wp_strip_all_tags(trim($_POST['emergency_phone1']));
        $emergency_phone2=wp_strip_all_tags(trim($_POST['emergency_phone2']));
        $email=wp_strip_all_tags(trim($_POST['email']));
        $notes=wp_strip_all_tags(trim(stripslashes_deep($_POST['notes'])));
        $loadkey="0";
        $temp_contact="0";
        $registered_datetime=current_time( 'timestamp' ) ;
        $registered_ip=onelife_get_the_user_ip();
        
        
        $insert_org= $wpdb->insert(
            $table_organization,
            array(
                'organisation_name' => $organisation_name,
                'user_id'=>$user_id,
                'address1' => $address1,
                'address2'=>$address2,
                'town'=>$town,
                'county'=>$county,
                'postcode'=>$postcode,
                'phone'=>$phone,
                'emergency_phone1'=>$emergency_phone1,
                'emergency_phone2'=>$emergency_phone2,
                'email'=>$email,
                'notes'=>$notes,
                'loadkey'=>$loadkey,
                'temp_contact'=>$temp_contact,
                'registered_datetime'=>$registered_datetime,
                'registered_ip'=>$registered_ip,
                
                
                
            ),
            array(
                '%s',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%d',
                '%s',
                '%s',
                
            )
            );
        
        if($insert_org){
            
            $suc_msg .="Successfully added Organization";
            $_SESSION['insert_org_message']=$suc_msg;
            wp_safe_redirect(get_permalink());
            exit();
            
        }else{
            
            $err_msg .=$wpdb->show_errors;
        }
        
        
    }
    
}
?>
	<div class="col-sm-9">
				<h1>Add New Organisation</h1>
					<div class="fullwidth">						
							<div class="formholder">
							<?php 
							if(isset($err_msg) && $err_msg!=""){
							    
							    echo '<div class="cs-form-err">'.$err_msg.'</div>';
    
							}
							?>
								<form id="cs-org-form" name="signup" action="" method="POST">
									<div class="form-body">
										<div class="row">
											<div class="form-group col-lg-12">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-pencil" aria-hidden="true"></i>
													</div>
													<input name="organisation_name" type="text"
														class="form-control validate[required]"
														placeholder="Organisation Name"  value="<?php if(isset($_POST['organisation_name'])) { echo $_POST['organisation_name'];}?>" >
												</div>
												<span class="help-block" id="error"></span>
											</div>
											
										</div>
										<div class="row">
    										<div class="form-group col-lg-6">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-envelope" aria-hidden="true"></i>
    													</div>    													
    														<textarea placeholder="Address1" name="address1" class="form-control validate[ maxSize[200]"><?php if(isset($_POST['address1'])) { echo $_POST['address1'];}?></textarea>
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-6">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-envelope" aria-hidden="true"></i>
    													</div>    													
    														<textarea placeholder="Address2" name="address2" class="form-control validate[ maxSize[200]"><?php if(isset($_POST['address2'])) { echo $_POST['address2'];}?></textarea>
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>										
										</div>
										
										<div class="row">
    										<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-map-marker" aria-hidden="true"></i>
    													</div>    													
    														<input name="town" type="text"
														class="form-control validate[required]"
														placeholder="Town"  value="<?php if(isset($_POST['town'])) { echo $_POST['town'];}?>" >
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-globe" aria-hidden="true"></i>
    													</div>    													
    														<input name="county" type="text"
														class="form-control"
														placeholder="County"  value="<?php if(isset($_POST['county'])) { echo $_POST['county'];}?>" >
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-map-pin" aria-hidden="true"></i>
    													</div>    													
    														<input name="postcode" type="text"
														
														placeholder="Post code" minlength="3" maxlength="8" class="form-control validate[minSize[3], maxSize[8]]"  value="<?php if(isset($_POST['postcode'])) { echo $_POST['postcode'];}?>" >
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>										
										</div>
										
										<div class="row">
    										<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-map-marker" aria-hidden="true"></i>
    													</div>    													
    														<input name="phone" type="text"
														
														placeholder="Phone Number" minlength="8" maxlength="16" class="form-control validate[minSize[8], maxSize[16], custom[onlyNumberSp]]" value="<?php if(isset($_POST['phone'])) { echo $_POST['phone'];}?>" >
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-globe" aria-hidden="true"></i>
    													</div>    													
    														<input name="emergency_phone1" type="text"
													
														placeholder="Emergency Phone1" minlength="8" maxlength="16" class="form-control validate[minSize[8], maxSize[16], custom[onlyNumberSp]]" value="<?php if(isset($_POST['emergency_phone1'])) { echo $_POST['emergency_phone1'];}?>" >
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-map-pin" aria-hidden="true"></i>
    													</div>    													
    														<input name="emergency_phone2" type="text"
													
														placeholder="Emergency Phone2" minlength="8" maxlength="16" class="form-control validate[minSize[8], maxSize[16], custom[onlyNumberSp]]"  value="<?php if(isset($_POST['emergency_phone2'])) { echo $_POST['emergency_phone2'];}?>" >
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>										
										</div>
										
										<div class="row">
											<div class="form-group col-lg-12">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-pencil" aria-hidden="true"></i>
													</div>
													<input name="email" type="email"
													
														placeholder="Email Address" class="form-control validate[required, custom[email]]" value="<?php if(isset($_POST['email'])) { echo $_POST['email'];}?>" >
												</div>
												<span class="help-block" id="error"></span>
											</div>
											
										</div>
										
										<div class="row">
											<div class="form-group col-lg-12">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</div>
													<textarea placeholder="Notes" name="notes" class="form-control validate[ maxSize[200]"><?php if(isset($_POST['notes'])) { echo $_POST['notes'];}?></textarea>
												</div>
												<span class="help-block" id="error"></span>
											</div>
											
										</div>
										
									</div>

									<div class="form-footer">									
										<div class="buttonholder">											
											<input type="submit" class="cs-button-left" name="submit_add_org" value="Add" >										</div>
									</div>
								</form>
							</div>
						</div>					
				</div>