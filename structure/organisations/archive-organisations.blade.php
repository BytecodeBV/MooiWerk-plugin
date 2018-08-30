@extends('layouts.user')

@section('content')
  @include('partials.page-header')
    <section class="vacancy-list">
        <div class="container">
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
                $meta_query = array('relation' => 'OR'); // Array of arrays that individually store key/value pairs.
                
            @endphp
            <div class="row">
                <aside id="archive-filters" class="col-lg-4 vacancy-list__layered layered">
                    @php dynamic_sidebar('sidebar-primary') @endphp
                </aside>                
                @php
                // Add key, value pair to the post meta filters if it is set.
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
                                        <img src="{{$image}}" class="vacancy-card__image">
                                    </div>
                                    <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                        <h2 class="card-title vacancy-card__header">{{  get_field('name', 'user_' . $user->ID) }}</h2>                                          
                                        <h3 class="card-subtitle vacancy-card__subheader">{{get_field('place', 'user_' . $user->ID)}}</h3>
                                    </div>
                                </div>
                                <div class="card-body vacancy-card__body">
                                    <div class="vacancy-card__text">{!! $user->description !!}</div>
                                    <a href="{{ get_author_posts_url($user->ID) }}" class="card-link">lees meer ›</a>
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
                                <div class="card-footer vacancy-card__footer">No of Vacancies: {{$count}}</div>                                
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
    {!! filter_script('organisaties') !!}
@endsection
