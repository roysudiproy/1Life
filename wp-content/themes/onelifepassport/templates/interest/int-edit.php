<?php
global $wpdb;

$table_interests=$wpdb->prefix.'interests';
$action="";
$int_id="";
$get_Int="";
$update_interest=false;
$interest="";

if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];    
}
if(isset($_REQUEST['int-id'])){
    $int_id=$_REQUEST['int-id'];
}

$redirect=false;
if($action!="edit" && $int_id==""){
    $redirect=true;
}

if($int_id){
    
    $get_Int = $wpdb->get_row( "SELECT * FROM $table_interests WHERE interest_id = $int_id",'OBJECT' );
    
    
    if (empty($get_Int)) {
        $redirect=true;
    }
}





if(isset($_POST['submit_update_interest'])){
    
    
    if(empty(trim($_POST['interest']))){
        $err_msg .="Please Enter Your Interest.<br>";
        
    }
    
    if(isset($_POST['interest']) && strlen($_POST['interest'])>75){
        $err_msg .="Text length should not be more than 75.<br>";
        
    }
    
    
    if($err_msg==""){
        
        $interest=wp_strip_all_tags(trim(stripslashes_deep($_POST['interest'])));
        
        
      if($wpdb->update(
            $table_interests,
            array(
                'interest'=>$interest
                
                
                
            ),
          array( 'interest_id' => $get_Int->interest_id ), 
            array(
                '%s',
                
            ),
          array( '%d' ) 
            )==false){
                $err_msg .=  $update_interest;
                $suc_msg="";
                
                $suc_msg .="Successfully Updated Interest";
                
                $_SESSION['update_int_message']=$suc_msg;
                
                wp_safe_redirect(get_permalink());
                exit();
                
            }else{
                
                $suc_msg .="Successfully Updated Interest";
                
                $_SESSION['update_int_message']=$suc_msg;
                
                wp_safe_redirect(get_permalink());
                exit();
                
            }
        
        
        
        
    }
    
}
?>
	<div class="col-sm-9">
				<h1>Add New Interest</h1>
					<div class="fullwidth">						
							<div class="formholder">
							<?php 
							if(isset($err_msg) && $err_msg!=""){
							    
							    echo '<div class="cs-form-err">'.$err_msg.'</div>';
    
							}
							?>
								<form id="cs-interest-form" name="interest-form" action="" method="POST">
									<div class="form-body">
										
										<div class="row">
    										<div class="form-group col-lg-12">
    												<div class="input-group">
    													<div class="input-group-addon">
    														<i class="fa fa-envelope" aria-hidden="true"></i>
    													</div>    													
    														<textarea placeholder="Interest" name="interest" maxlength="75" class="form-control validate[ required, maxSize[75]"><?php if(isset($_POST['interest'])) { echo $_POST['interest'];}else{echo $get_Int->interest;}?></textarea>
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>							
										</div>
										
										
									</div>

									<div class="form-footer">									
										<div class="buttonholder">											
											<input type="submit" class="cs-button-left" name="submit_update_interest" value="Update" >										</div>
									</div>
								</form>
							</div>
						</div>					
				</div>