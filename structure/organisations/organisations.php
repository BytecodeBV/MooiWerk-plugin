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
                'title' => 'Organisations',
                'fields' => array (
                    array (
                        'key' => 'field_5b7ee8f6950e7',
                        'label' => 'Upload profielfoto contactpersoon of logo organisatie',
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
                        'key' => 'field_5b7ee9fb950e8',
                        'label' => 'Upload omslagfoto',
                        'name' => 'profile_pic',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
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
                        'label' => 'Naam organisatie',
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
                        'label' => 'Adres',
                        'name' => 'address',
                        'type' => 'google_map',
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
                        'label' => 'Postcode',
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
                        'label' => 'Plaats',
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
                        'label' => 'Website',
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
                'title' => 'Contact Person',
                'fields' => array (
                    array (
                        'key' => 'field_5b7eebd77da33',
                        'label' => 'Voornaam',
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
                        'label' => 'Achternaam',
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
                        'label' => 'Tussenvoegsel',
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
                        'key' => 'field_5b7eec3a7da36',
                        'label' => 'E-mailadres',
                        'name' => 'email',
                        'type' => 'email',
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
                    ),
                    array (
                        'key' => 'field_5b7eec577da37',
                        'label' => 'Telefoonnummer',
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
                        'label' => 'Vertel iets over de organisatie',
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
                        'label' => 'Het organisatieprofiel tonen in de zoekresultaten',
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
                            'Yes' => 'Yes',
                            'Nee' => 'Nee',
                        ),
                        'allow_null' => 0,
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'vertical',
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7eed557da3a',
                        'label' => 'In welke sector is jouw organisatie actief (maximaal 3 antwoorden mogelijk)',
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
                            'Goede doelen en belangenbehartigers' => 'Goede doelen en belangenbehartigers',
                            'Kunst en Cultuur' => 'Kunst en Cultuur',
                            'Natuur en Milieu' => 'Natuur en Milieu',
                            'Onderwijs, Educatie en Openbaar bestuur (incl. taal)' => 'Onderwijs, Educatie en Openbaar bestuur (incl. taal)',
                            'Sport, bewegen en recreatie' => 'Sport, bewegen en recreatie',
                            'Zorg en Welzijn (incl. religie)' => 'Zorg en Welzijn (incl. religie)',
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
                    'title' => 'Social Media',
                    'fields' => array (
                        array (
                            'key' => 'field_5b7eeb458880a',
                            'label' => 'Facebook',
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
                            'label' => 'Twitter',
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
                            'label' => 'Linkedin',
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
                            'label' => 'Instagram',
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
 function archive_organisation_template( $page_template ) {
     if ( is_page( 'Organisaties' ) ) {
         $page_template = plugin_dir_path( __FILE__ ) . '/archive-organisations.blade.php';
     }
     return $page_template;
 }
 add_filter( 'page_template', 'archive_organisation_template' );
 