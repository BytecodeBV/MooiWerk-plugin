<?php
/**
 * Add Custom Fields to the events plugin on init.
 */
function register_custom_fields_cta() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            [
                'key' => 'group_5bc8cef4e0d08',
                'title' => 'CTA',
                'fields' => [
                    [
                        'key' => 'field_5bc8cefc284cf',
                        'label' => 'Title',
                        'name' => 'title',
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
                        'key' => 'field_5bc8cf0d284d0',
                        'label' => 'Content',
                        'name' => 'content',
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
                        'key' => 'field_5bc8cf34284d1',
                        'label' => 'Button Label',
                        'name' => 'button_label',
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
                        'label' => 'Button Action Type',
                        'name' => 'button_action_type',
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
                            'custom' => 'Go to URL',
                            'page' => 'Go to Page/Vacancy/Post',
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
                        'label' => 'Page',
                        'name' => 'page',
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
                        'label' => 'URL',
                        'name' => 'url',
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
                        'label' => 'Action Target',
                        'name' => 'action_target',
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
                            '_self' => 'Same Window',
                            '_blank' => 'New Window',
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
                            'value' => 'vacancies',
                        ],
                    ],
                    [
                        [
                            'param' => 'user_form',
                            'operator' => '==',
                            'value' => 'edit',
                        ],
                        [
                            'param' => 'user_role',
                            'operator' => '==',
                            'value' => 'organisation',
                        ],
                    ],
                    [
                        [
                            'param' => 'user_form',
                            'operator' => '==',
                            'value' => 'edit',
                        ],
                        [
                            'param' => 'user_role',
                            'operator' => '==',
                            'value' => 'volunteer',
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
