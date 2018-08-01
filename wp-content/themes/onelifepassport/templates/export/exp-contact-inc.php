<?php 

global $wpdb;

$table_contacts=$wpdb->prefix.'contacts';
$get_row="";
$mod_post="";

$err_msg="";
$user_intrts_lists="";
$temp_interest_list_arr=array();

$new_row=array();
$interests_lists=array();
$user_intrts_lists=get_user_interest_list(get_current_user_id());
if(isset($_POST['contact_export_submit'])){
    unset($_POST['contact_export_submit']);
    
   
    
    $temp_interest_list_arr=$_POST['temp_interest_fld'];
    
    if(!empty( $temp_interest_list_arr)){
        
        foreach ( $temp_interest_list_arr as  $temp_interest_list){
            
            if ($temp_interest_list === reset($temp_interest_list_arr)){
                
                $temp_interest_list = (string)$temp_interest_list;
                
                $temp_interest_list='"'.$temp_interest_list.'"';
                
                $where_tmp_interest .="WHERE temp_interest REGEXP '.*;s:[0-9]+:$temp_interest_list.*'";
                
            }else if ($temp_interest_list === end($temp_interest_list_arr)){
                
                $temp_interest_list = (string)$temp_interest_list;
                
                $temp_interest_list='"'.$temp_interest_list.'"';
                $where_tmp_interest .="OR temp_interest REGEXP '.*;s:[0-9]+:$temp_interest_list.*' ";
                
            }else if ($temp_interest_list != end($temp_interest_list_arr) && $temp_interest_list != end($temp_interest_list_arr)){
                $temp_interest_list = (string)$temp_interest_list;
                
                $temp_interest_list='"'.$temp_interest_list.'"';
                $where_tmp_interest .=" OR temp_interest REGEXP '.*;s:[0-9]+:$temp_interest_list.*' ";
            }
            
        }
        
        
    }else{
        
        $where_tmp_interest="";
    }
    
    unset($_POST['temp_interest_fld']);
    
    $mod_post=$_POST;
    
    if(empty($mod_post)){
        
        $err_msg .='No Column selected.<br>';
        
        return false;
    }
    
    
    if($err_msg==""){
    $select_contact_coulumn= (implode(",",array_keys($_POST)));
 
    
    $get_row= $wpdb->get_results( "SELECT $select_contact_coulumn FROM $table_contacts $where_tmp_interest");
    
  
  
    if(!empty($get_row)){
        foreach ($get_row as $key=>$g_row):
        
        if($get_row[$key]->use_org_address=='1'){
            
            $get_row[$key]->use_org_address='Yes';
        }else{
            $get_row[$key]->use_org_address='No';
            
        }
        
        if(isset($get_row[$key]->organisation_id) && $get_row[$key]->organisation_id!=0){
            
            $get_row[$key]->organisation_id=get_organisation_name_from_id($get_row[$key]->organisation_id);
        }else{
            
            $get_row[$key]->organisation_id="";
        }
        
        
        
        if(isset($get_row[$key]->dob) && $get_row[$key]->dob!='0000-00-00 00:00:00'){
            $get_row[$key]->dob=date('d/m/Y', strtotime($get_row[$key]->dob));
        }else{
            
            $get_row[$key]->dob="";
        }
        
        
        
        if(isset($get_row[$key]->start_date) && $get_row[$key]->start_date!='0000-00-00 00:00:00'){
            $get_row[$key]->start_date=date('d/m/Y', strtotime($get_row[$key]->start_date));
        }else{
            
            $get_row[$key]->start_date="";
        }
        
        
        if(isset($get_row[$key]->temp_interest)){
            
          //  $get_row[$key]->temp_interest=get_interest_name_from_id($get_row[$key]->temp_interest);
            
            $interests_lists=maybe_unserialize($get_row[$key]->temp_interest);
            
            if(!empty($interests_lists) && is_array($interests_lists)){
                
                $get_row[$key]->temp_interest=get_interest_name_from_id_multiple(implode(', ',$interests_lists));
            }
            
            
        }else{
            
            $get_row[$key]->temp_interest="";
        }
        
       
        
        if(isset($get_row[$key]->photo_consent) && !empty($get_row[$key]->photo_consent)){
            
            if($get_row[$key]->photo_consent==1){
                $get_row[$key]->photo_consent='Yes';
            }else{
                $get_row[$key]->photo_consent='No';
                
            }
        }else{
            $get_row[$key]->photo_consent='';
            
        }
        
        
        if(isset($get_row[$key]->photo_consent1) && !empty($get_row[$key]->photo_consent1)){
            
            if($get_row[$key]->photo_consent1==1){
                $get_row[$key]->photo_consent1='Yes';
            }else{
                $get_row[$key]->photo_consent1='No';
                
            }
        }else{
            $get_row[$key]->photo_consent1='';
            
        }
        
        
        
        if(isset($get_row[$key]->photo_consent2) && !empty($get_row[$key]->photo_consent2)){
            
            if($get_row[$key]->photo_consent2==1){
                $get_row[$key]->photo_consent2='Yes';
            }else{
                $get_row[$key]->photo_consent2='No';
                
            }
        }else{
            $get_row[$key]->photo_consent2='';
            
        }
        
        
        if(isset($get_row[$key]->photo_consent3) && !empty($get_row[$key]->photo_consent3)){
            
            if($get_row[$key]->photo_consent3==1){
                $get_row[$key]->photo_consent3='Yes';
            }else{
                $get_row[$key]->photo_consent3='No';
                
            }
        }else{
            $get_row[$key]->photo_consent3='';
            
        }
        
        
        if(isset($get_row[$key]->photo_consent4) && !empty($get_row[$key]->photo_consent4)){
            
            if($get_row[$key]->photo_consent4==1){
                $get_row[$key]->photo_consent4='Yes';
            }else{
                $get_row[$key]->photo_consent4='No';
                
            }
        }else{
            $get_row[$key]->photo_consent4='';
            
        }
        
        /******* */
        if(isset($get_row[$key]->aai) && !empty($get_row[$key]->aai)){
            
            if($get_row[$key]->aai==1){
                $get_row[$key]->aai=' N/A';
                
            }elseif($get_row[$key]->aai==2){
                    $get_row[$key]->aai='+VE';
                    
            }elseif($get_row[$key]->aai=3){
                $get_row[$key]->aai='-VE';           
            }else{
                $get_row[$key]->aai='No X-Ray';
                
            }
        }else{
            $get_row[$key]->aai='';
            
        }
       
       
        if(isset($get_row[$key]->photo) && !empty($get_row[$key]->photo)){
            
            $get_row[$key]->photo=content_url().'/uploads/1Life-Photo/'.$get_row[$key]->photo;
        }else{
            
            $get_row[$key]->photo="";
        }
        
        
        
        if(isset($get_row[$key]->medical_forms_sent) && $get_row[$key]->dob!='0000-00-00 00:00:00'){
            $get_row[$key]->medical_forms_sent=date('d/m/Y', strtotime($get_row[$key]->medical_forms_sent));
        }else{
            
            $get_row[$key]->medical_forms_sent="";
        }
        
        
        if(isset($get_row[$key]->medical_forms_received) && $get_row[$key]->medical_forms_received!='0000-00-00 00:00:00'){
            $get_row[$key]->medical_forms_received=date('d/m/Y', strtotime($get_row[$key]->medical_forms_received));
        }else{
            
            $get_row[$key]->medical_forms_received="";
        }
        
        
        if(isset($get_row[$key]->photo_received) && !empty($get_row[$key]->photo_received)){
            
            if($get_row[$key]->photo_received==1){
                $get_row[$key]->photo_received='Yes';
            }else{
                $get_row[$key]->photo_received='No';
                
            }
        }else{
            $get_row[$key]->photo_received='';
            
        }
        
        
        if(isset($get_row[$key]->Esendex) && !empty($get_row[$key]->Esendex)){
            
            if($get_row[$key]->Esendex==1){
                $get_row[$key]->Esendex='Yes';
            }else{
                $get_row[$key]->Esendex='No';
                
            }
        }else{
            $get_row[$key]->Esendex='';
            
        }
        
        
        if(isset($get_row[$key]->Register) && !empty($get_row[$key]->Register)){
            
            if($get_row[$key]->Register==1){
                $get_row[$key]->Register='Yes';
            }else{
                $get_row[$key]->Register='No';
                
            }
        }else{
            $get_row[$key]->Register='';
            
        }
        
        if(isset($get_row[$key]->Unified) && !empty($get_row[$key]->Unified)){
            
            if($get_row[$key]->Unified==1){
                $get_row[$key]->Unified='Yes';
            }else{
                $get_row[$key]->Unified='No';
                
            }
        }else{
            $get_row[$key]->Unified='';
            
        }
        
        
        if(isset($get_row[$key]->Eligibility) && !empty($get_row[$key]->Eligibility)){
            
            if($get_row[$key]->Eligibility==1){
                $get_row[$key]->Eligibility='Yes';
            }else{
                $get_row[$key]->Eligibility='No';
                
            }
        }else{
            $get_row[$key]->Eligibility='';
            
        }
        
        
        
        
        
        if(isset($get_row[$key]->document) && !empty($get_row[$key]->document)){
            
            $get_row[$key]->document=content_url().'/uploads/1Life-Document/'.$get_row[$key]->document;
        }else{
            
            $get_row[$key]->document="";
        }
        
        
        $new_row[]=(array)$g_row;
        endforeach;
        
    }else{
        
        $err_msg .='No data found.<br>';
        return false;
    }
    
    }

   $current_date = date( 'd-m-Y');
   $current_time = date_i18n ( 'h-i', current_time ( 'timestamp' ) );
   $filename ='cont_'.get_user_meta(get_current_user_id(), 'first_name', true).'_'.$current_date.'_'.$current_time.".csv";
   
   header ( "Content-type: text/csv" );
   header ( "Content-Disposition: attachment; filename=" . $filename . "" );
   header ( "Pragma: no-cache" );
   header ( "Expires: 0" );
   
   $file = fopen ( 'php://output', 'w' );
   fputcsv ( $file, array_values($mod_post) );
   
   if(!empty($new_row)){
       
      
       foreach ( $new_row as $row ) {
           
           fputcsv ( $file, $row );
           
       }
   }
   exit ();
   
   
   
   $filename ='cont_'.get_user_meta(get_current_user_id(), 'first_name', true).'_'.$current_date.'_'.$current_date.".csv";
   
   header ( 'Content-type: text/csv', 'charset=' . get_option ( 'blog_charset' ) );
   header ( 'Content-Disposition: attachment; filename=' . $filename );
   ob_clean ();
   echo $output;
   exit ();
   
}





?>