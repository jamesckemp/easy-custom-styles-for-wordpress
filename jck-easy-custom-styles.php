<?php

/*
Plugin Name: Easy Custom Styles
Plugin URI: http://www.jckemp.com
Description: Easily add any number of custom text styles to the WYSIWYG editor.
Version: 1.0.2
Author: James Kemp
Author URI: http://www.jckemp.com
License: GPL2

Copyright 2014, James Kemp
*/

class JCK_Custom_Styles {

    /**
     * Constructor
     */
    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'add_stylesheets' ) );
        add_action( 'admin_print_scripts-post-new.php', array( __CLASS__, 'add_admin_scripts' ), 10, 1 );
        add_action('admin_print_scripts-post.php', array( __CLASS__, 'add_admin_scripts' ), 10, 1 );

        add_action('add_meta_boxes', array( $this, 'metaboxes' ) );
        add_action('init', array( $this, 'post_type' ) );
        add_filter('mce_css', array( $this, 'plugin_mce_css' ) );
        add_action('wp_enqueue_scripts', array( $this, 'add_dynamic_stylesheet' ) );
        add_action('template_redirect', array( $this, 'trigger_check' ) );
        add_filter('query_vars', array( $this, 'add_trigger' ) );
        add_filter('tiny_mce_before_init', array( $this, 'mce_before_init' ), 1000);
        add_filter('mce_buttons_2', array( $this, 'mce_buttons' ), 1000);
        add_action('save_post', array( $this, 'save_custom_styles_meta' ) );
        add_filter('post_updated_messages', array( $this, 'message' ) );

        add_filter('post_row_actions', array( $this, 'remove_quick_edit' ), 10, 2);

    }

    public static function getValue($key, $default = '', $id = '') {

        if ($id == '') {
            global $post;
            $jck_custom_styles = get_post_meta($post->ID, 'jck_custom_styles', true);
        } else {
            $jck_custom_styles = get_post_meta($id, 'jck_custom_styles', true);
        }

        if (isset($jck_custom_styles[$key])) {
            return $jck_custom_styles[$key];
        } else {
            return $default;
        }

    }


    public static function add_stylesheets() {

        global $post_type;

        if( 'custom-styles' !== $post_type )
            return;

        wp_register_style('colorpicker_css', plugins_url('/assets/colorpicker/css/colorpicker.css', __FILE__));
        wp_enqueue_style('colorpicker_css');
        wp_register_style('jck_cs_styles', plugins_url('/assets/styles.css', __FILE__));
        wp_enqueue_style('jck_cs_styles');

    }


    // Enque admin scripts

    public static function add_admin_scripts() {

        global $post_type;

        if( 'custom-styles' !== $post_type )
            return;

        wp_enqueue_script('colorpicker_script', plugins_url('/assets/colorpicker/js/colorpicker.js', __FILE__), 'jquery');
        wp_enqueue_script('scroll_script', plugins_url('/assets/scroll.js', __FILE__), 'colorpicker_script');
        wp_enqueue_script('custom_style_editor_scripts', plugins_url('/assets/scripts.js', __FILE__), 'scroll_script');

    }


    public static function get_styles() {

        global $wpdb;

        $jck_posts = $wpdb->get_results("
        SELECT *
        FROM $wpdb->posts
        WHERE $wpdb->posts.post_type = 'custom-styles'
        AND $wpdb->posts.post_status = 'publish'
        ORDER BY ID DESC
        ");

        return $jck_posts;

    }


    /* Custom CSS styles on WYSIWYG Editor – Start
  ======================================= */

    public function mce_buttons($buttons) {

        $jck_posts = self::get_styles();

        if (!in_array('styleselect', $buttons) && $jck_posts) {
            array_unshift($buttons, 'styleselect');
        }

        return $buttons;

    }


    // Add Styles to mce

    public function mce_before_init($settings) {
        // Get existing styles
        if (isset($settings['style_formats'])) {
            $existing_styles = json_decode($settings['style_formats']);
        } else {
            $existing_styles = array();
        }

        $jck_posts = self::get_styles(); // Get All Custom Styles

        if ( $jck_posts ) {
            foreach ( $jck_posts as $jck_post ) {

                //$jck_custom_styles = get_post_meta($jck_post->ID, 'jck_custom_styles', true);

                $custom_style_settings = array(
                    'title' => $jck_post->post_title,
                    'attributes' => array(
                        'class' => $jck_post->post_name
                    ),
                    'wrapper' => false,
                    'name' => $jck_post->post_name
                );

                if (self::getValue('inline', '', $jck_post->ID) == 'inline') {
                    $custom_style_settings['inline'] = 'span';
                } //self::getValue('inline') == 'inline'
                else {
                    $custom_style_settings['block'] = 'p';
                }
                $style_formats[] = $custom_style_settings;

            }

            // Merge existing styles with new ones.
            $merge = array_merge($style_formats, $existing_styles);
            // Output merged styles as javascript
            $settings['style_formats'] = json_encode($merge);

        } // End if posts

        return $settings;

    }


    // Add dynamic CSS

    public function add_trigger($vars) {
        $vars[] = 'custom_styles_trigger';
        return $vars;
    }


    // Get the slug function

    public function the_slug() {
        $post_data = get_post($post->ID, ARRAY_A);
        $slug      = $post_data['post_name'];
        return $slug;
    }


    public function trigger_check() {
        if (intval(get_query_var('custom_styles_trigger')) == 1) {
            header("Content-type: text/css");


            $jck_posts = self::get_styles(); // Get All Custom Styles

            if ( $jck_posts ) {
                foreach ( $jck_posts as $jck_post ) {

                    $current_styles = $this->compile_styles(get_post_meta($jck_post->ID, 'jck_custom_styles', true), $jck_post->ID);
                    $slug = $jck_post->post_name;

                    echo '.' . $slug . ' {' . $current_styles . '}' . "\n";

                }

            } // End if posts

            exit;
        } //intval(get_query_var('custom_styles_trigger')) == 1
    }


    // Add Stylesheet to frontend

    public function add_dynamic_stylesheet() {
        $mce_css = get_bloginfo('url') . '?custom_styles_trigger=1';
        wp_register_style('custom_styles_css', $mce_css);
        wp_enqueue_style('custom_styles_css');
    }


    // Add Stylesheet to editor

    public function plugin_mce_css($mce_css) {
        if (!empty($mce_css))
            $mce_css .= ',';
        $mce_css .= get_bloginfo('url') . '?custom_styles_trigger=1';
        return $mce_css;
    }


    /* =====
  Add Custom Post Type
  ===== */

    public function post_type() {
        $labels = array(
            'name' => _x('Custom Styles', 'post type general name'),
            'singular_name' => _x('Custom Style', 'post type singular name'),
            'add_new' => _x('Add New', 'Custom Style'),
            'add_new_item' => __('Add New Custom Style'),
            'edit_item' => __('Edit Custom Style'),
            'new_item' => __('New Custom Style'),
            'view_item' => __('View Custom Stylea'),
            'search_items' => __('Search Custom Stylea'),
            'not_found' => __('No Custom Styles found'),
            'not_found_in_trash' => __('No Custom Styles found in Trash'),
            'parent_item_colon' => ''
        );

        register_post_type('custom-styles', array(
                'labels' => $labels,
                'public' => false,
                'show_ui' => true,
                'show_in_menu' => 'options-general.php',
                'supports' => array(
                    'title'
                )
            ));
    }


    // Add meta box

    public function metaboxes() {
        add_meta_box('style_selector', 'Style Selector', array(
                &$this,
                'custom_styles_meta'
            ), 'custom-styles', 'normal', 'high');

    }


    public function custom_styles_meta() {
        global $post;
        $current_styles = $this->compile_styles(get_post_meta($post->ID, 'jck_custom_styles', true));

        wp_nonce_field('custom_styles_nonce', 'meta_box_nonce');

        include 'inc/admin-editor.php';

    }


    public function save_custom_styles_meta($post_id) {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'custom_styles_nonce'))
            return;

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_posts'))
            return;

        // now we can actually save the data

        // Make sure your data is set before trying to save it
        if (isset($_POST['jck_custom_styles']))
            update_post_meta($post_id, 'jck_custom_styles', $_POST['jck_custom_styles']);

    }


    // =======================
    // Compile Saved Styles

    public function compile_styles($jck_custom_styles, $id = '') {
        $current_styles = '';

        if (self::getValue('fontFamily', '', $id) != "inherit") {
            $current_styles .= (self::getValue('fontFamily', '', $id) != '') ? 'font-family:' . self::getValue('fontFamily', '', $id) . '; ' : '';
        }

        $current_styles .= (self::getValue('fontSize', '', $id) != '') ? 'font-size:' . self::getValue('fontSize', '', $id) . self::getValue('fontSizeMeas', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('color', '', $id) != '') ? 'color:#' . self::getValue('color', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('fontWeight', '', $id) != '') ? 'font-weight:' . self::getValue('fontWeight', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('fontStyle', '', $id) != '') ? 'font-style:' . self::getValue('fontStyle', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('textDecoration', '', $id) != '') ? 'text-decoration:' . self::getValue('textDecoration', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('textTransform', '', $id) != '') ? 'text-transform:' . self::getValue('textTransform', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('textAlign', '', $id) != '') ? 'text-align:' . self::getValue('textAlign', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('letterSpacing', '', $id) != '') ? 'letter-spacing:' . self::getValue('letterSpacing', '', $id) . 'px; ' : '';

        $current_styles .= (self::getValue('wordSpacing', '', $id) != '') ? 'word-spacing:' . self::getValue('wordSpacing', '', $id) . 'px; ' : '';

        $current_styles .= (self::getValue('lineHeight', '', $id) != '') ? 'line-height:' . self::getValue('lineHeight', '', $id) . self::getValue('lineHeightMeas', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('backgroundColor', '', $id) != '') ? 'background-color:#' . self::getValue('backgroundColor', '', $id) . '; ' : '';

        if (self::getValue('margin_ind', '', $id) == 'margin_ind') {
            $current_styles .= (self::getValue('margin-top', '', $id) != '') ? 'margin-top:' . self::getValue('margin-top', '', $id) . 'px; ' : '';
            $current_styles .= (self::getValue('margin-right', '', $id) != '') ? 'margin-right:' . self::getValue('margin-right', '', $id) . 'px; ' : '';
            $current_styles .= (self::getValue('margin-bottom', '', $id) != '') ? 'margin-bottom:' . self::getValue('margin-bottom', '', $id) . 'px; ' : '';
            $current_styles .= (self::getValue('margin-left', '', $id) != '') ? 'margin-left:' . self::getValue('margin-left', '', $id) . 'px; ' : '';
        } //self::getValue('margin_ind','',$id) == 'margin_ind'
        else {
            $current_styles .= (self::getValue('margin', '', $id) != '') ? 'margin:' . self::getValue('margin', '', $id) . 'px; ' : '';
        }

        if (self::getValue('padding_ind', '', $id) == 'padding_ind') {
            $current_styles .= (self::getValue('padding-top', '', $id) != '') ? 'padding-top:' . self::getValue('padding-top', '', $id) . 'px; ' : '';
            $current_styles .= (self::getValue('padding-right', '', $id) != '') ? 'padding-right:' . self::getValue('padding-right', '', $id) . 'px; ' : '';
            $current_styles .= (self::getValue('padding-bottom', '', $id) != '') ? 'padding-bottom:' . self::getValue('padding-bottom', '', $id) . 'px; ' : '';
            $current_styles .= (self::getValue('padding-left', '', $id) != '') ? 'padding-left:' . self::getValue('padding-left', '', $id) . 'px; ' : '';
        } //self::getValue('padding_ind','',$id) == 'padding_ind'
        else {
            $current_styles .= (self::getValue('padding', '', $id) != '') ? 'padding:' . self::getValue('padding', '', $id) . 'px; ' : '';
        }

        $current_styles .= (self::getValue('borderStyle', '', $id) != '') ? 'border-style:' . self::getValue('borderStyle', '', $id) . '; ' : '';

        $current_styles .= (self::getValue('borderColor', '', $id) != '') ? 'border-color:#' . self::getValue('borderColor', '', $id) . '; ' : '';

        if (self::getValue('border_ind', '', $id) == 'border_ind') {
            $current_styles .= (self::getValue('border-top-width', '', $id) != '') ? 'border-top-width:' . self::getValue('border-top-width', '', $id) . 'px; ' : 'border-top-width:0px; ';
            $current_styles .= (self::getValue('border-right-width', '', $id) != '') ? 'border-right-width:' . self::getValue('border-right-width', '', $id) . 'px; ' : 'border-right-width:0px; ';
            $current_styles .= (self::getValue('border-bottom-width', '', $id) != '') ? 'border-bottom-width:' . self::getValue('border-bottom-width', '', $id) . 'px; ' : 'border-bottom-width:0px; ';
            $current_styles .= (self::getValue('border-left-width', '', $id) != '') ? 'border-left-width:' . self::getValue('border-left-width', '', $id) . 'px; ' : 'border-left-width:0px; ';
        } //self::getValue('border_ind','',$id) == 'border_ind'
        else {
            $current_styles .= (self::getValue('border-width', '', $id) != '') ? 'border-width:' . self::getValue('border-width', '', $id) . 'px; ' : 'border-width:0px; ';
        }

        return $current_styles;
    }


    public function message($messages) {
        global $post;
        $post_ID = $post->ID;

        $messages['custom-styles'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf(__('Custom Style updated.')),
            2 => __('Custom field updated.'),
            3 => __('Custom field deleted.'),
            4 => __('Custom Style updated.'),
            /* translators: %s: date and time of the revision */
            5 => isset($_GET['revision']) ? sprintf(__('Custom Style restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
            6 => sprintf(__('Custom Style created.')),
            7 => __('Custom Style saved.'),
            8 => sprintf(__('Custom Style submitted. <a target="_blank" href="%s">Preview post</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
            9 => sprintf(__('Custom Style scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview post</a>'),
                // translators: Publish box date format, see http://php.net/date
                date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
            10 => sprintf(__('Custom Style draft updated.'))
        );

        return $messages;

    }


    // Remove Quickedit
    public function remove_quick_edit( $actions ) {
        global $post;
        if ( $post->post_type == 'custom-styles' ) {
            unset($actions['inline hide-if-no-js']);
        }
        return $actions;
    }


} // End jck_custom_styles Class

$jck_custom_styles = new JCK_Custom_Styles(); // Start an instance of the plugin class