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
            'name'          => __('Bootstrap Card', 'fl-builder'),
            'description'   => __('To create Bootstrap Card builder modules.', 'fl-builder'),
            'category'		=> __('Advanced Modules', 'fl-builder'),
            'dir'           => BSF_MODULE_CARDS_DIR . 'bsf-bootstrap-cards/',
            'url'           => BSF_MODULE_CARDS_URL . 'bsf-bootstrap-cards/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
        
    }

    /** 
     * Use this method to work with settings data before 
     * it is saved. You must return the settings object. 
     *
     * @method update
     * @param $settings {object}
     */      
    public function update($settings)
    {
        $settings->textarea_field .= ' - this text was appended in the update method.';
        
        return $settings;
    }

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSFModuleCards', 
    array(
        'general'       => array( // Tab
            'title'         => __('General', 'fl-builder'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => __('Card Elements', 'fl-builder'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_title'     => array(
                            'type'          => 'text',
                            'label'         => __('Text Field', 'fl-builder'),
                            'default'       => '',
                            'placeholder'   => 'Enter Card Title',
                            'default'       => __('Card title', 'fl-builder'),
                            'class'         => 'my-card-title',
                            'preview'         => array(
                                'type'             => 'text',
                                'selector'         => '.bb_ulti_boot_card_title'
                            )
                        ),

                        'card_textarea' => array(
                            'type'          => 'textarea',
                            'label'         => __('Textarea Field', 'fl-builder'),
                            'default'       => '',
                            'placeholder'   => __('Enter Card Text', 'fl-builder'),
                            'default'       => __('Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totam rem aperiam.', 'fl-builder'),
                            'rows'          => '6',
                            'preview'         => array(
                                'type'             => 'text',
                                'selector'         => '.bb_ulti_boot_card_text'  
                            )
                        )
                    )
                ),
                'structure'     => array(
                    'title'         => __('Structure', 'fl-builder'),
                    'fields'        => array(
                        'alignment'     => array(
                            'type'          => 'select',
                            'label'         => __('Alignment', 'fl-builder'),
                            'default'       => 'Left',
                            'options'       => array(
                                'left'      =>  __('Left', 'fl-builder'),
                                'center'    =>  __('Center', 'fl-builder'),
                                'right'     =>  __('Right', 'fl-builder')
                            ),
                            'help'         => __('This is the overall alignment and would apply to all Card elements', 'fl-builder'),
                        ),
                        'bg_color' => array( 
                            'type'       => 'color',
                            'label'         => __('Background Color', 'fl-builder'),
                            'default'    => '',
                            'show_reset' => true,
                        ),
                        'bg_color_opc' => array( 
                            'type'        => 'text',
                            'label'       => __('Opacity', 'fl-builder'),
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
            'title'         => __('Image', 'fl-builder'), // Tab title
            'sections'      => array( // Tab Sections
                'card_image'       => array( // Section
                    'title'         => __('Select Card Image', 'fl-builder'), // Section Title
                    'fields'        => array( // Section Fields
                      'photo_field'    => array(
                            'type'          => 'photo',
                            'label'         => __('Photo Field', 'fl-builder')
                        )
                    )     
                )
            )
        ),

        'link'      => array( // Tab
            'title'         => __('Link', 'fl-builder'), // Tab title
            'sections'      => array( // Tab Sections
                'card_link'       => array( // Section
                    'title'         => __('Read More Link', 'fl-builder'), // Section Title
                    'fields'        => array( // Section Fields
                        'card_link_text'      => array(
                            'type'          => 'text',
                            'label'         => __('Text', 'fl-builder'),
                            'default'       => __('Read More', 'fl-builder'),
                        ),
                        'link_field'     => array(
                            'type'          => 'link',
                            'label'         => __('Link Field', 'fl-builder')
                        )
                    )
                ),
                'structure'     => array(
                    'title'         => __('Structure', 'fl-builder'),
                    'fields'        => array(

                        'link_color'        => array( 
                                'type'       => 'color',
                                'label'      => __('Link Color', 'fl-builder'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_ulti_boot_card_block'
                                )
                            ),

                    )
                )
            )
        ),

        'typography'         => array(
            'title'         => __('Typography', 'fl-builder'),
                'sections'      => array(
                    'heading_card'     => array(
                        'title'         => __('Heading', 'fl-builder'),
                        'fields'        => array(
                            'tag'           => array(
                                'type'          => 'select',
                                'label'         => __( 'HTML Tag', 'uabb' ),
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
                                'label'         => __('Font', 'fl-builder'),
                                'preview'         => array(
                                    'type'            => 'font',
                                    'selector'        => '.bb_ulti_boot_card_block .bb_ulti_boot_card_title'
                                )
                            ),
                            'new_font_size'     => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Font Size', 'fl-builder' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
                            ),

                            'line_height'    => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Line Height', 'fl-builder' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
                            ),

                            'color'    => array( 
                                'type'       => 'color',
                                'label'         => __('Text Color', 'fl-builder'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_ulti_boot_card_block .bb_ulti_boot_card_title'
                                )
                            ),

                        )
                    ),
                    'card_description'    =>  array(
                        'title'     => __('Description', 'fl-builder'),
                        'fields'    => array(
                            'desc_font_family'       => array(
                                'type'          => 'font',
                                'label'         => __('Font Family', 'fl-builder'),
                                'default'       => array(
                                    'family'        => 'Default',
                                    'weight'        => 'Default'
                                ),
                                'preview'         => array(
                                    'type'            => 'font',
                                    'selector'        => '.bb_ulti_boot_card_text, .bb_ulti_boot_card_text *'
                                )
                            ),
                            'desc_font_size'     => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Font Size', 'fl-builder' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
                            ),
                            'desc_line_height'    => array(
                                'type'          => 'uabb-simplify',
                                'label'         => __( 'Line Height', 'fl-builder' ),
                                'default'       => array(
                                    'desktop'       => '',
                                    'medium'        => '',
                                    'small'         => '',
                                )
                            ),
                            'desc_color'        => array( 
                                'type'       => 'color',
                                'label'      => __('Color', 'fl-builder'),
                                'default'    => '',
                                'show_reset' => true,
                                'preview'       => array(
                                    'type' => 'css',
                                    'property' => 'color',
                                    'selector' => '.bb_ulti_boot_card_text, .bb_ulti_boot_card_text *'
                                )
                            ),

                        )
                    ),

                )
            )
        )
    );

