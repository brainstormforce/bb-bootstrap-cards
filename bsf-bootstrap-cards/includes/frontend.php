<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 */
?>

<div class="bb_boot_card_container">

	<!--Card image-->
	<div class="bb_boot_card_image fl-photo<?php if ( ! empty( $settings->crop ) ) echo ' fl-photo-crop-' . $settings->crop ; ?> fl-photo-align-<?php echo $settings->align; ?>">
	    <!-- <img src="<?php //echo $settings->photo_field_src; ?>" /> -->
	    <?php if( $settings->photo != '' && isset( $settings->photo_src) ){ ?> 
		   <img src="<?php echo $settings->photo_src; ?>" />
		<?php } ?>
	</div>
	<!--/.Card image-->

	<!--Card content-->
	<div class="bb_boot_card_block bb-content-align-<?php echo $settings->alignment; ?>">
	    <!--Title-->
	    <<?php echo $settings->tag; ?> class="bb_boot_card_title"><?php echo $settings->card_title; ?></<?php echo $settings->tag; ?>>
	    <!--Text-->
			<div class="bb_boot_card_text">
				<?php echo $settings->card_textarea; ?>
			</div>
	    <!--Link-->   
	    <a class="bb_boot_card_link" href="<?php echo $settings->link_field; ?>">
	    	<?php echo $settings->card_link_text; ?>
	    </a>
	</div>
	<!--/.Card content-->

</div>    