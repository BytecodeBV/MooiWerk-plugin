<?php
/**
 * Change author template single
 *
 * @param $template represents the template as it came in through the template_include hook
 */
function change_template_single_author($template) {
    if (is_author()) {
        $author_id = get_query_var('author');
        $author_meta = get_userdata($author_id);
        $author_roles = $author_meta->roles;
        if (in_array('organisation', $author_roles)) {
            error_log('path: '.plugin_dir_path(dirname(__FILE__)));
            $template = plugin_dir_path(dirname(__FILE__)) . 'structure/organisations/single.blade.php';
        } elseif (in_array('volunteer', $author_roles)) {
            $user = wp_get_current_user();
            if (current_user_can('administrator') || in_array('organisation', (array) $user->roles)) {
                error_log('path: '.plugin_dir_path(__FILE__)."".plugin_dir_path(dirname(__FILE__)));
                $template = plugin_dir_path(dirname(__FILE__)). 'structure/volunteers/single.blade.php';
            } else {
                $template = locate_template('views/404.blade.php');
            }
        } else {
            _e('gebruiker was geen organisatie noch een vrijwilliger', 'mooiwerk');
        }
    }
    return $template;
}

add_filter('template_include', 'change_template_single_author');

/**
 * Change author slug
 */
function change_author_slug() {
    global $wp_rewrite;
    $author_slug = 'profile'; // change slug name
    $wp_rewrite->author_base = $author_slug;
}

add_action('init', 'change_author_slug');

/**
 * Disable the administrator bar for non-admins.
 */
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('after_setup_theme', 'remove_admin_bar');

function restrict_post_deletion($post_ID) {
    $restricted_pages = [
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
        __('Nieuw account', 'mooiwerk'),
        __('Registreer Organisatie', 'mooiwerk'),
        __('Registreer Vrijwilliger', 'mooiwerk'),
        __('Maak hier een veilig wachtwoord aan', 'mooiwerk'),
        __('Wachtwoord reset', 'mooiwerk')
    ];
    if (in_array(get_the_title($post_ID), $restricted_pages)) {
        _e('Kan pagina van WordPress niet verwijderen. Schakel de MooiWerk-plug-in uit om de pagina te verwijderen.', 'mooiwerk');
        exit;
    }
}

add_action('wp_trash_post', 'restrict_post_deletion', 10, 1);
//add_action('before_delete_post', 'restrict_post_deletion', 10, 1);

//add rule to acf location rules to check against author
add_filter(
    'acf/location/rule_values/current_user',
    function ($choices) {
        $choices[ 'is_author' ] = "Is author";
        return $choices;
    }
);

//acf location rule is_author matching function
add_filter(
    'acf/location/rule_match/current_user',
    function ($match, $rule, $options) {        
        if ($rule['value'] == 'is_author') {            
            global $post;
            $author_id = $post->post_author;
            $current_user = wp_get_current_user();
            if ($rule['operator'] == "==") {
                $match = ( $current_user->ID == $author_id);
            } elseif ($rule['operator'] == "!=") {
                $match = ( $current_user->ID != $author_id );
            }
        }
        return $match;
    },
    10, 
    3
);

/* DELETE: hook to update user vacancy apply/accept/reject status
//try add_action('wp_insert_comment', function ($comment_id, $comment_object){}, 99, 2) if comment_post doesnt work
add_action('comment_post', function ($comment_ID, $comment_approved) {
    $comment = get_comment($comment_ID);
    $comment_post = get_post($comment->comment_post_ID);
    $author_id = $comment_post->post_author;
    $action = get_field('action', 'comment_'.$comment_ID);
    if ($author_id == $comment->user_id && in_array($action, ['Weiger', 'Accepteer'])) {
        $user_comment = get_comment($comment->comment_parent);
        if ($user_comment) {
            $reactions = get_user_meta($user_comment->user_id, 'reacties', true);
            if (empty($reactions)) {
                $reactions = [];
            }
            $reactions[$user_comment->comment_post_ID] = $action;
            update_user_meta($user_comment->user_id, 'reacties', $reactions);
        }        
    } elseif (get_current_user_role() == 'volunteer' && $action == 'Reageer') {
        $comment = get_comment($comment_ID);
        $reactions = get_user_meta($comment->user_id, 'reacties', true);
        if (empty($reactions)) {
            $reactions = [];
        }
        $reactions[$comment->comment_post_ID] = $action;
        update_user_meta($comment->user_id, 'reacties', $reactions);
    }
}, 10, 2);
*/