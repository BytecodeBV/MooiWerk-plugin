<?php

/**
 * Fired during plugin activation
 *
 * @link       https://bytecode.nl
 * @since      1.0.0
 *
 * @package    MooiWerk
 * @subpackage MooiWerk/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    MooiWerk
 * @subpackage MooiWerk/includes
 * @author     Bytecode Digital Agency B.V. <support@bytecode.nl>
 */
class MooiWerk_Activator {
    /**
     * Function called on activation.
     *
     * Creates user roles.
     *
     * @since    1.0.0
     */
    public static function activate() {
        /**
         * Add User Roles
         */
        add_role('organisation', __('Organisatie', 'mooiwerk'), ['read' => true, 'level_0' => true]);
        add_role('volunteer', __('Vrijwilliger', 'mooiwerk'), ['read' => true, 'level_0' => true]);
        
        create_page(__('Organisaties', 'mooiwerk'));
        create_page(__('Vrijwilligers', 'mooiwerk'));
        create_page(__('Vacatures', 'mooiwerk'));
        create_page(__('Vrijwilligersacademie', 'mooiwerk'));

        create_page(__('Mijn Account', 'mooiwerk'));
        create_page(__('Nieuwe Vacature', 'mooiwerk'));
        create_page(__('Bewerk Vacature', 'mooiwerk'));
        create_page(__('Beheer Vacatures', 'mooiwerk'));
        create_page(__('Reacties', 'mooiwerk'));
        create_page(__('Favorieten', 'mooiwerk'));
        create_page(__('Wijzig Wachtwoord', 'mooiwerk'));
        create_page(__('Opstelling', 'mooiwerk'));
        create_page(__('Inloggen', 'mooiwerk'), '[theme-my-login action="login"]');
        create_page(__('Uitloggen', 'mooiwerk'), '[theme-my-login action="logout"]');
        create_page(__('Registreren', 'mooiwerk'), '[theme-my-login action="register"]');
        create_page(__('Registreer Organisatie', 'mooiwerk'), '[theme-my-login action="register"]');
        create_page(__('Registreer Vrijwilliger', 'mooiwerk'), '[theme-my-login action="register"]');
        create_page(__('Maak hier een veilig wachtwoord aan', 'mooiwerk'), '[theme-my-login action="lostpassword"]');
        create_page(__('Maak hier een veilig wachtwoord aan', 'mooiwerk'), '[theme-my-login action="resetpass"]');
    }
}

/**
 * Create a WordPress page.
 */
function create_page($name, $content = NULL, $template = NULL) {
    if (get_page_by_title($name) == NULL){
        $post = array(
            'comment_status' => 'closed',
            'ping_status' =>  'closed' ,
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_name' => $name,
            'post_status' => 'publish' ,
            'post_title' => $name,
            'post_type' => 'page'
        );
        if ($content != NULL) {
            $post['post_content'] = $content;
        }
        if ($template != NULL) {
            $post['page_template'] = $template;
        }        
        wp_insert_post($post); 
    }
}
