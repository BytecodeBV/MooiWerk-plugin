<?php
/**
 * This file contains all functionality regarding vacancies as a custom post type in WordPress.
 */

/**
 * Create the 'Vacancies' post type
 */
function create_post_type_vacancy()
{
    register_post_type(
        'vacancies',
        [
            'labels' => [
                'name' => __('Vacancies', 'mooiwerk'),
                'singular_name' => __('Vacancy', 'mooiwerk'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'vacatures'),
            'supports' => array(
                'title',
                'thumbnail',
                'comments',
                'editor'
            )
        ]
    );
}
add_action('init', 'create_post_type_vacancy');

/**
 * Add Custom Fields on plugin init.
 */
function register_custom_fields_vacancy()
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(
            array (
                'key' => 'group_5b7ef86f09d5c',
                'title' => __('Vacancy', 'mooiwerk'),
                'fields' => array (
                    array (
                        'key' => 'field_5b7ef8e109d65',
                        'label' => __('Waar vindt het vrijwilligerswerk plaats (maximaal 3 antwoorden mogelijk)', 'mooiwerk'),
                        'name' => 'region',
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
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7ef92009d66',
                        'label' => __('Hoe vaak is inzet van de vrijwilliger nodig voor dit vrijwilligerswerk (maximaal 1 antwoord mogelijk)', 'mooiwerk'),
                        'name' => 'frequency',
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
                            'Regelmatig' => __('Regelmatig', 'mooiwerk'),
                            'Eenmalig' => __('Eenmalig', 'mooiwerk'),
                            'Tijdelijk' => __('Tijdelijk', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7ef96709d67',
                        'label' => __('Hoeveel uren per dag ben je met dit werk bezig?', 'mooiwerk'),
                        'name' => 'period',
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
                            '1 tot 4 uur' => __('1 tot 4 uur', 'mooiwerk'),
                            '4 tot 8 uur' => __('4 tot 8 uur', 'mooiwerk'),
                            //'9 t/m 16 uur' => __('9 t/m 16 uur', 'mooiwerk'),
                            //'17 uur of meer' => __('17 uur of meer', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7ef9ba09d68',
                        'label' => __('Wat voor type mooi werk bied je aan (maximaal 3 antwoorden mogelijk)', 'mooiwerk'),
                        'name' => 'categories',
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
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7ef9f609d69',
                        'label' => __('Over welke competenties beschikt de vrijwilliger bij voorkeur', 'mooiwerk'),
                        'name' => 'competency',
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
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7efa5509d6a',
                        'label' => __('In dit vrijwilligerswerk werk je met name met (maximaal 3 antwoorden mogelijk)', 'mooiwerk'),
                        'name' => 'target',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'Chronisch zieken' => __('Chronisch zieken', 'mooiwerk'),
                            'Dak- en thuislozen' => __('Dak- en thuislozen', 'mooiwerk'),
                            'Jeugd/jongeren' => __('Jeugd/jongeren', 'mooiwerk'),
                            'Kinderen' => __('Kinderen', 'mooiwerk'),
                            'Mensen met een lichamelijke beperking' => __('Mensen met een lichamelijke beperking', 'mooiwerk'),
                            'Mensen met een psychische/psychiatrische beperking' => __('Mensen met een psychische/psychiatrische beperking', 'mooiwerk'),
                            'Mensen met verstandelijke beperking' => __('Mensen met verstandelijke beperking', 'mooiwerk'),
                            'Mensen met een zintuiglijke beperking' => __('Mensen met een zintuiglijke beperking', 'mooiwerk'),
                            'Ouderen' => __('Ouderen', 'mooiwerk'),
                            'Vluchtelingen en statushouders' => __('Vluchtelingen en statushouders', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7efab409d6b',
                        'label' => __('Deze vacature is ook geschikt voor (meerdere antwoorden mogelijk)', 'mooiwerk'),
                        'name' => 'requirements',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'Jongeren onder de 18' => __('Jongeren onder de 18', 'mooiwerk'),
                            'Groepen / vrienden / teamuitje' => __('Groepen / vrienden / teamuitje', 'mooiwerk'),
                            'Mensen met een rolstoel' => __('Mensen met een rolstoel', 'mooiwerk'),
                            'Mensen met een verstandelijke beperking' => __('Mensen met een verstandelijke beperking', 'mooiwerk'),
                            'Mensen met een beperkte kennis van de Nederlandse taal' => __('Mensen met een beperkte kennis van de Nederlandse taal', 'mooiwerk'),
                            'Mensen zonder kennis van de Nederlandse taal' => __('Mensen zonder kennis van de Nederlandse taal', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7efb4209d6c',
                        'label' => __('Bied je een vergoeding (maximaal 2 antwoorden mogelijk)', 'mooiwerk'),
                        'name' => 'compensation',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'Vrijwilligersvergoeding' => __('Vrijwilligersvergoeding', 'mooiwerk'),
                            'Onkostenvergoeding' => __('Onkostenvergoeding', 'mooiwerk'),
                            'Geen vergoeding' => __('Geen vergoeding', 'mooiwerk'),
                        ),
                        'allow_custom' => 0,
                        'save_custom' => 0,
                        'default_value' => array (
                        ),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                    ),
                    array (
                        'key' => 'field_5b7efba009d6d',
                        'label' => __('Uiterste reactiedatum', 'mooiwerk'),
                        'name' => 'date',
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
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'vacancies',
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
add_action('acf/init', 'register_custom_fields_vacancy');

/**
 * Set template for archive page.
 */
function archive_vacancy_template($page_template)
{
    if (is_post_type_archive('vacancies')) {
        $page_template = plugin_dir_path(__FILE__) . '/archive-vacancies.blade.php';
    }
    return $page_template;
}
add_filter('archive_template', 'archive_vacancy_template');

/**
 * Set template for single page.
 */
function single_vacancy_template($page_template)
{
    if (is_singular('vacancies')) {
        $page_template = plugin_dir_path(__FILE__) . '/single.blade.php';
    }
    return $page_template;
}
add_filter('single_template', 'single_vacancy_template');
