<?php

/**
 * Plugin Name: Simple Contact Form
 * Description: Simple contact form tutorial
 * Author: Mr Do
 * Author URI: http://thanhdo.com
 * Version: 1.0.0
 * Text Domain: simple-contact-form
 */


if (!defined('ABSPATH')) {

    echo 'What are you trying to do?';
    exit;
}


class SimpleContactForm
{
    public function __construct()
    {

        // Create custom post type
        add_action('init', array($this, 'create_custom_post_type'));

        //  Add assets (js, css ,ect)
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));

        // Add shortcode
        // add_shortcode('contact-form', array($this, 'load_shortcode'));

        // Load Javascrpit

        // add_action('wp_footer', array($this, 'load_script'));


    }

    public function initialize()
    {
        include(plugin_dir_path(__FILE__) . '/includes/contact-form.php');
    }



    public function create_custom_post_type()
    {

        $args = array(

            'public' => true,
            'has_archive' => true,
            'supports' => array('title'),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability' => 'manage_options',
            'labels' => array(
                'name' => 'Contact Form',
                'singular_name' => 'Contact Form Entry'
            ),
            'menu_icon' => 'dashicons-media-text'

        );

        register_post_type('simple-contact-form', $args);
    }




    public function load_assets()
    {

        wp_enqueue_style(
            'simple_contact_form',
            plugin_dir_url(__FILE__) . 'css/simple_contact_form.css',
            array(),
            1,
            'all'
        );

        wp_enqueue_script(
            'simple_contact_form',
            plugin_dir_url(__FILE__) . 'js/simple_contact_form.js',
            array('jquery'),
            1,
            true
        );
    }




    // public function load_shortcode()
    // {
    //     include(plugin_dir_path(__FILE__) . '/includes/contact-form.php');
    // }




    // public function load_script(){ }






}

$contactPlugin = new SimpleContactForm;
$contactPlugin->initialize();
