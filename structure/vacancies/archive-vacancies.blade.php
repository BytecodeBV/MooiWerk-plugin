@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    @php
        $vacancy_page = get_page_by_title(__('Vacatures', 'mooiwerk'));
        if (method_exists('App','getBlocks')) {
            $blocks = App::getBlocks($vacancy_page->ID);
        } else {
            $rows = get_field('content_blocks', $vacancy_page->ID);
            $blocks = [];
            if ($rows) {
                $blocks = array_map(function ($row) {
                    return [
                        'title' => $row['title'],
                        'content' => $row['description'],
                        'link' => $row['link'],
                    ];
                }, $rows);
            }
        }
        
    @endphp
    @if($blocks)
        @include('partials.content-blocks')
    @endif
    <section class="vacancy-list {{ empty($blocks)? '' : 'vacancy-list_drop-padding' }}">
        <div class="container">                           
            <ul class="nav nav-tabs tab-pager justify-content-end mb-5">
                @php
                    $pages = ['Vacatures', 'Organisaties', 'Vrijwilligers'];
                    $user = wp_get_current_user();
                    $roles = $user->roles;
                @endphp
                @foreach($pages as $page)
                    @if ( $page == 'Vrijwilligers' )
                        @php
                            if(in_array('administrator', $roles)) {
                            } elseif (in_array('organisation', $roles)) {
                            } else {
                                continue;
                            }
                        @endphp
                    @endif
                    @php 
                      $page_object = get_page_by_title( $page, NULL, 'page' );
                    @endphp
                    @if($page_object)
                        <li class="nav-item">
                            <a class="nav-link {{ ($page == 'Vacatures')? 'active':'' }}" href="{{ get_permalink(get_page_by_path($page_object->post_name )) }}">{{$page}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="row">
            @php
                global $wpdb;
                // Start session to save posts per page
                if (!session_id()) {
                    session_start();
                }
                if(isset($_GET['nr'])){
                    $_SESSION['nr'] = $_GET['nr'];
                }

                // Pagination
                if (get_query_var('paged')) {
                    $current_page = get_query_var('paged');
                } elseif (get_query_var('page')) {
                    $current_page = get_query_var('page');
                } else {
                    $current_page = 1;
                }
                $posts_per_page = 10;
                if(isset($_SESSION['nr'])){
                    $posts_per_page = $_SESSION['nr'];
                }

                // Filters
                $meta_query = array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'date',
                        'value'   => date('Y-m-d'),
                        'compare' => '>=',
                        'type' => 'DATE',
                    )
                ); // Array of arrays that individually store key/value pairs.
                $filter_keys = array(
                    'field_5b7ef8e109d65' => 'region',
                    'field_5b7ef92009d66' => 'frequency',
                    'field_5b7ef96709d67' => 'period',
                    'field_5b7ef9ba09d68' => 'categories',
                    'field_5b7ef9f609d69' => 'competency',
                    'field_5b7efa5509d6a' => 'target',
                    'field_5b7efab409d6b' => 'requirements',
                    'field_5b7efb4209d6c' => 'compensation'
                );
                $labels = array(
                    'field_5b7ef8e109d65' => __('Locatie', 'mooiwerk'),
                    'field_5b7ef92009d66' => __('Hoe vaak', 'mooiwerk'),
                    'field_5b7ef96709d67' => __('Uren per dag', 'mooiwerk'),
                    'field_5b7ef9ba09d68' => __('Categorie', 'mooiwerk'),
                    'field_5b7ef9f609d69' => __('Benodigde competenties', 'mooiwerk'),
                    'field_5b7efa5509d6a' => __('Doelgroep', 'mooiwerk'),
                    'field_5b7efab409d6b' => __('Ook geschikt voor', 'mooiwerk'),
                    'field_5b7efb4209d6c' => __('Vergoeding', 'mooiwerk')
                );
            @endphp
                <aside id="archive-filters" class="col-lg-4 vacancy-list__layered layered">
                    <a href="#filters" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">{{__('Filter', 'mooiwerk')}}</a>
                    <div id="filters" class="layered__form collapse dont-collapse-lg">
                        {{--// Loop over all filter keys and check if they are set in the _Get variable. --}}

                        @foreach($filter_keys as $acf_key => $key)
                            @php
                            // get the fields settings without attempting to load a value
                            $field = get_field_object($acf_key, false, false);

                            if(isset($_GET[$key])){
                                $field['value'] =  explode('_', $_GET[$key]);
                                add_to_meta_query_if_get_exists($key, $field['value'], $meta_query);
                            } else{
                                $field['value'] = array();
                            }
                            @endphp
                            <section class="mb-4 layered__group">
                            <div class="d-flex justify-content-between">                                
                                <a data-toggle="collapse" href="#{{  $key }}" role="button">
                                    <h2 class="layered__group-header">
                                        {{$labels[$acf_key]}}
                                    </h2>
                                </a>
                                <i class="fa fa-angle-right layered__group-header" aria-hidden="true"></i>
                            </div>
                            <div class="layered__field filter {{ empty($field['value'])? 'collapse' : '' }}" data-filter="{{  $key }}" id="{{  $key }}">
                                {!! render_field($field); !!}
                            </div>
                        </section>
                        @endforeach
                    </div>
                </aside>
                <main class="col-lg-8 vacancy-list__items">
                @php
                    // Arguments for out main query
                    $args = array(
                        // Add filter and pagination arguments here later, and get them from ?= variables with default values.
                        'post_type' => 'vacancies',
                        'posts_per_page' => $posts_per_page,
                        'paged' => $current_page,
                        'meta_query' => $meta_query,
                    );


                    // Add search term to wp-query if it is set in the url.
                    if(isset($_GET['search'])){
                        $search_term = $wpdb->esc_like($_GET['search']);
                        $args['s'] = $search_term;
                    }

                    // The Query
                    $query = new WP_Query($args);
                    $posts = $query->posts;

                    // Totals for pagination
                    $total_posts = $query->found_posts; // How many posts we have in total (beyond the current page)
                    $num_pages = ceil($total_posts / $posts_per_page); // How many pages of posts we will need
                @endphp
                {{--// Post Loop--}}
                @if (!empty($posts))
                    @foreach($posts as $p)
                        @php
                        $time = human_time_diff(get_post_time('U', true, $p), current_time('timestamp')) . __(' geleden', 'mooiwerk');
                        $vacancy = [
                            'title' => $p->post_title,
                            'link' => get_permalink($p->ID),
                            'image_link' => get_field('logo', 'user_'.$p->post_author),
                            'excerpt' => wp_kses_post(wp_trim_words($p->post_content, 25, '...')),
                            'footer' => $time . __(' - Breda, Nederland', 'mooiwerk'),
                        ];
                        $categories = get_field('categories', $p->ID);
                        if (is_array($categories)){
                            $vacancy['subtitle'] = implode(", ", $categories);
                        } else {
                            $vacancy['subtitle'] = $categories;
                        }
                        @endphp
                        <div class="card shadow border-light vacancy-list__item  vacancy-card">
                            <div class="row vacancy-card__header-wrapper">
                                <div class="col-xxl-2 col-md-3 col-xs-12 vacancy-card__figure d-flex align-items-center">
                                    <a href="{{ $vacancy['link'] }}"><img src="{{ $vacancy['image_link']? $vacancy['image_link'] : '//placehold.it/114x76' }}" class="vacancy-card__image"></a>
                                </div>
                                <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                    <h2 class="card-title vacancy-card__header"><a href="{{ $vacancy['link'] }}">{{ $vacancy['title'] }}</a></h2>
                                    <h3 class="card-subtitle vacancy-card__subheader">{{ $vacancy['subtitle'] }}</h3>
                                </div>
                            </div>
                            <div class="card-body vacancy-card__body">
                                <div class="vacancy-card__text">{!! $vacancy['excerpt'] !!}<a href="{{ $vacancy['link'] }}" class="card-link vacancy-card__link vacancy-card__link-spacer">{{__('lees meer ›', 'mooiwerk')}}</a></div>       
                            </div>
                            <div class="card-footer vacancy-card__footer">{{ $vacancy['footer'] }}</div>
                        </div>
                    @endforeach
                    {!! numeric_pagination($current_page, $num_pages) !!}
                @else 
                    <div class="alert alert-dark">{{__('Geen vacature gevonden die aan uw zoekopdracht voldeed.', 'mooiwerk')}}</div>
                @endif                
                </main>
            </div>
        </div>
    </section>
    {!! filter_script('vacatures') !!}
@endsection
