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
            'partial_refresh'   => true
        ));
        
    }

        /**
     * @method enqueue_scripts
     */
    public function enqueue_scripts()
    {
        $override_lightbox = apply_filters( 'fl_builder_override_lightbox', false );
        
        if($this->settings && $this->settings->link_type == 'lightbox') {
            if ( ! $override_lightbox ) {
                $this->add_js('jquery-magnificpopup');
                $this->add_css('jquery-magnificpopup');
            }
            else {
                wp_dequeue_script('jquery-magnificpopup');
                wp_dequeue_style('jquery-magnificpopup');
            }
        }
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

        // Save a crop if necessary.
        $this->crop();

        return $settings;
    }

    /**
     * @method delete
     */
    public function delete()
    {
        $cropped_path = $this->_get_cropped_path();

        if(file_exists($cropped_path['path'])) {
            unlink($cropped_path['path']);
        }
    }

    /**
     * @method crop
     */
    public function crop()
    {
        // Delete an existing crop if it exists.
        $this->delete();

        // Do a crop.
        if(!empty($this->settings->crop)) {

            $editor = $this->_get_editor();

            if(!$editor || is_wp_error($editor)) {
                return false;
            }

            $cropped_path = $this->_get_cropped_path();
            $size         = $editor->get_size();
            $new_width    = $size['width'];
            $new_height   = $size['height'];

            // Get the crop ratios.
            if($this->settings->crop == 'landscape') {
                $ratio_1 = 1.43;
                $ratio_2 = .7;
            }
            elseif($this->settings->crop == 'panorama') {
                $ratio_1 = 2;
                $ratio_2 = .5;
            }
            elseif($this->settings->crop == 'portrait') {
                $ratio_1 = .7;
                $ratio_2 = 1.43;
            }
            elseif($this->settings->crop == 'square') {
                $ratio_1 = 1;
                $ratio_2 = 1;
            }
            elseif($this->settings->crop == 'circle') {
                $ratio_1 = 1;
                $ratio_2 = 1;
            }

            // Get the new width or height.
            if($size['width'] / $size['height'] < $ratio_1) {
                $new_height = $size['width'] * $ratio_2;
            }
            else {
                $new_width = $size['height'] * $ratio_1;
            }

            // Make sure we have enough memory to crop.
            @ini_set('memory_limit', '300M');

            // Crop the photo.
            $editor->resize($new_width, $new_height, true);

            // Save the photo.
            $editor->save($cropped_path['path']);

            // Return the new url.
            return $cropped_path['url'];
        }

        return false;
    }

    /**
     * @method get_data
     */
    public function get_data()
    {
        if(!$this->data) {

            // Photo source is set to "url".
            if($this->settings->photo_source == 'url') {
                $this->data = new stdClass();
                $this->data->alt = $this->settings->caption;
                $this->data->caption = $this->settings->caption;
                $this->data->link = $this->settings->photo_url;
                $this->data->url = $this->settings->photo_url;
                $this->settings->photo_src = $this->settings->photo_url;
            }

            // Photo source is set to "library".
            else if(is_object($this->settings->photo)) {
                $this->data = $this->settings->photo;
            }
            else {
                $this->data = FLBuilderPhoto::get_attachment_data($this->settings->photo);
            }

            // Data object is empty, use the settings cache.
            if(!$this->data && isset($this->settings->data)) {
                $this->data = $this->settings->data;
            }
        }

        return $this->data;
    }

    /**
     * @method get_classes
     */
    public function get_classes()
    {
        $classes = array( 'fl-photo-img' );
        
        if ( $this->settings->photo_source == 'library' && ! empty( $this->settings->photo ) ) {
            
            $data = self::get_data();
            
            if ( is_object( $data ) ) {
                
                $classes[] = 'wp-image-' . $data->id;

                if ( isset( $data->sizes ) ) {

                    foreach ( $data->sizes as $key => $size ) {
                        
                        if ( $size->url == $this->settings->photo_src ) {
                            $classes[] = 'size-' . $key;
                            break;
                        }
                    }
                }
            }
        }
        
        return implode( ' ', $classes );
    }

    /**
     * @method get_src
     */
    public function get_src()
    {
        $src = $this->_get_uncropped_url();

        // Return a cropped photo.
        if($this->_has_source() && !empty($this->settings->crop)) {

            $cropped_path = $this->_get_cropped_path();

            // See if the cropped photo already exists.
            if(file_exists($cropped_path['path'])) {
                $src = $cropped_path['url'];
            }
            // It doesn't, check if this is a demo image.
            elseif(stristr($src, FL_BUILDER_DEMO_URL) && !stristr(FL_BUILDER_DEMO_URL, $_SERVER['HTTP_HOST'])) {
                $src = $this->_get_cropped_demo_url();
            }
            // It doesn't, check if this is a OLD demo image.
            elseif(stristr($src, FL_BUILDER_OLD_DEMO_URL)) {
                $src = $this->_get_cropped_demo_url();
            }
            // A cropped photo doesn't exist, try to create one.
            else {

                $url = $this->crop();

                if($url) {
                    $src = $url;
                }
            }
        }

        return $src;
    }

    /**
     * @method get_link
     */
    public function get_link()
    {
        $photo = $this->get_data();

        if($this->settings->link_type == 'url') {
            $link = $this->settings->link_url;
        }
        else if($this->settings->link_type == 'lightbox') {
            $link = $photo->url;
        }
        else if($this->settings->link_type == 'file') {
            $link = $photo->url;
        }
        else if($this->settings->link_type == 'page') {
            $link = $photo->link;
        }
        else {
            $link = '';
        }

        return $link;
    }

    /**
     * @method get_alt
     */
    public function get_alt()
    {
        $photo = $this->get_data();

        if(!empty($photo->alt)) {
            return htmlspecialchars($photo->alt);
        }
        else if(!empty($photo->description)) {
            return htmlspecialchars($photo->description);
        }
        else if(!empty($photo->caption)) {
            return htmlspecialchars($photo->caption);
        }
        else if(!empty($photo->title)) {
            return htmlspecialchars($photo->title);
        }
    }

    /**
     * @method get_attributes
     */
    public function get_attributes()
    {
        $attrs = '';
        
        if ( isset( $this->settings->attributes ) ) {
            foreach ( $this->settings->attributes as $key => $val ) {
                $attrs .= $key . '="' . $val . '" ';
            }
        }
        
        return $attrs;
    }

    /**
     * @method _has_source
     * @protected
     */
    protected function _has_source()
    {
        if($this->settings->photo_source == 'url' && !empty($this->settings->photo_url)) {
            return true;
        }
        else if($this->settings->photo_source == 'library' && !empty($this->settings->photo_src)) {
            return true;
        }

        return false;
    }

    /**
     * @method _get_editor
     * @protected
     */
    protected function _get_editor()
    {
        if($this->_has_source() && $this->_editor === null) {

            $url_path  = $this->_get_uncropped_url();
            $file_path = str_ireplace(home_url(), ABSPATH, $url_path);

            if(file_exists($file_path)) {
                $this->_editor = wp_get_image_editor($file_path);
            }
            else {
                $this->_editor = wp_get_image_editor($url_path);
            }
        }

        return $this->_editor;
    }

    /**
     * @method _get_cropped_path
     * @protected
     */
    protected function _get_cropped_path()
    {
        $crop        = empty($this->settings->crop) ? 'none' : $this->settings->crop;
        $url         = $this->_get_uncropped_url();
        $cache_dir   = FLBuilderModel::get_cache_dir();

        if(empty($url)) {
            $filename    = uniqid(); // Return a file that doesn't exist.
        }
        else {
            
            if ( stristr( $url, '?' ) ) {
                $parts = explode( '?', $url );
                $url   = $parts[0];
            }
            
            $pathinfo    = pathinfo($url);
            $dir         = $pathinfo['dirname'];
            $ext         = $pathinfo['extension'];
            $name        = wp_basename($url, ".$ext");
            $new_ext     = strtolower($ext);
            $filename    = "{$name}-{$crop}.{$new_ext}";
        }

        return array(
            'filename' => $filename,
            'path'     => $cache_dir['path'] . $filename,
            'url'      => $cache_dir['url'] . $filename
        );
    }

    /**
     * @method _get_uncropped_url
     * @protected
     */
    protected function _get_uncropped_url()
    {
        if($this->settings->photo_source == 'url') {
            $url = $this->settings->photo_url;
        }
        else if(!empty($this->settings->photo_src)) {
            $url = $this->settings->photo_src;
        }
        else {
            $url = FL_BUILDER_URL . 'img/pixel.png';
        }

        return $url;
    }

    /**
     * @method _get_cropped_demo_url
     * @protected
     */
    protected function _get_cropped_demo_url()
    {
        $info = $this->_get_cropped_path();

        return FL_BUILDER_DEMO_CACHE_URL . $info['filename'];
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
                        
                        // 'photo_field'    => array(
                        //     'type'          => 'photo',
                        //     'label'         => __('Photo Field', 'bsf-cards'),
                        //     'show_remove'   => true
                        // ),

                        'photo_source'  => array(
                            'type'          => 'select',
                            'label'         => __('Photo Source', 'bsf-cards'),
                            'default'       => 'library',
                            'options'       => array(
                                'library'       => __('Media Library', 'bsf-cards'),
                                'url'           => __('URL', 'fl-builder')
                            ),
                            'toggle'        => array(
                                'library'       => array(
                                    'fields'        => array('photo')
                                ),
                                'url'           => array(
                                    'fields'        => array('photo_url', 'caption')
                                )
                            )
                        ),
                        'photo'         => array(
                            'type'          => 'photo',
                            'label'         => __('Photo', 'bsf-cards'),
                            'show_remove'   => true
                        ),
                        'photo_url'     => array(
                            'type'          => 'text',
                            'label'         => __('Photo URL', 'bsf-cards'),
                            'placeholder'   => __( 'http://www.example.com/my-photo.jpg', 'bsf-cards' )
                        ),
                        'crop'          => array(
                            'type'          => 'select',
                            'label'         => __('Crop', 'fl-builder'),
                            'default'       => 'None',
                            'options'       => array(
                                ''              => _x( 'None', 'Photo Crop.', 'bsf-cards' ),
                                'landscape'     => __('Landscape', 'bsf-cards'),
                                'panorama'      => __('Panorama', 'bsf-cards'),
                                'portrait'      => __('Portrait', 'bsf-cards'),
                                'square'        => __('Square', 'bsf-cards'),
                                'circle'        => __('Circle', 'bsf-cards')
                            )
                        ),
                        'align'         => array(
                            'type'          => 'select',
                            'label'         => __('Alignment', 'bsf-cards'),
                            'default'       => 'center',
                            'options'       => array(
                                'left'          => __('Left', 'bsf-cards'),
                                'center'        => __('Center', 'bsf-cards'),
                                'right'         => __('Right', 'bsf-cards')
                            )
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
                            'title_font_size' => array(
                                'type'          => 'text',
                                'label'         => __('Font Size', 'bsf-cards'),
                                'description'   => 'px',
                                'preview'       => array(
                                    'type'          => 'css',
                                    'selector'      => '.bb_boot_card_block .bb_boot_card_title',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
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

                            'desc_font_size' => array(
                                'type'          => 'text',
                                'label'         => __('Font Size', 'bsf-cards'),
                                'description'   => 'px',
                                'preview'       => array(
                                    'type'          => 'css',
                                    'selector'      => '.bb_boot_card_text, .bb_boot_card_text',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
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

