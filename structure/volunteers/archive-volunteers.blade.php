@extends('layouts.user')

@section('content')
  @include('partials.page-header')
        <section class="vacancy-list no-background">
            <div class="container">
                <ul class="nav nav-tabs tab-pager justify-content-end mb-5">
                    @php
                        $pages = ['Vrijwilligers', 'Organisaties', 'Vacatures'];
                    @endphp
                    @foreach($pages as $page)
                        @php
                            $page_object = get_page_by_title( $page, NULL, 'page' );
                        @endphp
                        @if($page_object)
                            <li class="nav-item">
                                <a class="nav-link {{ ($page == 'Vrijwilligers')? 'active':'' }}" href="{{ get_permalink(get_page_by_path($page_object->post_name )) }}">{{$page}}</a>
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
                        $users_per_page = 10;
                        if(isset($_SESSION['nr'])){
                            $users_per_page = $_SESSION['nr'];
                        }

                        // Filters
                        $meta_query = array('relation' => 'AND'); // Array of arrays that individually store key/value pairs.
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
                        <a href="#filters" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">{{__('Filter', 'mooiwerk')}}</a>
                        <div id="filters" class="layered__form collapse dont-collapse-lg">
                            {{--// Loop over all filter keys and check if they are set in the _Get variable.--}}
                            @foreach($filter_keys as $acf_key => $key)
                                @php
                                    
                                    // get the fields settings without attempting to load a value
                                    $field = get_field_object($acf_key, false, false);

                                    //change radio to checkbox
                                    if ($field['type'] == 'radio') {
                                        $field['type'] = 'checkbox';
                                    }
                                   if (isset($_GET[$key])){                                                                                
                                        $field['value'] = explode('_', $_GET[$key]);
                                        if ($key == 'availability') {
                                            add_to_meta_query_if_get_exists_or($key, $field['value'], $meta_query);
                                        } else {                                            
                                            add_to_meta_query_if_get_exists($key, $field['value'], $meta_query);
                                        }
                                    } else {
                                        $field['value'] = array();
                                    }
                                   
                                @endphp
                                <section class="mb-4 layered__group">
                                    <div class="d-flex justify-content-between">                                
                                        <a data-toggle="collapse" href="#{{ $key }}" role="button">
                                            <h2 class="layered__group-header">
                                                {{$field['label']}}
                                            </h2>
                                        </a>
                                        <i class="fa fa-angle-right layered__group-header" aria-hidden="true"></i>
                                    </div>
                                    <div class="layered__field filter {{ empty($field['value'])? 'collapse' : '' }}" data-filter="{{$key}}" id="{{$key}}">
                                        {!! render_field($field) !!}
                                    </div>
                                </section>
                            @endforeach
                        </div>
                    </aside>
                    @php
                        
                        // Check if user wants to show up in results.
                        $check_pref = array(
                            'key' => 'searchable',
                            'value' => 'Ja',
                        );
                        array_push($meta_query, $check_pref);

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
                                        <a href="{{ get_author_posts_url($user->ID) }}"><img src="{{$image}}" class="vacancy-card__image"></a>
                                    </div>
                                    <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                        <h2 class="card-title vacancy-card__header"><a href="{{ get_author_posts_url($user->ID) }}">{{ get_field('first-name', 'user_' . $user->ID)}} {{get_field('last-name', 'user_' . $user->ID) }}</a></h2>
                                        @if(get_field('categorie', 'user_' . $user->ID))                                            
                                            <h3 class="card-subtitle vacancy-card__subheader">{{get_field('age', 'user_' . $user->ID)}}</h3>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body vacancy-card__body">
                                    <div class="vacancy-card__text">{!!get_field('bio', 'user_' . $user->ID)!!}</div>
                                    <a href="{{ get_author_posts_url($user->ID) }}" class="card-link vacancy-card__link">lees meer ›</a>
                                </div>
                                <div class="card-footer vacancy-card__footer">{{is_array(get_field('qualification', 'user_' . $user->ID))? implode(', ',get_field('qualification', 'user_' . $user->ID)) : get_field('qualification', 'user_' . $user->ID)}}</div>                                
                            </div>
                        @endforeach                
                    @else 
                        <div class="alert alert-dark">{{__('Geen vrijwilliger gevonden die aan uw zoekopdracht voldeed.', 'mooiwerk')}}</div>
                    @endif
                    {!! numeric_pagination($current_page, $num_pages) !!}
                </main>
            </div>
        </div>
    </section>
    {!! filter_script('vrijwilligers')!!}
@endsection
