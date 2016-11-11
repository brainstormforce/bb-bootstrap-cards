<?php

/**
 * @class BSFBBCards
 */
class BSFBBCards  extends FLBuilderModule {
  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Bootstrap Cards', 'bb-bootstrap-cards'),
            'description'   => __('To create Bootstrap Card builder modules.', 'bb-bootstrap-cards'),
            'category'		=> __('Advanced Modules', 'bb-bootstrap-cards'),
            'dir'           => BB_BOOTSTRAPCARDS_DIR . 'bb-bootstrap-cards-module/',
            'url'           => BB_BOOTSTRAPCARDS_URL . 'bb-bootstrap-cards-module/',
            'partial_refresh'   => true
        ));
        
    }

    /**
     * @method update
     * @param $settings {object}
     */
    public function update($settings)
    {
        // Make sure we have a photo_src property.
        if(!isset($settings->photo_src)) {
            $settings->photo_src = '';
        }
        // Cache the attachment data.
        $data = FLBuilderPhoto::get_attachment_data($settings->photo);

        if($data) {
            $settings->data = $data;
        }
        return $settings;
    }
  

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSFBBCards', 
    array(
        'general'       => array( // Tab
            'title'         => __('General', 'bb-bootstrap-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => __('Card Elements', 'bb-bootstrap-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_title'     => array(
                            'type'          => 'text',
                            'label'         => __('Text Field', 'bb-bootstrap-cards'),
                            'default'       => '',
                            'placeholder'   => 'Enter Card Title',
                            'default'       => __('Card title', 'bb-bootstrap-cards'),
                            'class'         => 'my-card-title',
                            'preview'         => array(
                                'type'             => 'text',
                                'selector'         => '.bb_boot_card_title'
                            )
                        ),

                        'card_textarea' => array(
                            'type'          => 'textarea',
                            'label'         => __('Textarea Field', 'bb-bootstrap-cards'),
                            'default'       => '',
                            'placeholder'   => __('Enter Card Text', 'bb-bootstrap-cards'),
                            'default'       => __('Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totam rem aperiam.', 'bb-bootstrap-cards'),
                            'rows'          => '6',
                            'preview'         => array(
                                'type'             => 'text',
                                'selector'         => '.bb_boot_card_text'  
                            )
                        )
                    )
                ),
                'structure'     => array(
                    'title'         => __('Structure', 'bb-bootstrap-cards'),
                    'fields'        => array(
                        'alignment'     => array(
                            'type'          => 'select',
                            'label'         => __('Alignment', 'bb-bootstrap-cards'),
                            'default'       => 'Left',
                            'options'       => array(
                                'left'      =>  __('Left', 'bb-bootstrap-cards'),
                                'center'    =>  __('Center', 'bb-bootstrap-cards'),
                                'right'     =>  __('Right', 'bb-bootstrap-cards')
                            ),
                            'help'         => __('This is the overall alignment and would apply to all Card elements', 'bb-bootstrap-cards'),
                        ),
                        'bg_color' => array( 
                            'type'       => 'color',
                            'label'         => __('Background Color', 'bb-bootstrap-cards'),
                            'default'    => '',
                            'show_reset' => true,
                        ),

                        'bg_color_opc' => array( 
                            'type'        => 'text',
                            'label'       => __('Opacity', 'bb-bootstrap-cards'),
                            'default'     => '',
                            'description' => '%',
                            'maxlength'   => '3',
                            'size'        => '5',
                        )
                    )
                )
            )
        ),

        'image'       => array( // Tab
            'title'         => __('Image', 'bb-bootstrap-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'card_image'       => array( // Section
                    'title'         => __('Select Card Image', 'bb-bootstrap-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'photo'         => array(
                            'type'          => 'photo',
                            'label'         => __('Photo', 'bb-bootstrap-cards'),
                            'show_remove'   => true
                        ),

                    )     
                )
            )
        ),

        'link'      => array( // Tab
            'title'         => __('Link / Button ', 'bb-bootstrap-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'card_link'       => array( // Section
                    'title'         => __('Select Read More', 'bb-bootstrap-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_btn_type'      => array(
                        'type'          => 'select',
                        'label'         => __('Type', 'bb-bootstrap-cards'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => _x( 'None', 'bb-bootstrap-cards' ),
                            'link'          => __('Text', 'bb-bootstrap-cards'),
                            'button'        => __('Button', 'bb-bootstrap-cards'),
                        ),
                        'toggle'        => array(
                            'none'          => array(),
                            'link'          => array(
                                'fields'        => array('card_btn_text'),
                                'sections'      => array('link', 'link_typography')
                            ),
                            'button'        => array(
                                'sections'      => array('btn-link', 'btn_typography')
                            ),

                            )
                        ),
                        

                    )
                ),

                'link'          => array(
                    'title'         => __('Link', 'bb-bootstrap-cards'),
                    'fields'        => array(
                        
                        'card_btn_text'      => array(
                            'type'          => 'text',
                            'label'         => __('Text', 'bb-bootstrap-cards'),
                            'default'       => __('Read More', 'bb-bootstrap-cards'),
                        ),

                        'link_field'          => array(
                            'type'          => 'link',
                            'label'         => __('Link', 'bb-bootstrap-cards'),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'link_target'   => array(
                            'type'          => 'select',
                            'label'         => __('Link Target', 'bb-bootstrap-cards'),
                            'default'       => '_self',
                            'options'       => array(
                                '_self'         => __('Same Window', 'bb-bootstrap-cards'),
                                '_blank'        => __('New Window', 'bb-bootstrap-cards')
                            ),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        
                    )
                ),

                'link_typography'    =>  array(
                    'title' => __( 'Link Typography', 'bb-bootstrap-cards' ),
                    'fields'    => array(
                        'link_text_font_family'       => array(
                            'type'          => 'font',
                            'label'         => __('Font Family', 'bb-bootstrap-cards'),
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 'Default'
                            ),
                            'preview'   => array(
                                'type'      => 'font',
                                'selector'  => '.bb_boot_card_block .bb_boot_card_link'
                            ),
                        ),

                        'link_font_size'    => array(
                            'type'          => 'select',
                            'label'         => __('Link Font Size', 'bb-bootstrap-cards'),
                            'default'       => 'default',
                            'options'       => array(
                                'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                            ),
                            'toggle'        => array(
                                'custom'        => array(
                                    'fields'        => array('link_custom_size')
                                )
                            )
                        ),
                        'link_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Font Size', 'bb-bootstrap-cards'),
                            'default'           => '20',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'link_line_height'     => array(
                            'type'          => 'select',
                            'label'         => __('Line Height', 'bb-bootstrap-cards'),
                            'default'       => 'default',
                            'options'       => array(
                                'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                            ),
                            'toggle'        => array(
                                'custom'        => array(
                                    'fields'        => array('link_custom_line_height')
                                )
                            )
                        ),
                        'link_custom_line_height' => array(
                            'type'          => 'text',
                            'label'         => __('Custom Line Height', 'bb-bootstrap-cards'),
                            'default'       => '24',
                            'maxlength'     => '4',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                        'link_letter_spacing'     => array(
                            'type'          => 'select',
                            'label'         => __('Letter Spacing', 'bb-bootstrap-cards'),
                            'default'       => 'default',
                            'options'       => array(
                                'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                            ),
                            'toggle'        => array(
                                'custom'        => array(
                                    'fields'        => array('link_custom_letter_spacing')
                                )
                            )
                        ),
                        'link_custom_letter_spacing' => array(
                            'type'          => 'text',
                            'label'         => __('Custom Letter Spacing', 'bb-bootstrap-cards'),
                            'default'       => '0',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),

                        'link_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Link Color', 'bb-bootstrap-cards'),
                            'default'    => '',
                            'show_reset' => true,
                        ),

                        'link_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Link Color', 'bb-bootstrap-cards'),
                            'default'    => '',
                            'show_reset' => true,
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'color',
                                'selector' => '.bb_boot_card_block .bb_boot_card_link',
                            )
                        ),

                        'link_hover_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Link Hover Color', 'bb-bootstrap-cards'),
                            'default'    => '',
                            'show_reset' => true,
                        ),

                        'link_margin_top' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Top', 'bb-bootstrap-cards'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-top',
                                'selector' => '.bb_boot_card_block .bb_boot_card_link',
                                'unit'       => 'px'
                            )

                        ),
                        'link_margin_bottom' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Bottom', 'bb-bootstrap-cards'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-bottom',
                                'selector' => '.bb_boot_card_link',
                                'unit'       => 'px'
                            )
                        ),
                    )
                ),

                'btn-link'       => array( // Section
                    'title'         => __('Button', 'bb-bootstrap-cards'),
                    'fields'        => array(

                        'btn_text'          => array(
                            'type'          => 'text',
                            'label'         => __('Button Text', 'bb-bootstrap-cards'),
                            'default'       => __('Click Here', 'bb-bootstrap-cards'),
                        ),

                        'btn_link'          => array(
                            'type'          => 'link',
                            'label'         => __('Button Link', 'bb-bootstrap-cards'),
                            'placeholder'   => __( 'http://www.example.com', 'bb-bootstrap-cards' ),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'btn_link_target'   => array(
                            'type'          => 'select',
                            'label'         => __('Button Target', 'bb-bootstrap-cards'),
                            'default'       => '_self',
                            'options'       => array(
                                '_self'         => __('Same Window', 'bb-bootstrap-cards'),
                                '_blank'        => __('New Window', 'bb-bootstrap-cards')
                            ),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        )
                    )
                ),

                'btn_typography'     => array( // Section
                    'title'         => __('Button Typography', 'bb-bootstrap-cards'),
                    'fields'        => array(
                        'btn_font_family'       => array(
                            'type'          => 'font',
                            'label'         => __('Font Family', 'bb-bootstrap-cards'),
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 'Default'
                            ),
                            'preview'   => array(
                                'type'      => 'font',
                                'selector'  => '.bb_boot_card_block .bb_boot_card_link_button .bb_boot_button'
                            ),
                        ),
                        'btn_font_size'    => array(
                            'type'          => 'select',
                            'label'         => __('Font Size', 'bb-bootstrap-cards'),
                            'default'       => 'default',
                            'options'       => array(
                                'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                            ),
                            'toggle'        => array(
                                'custom'        => array(
                                    'fields'        => array('btn_custom_size', 'btn_line_height')
                                )
                            )
                        ),
                        'btn_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Font Size', 'bb-bootstrap-cards'),
                            'default'           => '14',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'btn_line_height' => array(
                            'type'          => 'text',
                            'label'         => __('Line Height', 'bb-bootstrap-cards'),
                            'description'   => 'px',
                            'default'           => '16',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'      => '.bb_boot_card_block .bb_boot_card_link_button',
                                'property'      => 'line-height',
                                'unit'          => 'px'
                            )
                        ),

                        'btn_text_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Text Color', 'bb-bootstrap-cards'),
                            'default'    => '#414242',
                            'show_reset' => true,
                        ),
                        'btn_text_hover_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Text Hover Color', 'bb-bootstrap-cards'),
                            'default'    => '#ffffff',
                            'show_reset' => true,
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'btn_bg_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Background Color', 'bb-bootstrap-cards'),
                            'default'    => '#ffdd00',
                            'show_reset' => true,
                        ),
                        'btn_bg_hover_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Background Hover Color', 'bb-bootstrap-cards'),
                            'default'    => '',
                            'show_reset' => true,
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'btn_border_radius' => array(
                            'type'          => 'text',
                            'label'         => __('Round Corners', 'bb-bootstrap-cards'),
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                    )
                ),

            )
        ),

        'typography'         => array(
            'title'         => __('Typography', 'bb-bootstrap-cards'),
                'sections'      => array(
                    'heading_card'     => array(
                        'title'         => __('Heading', 'bb-bootstrap-cards'),
                        'fields'        => array(
                            'tag'           => array(
                                'type'          => 'select',
                                'label'         => __( 'HTML Tag', 'bb-bootstrap-cards' ),
                                'default'       => 'h4',
                                'options'       => array(
                                    'h1'            =>  'h1',
                                    'h2'            =>  'h2',
                                    'h3'            =>  'h3',
                                    'h4'            =>  'h4',
                                    'h5'            =>  'h5',
                                    'h6'            =>  'h6'
                                )
                            ),
                            'heading_font'          => array(
                                'type'          => 'font',
                                'default'       => array(
                                    'family'        => 'Default',
                                    'weight'        => 300
                                ),
                                'label'         => __('Font', 'bb-bootstrap-cards'),
                                'preview'         => array(
                                    'type'            => 'font',
                                    'selector'        => '.bb_boot_card_block .bb_boot_card_title'
                                )
                            ),

                            'title_size'    => array(
                                'type'          => 'select',
                                'label'         => __('Heading Size', 'bb-bootstrap-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                    'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('title_custom_size')
                                    )
                                )
                            ),
                            'title_custom_size' => array(
                                'type'              => 'text',
                                'label'             => __('Heading Custom Size', 'bb-bootstrap-cards'),
                                'default'           => '24',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px'
                            ),

                            'title_line_height'     => array(
                                'type'          => 'select',
                                'label'         => __('Line Height', 'bb-bootstrap-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                    'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('title_custom_line_height')
                                    )
                                )
                            ),
                            'title_custom_line_height' => array(
                                'type'          => 'text',
                                'label'         => __('Custom Line Height', 'bb-bootstrap-cards'),
                                'default'       => '26',
                                'maxlength'     => '4',
                                'size'          => '4',
                                'description'   => 'px'
                            ),
                            'title_letter_spacing'     => array(
                                'type'          => 'select',
                                'label'         => __('Letter Spacing', 'bb-bootstrap-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                    'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('title_custom_letter_spacing')
                                    )
                                )
                            ),
                            'title_custom_letter_spacing' => array(
                                'type'          => 'text',
                                'label'         => __('Custom Letter Spacing', 'bb-bootstrap-cards'),
                                'default'       => '0',
                                'maxlength'     => '3',
                                'size'          => '4',
                                'description'   => 'px'
                            ),

                            'color'    => array( 
                                'type'       => 'color',
                                'label'         => __('Text Color', 'bb-bootstrap-cards'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_boot_card_block .bb_boot_card_title'
                                )
                            ),

                            'title_margin_top' => array(
                                'type'              => 'text',
                                'label'             => __('Margin Top', 'bb-bootstrap-cards'),
                                'placeholder'       => '0',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px',
                                'default'    => '',
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'margin-top',
                                    'selector' => '.bb_boot_card_block .bb_boot_card_title',
                                    'unit'       => 'px'
                                )

                            ),
                            'title_margin_bottom' => array(
                                'type'              => 'text',
                                'label'             => __('Margin Bottom', 'bb-bootstrap-cards'),
                                'placeholder'       => '0',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px',
                                'default'    => '10',
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'margin-bottom',
                                    'selector' => '.bb_boot_card_block .bb_boot_card_title',
                                    'unit'       => 'px'
                                )
                            ),

                        )
                    ),
                    'card_description'    =>  array(
                        'title'     => __('Description', 'bb-bootstrap-cards'),
                        'fields'    => array(

                            'desc_font_family'       => array(
                                'type'          => 'font',
                                'label'         => __('Font Family', 'bb-bootstrap-cards'),
                                'default'       => array(
                                    'family'        => 'Default',
                                    'weight'        => 'Default'
                                ),
                                'preview'         => array(
                                    'type'            => 'font',
                                    'selector'        => '.bb_boot_card_block .bb_boot_card_text'
                                )
                            ),

                            'desc_font_size'    => array(
                                'type'          => 'select',
                                'label'         => __('Font Size', 'bb-bootstrap-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                    'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('desc_custom_size')
                                    )
                                )
                            ),
                            'desc_custom_size' => array(
                                'type'              => 'text',
                                'label'             => __('Font Size', 'bb-bootstrap-cards'),
                                'default'           => '14',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px'
                            ),

                            'desc_line_height'     => array(
                                'type'          => 'select',
                                'label'         => __('Line Height', 'bb-bootstrap-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                    'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('desc_custom_line_height')
                                    )
                                )
                            ),
                            'desc_custom_line_height' => array(
                                'type'          => 'text',
                                'label'         => __('Custom Line Height', 'bb-bootstrap-cards'),
                                'default'       => '24',
                                'maxlength'     => '4',
                                'size'          => '4',
                                'description'   => 'px'
                            ),
                            'desc_letter_spacing'     => array(
                                'type'          => 'select',
                                'label'         => __('Letter Spacing', 'bb-bootstrap-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bb-bootstrap-cards'),
                                    'custom'        =>  __('Custom', 'bb-bootstrap-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('desc_custom_letter_spacing')
                                    )
                                )
                            ),
                            'desc_custom_letter_spacing' => array(
                                'type'          => 'text',
                                'label'         => __('Custom Letter Spacing', 'bb-bootstrap-cards'),
                                'default'       => '0',
                                'maxlength'     => '3',
                                'size'          => '4',
                                'description'   => 'px'
                            ),

                            'desc_color'        => array( 
                                'type'       => 'color',
                                'label'      => __('Color', 'bb-bootstrap-cards'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_boot_card_block .bb_boot_card_text'
                                )
                            ),
                            'desc_margin_top' => array(
                                'type'              => 'text',
                                'label'             => __('Margin Top', 'bb-bootstrap-cards'),
                                'placeholder'       => '0',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px',
                                'default'    => '',
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'margin-top',
                                    'selector' => '.bb_boot_card_block .bb_boot_card_text',
                                    'unit'       => 'px'
                                )

                            ),
                            'desc_margin_bottom' => array(
                                'type'              => 'text',
                                'label'             => __('Margin Bottom', 'bb-bootstrap-cards'),
                                'placeholder'       => '0',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px',
                                'default'    => '10',
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'margin-bottom',
                                    'selector' => '.bb_boot_card_block .bb_boot_card_text',
                                    'unit'       => 'px'
                                )
                            ),

                        )
                    ),

                )
            )
        )
    );

