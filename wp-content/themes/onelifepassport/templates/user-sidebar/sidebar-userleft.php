<div class="col-md-3 col-sm-3 foldinsmall">
		      <div class="menuarea">
			  <div class="user-id">
				<p class="headingptag"></p>
				<h2 class="username"><?php echo get_user_meta($user_id, 'first_name', true).' '.get_user_meta($user_id, 'last_name', true);?></h2>
			  </div>
			      <ul class="cs-sidebar-list">
					<li class="activeli"><div class="menuiconholder"><img src="<?php echo get_template_directory_uri(); ?>/images/contactico.png" alt="Contact"/></div><a href="<?php echo site_url().'/contacts/'?>" >contacts</a></li>
					<li><div class="menuiconholder"><img src="<?php echo get_template_directory_uri(); ?>/images/interestico.png" alt="Interests"/></div><a href="<?php echo site_url().'/interests/'?>">Interests</a></li>
					<li><div class="menuiconholder"><img src="<?php echo get_template_directory_uri(); ?>/images/organizationico.png" alt="Organisation"/></div><a href="<?php echo site_url().'/organization/'?>">Organisation</a></li>
					<li><div class="menuiconholder"><img src="<?php echo get_template_directory_uri(); ?>/images/dataico.png" alt="data export"/></div><a href="<?php echo site_url();?>/export/">data export</a></li>
					<li><div class="menuiconholder"><i class="fa fa-sign-out" aria-hidden="true"></i></div><a href="<?php echo wp_logout_url(site_url())?>">Logout</a></li>
				  </ul>
			  </div>
		   </div>