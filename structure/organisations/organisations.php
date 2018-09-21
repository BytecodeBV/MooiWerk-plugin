<?php
/**
 * This file contains all functionality regarding organisations as a customization to WordPress users.
 */

/**
 * Add Custom Fields on plugin init.
 */
function register_custom_fields_organisation() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            array (
                'key' => 'group_5b7ee8a1ae2ac',
                'title' => __('Organisations', 'mooiwerk'),
                'fields' => array (
                    array (
                        'key' => 'field_5b7ee8f6950e7',
                        'label' => __('Upload profielfoto contactpersoon of logo organisatie', 'mooiwerk'),
                        'name' => 'logo',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
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
                    ),
                    array (
                        'key' => 'field_5b7eea1a950e9',
                        'label' => __('Naam organisatie', 'mooiwerk'),
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eea36950ea',
                        'label' => __('Adres', 'mooiwerk'),
                        'name' => 'address',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'center_lat' => '',
                        'center_lng' => '',
                        'zoom' => '',
                        'height' => '',
                    ),
                    array (
                        'key' => 'field_5b7eea5e950eb',
                        'label' => __('Postcode', 'mooiwerk'),
                        'name' => 'postcode',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eea9a950ec',
                        'label' => __('Plaats', 'mooiwerk'),
                        'name' => 'place',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eeac7950ed',
                        'label' => __('Website', 'mooiwerk'),
                        'name' => 'website',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                'location' => array (
                    array (
                        array (
                            'param' => 'user_role',
                            'operator' => '==',
                            'value' => 'organisation',
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

        acf_add_local_field_group(
            array (
                'key' => 'group_5b7eebc3623f1',
                'title' => __('Contact Person', 'mooiwerk'),
                'fields' => array (
                    array (
                        'key' => 'field_5b7eebd77da33',
                        'label' => __('Voornaam', 'mooiwerk'),
                        'name' => 'first-name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eec2a7da35',
                        'label' => __('Achternaam', 'mooiwerk'),
                        'name' => 'last-name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eebf97da34',
                        'label' => __('Tussenvoegsel', 'mooiwerk'),
                        'name' => 'position',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eec577da37',
                        'label' => __('Telefoonnummer', 'mooiwerk'),
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
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
                    array (
                        'key' => 'field_5b7eec737da38',
                        'label' => __('Vertel iets over de organisatie', 'mooiwerk'),
                        'name' => 'bio',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    array (
                        'key' => 'field_5b7eecca7da39',
                        'label' => __('Het organisatieprofiel tonen in de zoekresultaten', 'mooiwerk'),
                        'name' => 'show_in_search',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'Ja' => __('Ja', 'mooiwerk'),
                            'Nee' => __('Nee', 'mooiwerk'),
                        ),
                        'allow_null' => 1,
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'vertical',
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7eed557da3a',
                        'label' => __('In welke sector is jouw organisatie actief (maximaal 3 antwoorden mogelijk)', 'mooiwerk'),
                        'name' => 'category',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'Goede doelen en belangenbehartigers' => __('Goede doelen en belangenbehartigers', 'mooiwerk'),
                            'Kunst en Cultuur' => __('Kunst en Cultuur', 'mooiwerk'),
                            'Natuur en Milieu' => __('Natuur en Milieu', 'mooiwerk'),
                            'Onderwijs, Educatie en Openbaar bestuur (incl. taal)' => __('Onderwijs, Educatie en Openbaar bestuur (incl. taal)', 'mooiwerk'),
                            'Sport, bewegen en recreatie' => __('Sport, bewegen en recreatie', 'mooiwerk'),
                            'Zorg en Welzijn (incl. religie)' => __('Zorg en Welzijn (incl. religie)', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'user_role',
                            'operator' => '==',
                            'value' => 'organisation',
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

        if (!is_field_group_exists('Social Media') ) {
            acf_add_local_field_group(
                array (
                    'key' => 'group_5b7eeb2cb8b3e',
                    'title' => __('Social Media', 'mooiwerk'),
                    'fields' => array (
                        array (
                            'key' => 'field_5b7eeb458880a',
                            'label' => __('Facebook', 'mooiwerk'),
                            'name' => 'facebook',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                        array (
                            'key' => 'field_5b7eeb578880b',
                            'label' => __('Twitter', 'mooiwerk'),
                            'name' => 'twitter',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                        array (
                            'key' => 'field_5b7eeb668880c',
                            'label' => __('Linkedin', 'mooiwerk'),
                            'name' => 'linkedin',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                        array (
                            'key' => 'field_5b7eeb838880d',
                            'label' => __('Instagram', 'mooiwerk'),
                            'name' => 'instagram',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                    ),
                    'location' => array (
                        array (
                            array (
                                'param' => 'user_role',
                                'operator' => '==',
                                'value' => 'organisation',
                            ),
                        ),
                        array (
                            array (
                                'param' => 'user_role',
                                'operator' => '==',
                                'value' => 'volunteer',
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
}
add_action('acf/init', 'register_custom_fields_organisation');

/**
 * Set template for archive page.
 */    
function archive_organisation_template( $page_template )
{
    if (is_page(__('Organisaties', 'mooiwerk'))) {
        $page_template = plugin_dir_path( __FILE__ ) . '/archive-organisations.blade.php';
    }
    return $page_template;
}
add_filter('page_template', 'archive_organisation_template');

 