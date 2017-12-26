<?php 

	echo $before_widget;
	echo '<h2>Advertisements</h2>';


?>
<ul class="pgnyt-articles frontend">

	<li class="pgnyt-articles">

			<div class="pgnyt-articles-info">
										
			<?php 

				echo $title.'<br>';
				echo $description.'<br>';
				   $image_attributes = wp_get_attachment_image_src( $attachment_id );
				if ( $image_attributes ) : ?>
    				<img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />

			 <?php endif; 

                      ?>
			</div>
	</li>

</ul>

<?php 
	echo $after_widget;
?>