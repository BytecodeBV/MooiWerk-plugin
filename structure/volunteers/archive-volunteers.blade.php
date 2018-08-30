@extends('layouts.user')

@section('content')
  @include('partials.page-header')
        <section class="vacancy-list no-background">
            <div class="container">
                <div class="row">
                    @php
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
                        $users_per_page = 10;
                        if(isset($_SESSION['nr'])){
                            $users_per_page = $_SESSION['nr'];
                        }

                        // Filters
                        $meta_query = array('relation' => 'OR'); // Array of arrays that individually store key/value pairs.
                        $filter_keys = array(
                            'field_5b7ef28594888' => 'region',
                            'field_5b7ef2f894889'  => 'frequency',
                            'field_5b7ef3339488a' => 'availability',
                            'field_5b7ef39d9488b' => 'interest',
                            'field_5b7ef3fc9488c'  => 'competency',
                            'field_5b7ef4229488d' => 'preference',
                        );
                    @endphp

                    <aside id="archive-filters" class="col-lg-4 vacancy-list__layered layered">
                        <a href="#filters" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">Filter</a>
                        <div id="filters" class="layered__form collapse dont-collapse-lg">
                            {{--// Loop over all filter keys and check if they are set in the _Get variable.--}}
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
                                    <h2 class="layered__group-header">{{$field['label']}}</h2>
                                    <div class="filter" data-filter="{{$key}}">
                                        {!! render_field($field) !!}
                                    </div>
                                </section>
                            @endforeach
                        </div>
                    </aside>
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
                            'role' => 'volunteer',
                            'number' => $users_per_page,
                            'paged' => $current_page,
                            'meta_query' => $meta_query
                        );

                        // Add search term to wp-query if it is set in the url.
                        if(isset($_GET['search'])){
                            $search_term = $wpdb->esc_like($_GET['search']);
                            $args['search'] = '*'.$search_term.'*';
                            $args['search_columns'] = array(
                                'user_login',
                                'user_nicename',
                                'user_email',
                                'user_url',
                            );
                        }

                        // The Query
                        $user_query = new WP_User_Query($args);

                        // Totals for pagination
                        $total_users = $user_query->get_total(); // How many users we have in total (beyond the current page)
                        $num_pages = ceil($total_users / $users_per_page); // How many pages of users we will need
                    @endphp
                    <main class="col-lg-8 vacancy-list__items">
                        {{--// User Loop--}}
                        @if (!empty($user_query->get_results())) 
                        @foreach ($user_query->get_results() as $user) 
                            <div class="card shadow border-light vacancy-list__item  vacancy-card">
                                <div class="row vacancy-card__header-wrapper">
                                    <div class="col-xxl-2 col-md-3 col-xs-12 vacancy-card__figure d-flex align-items-center">
                                        @php
                                            $image = get_field('profile_image', 'user_' . $user->ID);
                                            $image = $image ? $image : '//placehold.it/114x76';
                                        @endphp
                                        <img src="{{$image}}" class="vacancy-card__image">
                                    </div>
                                    <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                        <h2 class="card-title vacancy-card__header">{{ get_field('first-name', 'user_' . $user->ID)}} {{get_field('last-name', 'user_' . $user->ID) }}</h2>
                                        @if(get_field('categorie', 'user_' . $user->ID))                                            
                                        <h3 class="card-subtitle vacancy-card__subheader">{{get_field('age', 'user_' . $user->ID)}}</h3>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body vacancy-card__body">
                                    <div class="vacancy-card__text">{{get_field('bio', 'user_' . $user->ID)}}</div>
                                    <a href="{{ get_author_posts_url($user->ID) }}" class="card-link">lees meer ›</a>
                                </div>
                                <div class="card-footer vacancy-card__footer">{{is_array(get_field('qualification', 'user_' . $user->ID))? implode(', ',get_field('qualification', 'user_' . $user->ID)) : get_field('qualification', 'user_' . $user->ID)}}</div>                                
                            </div>
                        @endforeach                
                    @else 
                        <div class="alert alert-dark">Geen organisatie gevonden die aan uw zoekopdracht voldeed.</div>
                    @endif
                    {!! numeric_pagination($current_page, $num_pages) !!}
                </main>
            </div>
        </div>
    </section>
    {!! filter_script('vrijwilligers')!!}
@endsection
