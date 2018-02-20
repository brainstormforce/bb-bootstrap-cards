<?php
/**
 * Beaver Builder Cards
 *
 * @package  bb-bootstrap-cards
 */

?>

<div class="bb_boot_card_container bb-content-align-<?php echo $settings->alignment; ?>">

	<!--Card image-->
	<div class="bb_boot_card_image">
		<?php
			$classes = $module->get_classes();
			$src     = $module->get_src();
			$alt     = $module->get_alt();
			$attrs   = $module->get_attributes();
		?>
		<?php if ( 'yes' == $settings->photo_hyperlink && 'link' == $settings->card_btn_type ) : ?>
		<a href="<?php echo $settings->link_field; ?>" target="<?php echo $settings->link_target; ?>" itemprop="url">
		<?php endif; ?>
		<?php if ( 'yes' == $settings->photo_hyperlink && 'button' == $settings->card_btn_type ) : ?>
		<a href="<?php echo $settings->btn_link; ?>" target="<?php echo $settings->btn_link_target; ?>" itemprop="url">
		<?php endif; ?>
		<img class="<?php echo $classes; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" itemprop="image" <?php echo $attrs; ?> />
		<?php if ( 'yes' == $settings->photo_hyperlink && 'none' != $settings->card_btn_type ) : ?>
		</a>
		<?php endif; ?>

	</div>
	<!--/.Card image-->

	<!--Card content-->
	<div class="bb_boot_card_block">
		<!--Title-->
		<<?php echo $settings->tag; ?> class="bb_boot_card_title"><?php echo $settings->card_title; ?></<?php echo $settings->tag; ?>>
		<!--/.Title-->	
			<!--Text-->
			<div class="bb_boot_card_text">
				<?php echo $settings->card_textarea; ?>
			</div>
			<!--/.Text-->	
			<!--Link--> 
			<?php if ( 'link' == $settings->card_btn_type ) { ?>  
			<a class="bb_boot_card_link" href="<?php echo $settings->link_field; ?>" target="<?php echo $settings->link_target; ?>">
				<?php echo $settings->card_btn_text; ?>
			</a>
		<?php } elseif ( 'button' == $settings->card_btn_type ) { ?>
			<a class="bb_boot_card_link_button" href="<?php echo $settings->btn_link; ?>" target="<?php echo $settings->btn_link_target; ?>">
				<span class="bb_boot_button"><?php echo $settings->btn_text; ?></span>
			</a>	
		<?php } ?>
		<!--/.Link-->

	</div>
	<!--/.Card content-->

</div>    
