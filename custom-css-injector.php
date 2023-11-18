<?php
/**
 * Plugin Name: Custom CSS Injector
 * Description: Add custom CSS to your WordPress site easily.
 * Version: 1.0
 * Author: PlainSurf Solutions
 * Author URI: https://plainsurf.com/
 * Requires PHP at least: 7.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Add a menu item to the admin menu
function custom_css_injector_menu() {
    add_menu_page(
        'Custom CSS Injector',
        'CSS Injector',
        'manage_options',
        'custom-css-injector',
        'custom_css_injector_page'
    );
}
add_action('admin_menu', 'custom_css_injector_menu');

// Render the plugin settings page
function custom_css_injector_page() {
    ?>
    <div class="wrap">
        <h2>Custom CSS Injector</h2>
        <form method="post" action="options.php">
            <?php settings_fields('custom_css_injector_settings'); ?>
            <?php do_settings_sections('custom_css_injector_settings'); ?>
            <?php
            $custom_css = get_option('custom_css', '');
            ?>
            <textarea name="custom_css" rows="10" cols="50"><?php echo esc_textarea($custom_css); ?></textarea>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register and sanitize the settings
function custom_css_injector_settings() {
    register_setting('custom_css_injector_settings', 'custom_css', 'sanitize_custom_css');
    add_settings_section('custom_css_injector_section', 'Custom CSS', 'custom_css_injector_section_callback', 'custom_css_injector_settings');
    add_settings_field('custom_css_field', 'Add your custom CSS here:', 'custom_css_field_callback', 'custom_css_injector_settings', 'custom_css_injector_section');
}
add_action('admin_init', 'custom_css_injector_settings');

// Section callback
function custom_css_injector_section_callback() {
    echo 'Add your custom CSS below:';
}

// Field callback
function custom_css_field_callback() {
    echo '<p>Enter your custom CSS below:</p>';
}

// Sanitize textarea field
function sanitize_custom_css($input) {
    return sanitize_text_field($input);
}

