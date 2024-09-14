<?php
/*
Plugin Name: AvatarBuddy Redirect
Description: Plugin for connecting with Buddy chat.
Version: 2.0
Author: Ing. Carlos Garzón
Author URI: https://www.bygarzon.com
*/

define('AVATAR_BUDDY_SECRET_KEY_OPTION', 'avatar_buddy_secret_key');
define('AVATAR_BUDDY_SSO_URL_OPTION', 'avatar_buddy_sso_url');

function generate_avatarbuddy_sso_url() {
    $secret_key = get_option(AVATAR_BUDDY_SECRET_KEY_OPTION);
    $sso_url = get_option(AVATAR_BUDDY_SSO_URL_OPTION);

    if (!$secret_key || !$sso_url) {
        return '#'; 
    }

    $utc_timestamp = time();

    $query_string = "?actionxm=ssologin&ts=" . $utc_timestamp;

    $signature = hash("sha256", $secret_key . $query_string);

    $full_url = $sso_url . $query_string . "&ssotoken=" . urlencode($signature);

    return $full_url;
}

function avatarbuddy_redirect_shortcode() {
    return '<button id="form_buddy_button" class="form_buddy_button">Try Me</button>';
}

add_shortcode('avatarbuddy_form', 'avatarbuddy_redirect_shortcode');

function avatarbuddy_enqueue_scripts() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('form_buddy_button').addEventListener('click', function () {
                fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=generate_avatarbuddy_sso_url')
                    .then(response => response.text())
                    .then(url => {
                        if (window.matchMedia("(min-width: 1024px)").matches) {
                            window.open(url, '_blank');
                        } else {
                            window.location.href = url;
                        }
                    })
                    .catch(error => console.error('Error generating SSO URL:', error));
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'avatarbuddy_enqueue_scripts');

function avatarbuddy_generate_sso_url_ajax() {
    echo generate_avatarbuddy_sso_url();
    wp_die(); // Properly end the AJAX request
}
add_action('wp_ajax_generate_avatarbuddy_sso_url', 'avatarbuddy_generate_sso_url_ajax');
add_action('wp_ajax_nopriv_generate_avatarbuddy_sso_url', 'avatarbuddy_generate_sso_url_ajax');

function avatarbuddy_register_admin_page() {
    add_menu_page(
        'AvatarBuddy Settings',           // Page title
        'AvatarBuddy',                    // Menu title
        'manage_options',                 // Capability
        'avatarbuddy-settings',           // Menu slug
        'avatarbuddy_settings_page',      // Callback function
        'dashicons-admin-network',        // Icon
        100                               // Position
    );
}
add_action('admin_menu', 'avatarbuddy_register_admin_page');

function avatarbuddy_settings_page() {
    ?>
    <div class="wrap">
        <h1>AvatarBuddy Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('avatarbuddy_settings_group');
            do_settings_sections('avatarbuddy-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function avatarbuddy_register_settings() {
    register_setting('avatarbuddy_settings_group', AVATAR_BUDDY_SECRET_KEY_OPTION);
    register_setting('avatarbuddy_settings_group', AVATAR_BUDDY_SSO_URL_OPTION);

    add_settings_section(
        'avatarbuddy_settings_section',   // ID
        'SSO Configuration',              // Title
        null,                             // Callback function (optional)
        'avatarbuddy-settings'            // Page slug
    );

    add_settings_field(
        AVATAR_BUDDY_SECRET_KEY_OPTION,   // ID
        'AvatarBuddy Secret Key',         // Label
        'avatarbuddy_secret_key_field',   // Callback function
        'avatarbuddy-settings',           // Page slug
        'avatarbuddy_settings_section'    // Section ID
    );

    add_settings_field(
        AVATAR_BUDDY_SSO_URL_OPTION,      // ID
        'AvatarBuddy SSO URL',            // Label
        'avatarbuddy_sso_url_field',      // Callback function
        'avatarbuddy-settings',           // Page slug
        'avatarbuddy_settings_section'    // Section ID
    );
}
add_action('admin_init', 'avatarbuddy_register_settings');

function avatarbuddy_secret_key_field() {
    $value = get_option(AVATAR_BUDDY_SECRET_KEY_OPTION);
    echo '<input type="text" name="' . AVATAR_BUDDY_SECRET_KEY_OPTION . '" value="' . esc_attr($value) . '" class="regular-text">';
}

function avatarbuddy_sso_url_field() {
    $value = get_option(AVATAR_BUDDY_SSO_URL_OPTION);
    echo '<input type="url" name="' . AVATAR_BUDDY_SSO_URL_OPTION . '" value="' . esc_attr($value) . '" class="regular-text">';
}
?>