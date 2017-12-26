 <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
            <h2>Single Advertise Options</h2>
            <?php settings_errors(); ?>
             
            <?php
                if( isset( $_GET[ 'tab' ] ) ) {
                    $active_tab = $_GET[ 'tab' ];
                }else{
                	$active_tab = 'ad_options';
                }
            ?>
             
            <h2 class="nav-tab-wrapper">
                <a href="?page=single_ad_options&tab=ad_options" class="nav-tab <?php echo $active_tab == 'ad_options' ? 'nav-tab-active' : ''; ?>">Ad Options</a>
                <a href="?page=single_ad_options&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Help & About</a>
            </h2>
             
            <form id="featured_upload" method="post" action="" enctype="multipart/form-data">
            <?php
             
             if( $active_tab == 'ad_options' ) { ?>
            
                <input type="hidden" name="pgnyt_form_submitted" value="Y">
                            <p>
                                Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input name="title" id="title" type="text" value="<?php echo $title; ?>" class="all-options" required/><br><br>
                                Description  &nbsp;&nbsp;&nbsp;: <textarea name="description" rows="5" cols="60"  required><?php echo $description; ?></textarea><br><br>
                                Upload Image: 
                                <!--<input  class="form-control" name="image" type="file" /><br>-->

                                <input type="file" name="my_image_upload" id="my_image_upload"  multiple="false"  required/>
                                    <input type="hidden" name="post_id" id="post_id" value="55" />
                                    <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
    
                            <?php

                                $image_attributes = wp_get_attachment_image_src( $attachment_id );
                                if ( $image_attributes ) : ?>
                                    <img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
                                <?php endif; 

                            ?>

                            </p>
    
                            <p>
                                <input class="button-primary" type="submit" name="form_submit" value="Update" />
                            </p>

                       <?php  } else {
                           
                            echo '<h2><center>Coming Soon</center></h2><hr>';

                        } 
                         
                    ?>
                </form>
                         
         </div><!-- /.wrap -->