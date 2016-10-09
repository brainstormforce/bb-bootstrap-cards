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
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
        
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
                        'bg_color_opc' => array( 
                            'type'        => 'text',
                            'label'       => __('Opacity', 'bsf-cards'),
                            'default'     => '',
                            'description' => '%',
                            'maxlength'   => '3',
                            'size'        => '5',
                        ),
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
                      'photo_field'    => array(
                            'type'          => 'photo',
                            'label'         => __('Photo Field', 'bsf-cards')
                        )
                    )     
                )
            )
        ),

        'link'      => array( // Tab
            'title'         => __('Link', 'bsf-cards'), // Tab title
            'sections'      => array( // Tab Sections
                'card_link'       => array( // Section
                    'title'         => __('Read More Link', 'bsf-cards'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_link_text'      => array(
                            'type'          => 'text',
                            'label'         => __('Text', 'bsf-cards'),
                            'default'       => __('Read More', 'bsf-cards'),
                        ),
                        'link_field'     => array(
                            'type'          => 'link',
                            'label'         => __('Link Field', 'bsf-cards')
                        )
                    )
                ),
                'structure'     => array(
                    'title'         => __('Structure', 'bsf-cards'),
                    'fields'        => array(

                        'link_color'        => array( 
                                'type'       => 'color',
                                'label'      => __('Link Color', 'bsf-cards'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_boot_card_block'
                                )
                            ),

                    )
                )
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
                            'new_font_size'     => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Font Size', 'bsf-cards' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
                            ),

                            'line_height'    => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Line Height', 'bsf-cards' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
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
                                    'selector'        => '.bb_boot_card_text, .bb_boot_card_text *'
                                )
                            ),
                            'desc_font_size'     => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Font Size', 'bsf-cards' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
                            ),
                            'desc_line_height'    => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Line Height', 'bsf-cards' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
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

                        )
                    ),

                )
            )
        )
    );

