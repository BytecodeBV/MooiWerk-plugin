<?php
//create teams CPT
function cptui_register_my_cpts_team()
{
    /**
     * Post Type: Teams.
     */

    $labels = [
        'name' => __('Teams', 'mooiwerk'),
        'singular_name' => __('Team', 'mooiwerk'),
    ];

    $args = [
        'label' => __('Teams', 'mooiwerk'),
        'labels' => $labels,
        'description' => '',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'has_archive' => false,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => ['slug' => 'team', 'with_front' => true],
        'query_var' => true,
        'supports' => ['title'],
    ];

    register_post_type('team', $args);
}

add_action('init', 'cptui_register_my_cpts_team');

/**
 * Add Custom Fields to the teams cpt on init.
 */
function register_custom_fields_teams() 
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            [
                'key' => 'group_5ba40341bb629',
                'title' => __('Teams Meta', 'mooiwerk'),
                'fields' => [
                    [
                        'key' => 'field_5ba40354de589',
                        'label' => __('Email', 'mooiwerk'),
                        'name' => 'email',
                        'type' => 'email',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ],
                    [
                        'key' => 'field_5ba4036ade58a',
                        'label' => __('Phone', 'mooiwerk'),
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_5ba40392de58b',
                        'label' => __('Bio', 'mooiwerk'),
                        'name' => 'bio',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => 'wpautop',
                    ],
                    [
                        'key' => 'field_5ba403b5de58c',
                        'label' => __('Avatar', 'mooiwerk'),
                        'name' => 'avatar',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'team',
                        ],
                    ],
                ],
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ]
        );
    }
}

add_action('acf/init', 'register_custom_fields_teams');
