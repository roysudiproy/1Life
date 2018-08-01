<?php
/*
 Template Name: Export Data
 
 */
session_start();
error_reporting(E_ALL & ~ E_NOTICE);
$action="";
require_once TEMPLATEPATH. '/templates/user-data/user-data.php';

include TEMPLATEPATH.'/templates/export/exp-contact-inc.php';

include TEMPLATEPATH.'/templates/export/exp-organisation-inc.php';

include TEMPLATEPATH.'/templates/export/exp-interest-inc.php';
get_header();
?>
<div class="container">
     <div class="bodycontent">
	    <div class="row">
		   <?php include TEMPLATEPATH.'/templates/user-sidebar/sidebar-userleft.php';

            ?>
            
            <div class="col-sm-9">
	<h1>Export Data</h1>
	<div class="fullwidth">
		<div class="formholder cs-export-list">
			<div class="form-body">
			
			<?php  if (isset($err_msg) && $err_msg != "") {
        
        echo '<div class="cs-form-err">' . $err_msg . '</div>';
    }?>
			
	

				<div class="row">
				
				<div class="col-md-12">
				<div id="jq-export-tab" class="cs-export-tab">
                  <ul>
                    <li><a href="#contact-export">Contact Export</a></li>
                    <li><a href="#organisation-export">Organisation Export</a></li>
                    <li><a href="#interest-export">Interest Export</a></li>
                  </ul>
                  <div id="contact-export">
                   <?php include TEMPLATEPATH.'/templates/export/exp-contact-view.php'; ?>
                  </div>
                  <div id="organisation-export">
                  <?php include TEMPLATEPATH.'/templates/export/exp-organisation-view.php'; ?>
                  </div>
                  <div id="interest-export">
                     <?php include TEMPLATEPATH.'/templates/export/exp-interest-view.php'; ?>
                  </div>
                </div>
                
                </div>
					
				</div>
			</div>

		</div>
	</div>
</div>

	</div>
	 </div>
  </div>

<?php 
get_footer();
?>