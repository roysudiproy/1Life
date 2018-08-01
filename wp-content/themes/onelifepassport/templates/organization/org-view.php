<?php
global $wpdb;

$table_organization=$wpdb->prefix.'organisations';
$action="";
$org_id="";
$get_Org="";
$update_org=false;

if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
}
if(isset($_REQUEST['org-id'])){
    $org_id=$_REQUEST['org-id'];
}

$redirect=false;
if($action!="view" && $org_id==""){
    $redirect=true;
}

if($org_id){
    
    $get_Org = $wpdb->get_row( "SELECT * FROM $table_organization WHERE organisation_id = $org_id",'OBJECT' );
    
    
    if (empty($get_Org)) {
        $redirect=true;
    }
}



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
        $err_msg .="Please Enter County Name.<br>";
        
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
    
    if ( isset($_POST['email']) && filter_var($_POST['email']) ) {
        
        
        $exists_Service_No = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_organization WHERE email = %s AND email!=%s", $_POST['email'], $get_Org->email
            ) );
        
        if ( $exists_Service_No ) {
            $err_msg .="Duplicate Email address.<br>";
        }
        
    }
    
    if($err_msg==""){
        
        $organisation_name=wp_strip_all_tags(trim($_POST['organisation_name']));
        $address1=wp_strip_all_tags(trim($_POST['address1']));
        $address2=wp_strip_all_tags(trim($_POST['address2']));
        $town=wp_strip_all_tags(trim($_POST['town']));
        $county=wp_strip_all_tags(trim($_POST['county']));
        $postcode=wp_strip_all_tags(trim($_POST['postcode']));
        $phone=wp_strip_all_tags(trim($_POST['phone']));
        $emergency_phone1=wp_strip_all_tags(trim($_POST['emergency_phone1']));
        $emergency_phone2=wp_strip_all_tags(trim($_POST['emergency_phone2']));
        $email=wp_strip_all_tags(trim($_POST['email']));
        $notes=wp_strip_all_tags(trim($_POST['notes']));
        $loadkey="0";
        $temp_contact="0";
        $registered_datetime=current_time( 'timestamp' ) ;
        $registered_ip=onelife_get_the_user_ip();
        
        
        if($wpdb->update(
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
                
                
                
                
            ),
            array( 'organisation_id' => $get_Org->organisation_id ),
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
                
                
                
            ),
            array( '%d' )
            )==false){
                $err_msg .=  $update_org;
                $suc_msg="";
                
            }else{
                wp_safe_redirect(get_permalink());
                exit();
                $suc_msg .="Successfully Updated";
            }
            
            
            
            
    }
    
}
?>
	<div class="col-sm-9">
				<h1>View Organisation</h1>
					<div class="fullwidth">						
							<div class="formholder">
							<?php 
							if(isset($err_msg) && $err_msg!=""){
							    
							    echo '<div class="cs-form-err">'.$err_msg.'</div>';
    
							}
							?>
								
									<div class="form-body cs-view-org">
										<div class="row">
											<div class="form-group col-lg-12">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-pencil" aria-hidden="true"></i>
														
													</div>
													<label>Organisation Name</label>
													<p><?php if(isset($get_Org->organisation_name)) { echo $get_Org->organisation_name;}?></p>
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
    														<label>Address 1</label>
    													<p><?php if(isset($get_Org->address1)) { echo $get_Org->address1;}?></p> 													
    														
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-6">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-envelope" aria-hidden="true"></i>    														
    													</div>    											
    													<label>Address 2</label>		
    														<p><?php if(isset($get_Org->address1)) { echo $get_Org->address1;}?></p> 	
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
    													<label>Town</label>		
    													
    													<p><?php if(isset($get_Org->town)) { echo $get_Org->town;}?></p> 													
    														
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-globe" aria-hidden="true"></i>
    													</div>    
    													<label>County</label>	
    													
    													<p><?php if(isset($get_Org->county)) { echo $get_Org->county;}?></p> 													
    													
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-map-pin" aria-hidden="true"></i>
    													</div>  
    													<label>Post Code</label>	 
    													
    													<p><?php if(isset($get_Org->postcode)) { echo $get_Org->postcode;}?></p>  													
    														
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
    													<label>Phone</label>
    													
    													<p><?php if(isset($get_Org->phone)) { echo $get_Org->phone;}?></p>
    														  													
    													
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-globe" aria-hidden="true"></i>
    													</div>  
    													<label>Emergency Phone 1</label>	
    													
    													<p><?php if(isset($get_Org->emergency_phone1)) { echo $get_Org->emergency_phone1;}?></p>  													  													
    														
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-lg-4">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-map-pin" aria-hidden="true"></i>
    													</div>   
    													<label>Emergency Phone 2</label>	 													
    														<p><?php if(isset($get_Org->emergency_phone2)) { echo $get_Org->emergency_phone2;}?></p>
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
													<label>Email</label>	
													<p><?php if(isset($get_Org->email)) { echo $get_Org->email;}?></p>
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
													<label>Notes</label>	
													<p><?php if(isset($get_Org->notes)) { echo $get_Org->notes;}?></p>
													
												</div>
												<span class="help-block" id="error"></span>
											</div>
											
										</div>
										
									</div>

									
						
							</div>
						</div>					
				</div>