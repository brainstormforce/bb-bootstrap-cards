<?php
/**
 * Beaver Builder Cards
 *
 * @package  bb-bootstrap-cards
 */

?>

/* Background Property */
<?php if ( ! empty( $settings->bg_color ) ) : ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_container { 
	background-color: #<?php echo $settings->bg_color; ?>;
	background: rgba(<?php echo implode( ',', FLBuilderColor::hex_to_rgb( $settings->bg_color ) ); ?>, <?php echo ( '' != $settings->bg_color_opc ) ? $settings->bg_color_opc / 100 : 100; ?>);
}
<?php endif; ?>

/* BCard Heading Typography */
<?php if ( ! empty( $settings->heading_font ) && 'Default' != $settings->heading_font['family'] ) : ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_title,
.fl-node-<?php echo $id; ?> .bb_boot_card_title *{
	<?php FLBuilderFonts::font_css( $settings->heading_font ); ?>
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .bb_boot_card_title,
.fl-node-<?php echo $id; ?> .bb_boot_card_title * {
<?php if ( ! empty( $settings->color ) ) : ?>
	color: #<?php echo $settings->color; ?>;
<?php endif; ?>

<?php if ( 'custom' == $settings->title_size ) : ?>
	font-size: <?php echo $settings->title_custom_size; ?>px;
<?php endif; ?>

<?php if ( 'custom' == $settings->title_line_height ) : ?>
	line-height: <?php echo $settings->title_custom_line_height; ?>px;
<?php endif; ?>

<?php if ( 'custom' == $settings->title_letter_spacing ) : ?>
	letter-spacing: <?php echo $settings->title_custom_letter_spacing; ?>px;
<?php endif; ?>

}

.fl-node-<?php echo $id; ?> .bb_boot_card_title {
margin-top: <?php echo ( trim( $settings->title_margin_top ) != '' ) ? $settings->title_margin_top : '0'; ?>px;
margin-bottom: <?php echo ( trim( $settings->title_margin_bottom ) != '' ) ? $settings->title_margin_bottom : '0'; ?>px;
<?php if ( '' != $settings->title_margin_top || '' != $settings->title_margin_bottom ) { ?>
<?php } ?>
}

/* BCard's Link color */

<?php if ( ! empty( $settings->link_text_font_family ) && 'Default' != $settings->link_text_font_family['family'] ) : ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_link, .fl-node-<?php echo $id; ?> .bb_boot_card_link:visited{
	<?php FLBuilderFonts::font_css( $settings->link_text_font_family ); ?>
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .bb_boot_card_link, .fl-node-<?php echo $id; ?> .bb_boot_card_link:visited {
<?php if ( ! empty( $settings->link_color ) ) : ?>
	color: #<?php echo $settings->link_color; ?>;
<?php endif; ?>

<?php if ( 'custom' == $settings->link_font_size ) : ?>
	font-size: <?php echo $settings->link_custom_size; ?>px;
<?php endif; ?>

<?php if ( 'custom' == $settings->link_line_height ) : ?>
	line-height: <?php echo $settings->link_custom_line_height; ?>px;
<?php endif; ?>

<?php if ( 'custom' == $settings->link_letter_spacing ) : ?>
	letter-spacing: <?php echo $settings->link_custom_letter_spacing; ?>px;
<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .bb_boot_card_link:hover {
<?php if ( ! empty( $settings->link_hover_color ) ) : ?>
	color: #<?php echo $settings->link_hover_color; ?>;
<?php endif; ?>
}

<?php if ( 'link' == $settings->card_btn_type ) { ?>
/* Link Text Margin */
.fl-node-<?php echo $id; ?> .bb_boot_card_link {
margin-top: <?php echo ( trim( $settings->link_margin_top ) != '' ) ? $settings->link_margin_top : '0'; ?>px;
margin-bottom: <?php echo ( trim( $settings->link_margin_bottom ) != '' ) ? $settings->link_margin_bottom : '0'; ?>px;
<?php if ( '' != $settings->link_margin_top || '' != $settings->link_margin_bottom ) { ?>
display:block;
<?php } ?>
}
<?php } ?>


/* BCard's Description Typography */

<?php if ( ! empty( $settings->desc_font_family ) && 'Default' != $settings->desc_font_family['family'] ) : ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_text{
	<?php FLBuilderFonts::font_css( $settings->desc_font_family ); ?>
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_text,
.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_text * {
<?php if ( ! empty( $settings->desc_color ) ) : ?>
	color: #<?php echo $settings->desc_color; ?>;
<?php endif; ?>

<?php if ( 'custom' == $settings->desc_font_size ) : ?>
	font-size: <?php echo $settings->desc_custom_size; ?>px;
<?php endif; ?>

<?php if ( 'custom' == $settings->desc_line_height ) : ?>
	line-height: <?php echo $settings->desc_custom_line_height; ?>px;
<?php endif; ?>

<?php if ( 'custom' == $settings->title_letter_spacing ) : ?>
	letter-spacing: <?php echo $settings->desc_custom_letter_spacing; ?>px;
<?php endif; ?>

}

.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_text {
margin-top: <?php echo ( trim( $settings->desc_margin_top ) != '' ) ? $settings->desc_margin_top : '0'; ?>px;
margin-bottom: <?php echo ( trim( $settings->desc_margin_bottom ) != '' ) ? $settings->desc_margin_bottom : '0'; ?>px;
<?php if ( '' != $settings->desc_margin_top || '' != $settings->desc_margin_bottom ) { ?>
<?php } ?>
}


/* BCard's Button Link */
<?php if ( 'button' == $settings->card_btn_type ) : ?>
<?php
	/**
	 * Helper function to format color value for CSS output.
	 * Handles: rgb(), rgba(), hex with #, hex without #
	 */
	if ( ! function_exists( 'bb_cards_format_color' ) ) {
		function bb_cards_format_color( $color, $default = '' ) {
			if ( empty( $color ) ) {
				return $default ? bb_cards_format_color( $default ) : '';
			}
			// If it's rgb/rgba format, return as-is
			if ( strpos( $color, 'rgb' ) === 0 ) {
				return $color;
			}
			// If it starts with #, return as-is
			if ( strpos( $color, '#' ) === 0 ) {
				return $color;
			}
			// Otherwise, it's a hex without #, add it
			return '#' . $color;
		}
	}

	// Get button colors with fallback to defaults
	$btn_bg_color = bb_cards_format_color(
		isset( $settings->btn_bg_color ) ? $settings->btn_bg_color : '',
		'ffdd00'
	);
	$btn_text_color = bb_cards_format_color(
		isset( $settings->btn_text_color ) ? $settings->btn_text_color : '',
		'414242'
	);
	$btn_text_hover_color = bb_cards_format_color(
		isset( $settings->btn_text_hover_color ) ? $settings->btn_text_hover_color : '',
		'ffffff'
	);
?>
<?php if ( ! empty( $settings->btn_font_family ) && 'Default' != $settings->btn_font_family['family'] ) : ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_link_button .bb_boot_button{
	<?php FLBuilderFonts::font_css( $settings->btn_font_family ); ?>
}
<?php endif; ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_link_button .bb_boot_button {
	color: <?php echo $btn_text_color; ?> !important;
<?php if ( 'custom' == $settings->btn_font_size ) : ?>
	font-size: <?php echo $settings->btn_custom_size; ?>px;
<?php endif; ?>
<?php if ( ! empty( $settings->btn_line_height ) ) : ?>
	line-height: <?php echo $settings->btn_line_height; ?>px;
<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_link_button:hover .bb_boot_button {
	color: <?php echo $btn_text_hover_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_link_button {
	background-color: <?php echo $btn_bg_color; ?> !important;
	padding: 8px 16px;
	text-decoration: none;
<?php if ( ! empty( $settings->btn_border_radius ) ) : ?>
	border-radius: <?php echo $settings->btn_border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->btn_border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->btn_border_radius; ?>px;
<?php endif; ?>
}

<?php if ( ! empty( $settings->btn_bg_hover_color ) ) : ?>
.fl-node-<?php echo $id; ?> .bb_boot_card_block .bb_boot_card_link_button:hover {
	background-color: <?php echo bb_cards_format_color( $settings->btn_bg_hover_color ); ?> !important;
}
<?php endif; ?>
<?php endif; ?>

