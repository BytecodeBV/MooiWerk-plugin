<?php
/**
 * Add Custom Fields to the events plugin on init.
 */
function create_header_post_type()
{
    $labels = array(
        'name' => __('Headers', 'mooiwerk'),
        'singular_name' => __('Header', 'mooiwerk'),
        'add_new' => __('New Header', 'mooiwerk'),
        'add_new_item' => __('Add New Header', 'mooiwerk'),
        'edit_item' => __('Edit Header', 'mooiwerk'),
        'new_item' => __('New Header', 'mooiwerk'),
        'view_item' => __('View Header', 'mooiwerk'),
        'search_items' => __('Search Headers', 'mooiwerk'),
        'not_found' =>  __('No Headers Found', 'mooiwerk'),
        'not_found_in_trash' => __('No Headers found in Trash', 'mooiwerk'),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
            //'editor',
            //'excerpt',
            //'custom-fields',
            //'thumbnail',
            //'page-attributes'
        ),
    );
    register_post_type('header', $args);
}
add_action('init', 'create_header_post_type');

/**
 * Add Custom Fields to the events plugin on init.
 */
function register_custom_fields_header()
{
    if (function_exists('acf_add_local_field_group')) {

        acf_add_local_field_group(
            array (
                'key' => 'group_5b8e7145d0f1a',
                'title' => __('Paginakoptekstvelden', 'mooiwerk'),
                'fields' => array (
                    array (
                        'key' => 'field_5b8e7193708a5',
                        'label' => __('Titel', 'mooiwerk'),
                        'name' => 'title',
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
                        'key' => 'field_5b8e71d4708a6',
                        'label' => __('Subtitel', 'mooiwerk'),
                        'name' => 'subtitle',
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
                        'key' => 'field_5b8e71f1708a7',
                        'label' => __('Achtergrond Afbeelding', 'mooiwerk'),
                        'name' => 'background',
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
                        'key' => 'field_5b8e72d6708a8',
                        'label' => __('Toon zoekformulier', 'mooiwerk'),
                        'name' => 'show_form',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
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
                    array (
                        'key' => 'field_5b8e7313708a9',
                        'label' => __('Zoek label', 'mooiwerk'),
                        'name' => 'search_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5b8e72d6708a8',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Zoek',
                        'placeholder' => 'Zoek',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_5b8e73bc708aa',
                        'label' => __('Zoek placeholder', 'mooiwerk'),
                        'name' => 'search_placeholder',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5b8e72d6708a8',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
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
                        'key' => 'field_5b8e742a708ab',
                        'label' => __('Wat te zoeken', 'mooiwerk'),
                        'name' => 'search_type',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5b8e72d6708a8',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            '*' => 'Alle',
                            'vacancies' => __('Vacatures', 'mooiwerk'),
                            'class' => __('Vrijwilligersacademie', 'mooiwerk'),
                            'volunteers' => __('Vrijwilligers', 'mooiwerk'),
                            'organisations' => __('Organisaties', 'mooiwerk'),
                        ),
                        'default_value' => array (
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'return_format' => 'value',
                        'placeholder' => '',
                    ),
                    array (
                        'key' => 'field_5b8e755e708ac',
                        'label' => __('Verzend label', 'mooiwerk'),
                        'name' => 'submit_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5b8e72d6708a8',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Zoek',
                        'placeholder' => 'Zoek',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'header',
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
                'key' => 'group_5b8e835e1b571',
                'title' => __('Pagina hoofd', 'mooiwerk'),
                'fields' => array (
                    array (
                        'key' => 'field_5b8e837eafa79',
                        'label' => __('Kies Header', 'mooiwerk'),
                        'name' => 'page_header',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array (
                            0 => 'header',
                        ),
                        'taxonomy' => array (
                        ),
                        'allow_null' => 1,
                        'multiple' => 0,
                        'return_format' => 'id',
                        'ui' => 1,
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'post',
                        ),
                    ),
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page',
                        ),
                    ),
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'vacancies',
                        ),
                    ),
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'class',
                        ),
                    ),
                    array (
                        array (
                            'param' => 'user_form',
                            'operator' => '==',
                            'value' => 'edit',
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
add_action('acf/init', 'register_custom_fields_header');

// function to show out header by ID
function get_header_by_ID($ID)
{
 
    // start by setting up the query
    $banner = get_post($ID);
 
    // now check if the query has posts and if so, output their content in a banner-box div
    if (!empty($banner) && get_post_type($ID) == 'header') {
        ob_start(); ?>
        <section class="hero" style="background-image:url(<?php echo get_field('background', $ID) ?>); 
            background-size:cover; background-position: center;">
            <?php if (!empty(get_field('title', $ID))) { ?>
                <div class="container">
                    <h1 class="hero__header"><?php echo get_field('title', $ID) ?></h1>
                    <?php if (!empty(get_field('subtitle', $ID))) { ?>
                        <h3 class="hero__sub-header"><?php echo get_field('subtitle', $ID) ?></h3>
                    <?php } ?>
                    <?php if (get_field('show_form', $ID)) { ?>
                        <div class="d-flex hero__form">
                            <?php
                                
                                $search_type = get_field('search_type', $ID);
                                if (!empty($search_type) && $search_type == 'volunteers') {
                                    $name = 'search';
                                    $page = get_page_by_title('Vrijwilligers');
                                    $url = home_url('/').$page->post_name;
                                    $type = false;
                                } elseif (!empty($search_type) && $search_type == 'organisations') {
                                    $name = 'search';
                                    $page = get_page_by_title('Organisaties');
                                    $url = home_url('/').$page->post_name;
                                    $type = false;
                                } else {
                                    $name = 's';
                                    $url = home_url('/');
                                    $type = true;
                                }
                            ?>
                            <form role="search" method="get" id="search-form" action="<?php echo $url; ?>" class="form-inline">
                                <label class="sr-only" for="s"><?php echo get_field('search_label', $ID) ?></label>
                                <input name="<?php echo $name; ?>" placeholder="<?php echo get_field('search_placeholder', $ID) ?>" class="hero__search" />
                                <?php if (get_field('search_type', $ID) && $type) { ?>
                                    <input type="hidden" name="type" value="<?php echo get_field('search_type', $ID) ?>"/>
                                <?php } ?>
                                <button type="submit" class="btn hero__btn"><?php echo get_field('submit_label', $ID) ?></button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </section>
        <?php $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    return false;
}
