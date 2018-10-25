<?php
/**
 * Add Custom Fields to the events plugin on init.
 */
function register_custom_fields_cta() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            [
                'key' => 'group_5bc8cef4e0d08',
                'title' => __('Vacancy CTA', 'mooiwerk'),
                'fields' => [

                    [
                        'key' => 'field_5bc8cf34284d1',
                        'label' => __('Button Label', 'mooiwerk'),
                        'name' => 'vacancy_button_label',
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
                        'key' => 'field_5bc8cf57284d2',
                        'label' => __('Button Action Type', 'mooiwerk'),
                        'name' => 'vacancy_button_action_type',
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
                        'key' => 'field_5bc8d034284d3',
                        'label' => __('Page', 'mooiwerk'),
                        'name' => 'vacancy_page',
                        'type' => 'page_link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_5bc8cf57284d2',
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
                        'key' => 'field_5bc8d098284d4',
                        'label' => __('URL', 'mooiwerk'),
                        'name' => 'vacancy_url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_5bc8cf57284d2',
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
                        'key' => 'field_5bc8d178284d6',
                        'label' => __('Action Target', 'mooiwerk'),
                        'name' => 'vacancy_action_target',
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
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'theme-general-settings',
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
                'key' => 'group_5bd157f6323e2',
                'title' => __('Organisation CTA', 'mooiwerk'),
                'fields' => [

                    [
                        'key' => 'field_5bd157191b4de',
                        'label' => __('Button Label', 'mooiwerk'),
                        'name' => 'organisation_button_label',
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
                        'name' => 'organisation_button_action_type',
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
                        'name' => 'organisation_page',
                        'type' => 'page_link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => '5bd157190b324',
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
                        'name' => 'organisation_url',
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
                        'name' => 'organistation_action_target',
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
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'theme-general-settings',
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
                'key' => 'group_5bd157f63248e',
                'title' => __('Volunteer CTA', 'mooiwerk'),
                'fields' => [

                    [
                        'key' => 'field_5bd1569c05dbc',
                        'label' => __('Button Label', 'mooiwerk'),
                        'name' => 'volunteer_button_label',
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
                        'key' => 'field_5bd155ffeb470',
                        'label' => __('Button Action Type', 'mooiwerk'),
                        'name' => 'volunteer_button_action_type',
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
                        'key' => 'field_5bd156411469c',
                        'label' => __('Page', 'mooiwerk'),
                        'name' => 'volunteer_page',
                        'type' => 'page_link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_5bd155ffeb470',
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
                        'key' => 'field_5bd1566d37b60',
                        'label' => __('URL', 'mooiwerk'),
                        'name' => 'volunteer_url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_5bd155ffeb470',
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
                        'key' => 'field_5bd1558b8b26f',
                        'label' => __('Action Target', 'mooiwerk'),
                        'name' => 'volunteer_action_target',
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
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'theme-general-settings',
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
