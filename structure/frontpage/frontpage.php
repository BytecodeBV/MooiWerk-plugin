<?php

/**
 * Add Custom Fields on plugin init.
 */
function register_custom_fields_frontpage() 
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            [
                'key' => 'group_5b5a18ac28cdd',
                'title' => __('Front Page', 'mooiwerk'),
                'fields' => [
                    [
                        'key' => 'field_5b5a18eeaf710',
                        'label' => __('Course Title', 'mooiwerk'),
                        'name' => 'course_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => 'Cursussen',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_5b5a1929af711',
                        'label' => __('Sidebar Title', 'mooiwerk'),
                        'name' => 'course_subtitle',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => __('Intro over cursussen lorep ipsum Breda cras sectum', 'mooiwerk'),
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_5b5a1955af712',
                        'label' => __('Description', 'mooiwerk'),
                        'name' => 'course_description',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => __(
                            '<p>In tempus pulvinar mattis. Sed sed feugiat metus. Nam sollicitudin risus sapien, id bibendum urna laoreet nec.' .
                            ' Etiam efficitur libero eget nisl euismod, a rutrum leo sagittis. Mauris egestas diam purus. In tempus pulvinar mattis. Sed sed feugiat metus.' .
                            ' Nam sollicitudin risus sapien, id bibendum urna laoreet nec.' .
                            ' Etiam efficitur libero eget nisl euismod, a rutrum leo sagittis. Mauris egestas diam purus.</p>' .
                            '<p>In tempus pulvinar mattis. Sed sed feugiat metus. Nam sollicitudin risus sapien, id bibendum urna laoreet nec.' .
                            ' Etiam efficitur libero eget nisl euismod. </p>', 'mooiwerk'
                        ),
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'page_type',
                            'operator' => '==',
                            'value' => 'front_page',
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
                'key' => 'group_5b990fcf252e8',
                'title' => __('Content Blocks', 'mooiwerk'),
                'fields' => [
                    [
                        'key' => 'field_5b990ff405436',
                        'label' => __('Blocks', 'mooiwerk'),
                        'name' => 'content_blocks',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'collapsed' => 'field_5b99107c05437',
                        'min' => 3,
                        'max' => 4,
                        'layout' => 'row',
                        'button_label' => __('Add Content', 'mooiwerk'),
                        'sub_fields' => [
                            [
                                'key' => 'field_5b99107c05437',
                                'label' => __('Title', 'mooiwerk'),
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
                                'key' => 'field_5b9910c205438',
                                'label' => __('Description', 'mooiwerk'),
                                'name' => 'description',
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
                                'key' => 'field_5b9910e905439',
                                'label' => __('Link', 'mooiwerk'),
                                'name' => 'link',
                                'type' => 'url',
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
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'page_type',
                            'operator' => '==',
                            'value' => 'front_page',
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
                'key' => 'group_5b9911463a200',
                'title' => __('Links', 'mooiwerk'),
                'fields' => [
                    [
                        'key' => 'field_5b99116f2e3f1',
                        'label' => __('Links', 'mooiwerk'),
                        'name' => 'links',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'collapsed' => 'field_5b9911812e3f2',
                        'min' => 6,
                        'max' => 9,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => [
                            [
                                'key' => 'field_5b9911812e3f2',
                                'label' => __('Location', 'mooiwerk'),
                                'name' => 'location',
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
                                'key' => 'field_5b9911a32e3f3',
                                'label' => __('Url', 'mooiwerk'),
                                'name' => 'url',
                                'type' => 'url',
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
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'page_type',
                            'operator' => '==',
                            'value' => 'front_page',
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
add_action('acf/init', 'register_custom_fields_frontpage');
