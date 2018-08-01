<?php 
if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
}

if (is_user_logged_in()) {
    $onelife_user_role = onelife__get_user_role();
    if ($onelife_user_role != 'onelifepassport_member') {
        wp_safe_redirect(site_url());
        exit();
    }
} else {
    wp_safe_redirect(site_url());
    exit();
}

$user_id = get_current_user_id();

$user_data = get_userdata($user_id);