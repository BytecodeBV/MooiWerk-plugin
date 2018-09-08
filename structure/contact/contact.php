<?php
/**
 * This file contains all functionality regarding contant page.
 */

/**
 * Add Custom Contact Fields on plugin init.
 */
function register_custom_fields_contact()
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            array(
                'key' => 'group_5b6b10ffe2ca3',
                'title' => __('Contact', 'mooiwerk'),
                'fields' => array(
                    array(
                        'key' => 'field_5b6b111410336',
                        'label' => __('Phone', 'mooiwerk'),
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5b6b112610337',
                        'label' => __('Address', 'mooiwerk'),
                        'name' => 'address',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5b6b113d10338',
                        'label' => __('Email', 'mooiwerk'),
                        'name' => 'email',
                        'type' => 'email',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_5b6b114c10339',
                        'label' => __('Form', 'mooiwerk'),
                        'name' => 'form',
                        'type' => 'text',
                        'instructions' => __('Paste Contact form shortcode here', 'mooiwerk'),
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page',
                        ),
                        array(
                            'param' => 'page',
                            'operator' => '==',
                            'value' => '122',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            )
        );
    }
}
add_action('acf/init', 'register_custom_fields_contact');
