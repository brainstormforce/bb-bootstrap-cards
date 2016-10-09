<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 * 
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * Example: 
 */
?>

<div class="bb_ulti_boot_card_container">

	<!--Card image-->
	<div class="bb_ulti_boot_card_image">
	    <img src="<?php echo $settings->photo_field_src; ?>" />
	</div>
	<!--/.Card image-->

	<!--Card content-->
	<div class="bb_ulti_boot_card_block bb-content-align-<?php echo $settings->alignment; ?>">
	    <!--Title-->
	    <<?php echo $settings->tag; ?> class="bb_ulti_boot_card_title"><?php echo $settings->card_title; ?></<?php echo $settings->tag; ?>>
	    <!--Text-->
			<div class="bb_ulti_boot_card_text">
				<?php echo $settings->card_textarea; ?>
			</div>
	    <!--Link-->   
	    <a class="bb_ulti_boot_card_link" href="<?php echo $settings->link_field; ?>">
	    	<?php echo $settings->card_link_text; ?>
	    </a>
	</div>
	<!--/.Card content-->

</div>    