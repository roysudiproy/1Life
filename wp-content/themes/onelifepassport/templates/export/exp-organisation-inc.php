<?php

global $wpdb;

$table_organisation=$wpdb->prefix.'organisations';
$get_row="";
$mod_post="";

$err_msg="";

$new_row=array();

if(isset($_POST['organisation_export_submit'])){
    unset($_POST['organisation_export_submit']);
    
    $mod_post=$_POST;
    
    if(empty($mod_post)){
        
        $err_msg .='No Column selected.<br>';
        
        return false;
    }
    
    
    if($err_msg==""){
        $select_organisation_coulumn= (implode(",",array_keys($_POST)));
        
        
        
        $get_row= $wpdb->get_results( "SELECT $select_organisation_coulumn FROM $table_organisation");
        
        if(!empty($get_row)){
            foreach ($get_row as $key=>$g_row):
            
                        
            
            $new_row[]=(array)$g_row;
            endforeach;
            
        }else{
            
            $err_msg .='No data found.<br>';
            return false;
        }
        
    }
    
    $current_date = date( 'd-m-Y');
    $current_time = date_i18n ( 'h-i', current_time ( 'timestamp' ) );
    $filename ='org_'.get_user_meta(get_current_user_id(), 'first_name', true).'_'.$current_date.'_'.$current_time.".csv";
    
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
    
    
    
    $filename ='org_'.get_user_meta(get_current_user_id(), 'first_name', true).'_'.$current_date.'_'.$current_date.".csv";
    
    header ( 'Content-type: text/csv', 'charset=' . get_option ( 'blog_charset' ) );
    header ( 'Content-Disposition: attachment; filename=' . $filename );
    ob_clean ();
    echo $output;
    exit ();
    
}





?>