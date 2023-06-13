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
        add_shortcode('contact-form', array($this, 'load_shortcode'));
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




    public function load_shortcode()
    { ?>
        <section class="page-wrap " style="min-height: 600px;">
            <div class="container bg-light h-100 w-100 py-5">

                <div class="border border-1 rounded w-75 m-auto py-3 px-5 m-2 ">
                    <div class="container_login">
                        <form action="" method="">
                            <div class="d-flex flex-column">
                                <label for="uname"><b>Username</b></label>
                                <input class="p-1 mb-3" type="email" placeholder="Enter Username" name="uname" required>

                                <label for="psw"><b>Password</b></label>
                                <input class="p-1" type="password" placeholder="Enter Password" name="psw" required>

                                <button class="btn btn-primary mt-4 mb-2" type="submit">Login</button>
                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-4">
                                <div class="register">Do not have an account register here <a href="http://localhost/wordpress/register/">Click Here</a></div>
                                <div class="login_admin"> Admin access <a href="/php_todolist/view_loginAdmin/login_admin.php">Click Here</a></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button id="button-cancel-login" class="cancelbtn btn btn-danger" type="button">Cancel</button>
                                <span class="psw">Forgot <a href="#">password?</a></span>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </section>
<?php }
}

new SimpleContactForm;
