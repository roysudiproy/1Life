<?php
global $wpdb;

$table_contacts=$wpdb->prefix.'contacts';
$action="";
$cont_id="";
$get_Cont="";
$update_org=false;


if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
}
if(isset($_REQUEST['cont-id'])){
    $cont_id=$_REQUEST['cont-id'];
}

$redirect=false;
if($action!="view" && $cont_id==""){
    $redirect=true;
}

if($cont_id){
    
    $get_Cont = $wpdb->get_row( "SELECT * FROM $table_contacts WHERE contact_id = $cont_id",'OBJECT' );
    
    
    if (empty($get_Cont)) {
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

?>
	<div class="col-sm-9">
				<h1>View Contact</h1>
					<div class="fullwidth">						
							<div class="formholder">
							<?php 
							if(isset($err_msg) && $err_msg!=""){
							    
							    echo '<div class="cs-form-err">'.$err_msg.'</div>';
    
							}
							?>
								
									<div class="form-body cs-view-cont">
										<div class="row">
											<div class="form-group col-md-6">
												<div class="input-group">													
													<label>First Name</label>
													<p> <?php if(isset($get_Cont->first_name)) { echo $get_Cont->first_name;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-6">
												<div class="input-group">													
													<label>Surname</label>
													<p> <?php if(isset($get_Cont->surname)) { echo $get_Cont->surname;}?></p>
												</div>												
											</div>
											
											<!-- <div class="form-group col-md-4">
												<div class="input-group">													
													<label>Position</label>
													<p><?php if(isset($get_Cont->position)) { echo $get_Cont->position;}?></p>
												</div>												
											</div> -->
											
										</div>
										
										<div class="row">
    										<div class="form-group col-md-6">
    												<div class="input-group">    													
    														<label>Use Organisation Address</label>
    													<p> <?php if(isset($get_Cont->use_org_address)) { if($get_Cont->use_org_address==1){ echo 'Yes';}else{ echo 'No';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-6">
    												<div class="input-group">    													
    														<label>Organisation Name</label>
    													<p> <?php if(isset($get_Cont->organisation_id)) { if($get_Cont->organisation_id!=0){ echo get_organisation_name_from_id($get_Cont->organisation_id);}}?></p> 													
    														
    												</div>    												
    											</div>							
										</div>
										
										<div class="row">
    										<div class="form-group col-md-6">
    												<div class="input-group">    													
    														<label>Address-1</label>
    													<p> <?php if(isset($get_Cont->use_org_address)) { echo $get_Cont->address1;}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-6">
    												<div class="input-group">    													
    														<label>Address-2</label>
    													<p> <?php if(isset($get_Cont->organisation_id)) {echo $get_Cont->address2;}?></p> 													
    														
    												</div>    												
    											</div>							
										</div>
										
										
										
										<div class="row">
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Town</label>
													<p> <?php if(isset($get_Cont->town)) { echo $get_Cont->town;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>County</label>
													<p> <?php if(isset($get_Cont->county)) { echo $get_Cont->county;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Postcode</label>
													<p> <?php if(isset($get_Cont->postcode)) { echo $get_Cont->postcode;}?></p>
												</div>												
											</div>
											
										</div>
										
										<div class="row">
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Phone</label>
													<p> <?php if(isset($get_Cont->phone)) { echo $get_Cont->phone;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Mobile</label>
													<p><?php if(isset($get_Cont->mobile)) { echo $get_Cont->mobile;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Emergency Phone-1</label>
													<p> <?php if(isset($get_Cont->emergency_phone1)) { echo $get_Cont->emergency_phone1;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Emergency Phone-2</label>
													<p> <?php if(isset($get_Cont->emergency_phone2)) { echo $get_Cont->emergency_phone2;}?></p>
												</div>												
											</div>
											
										</div>
										
										<div class="row">
											<div class="form-group col-md-6">
												<div class="input-group">													
													<label>Email</label>
													<p> <?php if(isset($get_Cont->email)) { echo $get_Cont->email;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-6">
												<div class="input-group">													
													<label>DOB</label>
													<p> <?php if(isset($get_Cont->dob)) { echo date('d/m/Y', strtotime($get_Cont->dob));}?></p>
												</div>												
											</div>
											</div>
											
											
											<div class="row">
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Email</label>
													<p> <?php if(isset($get_Cont->email)) { echo $get_Cont->email;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>DOB</label>
													<p> <?php if(isset($get_Cont->dob)) { echo date('d/m/Y', strtotime($get_Cont->dob));}?></p>
												</div>												
											</div>
											
																		
											</div>
											
											
											<div class="row">
											<div class="form-group col-md-6">
												<div class="input-group">													
													<label>Notes</label>
													<p> <?php if(isset($get_Cont->notes)) { echo $get_Cont->notes;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-6">
												<div class="input-group">													
													<label>Ethnicity</label>
													<p> <?php if(isset($get_Cont->ethnicity)) { echo $get_Cont->ethnicity;}?></p>
												</div>												
											</div>									
											</div>
											
											
											<div class="row">
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Start Date</label>
													<p> <?php if(isset($get_Cont->start_date) && $get_Cont->start_date!='0000-00-00 00:00:00') { echo date('d/m/Y', strtotime($get_Cont->start_date));}?></p>
												</div>												
											</div>		
											
												<div class="form-group col-md-8">
												<div class="input-group">													
													<label>Interest</label>
													<p> <?php 
													
													//echo $get_Cont->temp_interest;
													if($get_Cont->temp_interest!="") { 
													 
													    $interests_lists=maybe_unserialize($get_Cont->temp_interest);
													    
													    if(!empty($interests_lists) && is_array($interests_lists)){
													        
													        print_r(get_interest_name_from_id_multiple(implode(', ',$interests_lists)));
													    }
													}?></p>
												</div>												
											</div>								
											</div>
										
											<div class="row">
    										<div class="form-group col-md-3">
    												<div class="input-group">    													
    														<label>Social Media</label>
    													<p> <?php if(isset($get_Cont->photo_consent)) { if($get_Cont->photo_consent==1){ echo 'Yes';}else{ echo 'No';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-3">
    												<div class="input-group">    													
    														<label>Press Releases</label>
    													<p> <?php if(isset($get_Cont->photo_consent1)) { if($get_Cont->photo_consent1==1){ echo 'Yes';}else{ echo 'No';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-3">
    												<div class="input-group">    													
    														<label>Our Newsletters</label>
    													<p> <?php if(isset($get_Cont->photo_consent2)) { if($get_Cont->photo_consent2==1){ echo 'Yes';}else{ echo 'No';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-3">
    												<div class="input-group">    													
    														<label>Display Boards</label>
    													<p> <?php if(isset($get_Cont->photo_consent3)) { if($get_Cont->photo_consent3==1){ echo 'Yes';}else{ echo 'No';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    																	
										</div>
										
										
										<div class="row">
    										<div class="form-group col-md-4">
    												<div class="input-group">    													
    														<label>Other websites</label>
    													<p> <?php if(isset($get_Cont->photo_consent4)) { if($get_Cont->photo_consent4==1){ echo 'Yes';}else{ echo 'No';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-4">
    												<div class="input-group">    													
    														<label>Atlanto-axial Instability</label>
    													<p> <?php if(isset($get_Cont->aai)) { if($get_Cont->aai==1){ echo 'N/A';}elseif($get_Cont->aai==2){echo '+VE'; }elseif($get_Cont->aai==3){echo '-VE'; }else{ echo 'No X-Ray';}}?></p> 													
    														
    												</div>    												
    											</div>	
    											
    											<div class="form-group col-md-4">
    												<div class="input-group">    													
    														<label>Photo</label>
    													<p> <?php if($get_Cont->photo):?>
									<div class="cs-cnt-photo"><img alt=""  src="<?php echo content_url().'/uploads/1Life-Photo/'.$get_Cont->photo;?>">
									</div>    <?php endif;?></p> 													
    														
    																								
    											</div>
    																	
										</div>
										
									</div>
									
									
									<div class="row">
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Medical</label>
													<p> <?php if(isset($get_Cont->medical)) { echo $get_Cont->medical;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Member Mobile</label>
													<p> <?php if(isset($get_Cont->member_mobile)) { echo $get_Cont->member_mobile;}?></p>
												</div>												
											</div>	
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Email-2</label>
													<p> <?php if(isset($get_Cont->email2)) { echo $get_Cont->email2;}?></p>
												</div>												
											</div>	
																			
											</div>
											
											
											<div class="row">
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Known Disability</label>
													<p> <?php if(isset($get_Cont->known_disability)) { echo $get_Cont->known_disability;}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Age When Joined</label>
													<p> <?php if(isset($get_Cont->age_when_joined)) { echo $get_Cont->age_when_joined;}?></p>
												</div>												
											</div>	
											
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Medical Forms Sent</label>
													<p> <?php if(isset($get_Cont->medical_forms_sent) && $get_Cont->medical_forms_sent!='0000-00-00 00:00:00') { echo date('d/m/Y', strtotime($get_Cont->medical_forms_sent));}?></p>
												</div>												
											</div>	
											
											<div class="form-group col-md-3">
												<div class="input-group">													
													<label>Medical Forms Received</label>
													<p> <?php if(isset($get_Cont->medical_forms_received) && $get_Cont->medical_forms_received!='0000-00-00 00:00:00') { echo date('d/m/Y', strtotime($get_Cont->medical_forms_received));}?></p>
												</div>												
											</div>
																			
											</div>
											
											<div class="row">
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Photo Received</label>
													<p> <?php if(isset($get_Cont->photo_received)) { if($get_Cont->photo_received==1){echo 'Yes';}else{ echo 'No';}}?></p>
												</div>												
											</div>
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Esendex</label>
													<p> <?php if(isset($get_Cont->Esendex)) {  if($get_Cont->Esendex==1){echo 'Yes';}else{ echo 'No';}}?></p>
												</div>												
											</div>	
											
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Register</label>
													<p> <?php if(isset($get_Cont->Register)) {  if($get_Cont->Register==1){echo 'Yes';}else{ echo 'No';}}?></p>
												</div>												
											</div>	
																			
											</div>
											
											<div class="row">
        											<div class="form-group col-md-4">
        												<div class="input-group">													
        													<label>SOGB Membership</label>
        													<p> <?php if(isset($get_Cont->SOGB_membership)) { echo $get_Cont->SOGB_membership;}?></p>
        												</div>												
        											</div>
        											
        											<div class="form-group col-md-4">
        												<div class="input-group">													
        													<label>Unified</label>
        													<p> <?php if(isset($get_Cont->Unified)) {  if($get_Cont->Unified==1){echo 'Yes';}else{ echo 'No';}}?></p>
        												</div>												
        											</div>
        											
        											<div class="form-group col-md-4">
        												<div class="input-group">													
        													<label>Eligibility</label>
        													       													
        													<p> <?php if(isset($get_Cont->Eligibility)) {  if($get_Cont->Eligibility==1){echo 'Yes';}else{ echo 'No';}}?></p>
        												</div>												
        											</div>
											
											</div>
											<div class="row">
											<div class="form-group col-md-4">
												<div class="input-group">													
													<label>Document</label>
											
											<p><?php if($get_Cont->document):?>
									<div class="cs-cnt-document"><a href="<?php echo content_url().'/uploads/1Life-Document/'.$get_Cont->document;?>"><img alt="" width="80" height="80" src="<?php echo get_template_directory_uri();?>/images/docuement.png"></a>
									<?php endif;?></p> 	
									
									</div>
									</div>	
									</div>
									</div>

									
						
							</div>
						</div>					
				</div>
				
				</div>