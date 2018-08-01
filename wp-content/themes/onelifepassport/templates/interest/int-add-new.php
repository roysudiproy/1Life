<?php 
global $wpdb;

$table_interests=$wpdb->prefix.'interests';

$insert_interest="";
$err_msg="";
$suc_msg="";

$interest="";



if(isset($_POST['submit_add_interest'])){
    
    
    if(empty(trim($_POST['interest']))){
        $err_msg .="Please Enter Your Interest.<br>";
        
    }
    
    if(isset($_POST['interest']) && strlen($_POST['interest'])>75){
        $err_msg .="Text length should not be more than 75.<br>";
        
    }

    
   
    
    if($err_msg==""){
        
       
        $interest=wp_strip_all_tags(trim(stripslashes_deep($_POST['interest'])));
        
        $insert_interest= $wpdb->insert(
            $table_interests,
            array(
                'user_id'=>$user_id,
                'interest'=>$interest
            ),
            array(
                '%d',
                '%s',
               
            )
            );
        
        if($insert_interest){
            
            $suc_msg .="Successfully added Interest";
            
            $_SESSION['insert_int_message']=$suc_msg;
            wp_safe_redirect(get_permalink());
            exit();
            
        }else{
            
            $err_msg .=$wpdb->show_errors;
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
    														<textarea placeholder="Interest" name="interest" maxlength="75" class="form-control validate[ required, maxSize[75]"><?php if(isset($_POST['interest'])) { echo $_POST['interest'];}?></textarea>
    												</div>
    												<span class="help-block" id="error"></span>
    											</div>							
										</div>
										
										
									</div>

									<div class="form-footer">									
										<div class="buttonholder">											
											<input type="submit" class="cs-button-left" name="submit_add_interest" value="Add" >										</div>
									</div>
								</form>
							</div>
						</div>					
				</div>