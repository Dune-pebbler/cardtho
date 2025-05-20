<?php
// Configuration
// define('CUSTOM_LOGIN_SLUG', 'dp-login'); // Change this to modify the login URL

// Custom login styling and setup
function custom_login_styles()
{
    wp_enqueue_style('custom-login', get_template_directory_uri() . '/stylesheets/admin/login.css');
}
add_action('login_enqueue_scripts', 'custom_login_styles');

// Change login URL
// function custom_login_url($login_url) 
// {
//     return str_replace('wp-login.php', CUSTOM_LOGIN_SLUG, $login_url);
// }
// add_filter('login_url', 'custom_login_url', 10, 1);

// Redirect old login page
// function redirect_login_page() 
// {
//     if ($GLOBALS['pagenow'] === 'wp-login.php' && !is_admin() && $_SERVER['REQUEST_METHOD'] === 'GET') {
//         wp_redirect(home_url(CUSTOM_LOGIN_SLUG));
//         exit;
//     }
// }
// add_action('init', 'redirect_login_page');

// Handle new login URL
// function custom_login_page() 
// {
//     if ($_SERVER['REQUEST_URI'] == '/' . CUSTOM_LOGIN_SLUG) {
//         require_once ABSPATH . 'wp-login.php';
//         exit();
//     }
// }
// add_action('init', 'custom_login_page');

// Change login logo URL
function custom_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

// Change login logo and background
function custom_login_logo()
{
?>
    <style>
        body.login {
            background-image: url(<?php echo get_template_directory_uri(); ?>/images/login/dp_bg.webp) !important;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/images/login/dp_white.png) !important;
            width: auto;
            height: 154px;
            padding-bottom: 25px;
            margin: 0 auto;
            background-size: 164px 154px;
        }
    </style>
<?php
}
add_action('login_head', 'custom_login_logo');

// Remove language switcher
function remove_login_language_selector()
{
    return false;
}
add_filter('login_display_language_dropdown', 'remove_login_language_selector');