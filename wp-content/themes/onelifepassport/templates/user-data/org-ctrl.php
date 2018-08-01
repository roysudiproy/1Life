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
        $err_msg .="Please Enter Country Name.<br>";
        
    }
    if(empty(trim($_POST['postcode']))){
        $err_msg .="Please Enter Post Code.<br>";
        
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
        
        
        $exists_Org_Email = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_organization WHERE email = %s", $_POST['email']
            ) );
        
        if ( $exists_Org_Email ) {
            $err_msg .="Email already exists, Duplicate Eamil Address.<br>";
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
       
       if($insert_service){
           $suc_msg .="Successfully added Organization";
           
       }else{
           
           $err_msg .=$wpdb->show_errors;
       }
        
        
    }
    
}