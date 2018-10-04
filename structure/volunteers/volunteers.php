<?php
/**
 * This file contains all functionality regarding volunteers as a customization to WordPress users.
 */

/**
 * Make volunteer the default user-role
 */
add_filter('pre_option_default_role', function ($default_role) {
    return 'volunteer'; // This is changed
});

/**
 * Add Custom Fields on plugin init.
 */
function register_custom_fields_volunteer() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            array(
                'key' => 'group_5b7ef0eae6000',
                'title' => 'Volunteers',
                'fields' => array(
                    array(
                        'key' => 'field_5b7ef0fd9487f',
                        'label' => __('Upload profielfoto', 'mooiwerk'),
                        'name' => 'profile_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
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
                    array(
                        'key' => 'field_5b7ef13794880',
                        'label' => __('Voornaam', 'mooiwerk'),
                        'name' => 'first-name',
                        'type' => 'text',
                        'instructions' => '',
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
                    array(
                        'key' => 'field_5b7ef15394881',
                        'label' => __('Tussenvoegsel', 'mooiwerk'),
                        'name' => 'initials',
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
                        'key' => 'field_5b7ef16094882',
                        'label' => __('Achternaam', 'mooiwerk'),
                        'name' => 'last-name',
                        'type' => 'text',
                        'instructions' => '',
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
                    array (
                        'key' => 'field_5bb4920ddb987',
                        'label' => __('Email', 'mooiwerk'),
                        'name' => 'email',
                        'type' => 'email',
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
                    ),
                    array(
                        'key' => 'field_5b7ef19394884',
                        'label' => __('Telefoonnummer', 'mooiwerk'),
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
                        'key' => 'field_5b7ef1bf94885',
                        'label' => __('Je profiel tonen in de zoekresultaten', 'mooiwerk'),
                        'name' => 'searchable',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
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
                        'key' => 'field_5b7ef21994886',
                        'label' => __('Wat is je geboortedatum', 'mooiwerk'),
                        'name' => 'age',
                        'type' => 'date_picker',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'display_format' => 'd/m/Y',
                        'return_format' => 'd/m/Y',
                        'first_day' => 1,
                    ),
                    array(
                        'key' => 'field_5b7ef24e94887',
                        'label' => __('Wat is je opleiding of werk- en denkniveau', 'mooiwerk'),
                        'name' => 'qualification',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Basisschool' => __('Basisschool', 'mooiwerk'),
                            'VMBO/MAVO/LBO' => __('VMBO/MAVO/LBO', 'mooiwerk'),
                            'HAVO/VWO' => __('HAVO/VWO', 'mooiwerk'),
                            'MBO' => __('MBO', 'mooiwerk'),
                            'HBO/Universiteit' => __('HBO/Universiteit', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef28594888',
                        'label' => __('Waar wil je vrijwilligerswerk doen', 'mooiwerk'),
                        'name' => 'region',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Geen voorkeur' => __('Geen voorkeur', 'mooiwerk'),
                            'Breda Centrum' => __('Breda Centrum', 'mooiwerk'),
                            'Breda Noordwest' => __('Breda Noordwest', 'mooiwerk'),
                            'Breda Noordoost' => __('Breda Noordoost', 'mooiwerk'),
                            'Breda Zuidwest' => __('Breda Zuidwest', 'mooiwerk'),
                            'Breda Zuidoost' => __('Breda Zuidoost', 'mooiwerk'),
                            'Bavel' => __('Bavel', 'mooiwerk'),
                            'Effen-Rith' => __('Effen-Rith', 'mooiwerk'),
                            'Prinsenbeek' => __('Prinsenbeek', 'mooiwerk'),
                            'Teteringen' => __('Teteringen', 'mooiwerk'),
                            'Ulvenhout' => __('Ulvenhout', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef2f894889',
                        'label' => __('Hoe vaak wil je	vrijwilligerswerk doen', 'mooiwerk'),
                        'name' => 'frequency',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Regelmatig' => __('Regelmatig', 'mooiwerk'),
                            'Eenmalig' => __('Eenmalig', 'mooiwerk'),
                            'Tijdelijk' => __('Tijdelijk', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef3339488a',
                        'label' => __('Hoeveel uren per week of per keer ben je maximaal beschikbaar voor vrijwilligerswerk', 'mooiwerk'),
                        'name' => 'availability',
                        'type' => 'radio',
                        'instructions' => __('maximaal 1 antwoord mogelijk', 'mooiwerk'),
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            '1 t/m 4 uur' => __('1 t/m 4 uur', 'mooiwerk'), 
                            '5 t/m 8 uur' => __('5 t/m 8 uur', 'mooiwerk'), 
                            '9 t/m 16 uur' => __('9 t/m 16 uur', 'mooiwerk'), 
                            '17 uur of meer' => __('17 uur of meer', 'mooiwerk')
                        ),
                        'allow_null' => 1,
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'vertical',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef39d9488b',
                        'label' => __('Wat voor soort vrijwilligerswerk wil je doen', 'mooiwerk'),
                        'name' => 'interest',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Activiteitenbegeleiding en recreatie' => __('Activiteitenbegeleiding en recreatie', 'mooiwerk'),
                            'Administratie, winkel en gastvrouw/heer' => __('Administratie, winkel en gastvrouw/heer', 'mooiwerk'),
                            'Begeleiding, coaching en maatjes' => __('Begeleiding, coaching en maatjes', 'mooiwerk'),
                            'Bestuur en organisatie' => __('Bestuur en organisatie', 'mooiwerk'),
                            'Computer en ICT' => __('Computer en ICT', 'mooiwerk'),
                            'Evenementen en festivals' => __('Evenementen en festivals', 'mooiwerk'),
                            'Financiën en boekhouding' => __('Financiën en boekhouding', 'mooiwerk'),
                            'Fondsenwerving' => __('Fondsenwerving', 'mooiwerk'),
                            'Horeca en catering' => __('Horeca en catering', 'mooiwerk'),
                            'Kunst, cultuur en creatief' => __('Kunst, cultuur en creatief', 'mooiwerk'),
                            'Natuur, milieu en dieren' => __('Natuur, milieu en dieren', 'mooiwerk'),
                            'PR, communicatie en media' => __('PR, communicatie en media', 'mooiwerk'),
                            'Sport, bewegen en spel' => __('Sport, bewegen en spel', 'mooiwerk'),
                            'Taalondersteuning' => __('Taalondersteuning', 'mooiwerk'),
                            'Techniek, klussen en onderhoud' => __('Techniek, klussen en onderhoud', 'mooiwerk'),
                            'Vervoer en logistiek' => __('Vervoer en logistiek', 'mooiwerk'),
                            'Voorlichting, lesgeven en huiswerkbegeleiding' => __('Voorlichting, lesgeven en huiswerkbegeleiding', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef3fc9488c',
                        'label' => __('Waar ben je goed in', 'mooiwerk'),
                        'name' => 'competency',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Adviseren' => __('Adviseren', 'mooiwerk'),
                            'Begeleiden' => __('Begeleiden', 'mooiwerk'),
                            'Besturen' => __('Besturen', 'mooiwerk'),
                            'Communiceren' => __('Communiceren', 'mooiwerk'),
                            'Coördineren' => __('Coördineren', 'mooiwerk'),
                            'Denken' => __('Denken', 'mooiwerk'),
                            'Doen' => __('Doen', 'mooiwerk'),
                            'Geordend werken' => __('Geordend werken', 'mooiwerk'),
                            'Handig zijn' => __('Handig zijn', 'mooiwerk'),
                            'Initiatief nemen' => __('Initiatief nemen', 'mooiwerk'),
                            'Ondernemen' => __('Ondernemen', 'mooiwerk'),
                            'Organiseren' => __('Organiseren', 'mooiwerk'),
                            'Presenteren' => __('Presenteren', 'mooiwerk'),
                            'Rekenen' => __('Rekenen', 'mooiwerk'),
                            'Samenwerken' => __('Samenwerken', 'mooiwerk'),
                            'Schrijven' => __('Schrijven', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef4229488d',
                        'label' => __('Wil je met bepaalde doelgroepen werken', 'mooiwerk'),
                        'name' => 'preference',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Geen voorkeur' => __('Geen voorkeur', 'mooiwerk'),
                            'Chronisch zieken' => __('Chronisch zieken', 'mooiwerk'),
                            'Dak- en thuislozen' => __('Dak- en thuislozen', 'mooiwerk'),
                            'Jeugd/jongeren' => __('Jeugd/jongeren', 'mooiwerk'),
                            'Kinderen' => __('Kinderen', 'mooiwerk'),
                            'Mensen met een lichamelijke beperking' => __('Mensen met een lichamelijke beperking', 'mooiwerk'),
                            'Mensen met een psychische/psychiatrische beperking' => __('Mensen met een psychische/psychiatrische beperking', 'mooiwerk'),
                            'Mensen met verstandelijke beperking' => __('Mensen met verstandelijke beperking', 'mooiwerk'),
                            'Mensen met en zintuiglijke beperking' => __('Mensen met en zintuiglijke beperking', 'mooiwerk'),
                            'Ouderen' => __('Ouderen', 'mooiwerk'),
                            'Vluchtelingen en statushouders' => __('Vluchtelingen en statushouders', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5b7ef4639488e',
                        'label' => __('Vertel iets over jezelf', 'mooiwerk'),
                        'name' => 'bio',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
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
                ),
                'location' => array(
                    array(
                        array(
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
add_action('acf/init', 'register_custom_fields_volunteer');


/**
 * Set template for archive page.
 */    
function archive_volunteer_template($page_template )
{
    $user = wp_get_current_user();    

    if (is_page(__('Vrijwilligers', 'mooiwerk'))) {
        if (current_user_can('administrator') || in_array('organisation', (array) $user->roles)) {
            $page_template = plugin_dir_path(__FILE__).'/archive-volunteers.blade.php';
        } else {
            $page_template = locate_template('views/404.blade.php');
        }
    }
    return $page_template;
}
 add_filter('page_template', 'archive_volunteer_template');
