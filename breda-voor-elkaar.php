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
 * Version:           1.0.0
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
function activate_mooiwerk()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-mooiwerk-activator.php';
    Mooiwerk_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mooiwerk-deactivator.php
 */
function deactivate_mooiwerk()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-mooiwerk-deactivator.php';
    Mooiwerk_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_mooiwerk');
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
function run_mooiwerk()
{
    $plugin = new MooiWerk();
    $plugin->run();
}
run_mooiwerk();

/**
 * Change author slug
 */
add_action('init', 'change_author_slug');
function change_author_slug()
{
    global $wp_rewrite;
    $author_slug = 'profile'; // change slug name
    $wp_rewrite->author_base = $author_slug;
}

/**
 * Change author template single
 *
 * @param $template represents the template as it came in through the template_include hook
 */
function change_template_single_author($template)
{
    if (is_author()) {
        $author_id = get_query_var('author');
        $author_meta = get_userdata($author_id);
        $author_roles = $author_meta->roles;
        if (in_array('organisation', $author_roles)) {
            $template = plugin_dir_path(__FILE__) . 'structure/organisations/single.blade.php';
        } elseif (in_array('volunteer', $author_roles)) {
            $template = plugin_dir_path(__FILE__) . 'structure/volunteers/single.blade.php';
        } else {
            _e('gebruiker was geen organisatie noch een vrijwilliger', 'mooiwerk');
        }
    }
    return $template;
}
add_filter('template_include', 'change_template_single_author');

/*
 * Check if field  group exists
 */
function is_field_group_exists($value, $type='post_title') 
{
    $exists = false;
    if ($field_groups = get_posts(array('post_type'=>'acf-field-group'))) {
        foreach ($field_groups as $field_group) {
            if ($field_group->$type == $value) {
                $exists = true;
            }
        }
    }
    return $exists;
}

/*
 * Output pagination for posts and users.
 */
function numeric_pagination($current_page, $num_pages)
{
    echo '<nav class="d-flex justify-content-center vacancy-list__pagination custom-pagination">'.
    '<ul class="pagination pagination-sm custom-pagination__list">';
    $start_number = $current_page - 2;
    $end_number = $current_page + 2;

    if (($start_number - 1) < 1) {
        $start_number = 1;
        $end_number = min($num_pages, $start_number + 4);
    }
    
    if (($end_number + 1) > $num_pages) {
        $end_number = $num_pages;
        $start_number = max(1, $num_pages - 4);
    }

    if ($start_number > 1) {
        echo '<li class="page-item custom-pagination__item"> 1 ... </li>';
    }

    for ($i = $start_number; $i <= $end_number; $i++) {
        if ($i === $current_page) {
            echo '<li class="page-item active custom-pagination__item"><a href="?page='.$i.'" class="page-link custom-pagination__link">';
            echo " [{$i}] ";
            echo '</a></li>';
        } else {
            echo '<li class="page-item custom-pagination__item"><a href="?page='.$i.'" class="page-link custom-pagination__link">';
            echo " {$i} ";
            echo '</a></li>';
        }
    }

    if ($end_number < $num_pages) {
        echo '<li class="page-item custom-pagination__item">... {$num_pages}</li>';
    }
    echo '</ul></nav>';
}

/**
 * Script to add filter variables to the url and refresh.
 * Originally taken from ACF documentation.
 */
function filter_script($page)
{
    ?>

<script type="text/javascript">
(function($) {
    // change
    $('#archive-filters').on('change', 'input[type="checkbox"],input[type="radio"],select', function(){
        // vars
        var url = '<?php echo home_url($page); ?>';
            args = {};
        // loop over filters
        $('#archive-filters .filter').each(function(){
            // vars
            var filter = $(this).data('filter'),
                vals = [];
            // find checked inputs
            $(this).find('input:checked, option:selected').each(function(){
                if( $(this).val()  !== '*'){
                    vals.push( $(this).val() );
                }                
            });
            // append to args
            args[ filter ] = vals.join(',');
        });
        // update url
        url += '?';
        // loop over args
        $.each(args, function( name, value ){
            if(value !== ""){
                url += name + '=' + value + '&';
            }
        });
        // remove last &
        url = url.slice(0, -1);
        // reload page
        window.location.replace( url );
    });
})(jQuery);
</script>

    <?php
}

//compare dates
function isExpired($time)
{
    return (time() > strtotime($time));
}

/**
 * Disable the administrator bar for non-admins.
 */
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');


function register_custom_fields_users()
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'acf_user',
            'title' => __('User Custom Fields', 'mooiwerk'),
            'fields' => [
                [
                    'key' => 'field_acf_form_first_name',
                    'label' => __('Naam', 'mooiwerk'),
                    'name' => 'first_name',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_acf_form_email',
                    'label' => __('Email', 'mooiwerk'),
                    'name' => 'email',
                    'type' => 'text',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'user_role',
                        'operator' => '==',
                        'value' => 'all',
                        'order_no' => 0,
                        'group_no' => 0,
                    ],
                ],
            ],
            'options' => [
                'position' => 'normal',
                'layout' => 'no_box',
                'hide_on_screen' => [
                ],
            ],
            'menu_order' => 0,
        ]);
    }
}
add_action('acf/init', 'register_custom_fields_users');

function restrict_post_deletion($post_ID)
{
    $restricted_pages = array(
        __('Organisaties', 'mooiwerk'),
        __('Vrijwilligers', 'mooiwerk'),
        __('Vacatures', 'mooiwerk'),
        __('Mijn Account', 'mooiwerk'),
        __('Nieuwe Vacature', 'mooiwerk'),
        __('Bewerk Vacature', 'mooiwerk'),
        __('Beheer Vacatures', 'mooiwerk'),
        __('Reacties', 'mooiwerk'),
        __('Favorieten', 'mooiwerk'),
        __('Wijzig Wachtwoord', 'mooiwerk'),
        __('Opstelling', 'mooiwerk'),
        __('Inloggen', 'mooiwerk'),
        __('Uitloggen', 'mooiwerk'),
        __('Registreren', 'mooiwerk'),
        __('Registreer Organisatie', 'mooiwerk'),
        __('Registreer Vrijwilliger', 'mooiwerk'),
        __('Maak hier een veilig wachtwoord aan', 'mooiwerk'),
        __('Wachtwoord reset', 'mooiwerk')
    );
    if (in_array(get_the_title($post_ID), $restricted_pages)) {
        _e("Kan pagina van WordPress niet verwijderen. Schakel de MooiWerk-plug-in uit om de pagina te verwijderen.", 'mooiwerk');
        exit;
    }
}
//add_action('before_edit_post', 'restrict_post_deletion', 10, 1);
//add_action('edit_post', 'restrict_post_deletion', 10, 1);
add_action('wp_trash_post', 'restrict_post_deletion', 10, 1);
add_action('before_delete_post', 'restrict_post_deletion', 10, 1);
