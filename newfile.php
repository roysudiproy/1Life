<?php
   $prop_images = array();
   $terms_amenities = array();
   if (has_post_thumbnail()) :
   $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
   // array_push($prop_images, $thumb_url);
   endif;
   
   if (have_rows('gallery')) :
   
   // loop through the rows of data
   while (have_rows('gallery')) :
   the_row();
   $prop_images[] = get_sub_field('gallery_image');
   endwhile
   ;
   endif;
   
   $terms_amenities = wp_get_post_terms(get_the_ID(), 'amenities', array(
       'orderby' => 'name',
       'order' => 'ASC',
       'fields' => 'all'
   ));
   
   get_header();
   
   bac_PostViews(get_the_ID());
   
   ?>
<div class="global-page-banner cs-single-banner" style="background-image: url(<?php echo  $thumb_url;?>)">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="block-banner">
               <h2><?php the_title()?></h2>
               <ol class="breadcrumb">
                  <li><a href="<?php echo site_url();?>"> <i class="fa fa-home"></i>
                     Home
                     </a>
                  </li>
                  <li class="active"><?php the_title();?></li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Banner slider start-->
<?php
   while (have_posts()) :
       the_post();
       ?>
<!-- Castle Details page start -->
<div class="castleDetails">
   <div class="container">
      <div class="row">
         <div class="col-sm-8 wow  fadeInLeft">
            <div class="castleDetailsTop">
               <h2><?php the_title();?> <?php if(get_field('property_sub_title')<>"") :?>| <span><?php the_field('property_sub_title');?></span><?php endif; ?></h2>
               <?php if(!empty($terms_amenities)): ?>
               <div class="moreTwoBtnArea">
                  <ul>
                     <?php
                        $count_amenties = count($terms_amenities);
                        $i = 1;
                        foreach ($terms_amenities as $amenities) :
                            ?>
                     <li><a
                        href="<?php echo get_term_link($amenities->term_id); ?>"><?php echo $amenities->name;?></a></li>
                     <?php $i++; endforeach; ?>
                     <?php if($count_amenties>5 ){ ?>
                     <li class="btn2More"><a
                        href="javascript:void(0);">+ 2 more</a></li>
                     <?php } ?>
                  </ul>
               </div>
               <?php endif; ?>
               <div class="cs-key-wrap">
                  <h5>KEY FACTS</h5>
                  <ul class="cs-key-list">
                     <?php if(get_field('how_many_people_sleeps')<>""): ?>
                     <li><img
                        src="<?php echo get_template_directory_uri(); ?>/images/SLEEPS.png"
                        alt="SLEEPS" /> <span class="cs-key-txt">SLEEPS: <?php the_field('how_many_people_sleeps');?></span></li>
                     <?php endif; ?>
                     <?php if(get_field('bedroom')<>""): ?>
                     <li><img
                        src="<?php echo get_template_directory_uri(); ?>/images/BEDROOMS.png"
                        alt="BEDROOMS" /> <span class="cs-key-txt">BEDROOMS: <?php the_field('bedroom');?></span></li>
                     <?php endif; ?>
                     <?php if(get_field('bathrooms')<>""): ?>
                     <li><img
                        src="<?php echo get_template_directory_uri(); ?>/images/BATHROOMS.png"
                        alt="BATHROOMS" /> <span class="cs-key-txt">BATHROOMS: <?php the_field('bathrooms');?></span></li>
                     <?php endif; ?>
                  </ul>
               </div>
               <div class="castleDetailsTopList">
                  <?php the_content(); ?>
               </div>
            </div>
            <div class="castleDetailsTab">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#overview" data-toggle="tab">Overview
                     </a>
                  </li>
                  <li><a href="#history" data-toggle="tab">History</a></li>
                  <li><a href="#location" data-toggle="tab">Location</a></li>
                  <li><a href="#rates" data-toggle="tab">Rates</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="overview">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent=".tab-pane"
                                 href="#collapseOne"> Overview </a>
                           </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                           <div class="panel-body">
                              <?php the_field('overview'); ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="history">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent=".tab-pane"
                                 href="#collapseTwo"> History </a>
                           </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                           <div class="panel-body">
                              <?php the_field('history'); ?> 
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="location">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent=".tab-pane"
                                 href="#collapseThree"> Location </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                           <div class="panel-body">
                              <?php the_field('property_location'); ?> 
                              <div class="googleMapTab">
                                 <?php
                                    $location = get_field('location');
                                    
                                    if (! empty($location)) :
                                        ?>
                                 <div class="acf-map">
                                    <div class="marker"
                                       data-lat="<?php echo $location['lat']; ?>"
                                       data-lng="<?php echo $location['lng']; ?>"></div>
                                 </div>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="rates">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent=".tab-pane"
                                 href="#collapseFour"> Rates </a>
                           </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                           <div class="panel-body">
                              <?php
                                 $months_obj = "";
                                 if (have_rows('rate_table_gbp')) :
                                     ?>
                              <div class="cs-curr-wrapper">
                                 <label>Select currency</label>
                                 <div class="cs-currency-dropdown form-control"></div>
                              </div>
                              <p class="cs-occupency">
                                 Prices based on an occupancy of <strong>14 people</strong>:
                              </p>
                              <div class="table-responsive">
                                 <table
                                    class="table table-striped table-bordered cs-table-rates">
                                    <thead>
                                       <tr>
                                          <th>Rental period</th>
                                          <th>2 Nights</th>
                                          <th>3 Nights</th>
                                          <th>Weekly</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          while (have_rows('rate_table_gbp')) :
                                              the_row();
                                              ?>
                                       <tr>
                                          <td><?php
                                             echo get_month_name_from_value(get_sub_field('month'))?></td>
                                          <td
                                             <?php if(get_sub_field('2_nights')<>"" && get_sub_field('2_nights')>0) { ?>
                                             class="propprice" <?php } ?>><?php if(get_sub_field('2_nights')<>"" && get_sub_field('2_nights')>0) { echo '&pound;'.get_sub_field('2_nights'); } ?></td>
                                          <td
                                             <?php if(get_sub_field('3_nights')<>"" && get_sub_field('3_nights')>0) { ?>
                                             class="propprice" <?php } ?>><?php if(get_sub_field('3_nights')<>"" && get_sub_field('3_nights')>0) { echo '&pound;'.get_sub_field('3_nights'); } ?></td>
                                          <td
                                             <?php if(get_sub_field('weekly')<>"" && get_sub_field('weekly')>0) { ?>
                                             class="propprice" <?php } ?>><?php if(get_sub_field('weekly')<>"" && get_sub_field('weekly')>0) { echo '&pound;'.get_sub_field('weekly'); } ?></td>
                                       </tr>
                                       <?php endwhile; ?>
                                      
                                    </tbody>
                                 </table>
                              </div>
                              
                               <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="gallery">
                  <h4 class="panel-title">Gallery</h4>
                  <div id="galleyBody">
                     <div class="panel-body">
                        <div class="galleryRow">
                           <?php if(!empty($prop_images)): ?>
                           <div class=" gal-container">
                              <?php
                                 $i = 1;
                                 foreach ($prop_images as $key => $gal_img) :
                                     if ($gal_img != "") :
                                         ?>
                              <div class="col-md-4 col-sm-4 co-xs-12 gal-item">
                                 <div class="box">
                                    <a class="example-image-link" href="<?php echo $gal_img; ?>"
                                       data-lightbox="example-set"> <img
                                       src="<?php echo $gal_img; ?>">
                                    </a>
                                    <div class="modal fade" id="<?php echo $i;?>" tabindex="-1"
                                       role="dialog">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                             </button>
                                             <div class="modal-body">
                                                <img src="<?php echo $gal_img; ?>">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php $i++; endif; endforeach; ?>   
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="rightSideBar wow  fadeInRight">
               <div class="playTrip">
                  <h3>
                     <span><img
                        src="<?php echo get_template_directory_uri(); ?>/images/tripIconn.png"
                        alt="" /></span>Plan Your Trip
                  </h3>
                  <ul>
                     <li>Unique Portfolio</li>
                     <li>Big Travel team</li>
                     <li>Price Parity</li>
                     <li>Best Prices Guaranteed</li>
                     <li>No Booking Fees</li>
                     <li>Book Online 24/7 Instantly</li>
                  </ul>
               </div>
               <div class="checkAvaility">
                  <a href="javascript:void(0)" class="chAvail" data-toggle="modal"
                     data-target="#bookingFromModal"> <i class="fa fa-calendar"
                     aria-hidden="true"></i> Book Direct Now
                  </a>
               </div>
               <div class="checkAvaility enquireNow">
                  <a href="javascript:void(0)" class="chAvail" data-toggle="modal"
                     data-target="#enquireFromModal"> <i
                     class="fa fa-question-circle-o" aria-hidden="true"></i> Enquire
                  Now
                  </a>
               </div>
               <div class="castleAccordian">
                  <div class="panel-group" id="accordion">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse"
                                 data-parent="#accordion" href="#accordion1"> Price Guide </a>
                           </h4>
                        </div>
                        <div id="accordion1" class="panel-collapse collapse ">
                           <div class="panel-body">
                              <div class="castelAccoContent">
                                 <?php
                                    if (get_field('price_guide') != "") {
                                            the_field('price_guide');
                                        }
                                        ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse"
                                 data-parent="#accordion" href="#accordion2"> Booking Terms </a>
                           </h4>
                        </div>
                        <div id="accordion2" class="panel-collapse collapse">
                           <div class="panel-body">
                              <div class="castelAccoContent">
                                 <?php
                                    if (get_field('booking_terms') != "") {
                                            the_field('booking_terms');
                                        }
                                        ?>
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
<?php endwhile; ?>
<!-- Castle Details page End -->
<!-- Modal -->
<div id="bookingFromModal" class="modal fade   animated bookingModal"
   role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Booking Form</h4>
         </div>
         <div class="modal-body">
            <div class="bookingForm">
               <?php echo do_shortcode('[booking]'); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Enquire Now modal start-->
<div id="enquireFromModal" class="modal fade   animated bookingModal"
   role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php the_title();?></h4>
         </div>
         <div class="modal-body">
            <div class="bookingForm">
               <div class="booking_form_div">
                  <?php echo do_shortcode('[contact-form-7 id="1093" title="Enquire"]'); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   jQuery(document).ready(function($){
       //alert("Hello");
      jQuery('#arrivalDate').datepicker(); 
       jQuery('#departureDate').datepicker(); 
   
       
   }); 
   
</script>
<style type="text/css">
   .acf-map {
   width: 100%;
   height: 400px;
   border: #ccc solid 1px;
   margin: 20px 0;
   }
   /* fixes potential theme css conflict */
   .acf-map img {
   max-width: inherit !important;
   }
</style>
<?php get_footer(); ?>