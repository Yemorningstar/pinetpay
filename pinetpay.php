<?php
/**
 * Plugin Name:       Pinetpay
 * Description:       Accept Pi Network payments directly on your WordPress site.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Your Name
 * Author URI:        https://yourwebsite.com/
 */

if (!defined('WPINC')) {
    die;
}

// Include the enqueue scripts file
require_once plugin_dir_path(__FILE__) . 'includes/enqueue-scripts.php';

// Include the admin settings page
require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';

// Hook into the 'admin_menu' action to add the settings page
function pinetpay_add_admin_page() {
    add_options_page('Pinetpay Settings', 'Pinetpay', 'manage_options', 'pinetpay', 'pinetpay_create_page');
}
add_action('admin_menu', 'pinetpay_add_admin_page');

// Settings page content
function pinetpay_create_page() {
    ?>
    <div class="wrap">
        <h1>Pinetpay</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields('pinetpay_settings_group');
                do_settings_sections('pinetpay_settings');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register and add settings
function pinetpay_register_settings() {
    register_setting('pinetpay_settings_group', 'pinetpay_pi_network_address');
    add_settings_section('pinetpay_settings_section', 'Settings', null, 'pinetpay_settings');
    add_settings_field('pinetpay_pi_network_address_field', 'Pi Network Address', 'pinetpay_pi_network_address_callback', 'pinetpay_settings', 'pinetpay_settings_section');
}
add_action('admin_init', 'pinetpay_register_settings');

function pinetpay_pi_network_address_callback() {
    ?>
    <input type="text" name="pinetpay_pi_network_address" value="<?php echo esc_attr(get_option('pinetpay_pi_network_address')); ?>" />
    <?php
}
