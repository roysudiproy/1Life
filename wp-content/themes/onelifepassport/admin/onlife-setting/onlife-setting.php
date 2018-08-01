<?php 

function onelife_user_manage_setting_item() {
    register_setting( 'onlife-settings-group', 'onelife_google_site_key' );
    register_setting( 'onlife-settings-group', 'onelife_google_secret_key' );
    register_setting( 'onlife-settings-group', 'onelife_per_page_list' );
    
}
add_action( 'admin_init', 'onelife_user_manage_setting_item' );


function onelife_user_manage_setting(){ 

   
    
    ?>

<div class="wrap simsof-setting-wrapper">



<div class="container">
<h1>One Life Setting Page</h1>
<form method="post" action="options.php" class="onlief_setting_form" autocomplete="off">

 <?php settings_fields( 'onlife-settings-group' ); ?>
    <?php do_settings_sections( 'onlife-settings-group' ); ?>
   <div class="form-body">
							<div class="panel-heading"><strong>Google Recaptcha Setting</strong></div>			
										<div class="row">
    										<div class="form-group col-md-6">
    												<div class="input-group">
    													<label>Google Site Key</label>  													
    														<input type="text" name="onelife_google_site_key" class="form-control" value="<?php echo esc_attr( get_option('onelife_google_site_key') ); ?>" >
    														<p class="description" >Example: 6LfBkkQUAAAAAILGELg0xy6aPMabrBfaLSexMzM2
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>	
    											
    											<div class="form-group col-md-6">
    												<div class="input-group">
    														<label>Google Secret Key</label>   													
    														<input type="text" name="onelife_google_secret_key" class="form-control" value="<?php echo esc_attr( get_option('onelife_google_secret_key') ); ?>">
    														<p class="description" >Example: 6LfBkkQUAAAAAOzsc-JOlNHupHCU4klG9HFnlenc</p>
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>							
										</div>
										
										<div class="panel-heading"><strong>General Setting</strong></div>			
										<div class="row">
    										<div class="form-group col-md-6">
    										<div class="input-group">
    													<label>Show Per Page</label>  													
    														<input type="number" min="1" max="30" name="onelife_per_page_list" class="form-control" value="<?php echo esc_attr( get_option('onelife_per_page_list') ); ?>" >
    														<p class="description" >Example: 10
    												</div>
    										</div>
    										</div>
										
									</div>

									<div class="form-footer">									
										<div class="buttonholder">	
										
										<input type="submit" class="cs-button-left" name="submit" value="Save Changes" >										
										
											  
											  </div>
									</div>

</form>
</div>
</div>

<?php } ?>
