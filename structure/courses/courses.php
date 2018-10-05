<?php
/**
 * Custom Taxonomy Categorieën for Courses.
 */
function register_custom_tax_wcs_category()
{
    /**
     * Taxonomy: Categorieën.
     */

    $labels = [
        'name' => __('Categorieën', 'mooiwerk'),
        'singular_name' => __('Categorie', 'mooiwerk'),
        'all_items' => __('Alle Categorieën', 'mooiwerk'),
        'edit_item' => __('Eategorie Bewerken', 'mooiwerk'),
        'view_item' => __('Bekijk categorie', 'mooiwerk'),
        'add_new_item' => __('Voeg een nieuwe categorie toe', 'mooiwerk'),
    ];

    $args = [
        'label' => __('Categorieën', 'mooiwerk'),
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'wcs_category', 'with_front' => true, ],
        'show_admin_column' => false,
        'show_in_rest' => false,
        'rest_base' => 'wcs_category',
        'show_in_quick_edit' => false,
    ];
    register_taxonomy('wcs_category', ['class'], $args);
}

add_action('init', 'register_custom_tax_wcs_category');

/**
 * Create Course categorires
 */
function create_course_terms() 
{
    if (!term_exists(__('Persoonlijke ontwikkeling', 'mooiwerk'), 'wcs_category')) {
        wp_insert_term(
            __('Persoonlijke ontwikkeling', 'mooiwerk'),
            'wcs_category'
        );
    }

    if (!term_exists(__('Sociale veiligheid', 'mooiwerk'), 'wcs_category')) {
        wp_insert_term(
            __('Sociale veiligheid', 'mooiwerk'), // the term
            'wcs_category'
        );
    }

    if (!term_exists(__('Financiën en sponsoring', 'mooiwerk'), 'wcs_category')) {
        wp_insert_term(
            __('Financiën en sponsoring', 'mooiwerk'), // the term
            'wcs_category'
        );
    }

    if (!term_exists(__('Communicatie en PR', 'mooiwerk'), 'wcs_category')) {
        wp_insert_term(
            __('Communicatie en PR', 'mooiwerk'), // the term
            'wcs_category'
        );
    }

    if (!term_exists(__('Werving en Selectie', 'mooiwerk'), 'wcs_category')) {
        wp_insert_term(
            __('Werving en Selectie', 'mooiwerk'), // the term
            'wcs_category'
        );
    }

    if (!term_exists(__('Organisatie en Bestuur', 'mooiwerk'), 'wcs_category')) {
        wp_insert_term(
            __('Organisatie en Bestuur', 'mooiwerk'), // the term
            'wcs_category'
        );
    }

    
}

add_action('init', 'create_course_terms');

/**
 * Add Custom Fields to the events plugin on init.
 */
function register_custom_fields_course() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            [
                'key' => 'group_5b86cb5cbd4b1',
                'title' => 'Events',
                'fields' => [
                    [
                        'key' => 'field_5b86cb7687d30',
                        'label' => __('Sub titel', 'mooiwerk'),
                        'name' => '_wcs_sub_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                        'key' => 'field_5b86ccc587d32',
                        'label' => __('Doelgroep', 'mooiwerk'),
                        'name' => '_wcs_audience',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [
                            'Vrijwilligers' => __('Vrijwilligers', 'mooiwerk'),
                            'Professionals' => __('Professionals', 'mooiwerk'),
                            'Bestuur' => __('Bestuur', 'mooiwerk'),
                            'Coordinatoren' => __('Coordinatoren', 'mooiwerk'),
                        ],
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => [
                        ],
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ],
                    [
                        'key' => 'field_5b86cd7687d34',
                        'label' => __('Programma', 'mooiwerk'),
                        'name' => '_wcs_program',
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
                        'key' => 'field_5b86cd9187d35',
                        'label' => __('Kosten/Prijs', 'mooiwerk'),
                        'name' => '_wcs_price',
                        'type' => 'number',
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
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ],
                    [
                        'key' => 'field_5b86cdf987d36',
                        'label' => __('Beschikbare plaatsen', 'mooiwerk'),
                        'name' => '_wcs_available',
                        'type' => 'number',
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
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'class',
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

        acf_add_local_field_group(
            [
                'key' => 'group_5b86ceba54ac9',
                'title' => __('Location', 'mooiwerk'),
                'fields' => [
                    [
                        'key' => 'field_5b86cec2fae67',
                        'label' => __('Straat', 'mooiwerk'),
                        'name' => '_wcs_street',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                        'key' => 'field_5b86cedcfae68',
                        'label' => __('Nummer', 'mooiwerk'),
                        'name' => '_wcs_number',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 1,
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
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ],
                    [
                        'key' => 'field_5b86cf01fae69',
                        'label' => __('Toevoeging', 'mooiwerk'),
                        'name' => '_wcs_addition',
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
                        'key' => 'field_5b86cf0cfae6a',
                        'label' => __('Postcode', 'mooiwerk'),
                        'name' => '_wcs_postcode',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                        'key' => 'field_5b86cf65fae6b',
                        'label' => __('Plaats', 'mooiwerk'),
                        'name' => '_wcs_place',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                        'key' => 'field_5b86cfa0fae6c',
                        'label' => __('Image', 'mooiwerk'),
                        'name' => '_wcs_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'url',
                        'preview_size' => 'full',
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
                            'param' => 'taxonomy',
                            'operator' => '==',
                            'value' => 'wcs-room',
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

        acf_add_local_field_group(
            [
                'key' => 'group_5b86d08001718',
                'title' => 'Teachers',
                'fields' => [
                    [
                        'key' => 'field_5b86d124f9016',
                        'label' => __('Tussenvoeging', 'mooiwerk'),
                        'name' => '_wcs_interposition',
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
                        'key' => 'field_5b86d14bf9017',
                        'label' => __('Achternaam', 'mooiwerk'),
                        'name' => '_wcs_last-name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                        'key' => 'field_5b86d165f9018',
                        'label' => __('Titel', 'mooiwerk'),
                        'name' => '_wcs_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                        'key' => 'field_5b86d17af9019',
                        'label' => __('Organisatie', 'mooiwerk'),
                        'name' => '_wcs_organisation',
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
                        'key' => 'field_5b86d195f901a',
                        'label' => __('Image', 'mooiwerk'),
                        'name' => '_wcs_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'url',
                        'preview_size' => 'full',
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
                            'param' => 'taxonomy',
                            'operator' => '==',
                            'value' => 'wcs-instructor',
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
add_action('acf/init', 'register_custom_fields_course');
