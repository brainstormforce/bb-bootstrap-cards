/**
 * This file should contain frontend styles that 
 * will be applied to individual module instances.
 *
 */

.fl-node-<?php echo $id; ?> {
    font-size: <?php echo $settings->text_field; ?>px;
}

<?php 
	$settings->bg_color = UABB_Helper::uabb_colorpicker( $settings, 'bg_color', true );
	$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->link_color = UABB_Helper::uabb_colorpicker( $settings, 'link_color' );
	$settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );
?>

/* Background Property */
.fl-node-<?php echo $id; ?> .bb_boot_card_container { 
		background: <?php echo $settings->bg_color; ?>;
}


/* BCard Heading Typography */
.fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.bb_boot_card_title,
.fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.bb_boot_card_title * {
	
	<?php if(!empty($settings->color)) : ?>
		color: <?php echo $settings->color; ?>;
	<?php endif; ?>
	
	<?php if( !empty($settings->font) && $settings->font['family'] != 'Default' ) : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font ); ?>
	<?php endif; ?>

	<?php if( $settings->new_font_size['desktop'] != '' ) : ?>
		font-size: <?php echo $settings->new_font_size['desktop']; ?>px;
	<?php elseif( isset( $settings->font_size ) && isset( $settings->custom_font_size ) && $settings->font_size == 'custom' && $settings->custom_font_size != '' ) : ?>
		font-size: <?php echo $settings->custom_font_size; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>
}


/* BCard's Description Typography */
.fl-node-<?php echo $id; ?> .bb_boot_card_text,
.fl-node-<?php echo $id; ?> .bb_boot_card_text * {
	
	<?php if(!empty($settings->desc_color)) : ?>
		color: <?php echo $settings->desc_color; ?>;
	<?php endif; ?>

	<?php if( !empty($settings->desc_font_family) && $settings->desc_font_family['family'] != 'Default' ) : ?>
		<?php UABB_Helper::uabb_font_css( $settings->desc_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->desc_font_size['desktop'] != '' ) : ?>
		font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
	<?php endif; ?>
	<?php if( $settings->desc_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
	<?php endif; ?>
}

/* BCard's Link color */
.fl-node-<?php echo $id; ?> .bb_boot_card_link {
	<?php if(!empty($settings->link_color)) : ?>
		color: #<?php echo $settings->link_color; ?>;
	<?php endif; ?>
}