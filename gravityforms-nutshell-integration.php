<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.gulosolutions.com/
 * @since             1.0.0
 * @package           Gravityforms_Nutshell_Integration
 *
 * @wordpress-plugin
 * Plugin Name:       gravityforms-nutshell-integration
 * Plugin URI:        https://www.gulosolutions.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Gulo
 * Author URI:        https://www.gulosolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gravityforms-nutshell-integration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PLUGIN_NAME_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gravityforms-nutshell-integration-activator.php
 */
function activate_gravityforms_nutshell_integration()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-gravityforms-nutshell-integration-activator.php';
    Gravityforms_Nutshell_Integration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gravityforms-nutshell-integration-deactivator.php
 */
function deactivate_gravityforms_nutshell_integration()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-gravityforms-nutshell-integration-deactivator.php';
    Gravityforms_Nutshell_Integration_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_gravityforms_nutshell_integration');
register_deactivation_hook(__FILE__, 'deactivate_gravityforms_nutshell_integration');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-gravityforms-nutshell-integration.php';
require plugin_dir_path(__FILE__) . 'public/class-gravityforms-nutshell-integration-public.php';
require plugin_dir_path(__FILE__) . 'includes/class-settings.php';
require plugin_dir_path(__FILE__) . 'includes/class-gravityforms-nutshell-integration-update-options.php';


/**
 * The core app autoloader
 */
if (is_file(plugin_dir_path(__FILE__) . 'vendor/autoload.php')) {
    require plugin_dir_path(__FILE__) . 'vendor/autoload.php';
} elseif (is_file(dirname(__FILE__, 4) . '/vendor/autoload.php')) {
    require dirname(__FILE__, 4) . '/vendor/autoload.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gravityforms_nutshell_integration()
{
    $plugin_name = get_plugin_data(__FILE__, $markup = true, $translate = true)['Name'];

    if (is_admin() && !is_null($plugin_name)) {
        $my_settings_page = new MySettingsPage($plugin_name);
    }

    $plugin = new Gravityforms_Nutshell_Integration();
    $plugin->run();
}
run_gravityforms_nutshell_integration();
