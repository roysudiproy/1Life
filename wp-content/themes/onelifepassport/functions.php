<?php 
if(!function_exists('onelifepassport_setup')):
function onelifepassport_setup() {  
    load_theme_textdomain( 'onelifepassport' );
   
    add_theme_support( 'title-tag' );
  
  
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 );
    
}
endif;
add_action( 'after_setup_theme', 'onelifepassport_setup' );


function onelifepassport_scripts() {  
    wp_enqueue_style( 'onelifepassport-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
    //wp_enqueue_style( 'onelifepassport-datatable-css', 'https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css');
    
    wp_enqueue_style( 'onelifepassport-googlefont', 'https://fonts.googleapis.com/css?family=Open+Sans:300i,400,600,700');
    
    wp_enqueue_style( 'onelifepassport-validator', get_template_directory_uri().'/css/validationEngine.jquery.css');
    
    wp_enqueue_style('jquery-ui-cssfront', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
    wp_enqueue_style( 'onelifepassport-defaultcss', get_template_directory_uri().'/css/default.css');
    wp_enqueue_style( 'onelifepassport-bootstrab', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style( 'onelifepassport-chossen', get_template_directory_uri().'/css/chosen-new.css');
    wp_enqueue_style( 'onelifepassport-maincss', get_template_directory_uri().'/css/main.css', '', time());
    
   
    
    
    wp_enqueue_style( 'onelifepassport-customcss', get_template_directory_uri().'/css/custom.css');
    
    
    
  
    wp_enqueue_script( 'jquery');
    wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js');
    

}
add_action( 'wp_enqueue_scripts', 'onelifepassport_scripts' );

function onelifepassport_scripts_add_to_footer() {  
    
    wp_enqueue_script( 'jquery-ui-front', get_template_directory_uri().'/js/code.jquery.min.js');
    
    //wp_enqueue_script( 'jquery-datatable', 'https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js');
   
    wp_enqueue_script( 'bootstrab-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
    wp_enqueue_script( 'form-validator-eng', get_template_directory_uri().'/js/jquery.validationEngine-en.js');
    
    wp_enqueue_script( 'form-validator', get_template_directory_uri().'/js/jquery.validationEngine.js');
    wp_enqueue_script( 'script-table-sorter', get_template_directory_uri().'/js/jquery.tablesorter.min.js');
    
    wp_enqueue_script( 'script-chosen-new', get_template_directory_uri().'/js/chosen-new.js');
    
    wp_enqueue_script( 'script-chosen-ajax', get_template_directory_uri().'/js/ajax-chosen.js');
    
    
    wp_enqueue_script( 'onelifepassport-mainjs', get_template_directory_uri().'/js/main.js');
    wp_enqueue_script( 'custom-script', get_template_directory_uri().'/js/custom.js');
    
    
}

add_action('wp_footer', 'onelifepassport_scripts_add_to_footer');

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

add_action( 'admin_init', 'redirect_non_admin_users' );
function redirect_non_admin_users() {
    if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
        wp_redirect( home_url() );
        exit;
    }
}

function onelifepassport_gen_init(){
add_role( 'onelifepassport_member', 'Member', array( 'read' => true, 'level_0' => true ) );
}

add_action('init', 'onelifepassport_gen_init');

add_action('admin_menu', 'remove_built_in_roles');

function remove_built_in_roles() {
    global $wp_roles;
    
  $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');
    
    
    
    foreach ($roles_to_remove as $role) {
        if (isset($wp_roles->roles[$role])) {
            $wp_roles->remove_role($role);
        }
    }
}


/***************GET USER IP****************/



/********************************************/


include TEMPLATEPATH.'/admin/main.php';


function onelife_cokkies_timeout( $expirein ) {
    $simsof_auto_logout_time=172800;    
    
    if(is_user_logged_in()){
        $userdata=wp_get_current_user();
        $user_id=$userdata->ID;
        $role=get_user_role($user_id);
        
        if($role=='onelifepassport_member'){
            
            $onelife_auto_logout_time=600;
        }else{
            $onelife_auto_logout_time=172800;
        }
        
    }
    
    return $onelife_auto_logout_time;
}
//add_filter( 'auth_cookie_expiration', 'onelife_cokkies_timeout' );


function remove_menus(){
    
    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'jetpack' );                    //Jetpack*
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    //remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    //remove_menu_page( 'options-general.php' );        //Settings
    
}
add_action( 'admin_menu', 'remove_menus' );


function getCurrentURL()
{
    $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $currentURL .= $_SERVER["SERVER_NAME"];
    
    if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
    {
        $currentURL .= ":".$_SERVER["SERVER_PORT"];
    }
    
    $currentURL .= $_SERVER["REQUEST_URI"];
    return $currentURL;
}
?>