@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    <section class="vacancy-list">
        <div class="container">
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
                $meta_query = array('relation' => 'OR'); // Array of arrays that individually store key/value pairs.
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
                    'field_5b7ef8e109d65' => 'Locatie',
                    'field_5b7ef92009d66' => 'Hoe vaak',
                    'field_5b7ef96709d67' => 'Uren per week',
                    'field_5b7ef9ba09d68' => 'Categorie',
                    'field_5b7ef9f609d69' => 'Benodigde competenties',
                    'field_5b7efa5509d6a' => 'Doelgroep',
                    'field_5b7efab409d6b' => 'Ook geschikt voor',
                    'field_5b7efb4209d6c' => 'Vergoeding'
                );
            @endphp
                <aside id="archive-filters" class="col-lg-4 vacancy-list__layered layered">
                    <a href="#filters" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">Filter</a>
                    <div id="filters" class="layered__form collapse dont-collapse-lg">
                        {{--// Loop over all filter keys and check if they are set in the _Get variable. --}}

                        @foreach($filter_keys as $acf_key => $key)
                            @php
                            // get the field's settings without attempting to load a value
                            $field = get_field_object($acf_key, false, false);

                            if(isset($_GET[$key])){
                                $field['value'] = explode(',', $_GET[$key]);
                                add_to_meta_query_if_get_exists($key,$_GET[$key],$meta_query);
                            } else{
                                $field['value'] = array();
                            }
                            @endphp
                            <section class="mb-4 layered__group">
                            <h2 class="layered__group-header">{{$labels[$acf_key]}}</h2>
                            <div class="b-4 layered__field filter" data-filter="{{  $key }}">
                                {!! render_field($field); !!}
                            </div>
                        </section>
                        @endforeach
                    </div>
                </aside>
                <main class="col-lg-8 vacancy-list__items">
                @php
                    /**
                     * Add key, value pair to the post meta filters if it is set.
                     */
                    function add_to_meta_query_if_get_exists($filter_key, $filter_value, &$query){
                        if(isset($_GET[$filter_key])){
                            $values_to_search = explode(',', $_GET[$filter_key]);
                            foreach ($values_to_search as $value) {
                                $meta_addition = array(
                                    'key' => rawurldecode($filter_key),
                                    'value' => rawurldecode($value),
                                    'compare' => 'LIKE'
                                );
                                array_push($query,$meta_addition);
                            }
                        }
                    }
                    // Arguments for out main query
                    $args = array(
                        // Add filter and pagination arguments here later, and get them from ?= variables with default values.
                        'post_type' => 'vacancies',
                        'posts_per_page' => $posts_per_page,
                        'paged' => $current_page,
                        'meta_query' => $meta_query
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
                        $time = human_time_diff(get_post_time('U', true, $p), current_time('timestamp')) . ' geleden';
                        $vacancy = [
                            'title' => $p->post_title,
                            'link' => get_permalink($p->ID),
                            'image_link' => get_field('logo', 'user_'.$p->post_author),
                            'excerpt' => wp_kses_post(wp_trim_words($p->post_content, 25, '...')),
                            'footer' => $time . ' - Breda, Nederland',
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
                                <img src="{{ $vacancy['image_link']? $vacancy['image_link'] : '//placehold.it/114x76' }}" class="vacancy-card__image">
                                </div>
                                <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                    <h2 class="card-title vacancy-card__header">{{ $vacancy['title'] }}</h2>
                                    <h3 class="card-subtitle vacancy-card__subheader">{{ $vacancy['subtitle'] }}</h3>
                                </div>
                            </div>
                            <div class="card-body vacancy-card__body">
                                <div class="vacancy-card__text">{!! $vacancy['excerpt'] !!}<a href="{{ $vacancy['link'] }}" class="card-link vacancy-card__link">lees meer ›</a></div>       
                            </div>
                            <div class="card-footer vacancy-card__footer">{{ $vacancy['footer'] }}</div>
                        </div>
                    @endforeach
                    {!! numeric_pagination($current_page, $num_pages) !!}
                @else 
                    <div class="alert alert-dark">Geen vacature gevonden die aan uw zoekopdracht voldeed.</div>
                @endif                
                </main>
            </div>
        </div>
    </section>
    {!! filter_script('vacatures') !!}
@endsection
