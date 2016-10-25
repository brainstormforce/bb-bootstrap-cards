<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 */
?>

<?php

$photo    = $module->get_data();
$classes  = $module->get_classes();
$src      = $module->get_src();
$link     = $module->get_link();
$alt      = $module->get_alt();
$attrs    = $module->get_attributes();
$filetype = pathinfo($src, PATHINFO_EXTENSION);

?>

<div class="bb_boot_card_container">

	<!--Card image-->
	<div class="bb_boot_card_image fl-photo<?php if ( ! empty( $settings->crop ) ) echo ' fl-photo-crop-' . $settings->crop ; ?> fl-photo-align-<?php echo $settings->align; ?>">
	    <!-- <img src="<?php //echo $settings->photo_field_src; ?>" /> -->
	    <img class="<?php echo $classes; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" itemprop="image" <?php echo $attrs; ?> />
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