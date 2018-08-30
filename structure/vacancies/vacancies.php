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
                'name' => __('Vacancies'),
                'singular_name' => __('Vacancy'),
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
                'title' => 'Vacancy',
                'fields' => array (
                    array (
                        'key' => 'field_5b7ef8e109d65',
                        'label' => 'Waar vindt het vrijwilligerswerk plaats (maximaal 3 antwoorden mogelijk)',
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
                            'Breda Centrum' => 'Breda Centrum',
                            'Breda Noordwest' => 'Breda Noordwest',
                            'Breda Noordoost' => 'Breda Noordoost',
                            'Breda Zuidwest' => 'Breda Zuidwest',
                            'Breda Zuidoost' => 'Breda Zuidoost',
                            'Bavel' => 'Bavel',
                            'Effen-Rith' => 'Effen-Rith',
                            'Prinsenbeek' => 'Prinsenbeek',
                            'Teteringen' => 'Teteringen',
                            'Ulvenhout' => 'Ulvenhout',
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
                        'label' => 'Hoe vaak is inzet van de vrijwilliger nodig voor dit vrijwilligerswerk (maximaal 1 antwoord mogelijk)',
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
                            'Regelmatig (elke week, elke 2 weken, elke maand)' => 'Regelmatig (elke week, elke 2 weken, elke maand)',
                            'Eenmalig (een dag of dagdeel)' => 'Eenmalig (een dag of dagdeel)',
                            'Tijdelijk (maximaal 3 maanden, projectmatig)' => 'Tijdelijk (maximaal 3 maanden, projectmatig)',
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
                        'label' => 'Hoeveel uren per week of per keer is voor deze vacature nodig (maximaal 1 antwoord mogelijk)',
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
                            '1 t/m 4 uur' => '1 t/m 4 uur',
                            '5 t/m 8 uur' => '5 t/m 8 uur',
                            '9 t/m 16 uur' => '9 t/m 16 uur',
                            '17 uur of meer' => '17 uur of meer',
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
                        'label' => 'Wat voor type mooi werk bied je aan (maximaal 3 antwoorden mogelijk)',
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
                            'Activiteitenbegeleiding en recreatie' => 'Activiteitenbegeleiding en recreatie',
                            'Administratie, winkel en gastvrouw/heer' => 'Administratie, winkel en gastvrouw/heer',
                            'Begeleiding, coaching en maatjes' => 'Begeleiding, coaching en maatjes',
                            'Bestuur en organisatie' => 'Bestuur en organisatie',
                            'Computer en ICT' => 'Computer en ICT',
                            'Evenementen en festivals' => 'Evenementen en festivals',
                            'Financiën en boekhouding' => 'Financiën en boekhouding',
                            'Fondsenwerving' => 'Fondsenwerving',
                            'Horeca en catering' => 'Horeca en catering',
                            'Kunst, cultuur en creatief' => 'Kunst, cultuur en creatief',
                            'Natuur, milieu en dieren' => 'Natuur, milieu en dieren',
                            'PR, communicatie en media' => 'PR, communicatie en media',
                            'Sport, bewegen en spel' => 'Sport, bewegen en spel',
                            'Taalondersteuning' => 'Taalondersteuning',
                            'Techniek, klussen en onderhoud' => 'Techniek, klussen en onderhoud',
                            'Vervoer en logistiek' => 'Vervoer en logistiek',
                            'Voorlichting, lesgeven en huiswerkbegeleiding' => 'Voorlichting, lesgeven en huiswerkbegeleiding',
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
                        'label' => 'Over welke competenties beschikt de vrijwilliger bij voorkeur',
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
                            'Adviseren' => 'Adviseren',
                            'Begeleiden' => 'Begeleiden',
                            'Besturen' => 'Besturen',
                            'Communiceren' => 'Communiceren',
                            'Coördineren' => 'Coördineren',
                            'Denken' => 'Denken',
                            'Doen' => 'Doen',
                            'Geordend werken' => 'Geordend werken',
                            'Handig zijn' => 'Handig zijn',
                            'Initiatief nemen' => 'Initiatief nemen',
                            'Ondernemen' => 'Ondernemen',
                            'Organiseren' => 'Organiseren',
                            'Presenteren' => 'Presenteren',
                            'Rekenen' => 'Rekenen',
                            'Samenwerken' => 'Samenwerken',
                            'Schrijven' => 'Schrijven',
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
                        'label' => 'In dit vrijwilligerswerk werk je met name met (maximaal 3 antwoorden mogelijk)',
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
                            'Chronisch zieken' => 'Chronisch zieken',
                            'Dak- en thuislozen' => 'Dak- en thuislozen',
                            'Jeugd/jongeren' => 'Jeugd/jongeren',
                            'Kinderen' => 'Kinderen',
                            'Mensen met een lichamelijke beperking' => 'Mensen met een lichamelijke beperking',
                            'Mensen met een psychische/psychiatrische beperking' => 'Mensen met een psychische/psychiatrische beperking',
                            'Mensen met verstandelijke beperking' => 'Mensen met verstandelijke beperking',
                            'Mensen met een zintuiglijke beperking' => 'Mensen met een zintuiglijke beperking',
                            'Ouderen' => 'Ouderen',
                            'Vluchtelingen en statushouders' => 'Vluchtelingen en statushouders',
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
                        'label' => 'Deze vacature is ook geschikt voor (meerdere antwoorden mogelijk)',
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
                            'Jongeren onder de 18' => 'Jongeren onder de 18',
                            'Groepen / vrienden / teamuitje' => 'Groepen / vrienden / teamuitje',
                            'Mensen met een rolstoel' => 'Mensen met een rolstoel',
                            'Mensen met een verstandelijke beperking' => 'Mensen met een verstandelijke beperking',
                            'Mensen met een beperkte kennis van de Nederlandse taal' => 'Mensen met een beperkte kennis van de Nederlandse taal',
                            'Mensen zonder kennis van de Nederlandse taal' => 'Mensen zonder kennis van de Nederlandse taal',
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
                        'label' => 'Bied je een vergoeding (maximaal 2 antwoorden mogelijk)',
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
                            'Vrijwilligersvergoeding' => 'Vrijwilligersvergoeding',
                            'Onkostenvergoeding' => 'Onkostenvergoeding',
                            'Geen vergoeding' => 'Geen vergoeding',
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
                        'label' => 'Uiterste reactiedatum',
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
        
        acf_add_local_field_group(
            array (
                'key' => 'group_5b86d5b97f387',
                'title' => 'Vacancy Comment',
                'fields' => array (
                    array (
                        'key' => 'field_5b86d5cc8043b',
                        'label' => 'Ik ga akkoord met de Algemene Voorwaarden',
                        'name' => 'tos',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'comment',
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
