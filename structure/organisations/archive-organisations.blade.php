@extends('layouts.user')

@section('content')
  @include('partials.page-header')
    <section class="vacancy-list">
        <div class="container">
            <ul class="nav nav-tabs tab-pager justify-content-end mb-5">
                @php
                    $pages = ['Organisaties', 'Vacatures', 'Vrijwilligers'];
                    $user = wp_get_current_user();
                    $roles = $user->roles;
                @endphp
                @foreach($pages as $page)
                    @if ($page == 'Vrijwilligers')
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
                            <a class="nav-link {{ ($page == 'Organisaties')? 'active':'' }}" href="{{ get_permalink(get_page_by_path($page_object->post_name )) }}">{{$page}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
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
                $users_per_page = 10;
                if(isset($_SESSION['nr'])){
                    $users_per_page = $_SESSION['nr'];
                }

                // Filters
                $meta_query = array(
                    'relation' => 'AND',
                    array (                        
                        'key' => 'show_in_search', 
                        'value' => 'Ja',
                    ),
                ); // Array of arrays that individually store key/value pairs.
                $filter_keys = array('field_5b7eed557da3a' => 'category');
                $labels = array('field_5b7eed557da3a' => __('Categorie', 'mooiwerk'));
                
            @endphp
            <div class="row">            
                <aside id="archive-filters" class="col-lg-4 vacancy-list__layered layered">
                    <a href="#filters" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">{{__('Filter', 'mooiwerk')}}</a>
                    <div id="filters" class="layered__form collapse dont-collapse-lg">
                        {{--// Loop over all filter keys and check if they are set in the _Get variable. --}}

                        @foreach($filter_keys as $acf_key => $key)
                            @php
                            // get the fields settings without attempting to load a value
                            $field = get_field_object($acf_key, false, false);

                            if (isset($_GET[$key])) {
                                $field['value'] = explode(',', $_GET[$key]);
                                add_to_meta_query_if_get_exists($key,$_GET[$key],$meta_query);
                            } else {
                                $field['value'] = array();
                            }
                            @endphp
                            <section class="mb-4 layered__group">
                                <div class="d-flex justify-content-between">                                
                                    <a data-toggle="collapse" href="#{{ $key }}" role="button">
                                        <h2 class="layered__group-header">
                                            {{$labels[$acf_key]}}
                                        </h2>
                                    </a>
                                    <i class="fa fa-angle-right layered__group-header" aria-hidden="true"></i>
                                </div>
                                <div class="layered__field filter collapse" data-filter="{{$key}}" id="{{$key}}">
                                    {!! render_field($field); !!}
                                </div>
                            </section>
                        @endforeach
                    </div>
                </aside>                
                @php
                // Arguments for out main query
                $args = array(
                    // Add filter and pagination arguments here later, and get them from ?= variables with default values.
                    'role' => 'organisation',
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
                                            $image = get_field('logo', 'user_' . $user->ID);
                                            $image = $image ? $image : '//placehold.it/114x76';
                                        @endphp
                                        <a href="{{ get_author_posts_url($user->ID) }}"><img src="{{$image}}" class="vacancy-card__image"></a>
                                    </div>
                                    <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                        <h2 class="card-title vacancy-card__header"><a href="{{ get_author_posts_url($user->ID) }}">{{  get_field('name', 'user_' . $user->ID) }}</a></h2>                                          
                                        <h3 class="card-subtitle vacancy-card__subheader">{{get_field('place', 'user_' . $user->ID)}}</h3>
                                    </div>
                                </div>
                                <div class="card-body vacancy-card__body">
                                    <div class="vacancy-card__text">{!! wp_kses_post(wp_trim_words(get_field('bio', 'user_' . $user->ID), 25, '...')) !!}</div>
                                    <a href="{{ get_author_posts_url($user->ID) }}" class="card-link vacancy-card__link">{{__('lees meer ›', 'mooiwerk')}}</a>
                                </div>
                                @php
                                    $args = array(
                                    'author' => $user->ID,
                                    'post_type' => 'vacancies',
                                    );
                                    $posts = get_posts($args);
                                    if($posts)
                                        $count = count($posts);
                                    else
                                        $count = 0;
                                @endphp
                                <div class="card-footer vacancy-card__footer">{{sprintf(__('No of Vacancies: %s', 'mooiwerk'), $count)}}</div>                                
                            </div>
                        @endforeach                
                    @else 
                        <div class="alert alert-dark">{{__('Geen organisatie gevonden die aan uw zoekopdracht voldeed.', 'mooiwerk')}}</div>
                    @endif
                    {!! numeric_pagination($current_page, $num_pages) !!}
                </main>
            </div>
        </div>
    </section>    
    {!! filter_script('organisaties') !!}
@endsection
