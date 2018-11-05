<?php
/**
 * Add Custom Fields to the events plugin on init.
 */
function create_cta_post_type()
{
    $labels = array(
        'name' => __('CTA Buttons', 'mooiwerk'),
        'singular_name' => __('CTA Button', 'mooiwerk'),
        'add_new' => __('New Button', 'mooiwerk'),
        'add_new_item' => __('Add New Button', 'mooiwerk'),
        'edit_item' => __('Edit Button', 'mooiwerk'),
        'new_item' => __('New Button', 'mooiwerk'),
        'view_item' => __('View Button', 'mooiwerk'),
        'search_items' => __('Search Buttons', 'mooiwerk'),
        'not_found' =>  __('No Buttons Found', 'mooiwerk'),
        'not_found_in_trash' => __('No Buttons found in Trash', 'mooiwerk'),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
        ),
    );
    register_post_type('cta', $args);
}
add_action('init', 'create_cta_post_type');
/**
 * Add Custom Fields to the events plugin on init.
 */
function register_custom_fields_cta() {
    if (function_exists('acf_add_local_field_group')) {

        acf_add_local_field_group(
            [
                'key' => 'group_5bd157f6323e2',
                'title' => __('CTA Fields', 'mooiwerk'),
                'fields' => [

                    [
                        'key' => 'field_5bd157191b4de',
                        'label' => __('Button Label', 'mooiwerk'),
                        'name' => 'cta_label',
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
                        'key' => 'field_5bd157190b324',
                        'label' => __('Button Action Type', 'mooiwerk'),
                        'name' => 'cta_action_type',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [
                            'custom' => __('Go to URL', 'mooiwerk'),
                            'page' => __('Go to Page/Vacancy/Post', 'mooiwerk'),
                        ],
                        'allow_null' => 0,
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ],
                    [
                        'key' => 'field_5bd157190b40e',
                        'label' => __('Page', 'mooiwerk'),
                        'name' => 'cta_page',
                        'type' => 'page_link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_5bd157190b324',
                                    'operator' => '==',
                                    'value' => 'page',
                                ],
                            ],
                        ],
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'post_type' => [
                            0 => 'page',
                            1 => 'vacancies',
                            2 => 'post',
                        ],
                        'taxonomy' => [
                        ],
                        'allow_null' => 0,
                        'allow_archives' => 1,
                        'multiple' => 0,
                    ],
                    [
                        'key' => 'field_5bd157191b438',
                        'label' => __('URL', 'mooiwerk'),
                        'name' => 'cta_url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_5bd157190b324',
                                    'operator' => '==',
                                    'value' => 'custom',
                                ],
                            ],
                        ],
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                    ],
                    [
                        'key' => 'field_5bd156d71a65f',
                        'label' => __('Action Target', 'mooiwerk'),
                        'name' => 'cta_action_target',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [
                            '_self' => __('Same Window', 'mooiwerk'),
                            '_blank' => __('New Window', 'mooiwerk'),
                        ],
                        'allow_null' => 0,
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '_self',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'cta',
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

        
    };
}
add_action('acf/init', 'register_custom_fields_cta');
