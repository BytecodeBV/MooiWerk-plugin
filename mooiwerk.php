<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bytecode.nl
 * @since             1.0.0
 * @package           MooiWerk
 *
 * @wordpress-plugin
 * Plugin Name:       MooiWerk
 * Plugin URI:        https://bytecode.nl
 * Description:       Adds all custom functionality for MooiWerk platform
 * Version:           1.2.3
 * Author:            Bytecode Digital Agency B.V.
 * Author URI:        https://bytecode.nl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mooiwerk
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 0.1.0 and use SemVer - https://semver.org
 */
define('PLUGIN_NAME_VERSION', '0.1.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mooiwerk-activator.php
 */
function activate_mooiwerk() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-mooiwerk-activator.php';
    Mooiwerk_Activator::activate();
}

register_activation_hook(__FILE__, 'activate_mooiwerk');

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mooiwerk-deactivator.php
 */
function deactivate_mooiwerk() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-mooiwerk-deactivator.php';
    Mooiwerk_Deactivator::deactivate();
}

register_deactivation_hook(__FILE__, 'deactivate_mooiwerk');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-mooiwerk.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mooiwerk() {
    $plugin = new MooiWerk();
    $plugin->run();
}
run_mooiwerk();

