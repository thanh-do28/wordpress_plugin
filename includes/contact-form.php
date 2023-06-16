<?php

add_shortcode("userlogin", 'show_contact_login');

add_shortcode("userregister", "show_contact_register");


function show_contact_login()
{

    include(plugin_dir_path(__FILE__) . '/templates/login-form.php');
}

function show_contact_register()
{
    include(plugin_dir_path(__FILE__) . "/templates/register-form.php");
}



// form-login
add_action('wp_ajax_login', 'login_form');
add_action('wp_ajax_nopriv_login', 'login_form');

function login_form()
{

    $formdata = [];
    wp_parse_str($_POST['login'], $formdata);

    $uemail = $formdata['uemail'];
    $psw = $formdata['psw'];

    global $wpdb;
    // // this is how you get access to the database
    $result = $wpdb->get_results("SELECT * FROM wp_userstodo WHERE email ='$uemail'");
    $id = $result[0]->user_id;
    $name = $result[0]->names;
    $email = $result[0]->email;
    $password = $result[0]->password;

    $cookieid = "user_login_id";
    $cookiename = "user_login_name";

    if (count($result) != 0) {
        if ($password == $psw) {
            setcookie($cookieid, $id, time() + 86400 * 30, "/");
            setcookie($cookiename, $name, time() + 86400 * 30, "/");
            wp_send_json_success(['mess' => "ok"]);
        } else {
            wp_send_json_success(['mess' => "erropass"]);
        }
    } else {
        wp_send_json_success(['mess' => "erroemail"]);
    }
}



// form-register

add_action('wp_ajax_register', 'register_form');
add_action('wp_ajax_nopriv_register', 'register_form');

function register_form()
{

    $formdata = [];
    wp_parse_str($_POST['register'], $formdata);

    $name = $formdata['name'];
    $email = $formdata['email'];
    $psw = $formdata['psw'];
    $pswrepeat = $formdata['psw-repeat'];
    global $wpdb;
    // // this is how you get access to the database
    $result = $wpdb->get_results("SELECT email FROM wp_userstodo WHERE email ='$email'");

    if (count($result) != 0) {
        wp_send_json_success(['mess' => "erroemail"]);
    } else {
        if ($psw != $pswrepeat) {
            wp_send_json_success(['mess' => "erropass"]);
        } else {

            $results = $wpdb->insert(
                'wp_userstodo',
                array(
                    'names' => $name,
                    'email' => $email,
                    'password' => $psw,
                ),
            );

            wp_send_json_success(['mess' => "ok"]);
        }
    }
}
