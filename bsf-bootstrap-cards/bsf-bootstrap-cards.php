<?php

/**
 * @class BSFModuleCards
 */
class BSFModuleCards extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Bootstrap Card', 'bsf-cards'),
            'description'   => __('To create Bootstrap Card builder modules.', 'bsf-cards'),
            'category'		=> __('Advanced Modules', 'bsf-cards'),
            'dir'           => BSF_MODULE_CARDS_DIR . 'bsf-bootstrap-cards/',
            'url'           => BSF_MODULE_CARDS_URL . 'bsf-bootstrap-cards/',
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
FLBuilder::register_module('BSFModuleCards', 
    array(
        'general'       => array( // Tab
            'title'         => __('General', 'bsf-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => __('Card Elements', 'bsf-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_title'     => array(
                            'type'          => 'text',
                            'label'         => __('Text Field', 'bsf-cards'),
                            'default'       => '',
                            'placeholder'   => 'Enter Card Title',
                            'default'       => __('Card title', 'bsf-cards'),
                            'class'         => 'my-card-title',
                            'preview'         => array(
                                'type'             => 'text',
                                'selector'         => '.bb_boot_card_title'
                            )
                        ),

                        'card_textarea' => array(
                            'type'          => 'textarea',
                            'label'         => __('Textarea Field', 'bsf-cards'),
                            'default'       => '',
                            'placeholder'   => __('Enter Card Text', 'bsf-cards'),
                            'default'       => __('Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totam rem aperiam.', 'bsf-cards'),
                            'rows'          => '6',
                            'preview'         => array(
                                'type'             => 'text',
                                'selector'         => '.bb_boot_card_text'  
                            )
                        )
                    )
                ),
                'structure'     => array(
                    'title'         => __('Structure', 'bsf-cards'),
                    'fields'        => array(
                        'alignment'     => array(
                            'type'          => 'select',
                            'label'         => __('Alignment', 'bsf-cards'),
                            'default'       => 'Left',
                            'options'       => array(
                                'left'      =>  __('Left', 'bsf-cards'),
                                'center'    =>  __('Center', 'bsf-cards'),
                                'right'     =>  __('Right', 'bsf-cards')
                            ),
                            'help'         => __('This is the overall alignment and would apply to all Card elements', 'bsf-cards'),
                        ),
                        'bg_color' => array( 
                            'type'       => 'color',
                            'label'         => __('Background Color', 'bsf-cards'),
                            'default'    => '',
                            'show_reset' => true,
                        ),
                        // 'bg_color_opc' => array( 
                        //     'type'        => 'text',
                        //     'label'       => __('Opacity', 'bsf-cards'),
                        //     'default'     => '100',
                        //     'description' => '%',
                        //     'maxlength'   => '3',
                        //     'size'        => '5',
                        // )
                    )
                )
            )
        ),

        'image'       => array( // Tab
            'title'         => __('Image', 'bsf-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'card_image'       => array( // Section
                    'title'         => __('Select Card Image', 'bsf-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'photo'         => array(
                            'type'          => 'photo',
                            'label'         => __('Photo', 'bsf-cards'),
                            'show_remove'   => true
                        ),
                        
                        // 'align'         => array(
                        //     'type'          => 'select',
                        //     'label'         => __('Alignment', 'bsf-cards'),
                        //     'default'       => 'center',
                        //     'options'       => array(
                        //         'left'          => __('Left', 'bsf-cards'),
                        //         'center'        => __('Center', 'bsf-cards'),
                        //         'right'         => __('Right', 'bsf-cards')
                        //     )
                        // )

                    )     
                )
            )
        ),

        'link'      => array( // Tab
            'title'         => __('Link / Button ', 'bsf-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'card_link'       => array( // Section
                    'title'         => __('Select Read More', 'bsf-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_btn_type'      => array(
                        'type'          => 'select',
                        'label'         => __('Type', 'bsf-cards'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => _x( 'None', 'bsf-cards' ),
                            'link'          => __('Text', 'bsf-cards'),
                            'button'        => __('Button', 'bsf-cards'),
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
                    'title'         => __('Link', 'bsf-cards'),
                    'fields'        => array(
                        
                        'card_btn_text'      => array(
                            'type'          => 'text',
                            'label'         => __('Text', 'bsf-cards'),
                            'default'       => __('Read More', 'bsf-cards'),
                        ),

                        'link_field'          => array(
                            'type'          => 'link',
                            'label'         => __('Link', 'bsf-cards'),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'link_target'   => array(
                            'type'          => 'select',
                            'label'         => __('Link Target', 'bsf-cards'),
                            'default'       => '_self',
                            'options'       => array(
                                '_self'         => __('Same Window', 'bsf-cards'),
                                '_blank'        => __('New Window', 'bsf-cards')
                            ),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        
                    )
                ),

                'link_typography'    =>  array(
                    'title' => __( 'Link Typography', 'bsf-cards' ),
                    'fields'    => array(
                        'link_font_family'       => array(
                            'type'          => 'font',
                            'label'         => __('Font Family', 'bsf-cards'),
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 'Default'
                            ),
                            'preview'   => array(
                                'type'      => 'font',
                                'selector'  => '.bb_boot_card_link'
                            ),
                        ),

                        'link_font_size'    => array(
                            'type'          => 'select',
                            'label'         => __('Link Font Size', 'fl-builder'),
                            'default'       => 'default',
                            'options'       => array(
                                'default'       =>  __('Default', 'fl-builder'),
                                'custom'        =>  __('Custom', 'fl-builder')
                            ),
                            'toggle'        => array(
                                'custom'        => array(
                                    'fields'        => array('link_custom_size')
                                )
                            )
                        ),
                        'link_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Link Font Size', 'fl-builder'),
                            'default'           => '20',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'link_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Link Color', 'bsf-cards'),
                            'default'    => '',
                            'show_reset' => true,
                        ),

                        'link_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Link Color', 'bsf-cards'),
                            'default'    => '',
                            'show_reset' => true,
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'color',
                                'selector' => '.bb_boot_card_link',
                            )
                        ),

                        'link_hover_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Link Hover Color', 'bsf-cards'),
                            'default'    => '',
                            'show_reset' => true,
                            // 'preview'       => array(
                            //     'type' => 'css',
                            //     'property' => 'color',
                            //     'selector' => '.bb_boot_card_link',
                            // )
                        ),

                        'link_margin_top' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Top', 'bsf-cards'),
                            'placeholder'       => '0',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'default'    => '',
                            'preview'       => array(
                                'type' => 'css',
                                'property' => 'margin-top',
                                'selector' => '.bb_boot_card_link',
                                'unit'       => 'px'
                            )

                        ),
                        'link_margin_bottom' => array(
                            'type'              => 'text',
                            'label'             => __('Margin Bottom', 'bsf-cards'),
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
                    'title'         => __('Button', 'bsf-cards'),
                    'fields'        => array(

                        'btn_text'          => array(
                            'type'          => 'text',
                            'label'         => __('Button Text', 'bsf-cards'),
                            'default'       => __('Click Here', 'bsf-cards'),
                        ),

                        'btn_link'          => array(
                            'type'          => 'link',
                            'label'         => __('Button Link', 'bsf-cards'),
                            'placeholder'   => __( 'http://www.example.com', 'bsf-cards' ),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'btn_link_target'   => array(
                            'type'          => 'select',
                            'label'         => __('Button Target', 'bsf-cards'),
                            'default'       => '_self',
                            'options'       => array(
                                '_self'         => __('Same Window', 'bsf-cards'),
                                '_blank'        => __('New Window', 'bsf-cards')
                            ),
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        )
                    )
                ),

                'btn_typography'     => array( // Section
                    'title'         => __('Button Typography', 'bsf-cards'),
                    'fields'        => array(
                        'btn_font_family'       => array(
                            'type'          => 'font',
                            'label'         => __('Font Family', 'bsf-cards'),
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 'Default'
                            ),
                            'preview'   => array(
                                'type'      => 'font',
                                'selector'  => '.bb_boot_card_link_button'
                            ),
                        ),
                        'btn_font_size'    => array(
                            'type'          => 'select',
                            'label'         => __('Button Font Size', 'fl-builder'),
                            'default'       => 'default',
                            'options'       => array(
                                'default'       =>  __('Default', 'fl-builder'),
                                'custom'        =>  __('Custom', 'fl-builder')
                            ),
                            'toggle'        => array(
                                'custom'        => array(
                                    'fields'        => array('btn_custom_size', 'btn_line_height')
                                )
                            )
                        ),
                        'btn_custom_size' => array(
                            'type'              => 'text',
                            'label'             => __('Button Font Size', 'fl-builder'),
                            'default'           => '14',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px'
                        ),

                        'btn_line_height' => array(
                            'type'          => 'text',
                            'label'         => __('Button Line Height', 'fl-builder'),
                            'description'   => 'px',
                            'default'           => '16',
                            'maxlength'         => '3',
                            'size'              => '4',
                            'description'       => 'px',
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'      => '.bb_boot_card_link_button',
                                'property'      => 'line-height',
                                'unit'          => 'px'
                            )
                        ),

                        'btn_text_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Text Color', 'bsf-cards'),
                            'default'    => '#414242',
                            'show_reset' => true,
                        ),
                        'btn_text_hover_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Text Hover Color', 'bsf-cards'),
                            'default'    => '#ffffff',
                            'show_reset' => true,
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'btn_bg_color'        => array( 
                            'type'       => 'color',
                            'label'      => __('Background Color', 'bsf-cards'),
                            'default'    => '#ffdd00',
                            'show_reset' => true,
                        ),
                        'btn_bg_hover_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Background Hover Color', 'bsf-cards'),
                            'default'    => '',
                            'show_reset' => true,
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'btn_border_radius' => array(
                            'type'          => 'text',
                            'label'         => __('Round Corners', 'bsf-cards'),
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                    )
                ),

            )
        ),

        'typography'         => array(
            'title'         => __('Typography', 'bsf-cards'),
                'sections'      => array(
                    'heading_card'     => array(
                        'title'         => __('Heading', 'bsf-cards'),
                        'fields'        => array(
                            'tag'           => array(
                                'type'          => 'select',
                                'label'         => __( 'HTML Tag', 'bsf-cards' ),
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
                            'font'          => array(
                                'type'          => 'font',
                                'default'       => array(
                                    'family'        => 'Default',
                                    'weight'        => 300
                                ),
                                'label'         => __('Font', 'bsf-cards'),
                                'preview'         => array(
                                    'type'            => 'font',
                                    'selector'        => '.bb_boot_card_block .bb_boot_card_title'
                                )
                            ),

                            'title_size'    => array(
                                'type'          => 'select',
                                'label'         => __('Heading Size', 'fl-builder'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'fl-builder'),
                                    'custom'        =>  __('Custom', 'fl-builder')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('title_custom_size')
                                    )
                                )
                            ),
                            'title_custom_size' => array(
                                'type'              => 'text',
                                'label'             => __('Heading Custom Size', 'fl-builder'),
                                'default'           => '24',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px'
                            ),

                            'color'    => array( 
                                'type'       => 'color',
                                'label'         => __('Text Color', 'bsf-cards'),
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
                                'label'             => __('Margin Top', 'bsf-cards'),
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
                                'label'             => __('Margin Bottom', 'bsf-cards'),
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
                        'title'     => __('Description', 'bsf-cards'),
                        'fields'    => array(

                            'desc_font_family'       => array(
                                'type'          => 'font',
                                'label'         => __('Font Family', 'bsf-cards'),
                                'default'       => array(
                                    'family'        => 'Default',
                                    'weight'        => 'Default'
                                ),
                                'preview'         => array(
                                    'type'            => 'font',
                                    'selector'        => '.bb_boot_card_text, .bb_boot_card_text'
                                )
                            ),

                            'desc_font_size'    => array(
                                'type'          => 'select',
                                'label'         => __('Font Size', 'bsf-cards'),
                                'default'       => 'default',
                                'options'       => array(
                                    'default'       =>  __('Default', 'bsf-cards'),
                                    'custom'        =>  __('Custom', 'bsf-cards')
                                ),
                                'toggle'        => array(
                                    'custom'        => array(
                                        'fields'        => array('desc_custom_size')
                                    )
                                )
                            ),
                            'desc_custom_size' => array(
                                'type'              => 'text',
                                'label'             => __('Font Size', 'fl-builder'),
                                'default'           => '14',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px'
                            ),

                            'desc_color'        => array( 
                                'type'       => 'color',
                                'label'      => __('Color', 'bsf-cards'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_boot_card_text, .bb_boot_card_text *'
                                )
                            ),
                            'desc_margin_top' => array(
                                'type'              => 'text',
                                'label'             => __('Margin Top', 'bsf-cards'),
                                'placeholder'       => '0',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px',
                                'default'    => '',
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'margin-top',
                                    'selector' => '.bb_boot_card_text',
                                    'unit'       => 'px'
                                )

                            ),
                            'desc_margin_bottom' => array(
                                'type'              => 'text',
                                'label'             => __('Margin Bottom', 'bsf-cards'),
                                'placeholder'       => '0',
                                'maxlength'         => '3',
                                'size'              => '4',
                                'description'       => 'px',
                                'default'    => '10',
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'margin-bottom',
                                    'selector' => '.bb_boot_card_text',
                                    'unit'       => 'px'
                                )
                            ),

                        )
                    ),

                )
            )
        )
    );

