<?php
add_action( 'admin_menu', 'register_my_user_management_menu' );
function register_my_user_management_menu() {
   
  
    
    add_menu_page('User Management', 'User Management', 'manage_options', 'onelife-user-manage', 'onelife_user_list', 'dashicons-admin-users');   
   
    
    add_submenu_page('onelife-user-manage', __('Add New User', 'onelife-user-manage'), __('Add New User', 'onelife-user-manage'), 'delete_others_pages', 'onelife_user_add','onelife_user_add');
    
    add_submenu_page(null, __('Edit User', 'onelife-user-manage'), __('Edit User', 'onelife-user-manage'), 'delete_others_pages', 'onelife_user_edit','onelife_user_edit');
    
    add_submenu_page(null, __('Password Change', 'onelife-user-manage'), __('Password Change', 'onelife-user-manage'), 'delete_others_pages', 'onelife_user_pass_change','onelife_user_pass_change');
    
    
    add_submenu_page(null, __('1-Life Setting', 'onelife-user-manage'), __('1-Life Setting', 'onelife-user-manage'), 'delete_others_pages', 'onelife_setting_option','onelife_setting_option');
    
    
    add_submenu_page('onelife_user_list', __('1-Life Setting', '1_life_management_setting'), __('1 Life Setting', '1_life_management_setting'), 'delete_others_pages', '1life-settting-page', '1_life_management_setting');
    
    
    add_menu_page('1 Life Setting', '1 Life Setting', 'manage_options', 'onelife-manage-setting', 'onelife_user_manage_setting', 'dashicons-admin-generic');
}



function add_admin_script_style(){
  
    wp_enqueue_style( 'onelifepassport-bootstrab', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    
    wp_enqueue_style( 'onelifepassport-maincss', get_template_directory_uri().'/admin/assets/css/main.css', '', time());
    
    wp_enqueue_style( 'onelifepassport-customcss', get_template_directory_uri().'/admin/assets/css/custom.css');
    
    wp_enqueue_style( 'onelifepassport-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
    wp_enqueue_style( 'onelifepassport-googlefont', 'https://fonts.googleapis.com/css?family=Open+Sans:300i,400,600,700');
    
    wp_enqueue_style( 'onelifepassport-validator', get_template_directory_uri().'/admin/assets/css/validationEngine.jquery.css');

    
    
    wp_enqueue_script( 'bootstrab-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
    
  wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
    
   
    wp_enqueue_style('jquery-ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
    
    wp_enqueue_script( 'form-validator-eng', get_template_directory_uri().'/admin/assets/js/jquery.validationEngine-en.js');
    
    wp_enqueue_script( 'form-validator', get_template_directory_uri().'/admin/assets/js/jquery.validationEngine.js');
    wp_enqueue_script( 'custom-script', get_template_directory_uri().'/admin/assets/js/custom.js');
    
    
}

add_action('admin_enqueue_scripts', 'add_admin_script_style');


if (file_exists(dirname(__FILE__) . '/user-mangement/onelife_user_list.php')) {
    require_once dirname(__FILE__) . '/user-mangement/onelife_user_list.php';
}

if (file_exists(dirname(__FILE__) . '/user-mangement/onelife_user_add.php')) {
    require_once dirname(__FILE__) . '/user-mangement/onelife_user_add.php';
}

if (file_exists(dirname(__FILE__) . '/user-mangement/onelife_user_edit.php')) {
    require_once dirname(__FILE__) . '/user-mangement/onelife_user_edit.php';
}

if (file_exists(dirname(__FILE__) . '/user-mangement/onelife_user_pass_change.php')) {
    require_once dirname(__FILE__) . '/user-mangement/onelife_user_pass_change.php';
}



if (file_exists(dirname(__FILE__) . '/onlife-setting/onlife-setting.php')) {
    require_once dirname(__FILE__) . '/onlife-setting/onlife-setting.php';
}



function onelife_get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'wpb_get_ip', $ip );
}

function onelife__get_user_role( $user = null ) {
    $user = $user ? new WP_User( $user ) : wp_get_current_user();
    return $user->roles ? $user->roles[0] : false;
}


/*************************************/
    
function get_user_organisation_list($user_id){
    $all_organisations="";
    global $wpdb;
    $table_organisation=$wpdb->prefix. 'organisations';
    
    $all_organisations=$wpdb->get_results("SELECT * FROM $table_organisation WHERE user_id = $user_id");
    
    return $all_organisations;
}


function get_user_interest_list($user_id){
    $all_interests="";
    global $wpdb;
    $table_interests=$wpdb->prefix. 'interests';
    
    $all_interests=$wpdb->get_results("SELECT * FROM $table_interests WHERE user_id = $user_id");
    
    return $all_interests;
}


function get_organisation_name_from_id($org_id){
    $all_organisations="";
    global $wpdb;
    $table_organisation=$wpdb->prefix. 'organisations';
    
    $all_organisations=$wpdb->get_row("SELECT organisation_name FROM $table_organisation WHERE organisation_id = $org_id");
    
    if(!empty($all_organisations)){
        
        $all_organisations=$all_organisations->organisation_name;
    }
    return $all_organisations;
    
}


function get_interest_name_from_id($int_id){
    $all_interests="";
    global $wpdb;
    $table_interests=$wpdb->prefix. 'interests';
    
    $all_interests=$wpdb->get_row("SELECT interest FROM $table_interests WHERE interest_id = $int_id");
    
    if(!empty($all_interests)){
        $all_interests=$all_interests->interest;
    }
    return $all_interests;
}
/************************************************************************************/
    
function file_validate($upload){ // Must be a $_FILES array
    if($upload['size'] == 0) return "Image not uploaded correctly.";
    if($upload['size'] > 2097152){ // Measured in bytes, this is equal to 2MB
        $filesize = $upload['size']/1048576; // Converts from bytes to Megabytes
        return "The image you uploaded has a filesize that is too large. Please reduce your image to < 2MB. It is currently ".$filesize."MB.";
    }
    if(($upload['type'] != "image/gif" || "image/jpeg" || "image/png") || ($this->imageinfo['mime'] != "image/gif" || "image/jpeg" || "image/png"))
        return "Uploads of that file type are not allowed. You need a jpg, png, or gif image.";
        $blacklist = array(".php", ".phtml", ".php3", ".php4", ".ph3", ".ph4");
        foreach ($blacklist as $item) {
            if(preg_match("/$item\$/i", $upload['name']))
                return "Uploads with that file extension are not allowed. You need an image ending in .jpg, .png, or .gif";
        }
        return true; // Validates
}

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
    
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}


function get_interest_name_from_id_multiple($int_id){
    $all_interests="";
    $all_interest_name="";
    global $wpdb;
    $table_interests=$wpdb->prefix. 'interests';
    
    $all_interests=$wpdb->get_results("SELECT interest FROM $table_interests WHERE interest_id in ($int_id)", OBJECT);
    
    if(!empty($all_interests)){
        
        foreach ($all_interests as $all_interest){
            $all_interest_name[]=$all_interest->interest;
            
        }
        if(!empty($all_interest_name) && is_array($all_interest_name)){
            $all_interest_name=implode(',', $all_interest_name);
        }
    }
    return $all_interest_name;
}

