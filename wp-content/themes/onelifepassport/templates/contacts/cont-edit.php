<?php

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

global $wpdb;

$table_contacts = $wpdb->prefix .'contacts';

$wpdb->show_errors = true;


$action="";
$cont_id="";
$get_Int="";
$update_interest=false;
$conterest="";

if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
}
if(isset($_REQUEST['cont-id'])){
    $cont_id=$_REQUEST['cont-id'];
}

$redirect=false;
if($action!="edit" && $cont_id==""){
    $redirect=true;
}

if($cont_id){
    
    $get_Cont = $wpdb->get_row( "SELECT * FROM $table_contacts WHERE contact_id = $cont_id",'OBJECT' );
    
    
    if (empty($get_Cont)) {
        $redirect=true;
    }
}


$err_msg = "";
$suc_msg = "";

$first_name="";
$surname ="";
$position ="";
$use_org_address="";
$organisation_id ="";
$address1 ="";
$address2 ="";
$town ="";
$county ="";
$postcode ="";
$phone="";
$mobile ="";
$emergency_phone1="";
$emergency_phone2 ="";
$email ="";
$dob="";
$notes ="";
$ethnicity ="";
$SOGB_membership="";
$start_date="";
$temp_interest="";
$photo_consent ="";
$photo_consent1 ="";
$photo_consent2 ="";
$photo_consent3 ="";
$photo_consent4 ="";
$aai = "";
$photo="";
$medical ="";
$member_mobile="";
$email2 ="";
$known_disability ="";
$age_when_joined ="";
$medical_forms_sent ="";
$medical_forms_received ="";
$photo_received ="";
$Esendex ="";
$Register ="";

$Unified="";
$Eligibility="";

$submit_add_contact ="";

$user_orgs_lists="";
$user_intrts_lists="";

$interest_lists_arr=array();


if(isset($_POST['submit_update_contact'])){
    

    
   if(empty($_POST['first_name'])){
        $err_msg .='First name should not be blank';
    }
    
    if(empty($_POST['surname'])){
        $err_msg .='Surname should not be blank';
    }
    
    if(!isset($_POST['use_org_address'])){
        $err_msg .='Please select Use Organisation Address';
    }
    
    
   
    if(empty($_POST['mobile'])){
        $err_msg .='Mobile number should not be blank';
    }
    
    if(empty($_POST['emergency_phone1'])){
        $err_msg .='Emergency Phone 1 should not be blank';
    }
    
    if(empty($_POST['dob'])){
        $err_msg .='DOB should not be blank';
    }
    
    if(empty($_POST['start_date'])){
        $err_msg .='Start Date should not be blank';
    }
    
   
   
    
    //if (isset($_FILES["photo"])) {
        
    if(file_exists($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        
        $allowedExts = array("jpg", "jpg", "png", "gif", "bmp");
        $temp = explode(".", $_FILES["photo"]["name"]);
        $extension = end($temp);
        
        if (isset($_FILES['photo'])&&  $_FILES["photo"]["error"] > 0) {
            $err_msg.= "Error opening the file<br />";
        }
        $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        
        if(isset($_FILES['photo'])&& $extension!='jpg' && $extension!='jpeg' && $extension!='png' && $extension!='gif')
        {
            $err_msg .="File is not image";
        }
        
        
        if ($_FILES["photo"]["size"] > 2097152) {
            $err_msg .= "File size shoud be less than 2MB<br />";
        }
        
        
    }
   
    
    if(file_exists($_FILES['document']['tmp_name']) && is_uploaded_file($_FILES['document']['tmp_name'])) {
        
        $allowedExts_docuemt = array("doc", "docx", "odt", "pdf");
        $temp = explode(".", $_FILES["document"]["name"]);
        $extension_document = end($temp);
        
        if (isset($_FILES['document'])&&  $_FILES["document"]["error"] > 0) {
            $err_msg.= "Error opening the file<br />";
        }
        $extension_document = pathinfo($_FILES["document"]["name"], PATHINFO_EXTENSION);
        
        if(isset($_FILES['document'])&& $extension_document!='doc' && $extension_document!='docx' && $extension_document!='pdf' && $extension_document!='odt')
        {
            $err_msg .="File is not document";
        }
        
        
        if ($_FILES["document"]["size"] > 2097152) {
            $err_msg .= "File size shoud be less than 2MB<br />";
        }
        
        
    }else{
        
        // $err_msg .="Please upload the photo";
    }
    
    if(empty($err_msg)){
      
       
      $first_name=wp_strip_all_tags(trim($_POST['first_name']));
        $surname =wp_strip_all_tags(trim($_POST['surname']));
        $position =wp_strip_all_tags(trim($_POST['position']));
        $use_org_address=wp_strip_all_tags(trim($_POST['use_org_address']));
        $organisation_id =wp_strip_all_tags(trim($_POST['organisation_id']));
        $address1 =wp_strip_all_tags(trim(stripslashes_deep($_POST['address1'])));
        $address2 =wp_strip_all_tags(trim(stripslashes_deep($_POST['address2'])));
        $town =wp_strip_all_tags(trim($_POST['town']));
        $county =wp_strip_all_tags(trim($_POST['county']));
        $postcode =wp_strip_all_tags(trim($_POST['postcode']));
        $phone=wp_strip_all_tags(trim($_POST['phone']));
        $mobile =wp_strip_all_tags(trim($_POST['mobile']));
        $emergency_phone1=wp_strip_all_tags(trim($_POST['emergency_phone1']));
        $emergency_phone2 =wp_strip_all_tags(trim($_POST['emergency_phone2']));
        $email =wp_strip_all_tags(trim($_POST['email']));
        $dob=wp_strip_all_tags(trim($_POST['dob']));
        
        $dob= date('Y-m-d',strtotime(str_replace('/','-',$dob)));
        
        $notes =wp_strip_all_tags(trim(stripslashes_deep($_POST['notes'])));
        $ethnicity =wp_strip_all_tags(trim($_POST['ethnicity']));
        $SOGB_membership=wp_strip_all_tags(trim($_POST['SOGB_membership']));
        
        $start_date=wp_strip_all_tags(trim($_POST['start_date']));
        if($start_date){
            $start_date= date('Y-m-d',strtotime(str_replace('/','-',$start_date)));        
        }
        $temp_interest=wp_strip_all_tags(trim($_POST['temp_interest']));
        
        $temp_interest=maybe_serialize($_POST['temp_interest']);
        $photo_consent =wp_strip_all_tags(trim($_POST['photo_consent']));
        $photo_consent1 =wp_strip_all_tags(trim($_POST['photo_consent1']));
        $photo_consent2 =wp_strip_all_tags(trim($_POST['photo_consent2']));
        $photo_consent3 =wp_strip_all_tags(trim($_POST['photo_consent3']));
        $photo_consent4 =wp_strip_all_tags(trim($_POST['photo_consent4']));
        $aai = wp_strip_all_tags(trim($_POST['aai']));
        
      
        $medical =wp_strip_all_tags(trim($_POST['medical']));
        $member_mobile=wp_strip_all_tags(trim($_POST['member_mobile']));
        $email2 =wp_strip_all_tags(trim($_POST['email2']));
        $known_disability =wp_strip_all_tags(trim($_POST['known_disability']));
        $age_when_joined =wp_strip_all_tags(trim($_POST['age_when_joined']));
       
        $medical_forms_sent =wp_strip_all_tags(trim($_POST['medical_forms_sent']));
        if($medical_forms_sent){
         $medical_forms_sent= date('Y-m-d',strtotime(str_replace('/','-',$medical_forms_sent)));     
        }
        $medical_forms_received =wp_strip_all_tags(trim($_POST['medical_forms_received']));
        if($medical_forms_received){
            $medical_forms_received= date('Y-m-d',strtotime(str_replace('/','-',$medical_forms_received)));  
        }
        $photo_received =wp_strip_all_tags(trim($_POST['photo_received']));
        $Esendex =wp_strip_all_tags(trim($_POST['Esendex']));
        $Register =wp_strip_all_tags(trim($_POST['Register']));
        
        $Unified =wp_strip_all_tags(trim($_POST['Unified']));
        
        $Eligibility =wp_strip_all_tags(trim($_POST['Eligibility']));
        
        
       
        $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        
        $new_photo_name=$first_name.'_'.time().'.'.$extension;
        
        $photo_upload_dir= WP_CONTENT_DIR.'/uploads/1Life-Photo/'.$new_photo_name;
        
        
        if(file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
            
            
            if(!move_uploaded_file($_FILES['photo']['tmp_name'],$photo_upload_dir)){
                
                $err_msg .='Photo Upload failed, please try again later';
            }
            
        }else{
            if(isset($get_Cont->photo) && !empty($get_Cont->photo)){
                
                
                $new_photo_name=$get_Cont->photo;
            }else{
                $new_photo_name="";
                
            }
           
        }
            
        /*****************Document************************/
        
        $extension_document = pathinfo($_FILES["document"]["name"], PATHINFO_EXTENSION);
        
        $new_document_name=$first_name.'_'.time().'.'.$extension_document;
        
        $document_upload_dir= WP_CONTENT_DIR.'/uploads/1Life-Document/'.$new_document_name;
        
        
        if(file_exists($_FILES['document']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
            
            
            if(!move_uploaded_file($_FILES['document']['tmp_name'],$document_upload_dir)){
                $err_msg .='Document Upload failed, please try again later';
                
            }
            
        }else{
            if(isset($get_Cont->document) && !empty($get_Cont->document)){
                $new_document_name=$get_Cont->document;
            }else{
                $new_document_name="";
                
            }
        }
            
            $update_contact=$wpdb->update(
                $table_contacts,
                array(              
                    'first_name'=>$first_name,
                    'surname'=>$surname,                   
                    'use_org_address'=>$use_org_address,
                    'organisation_id'=>$organisation_id,
                    'address1'=>$address1,
                    'address2'=>$address2,
                    'town'=>$town,
                    'county'=>$county,
                    'postcode'=>$postcode,
                    'phone'=>$phone,
                    'mobile'=>$mobile,
                    'emergency_phone1'=>$emergency_phone1,
                    'emergency_phone2'=>$emergency_phone2,
                    'email'=>$email,
                    'dob'=>$dob,
                    'notes'=>$notes,
                    'ethnicity'=>$ethnicity,
                    'SOGB_membership'=>$SOGB_membership,                   
                    'start_date'=>$start_date,
                    'temp_interest'=>$temp_interest,
                    'photo_consent'=>$photo_consent,
                    'photo_consent1'=>$photo_consent1,
                    'photo_consent2'=>$photo_consent2,
                    'photo_consent3'=>$photo_consent3,
                    'photo_consent4'=>$photo_consent4,
                    'aai' => $aai,
                    'photo'=>$new_photo_name,
                    'medical'=>$medical,
                    'member_mobile'=>$member_mobile,
                    'email2'=>$email2,
                    'known_disability'=>$known_disability,
                    'age_when_joined'=>$age_when_joined,
                    'medical_forms_sent'=>$medical_forms_sent,
                    'medical_forms_received'=>$medical_forms_received,
                    'photo_received'=>$photo_received,
                    'Esendex'=>$Esendex,
                    'Register'=>$Register,
                    'Unified'=>$Unified,
                    'Eligibility'=>$Eligibility,
                    'document'=>$new_document_name
                ),
                array( 'contact_id' => $get_Cont->contact_id ),
                array( 
                    '%s',
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
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                ),
                array( '%d' )
                );
            
            
            if($update_contact){
                $suc_msg="Successfully Updated Contact";
                $_SESSION['update_contact_message']=$suc_msg;
                wp_safe_redirect(get_permalink());
                exit();
            }else{
                
                $suc_msg="Successfully Updated Contact";
                $_SESSION['update_contact_message']=$suc_msg;
                
                wp_safe_redirect(get_permalink());
                exit();
            }
            
       
        
        
    }
    
}


$user_orgs_lists=get_user_organisation_list(get_current_user_id());

$user_intrts_lists=get_user_interest_list(get_current_user_id());
if(!empty($user_intrts_lists)){
    
    $user_intrts_lists=maybe_unserialize($user_intrts_lists);
}
if(!empty($get_Cont->temp_interest)){
$interest_lists_arr=maybe_unserialize($get_Cont->temp_interest);

if(!is_array($interest_lists_arr)){
    
    $interest_lists_arr=array($get_Cont->temp_interest);
}
}


?>
<div class="col-sm-9">
	<h1>Update Contact</h1>
	<div class="fullwidth">
		<div class="formholder cs-wrap-opacity">
		
		  <div class="cs-loader" style="display: none"><img src="<?php echo get_template_directory_uri();?>/images/loader.gif" alt="loader" class="cs-img-loader"></div>
							<?php
    if (isset($err_msg) && $err_msg != "") {
        
        echo '<div class="cs-form-err">' . $err_msg . '</div>';
    }
    ?>
								<form id="cs-cont-form" name="contct-form" action=""
				method="POST" enctype="multipart/form-data">
				<div class="form-body">

					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>First Name</label> <input type="text" name="first_name"
									class="form-control validate[required, maxSize[75]]"
									value="<?php if(isset($_POST['first_name'])){ echo $_POST['first_name']; }else{ echo $get_Cont->first_name;}?>"
									placeholder="First Name" />

							</div>
							<span class="help-block" id="error"></span>
						</div>


						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Surname</label> <input type="text" name="surname"
									class="form-control validate[required, maxSize[75]]"
									value="<?php if(isset($_POST['surname'])){ echo $_POST['surname']; }else{ echo $get_Cont->surname;}?>"
									placeholder="Surname" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

					
					</div>

					<div class="row">
						<div class="form-group col-md-12 cs-org-address">
							<div class="form-group">
								<label>Use Organisation Address</label> 									
									<select name="use_org_address" class="form-control validate[required] cs-sel-org">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['use_org_address']) && $_POST['use_org_address']=='1'){ echo 'selected'; }elseif(isset($get_Cont->use_org_address)&& $get_Cont->use_org_address==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['use_org_address']) && $_POST['use_org_address']=='0'){ echo 'selected'; }elseif(isset($get_Cont->use_org_address)&& $get_Cont->use_org_address==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6 cs-org-list">
							<div class="form-group">
								<label>Organisation Name</label> 
								
								<select name="organisation_id" id="cs-org-list" class="form-control">
								<option value="">Select organisation</option>
								<?php if(!empty($user_orgs_lists)): foreach ($user_orgs_lists as $user_orgs_list):?>
									<option value="<?php echo $user_orgs_list->organisation_id;?>" <?php if(isset($_POST['organisation_id']) && $_POST['organisation_id']==$user_orgs_list->organisation_id){ echo 'selected'; }elseif(isset($get_Cont->organisation_id)&& $get_Cont->organisation_id==$user_orgs_list->organisation_id){ echo 'selected';}else{}?>><?php echo $user_orgs_list->organisation_name;?></option>
								<?php endforeach; endif;?>
								
								
								</select>
								
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Address-1</label>
								<textarea name="address1" id="address1" class="form-control validate[maxSize[75]]" placeholder="Address-1"><?php if(isset($_POST['address1'])){ echo $_POST['address1']; }else{ echo $get_Cont->address1;}?></textarea>
							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Address-2</label> 
								<textarea name="address2" id="address2" class="form-control validate[maxSize[75]]" placeholder="Address-2"><?php if(isset($_POST['address2'])){ echo $_POST['address2']; }else{ echo $get_Cont->address2;}?></textarea>
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					<div class="row">
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Town</label> <input type="text" name="town" id="town"
									class="form-control validate[maxSize[75]]"
									value="<?php if(isset($_POST['town'])){ echo $_POST['town']; }else{ echo $get_Cont->town;}?>"
									placeholder="Town" />

							</div>
							<span class="help-block" id="error"></span>
						</div>


						<div class="form-group col-md-4">
							<div class="form-group">
								<label>County</label> <input type="text" name="county" id="county"
									class="form-control validate[maxSize[75]]"
									value="<?php if(isset($_POST['county'])){ echo $_POST['county']; }else{ echo $get_Cont->county;}?>"
									placeholder="County" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Postcode</label> <input type="text" name="postcode" id="postcode"
									class="form-control validate[minSize[3], maxSize[8]]"
									value="<?php if(isset($_POST['postcode'])){ echo $_POST['postcode']; }else{ echo $get_Cont->postcode;}?>"
									placeholder="Postcode" />
							</div>
							<span class="help-block" id="error"></span>
						</div>
					</div>
					
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Phone</label> 
								
								<input type="text"
									name="phone" id="phone"
									class="form-control validate[minSize[8], maxSize[15], custom[onlyNumberSp]]"
									value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; }else{ echo $get_Cont->phone;}?>"
									placeholder="Phone" />

							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Mobile</label> <input type="text"
									name="mobile" id="mobile"
									class="form-control validate[required, minSize[8], maxSize[15], custom[onlyNumberSp]]"
									value="<?php if(isset($_POST['mobile'])){ echo $_POST['mobile']; }else{ echo $get_Cont->mobile;}?>"
									placeholder="Mobile" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Emergency Phone1</label> 
								
								<input type="text"
									name="emergency_phone1" id="emergency_phone1"
									class="form-control validate[required, minSize[8]]"
									value="<?php if(isset($_POST['emergency_phone1'])){ echo $_POST['emergency_phone1']; }else{ echo $get_Cont->emergency_phone1;}?>"
									placeholder="Emergency Phone1" />

							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Emergency Phone2</label> 
								
								<input type="text"
									name="emergency_phone2" id="emergency_phone2"
									class="form-control validate[minSize[8]]"
									value="<?php if(isset($_POST['emergency_phone2'])){ echo $_POST['emergency_phone2']; }else{ echo $get_Cont->emergency_phone2;}?>"
									placeholder="Emergency Phone2" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Email</label> 
								
								<input type="email"
									name="email" id="email"
									class="form-control validate[ custom[email]]"
									value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }else{ echo $get_Cont->email;}?>"
									placeholder="Email" />

							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>DOB</label> 
								
								<input type="text"
									name="dob"
									class="form-control validate[required]" id="cs-cont-dob"
									value="<?php if(isset($_POST['dob'])){ echo $_POST['dob']; }elseif($get_Cont->dob!='0000-00-00 00:00:00'){echo date('d/m/Y', strtotime($get_Cont->dob));}else{}?>"
									placeholder="DOB" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Notes</label>
								<textarea name="notes" class="form-control" placeholder="Notes"><?php if(isset($_POST['notes'])){ echo $_POST['notes']; }else{ echo $get_Cont->notes;}?></textarea>
							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Ethnicity</label> 
								<textarea name="ethnicity" class="form-control 	" maxlength="200" placeholder="Ethnicity"><?php if(isset($_POST['ethnicity'])){ echo $_POST['ethnicity']; }else{ echo $get_Cont->ethnicity;}?></textarea>
							</div>
							<span class="help-block" id="error"></span>
						</div>						
					</div>
					
					<div class="row">
						
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Start Date</label> 
									<input type="text"
									name="start_date"
									class="form-control validate[required]" id="cs-start_date"
									value="<?php if(isset($_POST['start_date'])){ echo $_POST['start_date']; }elseif($get_Cont->start_date!='0000-00-00 00:00:00'){echo date('d/m/Y', strtotime($get_Cont->start_date));}else{}?>"
									placeholder="Start Date" />
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						
						<div class="form-group col-md-8">
							<div class="form-group">
								<label>Interest</label> 
								<?php //echo $get_Cont->temp_interest;?>
								<select name="temp_interest[]" id="cs-tmp-list" class="form-control chosen-select" multiple>								
								<?php if(!empty($user_intrts_lists)): foreach ($user_intrts_lists as $user_intrts_list): ?>
									<option value="<?php echo $user_intrts_list->interest_id;?>" <?php if(isset($_POST['temp_interest']) && $_POST['temp_interest']==$user_intrts_list->interest_id){ echo 'selected'; }elseif(!empty($interest_lists_arr)&& in_array($user_intrts_list->interest_id, $interest_lists_arr)){ echo 'selected';}else{}?>><?php echo $user_intrts_list->interest;?></option>
								<?php endforeach; endif;?>
								</select>
								
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="panel-heading"><strong>Photo Consent</strong></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Social Media</label> 									
									<select name="photo_consent" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['photo_consent']) && $_POST['photo_consent']=='1'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent)&& $get_Cont->photo_consent==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['photo_consent']) && $_POST['photo_consent']=='0'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent)&& $get_Cont->photo_consent==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Press Releases</label> 									
									<select name="photo_consent1" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['photo_consent1']) && $_POST['photo_consent1']=='1'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent1)&& $get_Cont->photo_consent1==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['photo_consent1']) && $_POST['photo_consent1']=='0'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent1)&& $get_Cont->photo_consent1==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						

					</div>
					
					
					<div class="row">
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Our Newsletters</label> 									
									<select name="photo_consent2" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['photo_consent2']) && $_POST['photo_consent2']=='1'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent2)&& $get_Cont->photo_consent2==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['photo_consent2']) && $_POST['photo_consent2']=='0'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent2)&& $get_Cont->photo_consent2==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Display Boards</label> 									
									<select name="photo_consent3" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['photo_consent3']) && $_POST['photo_consent3']=='1'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent3)&& $get_Cont->photo_consent3==1){ echo 'selected';}else{}?>?>>Yes</option>
										<option value="0" <?php if(isset($_POST['photo_consent3']) && $_POST['photo_consent3']=='0'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent3)&& $get_Cont->photo_consent3==0){ echo 'selected';}else{}?>?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Other websites</label> 									
									<select name="photo_consent4" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['photo_consent4']) && $_POST['photo_consent4']=='1'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent4)&& $get_Cont->photo_consent4==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['photo_consent4']) && $_POST['photo_consent4']=='0'){ echo 'selected'; }elseif(isset($get_Cont->photo_consent4)&& $get_Cont->photo_consent4==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						

					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Atlanto-axial Instability</label> 									
									<select name="aai" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['aai']) && $_POST['aai']=='1'){ echo 'selected'; }elseif(isset($get_Cont->aai)&& $get_Cont->aai==1){ echo 'selected';}else{}?>>N/A</option>
										<option value="2" <?php if(isset($_POST['aai']) && $_POST['aai']=='2'){ echo 'selected'; }elseif(isset($get_Cont->aai)&& $get_Cont->aai==2){ echo 'selected';}else{}?>>+ve</option>
										<option value="3" <?php if(isset($_POST['aai']) && $_POST['aai']=='3'){ echo 'selected'; }elseif(isset($get_Cont->aai)&& $get_Cont->aai==3){ echo 'selected';}else{}?>>-ve</option>
										<option value="4" <?php if(isset($_POST['aai']) && $_POST['aai']=='4'){ echo 'selected'; }elseif(isset($get_Cont->aai)&& $get_Cont->aai==4){ echo 'selected';}else{}?>>No X-Ray </option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
					
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Photo</label> 									
									<input type="file" name="photo" accept="image/*" id="upload_photo" style="display: none">
									<a href="javascript:void(0)"  id="upload_link">Upload your photo</a>
									<?php if($get_Cont->photo):?>
									<div class="cs-cnt-photo"><img id="image_upload_preview" alt=""  src="<?php echo content_url().'/uploads/1Life-Photo/'.$get_Cont->photo;?>">
									<?php else:?>
									<img id="image_upload_preview" src="<?php echo get_template_directory_uri();?>/images/blank_img.jpeg" alt="your image" height="100" width="100"/>
									<?php endif;?>
							</div>
							<span class="help-block" id="error"></span>
						</div>
							</div>

					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Medical</label>
								<textarea name="medical" class="form-control" placeholder="Medical"><?php if(isset($_POST['medical'])){ echo $_POST['medical']; }elseif(isset($get_Cont->medical)){ echo $get_Cont->medical;}?></textarea>
							</div>
							<span class="help-block" id="error"></span>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Member Mobile</label>
								<input type="text"
									name="member_mobile"
									class="form-control validate[minSize[8], maxSize[15], custom[onlyNumberSp]]"
									value="<?php if(isset($_POST['member_mobile'])){ echo $_POST['member_mobile']; }elseif(isset($get_Cont->member_mobile)){ echo $get_Cont->member_mobile;}elseif(isset($get_Cont->member_mobile)){ echo $get_Cont->member_mobile;}?>"
									placeholder="Member Mobile" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					
					<div class="row">
					
					<div class="form-group col-md-4">
							<div class="form-group">
								<label>Email-2</label> 
								<input type="email"
									name="email2"
									class="form-control validate[maxSize[75], custom[email]]"
									value="<?php if(isset($_POST['email2'])){ echo $_POST['email2']; }elseif(isset($get_Cont->email2)){ echo $get_Cont->email2;}?>"
									placeholder="Email-2" />
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Known Disability</label>
								<textarea name="known_disability" class="form-control validate[maxSize[75]]" placeholder="Known Disability"><?php if(isset($_POST['known_disability'])){ echo $_POST['known_disability']; }elseif(isset($get_Cont->known_disability)){ echo $get_Cont->known_disability;}?></textarea>
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Age When Joined</label> 
								<input type="number"
									name="age_when_joined"  min="1"
									class="form-control validate[maxSize[2], custom[onlyNumberSp]]"
									value="<?php if(isset($_POST['age_when_joined'])){ echo $_POST['age_when_joined']; }elseif(isset($get_Cont->age_when_joined)){ echo $get_Cont->age_when_joined;}?>"
									placeholder="Age When Joined" />
							</div>
							<span class="help-block" id="error"></span>
						</div>
						

					</div>
					
					
					<div class="row">
					
					<div class="form-group col-md-6">
							<div class="form-group">
								<label>Medical Forms Sent</label> 
								<input type="text"
									name="medical_forms_sent" id="cs_medical_forms_sent"
									class="form-control"
									value="<?php if(isset($_POST['medical_forms_sent'])){ echo $_POST['medical_forms_sent']; }elseif($get_Cont->medical_forms_sent!='0000-00-00 00:00:00'){echo date('d/m/Y', strtotime($get_Cont->medical_forms_sent));}else{}?>"
									placeholder="Medical Forms Sent" />
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Medical Forms Received</label>
							<input type="text"
									name="medical_forms_received" id="cs_medical_forms_received"
									class="form-control"
									value="<?php if(isset($_POST['medical_forms_received'])){ echo $_POST['medical_forms_received']; }elseif($get_Cont->medical_forms_received!='0000-00-00 00:00:00'){echo date('d/m/Y', strtotime($get_Cont->medical_forms_received));}else{}?>"
									placeholder="Medical Forms Received" />
							</div>
							<span class="help-block" id="error"></span>
						</div>

					</div>
					
					<div class="row">
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Photo Received</label> 									
									<select name="photo_received" class="form-control">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['photo_received']) && $_POST['photo_received']=='1'){ echo 'selected'; }elseif(isset($get_Cont->photo_received)&& $get_Cont->photo_received==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['photo_received']) && $_POST['photo_received']=='0'){ echo 'selected'; }elseif(isset($get_Cont->photo_received)&& $get_Cont->photo_received==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Esendex</label> 									
									<select name="Esendex" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['Esendex']) && $_POST['Esendex']=='1'){ echo 'selected'; }elseif(isset($get_Cont->Esendex)&& $get_Cont->Esendex==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['Esendex']) && $_POST['Esendex']=='0'){ echo 'selected'; }elseif(isset($get_Cont->Esendex)&& $get_Cont->Esendex==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Register</label> 									
									<select name="Register" class="form-control ">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['Register']) && $_POST['Register']=='1'){ echo 'selected'; }elseif(isset($get_Cont->Register)&& $get_Cont->Register==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['Register']) && $_POST['Register']=='0'){ echo 'selected'; }elseif(isset($get_Cont->Register)&& $get_Cont->Register==0){ echo 'selected';}else{}?>>No</option>
									</select>

							</div>
							<span class="help-block" id="error"></span>
						</div>					

					</div>
					
					<div class="row">
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>SOGB membership</label> 
																
								<input type="text"
									name="SOGB_membership"
									class="form-control validate[maxSize[50]]" 
									value="<?php if(isset($_POST['SOGB_membership'])){ echo $_POST['SOGB_membership']; }else{ echo $get_Cont->SOGB_membership;}?>"
									placeholder="SOGB Membership" />
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Unified</label> 
																
								<select name="Unified" class="form-control">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['Unified']) && $_POST['Unified']=='1'){ echo 'selected'; }elseif(isset($get_Cont->Unified)&& $get_Cont->Unified==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['Unified']) && $_POST['Unified']=='0'){ echo 'selected'; }elseif(isset($get_Cont->Unified)&& $get_Cont->Unified==0){ echo 'selected';}else{}?>>No</option>
									</select>
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<div class="form-group">
								<label>Eligibility</label> 
																
									<select name="Unified" class="form-control">
										<option value="">Select Any</option>
										<option value="1" <?php if(isset($_POST['Eligibility']) && $_POST['Eligibility']=='1'){ echo 'selected'; }elseif(isset($get_Cont->Unified)&& $get_Cont->Eligibility==1){ echo 'selected';}else{}?>>Yes</option>
										<option value="0" <?php if(isset($_POST['Eligibility']) && $_POST['Eligibility']=='0'){ echo 'selected'; }elseif(isset($get_Cont->Unified)&& $get_Cont->Eligibility==0){ echo 'selected';}else{}?>>No</option>
									</select>
							</div>
							<span class="help-block" id="error"></span>
						</div>
					</div>
					
					<div class="row">
					
						<div class="form-group col-md-6">
							<div class="form-group">
								<label>Document</label> 									
									<input type="file" id="cs-document-file" name="document" accept=".pdf,.doc,.docx,.odt" style="display: none"/>
									<a href="javascript:void(0)" id="cs-upload-document">Upload Document</a>
									<span id="cs-upload-file-name"></span>	
									<?php if($get_Cont->document):?>
									<div class="cs-cnt-document"><img id="document_upload_preview" alt="" width="80" height="80" src="<?php echo get_template_directory_uri();?>/images/docuement.png">
									
									<?php endif;?>	
							</div>
							<span class="help-block" id="error"></span>
						</div>
						
					
					
					</div>			
					
					
				</div>

				<div class="form-footer">
					<div class="buttonholder">
						<input type="submit" class="cs-button-left"
							name="submit_update_contact" value="Update">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>