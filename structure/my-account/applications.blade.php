{{--
  Template Name: Reacties
--}}

@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    <section @php post_class('member-page') @endphp>
        <div class="member-page__body container">
            <div class="row">
                <aside class="col-lg-4 sidebar">
                    <a href="#sidebarnav" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">{{__('Menu', 'mooiwerk')}}</a>
                    <div id="sidebarnav" class="member-page__menu sidebar__item collapse dont-collapse-lg">
                        {!! my_account_menu() !!}
                    </div>
                </aside>
                <div class="col-lg-8 member-page__content"> 
                    @if(is_user_logged_in())
                        @php 
                            $user = wp_get_current_user();
                            $role = ( array ) $user->roles;
                        @endphp
                        @if($role[0] == 'volunteer')  
                            <div id="applications">
                                @php
                                    $posts = get_field('applications', 'user_' . $user->ID);
                                    $args = array(
                                        'post_type' => 'vacancies',
                                        'user_id' => $user->ID,
                                        //'status' => 'approve'
                                    );
                                    $comments = get_comments( $args );
                                    $vacancies = array_unique( 
                                        wp_list_pluck( 
                                            $comments,       
                                            'comment_post_ID' 
                                        )
                                    );
                                @endphp
                                @if ($vacancies)
                                    <h1>{{__('Reacties','mooiwerk')}}</h1>
                                    @foreach ($vacancies as $p) {{-- variable must NOT be called $post (IMPORTANT) --}}
                                        @php
                                        $p = get_post($p);
                                        $time = human_time_diff(get_post_time('U', true, $p), current_time('timestamp')) . __(' geleden', 'mooiwerk');
                                        $vacancy = [
                                            'title' => $p->post_title,
                                            'link' => get_permalink($p->ID),
                                            'image_link' => get_field('logo', 'user_'.$p->post_author),
                                            'excerpt' => wp_kses_post(wp_trim_words($p->post_content, 25, '...')),
                                        ];
                                        $post_comments = array_filter($comments, function($comment) use ($p){
                                            return ($comment->comment_post_ID == $p->ID);
                                        });
                                        @endphp
                                        <div class="card shadow border-light comment-card vacancy-card">                                        
                                            <div class="card-body">                                            
                                                <h2 class="card-title vacancy-card__header">{{ $vacancy['title'] }}</h2>
                                                <div class="card-text">{!! apply_filters('the_content', $vacancy['excerpt']) !!}</div>
                                            </div>
                                            <ul class="list-group list-group-flush">                                                
                                                @foreach(array_slice($post_comments, 0, 3) as $comment)
                                                    <li class="list-group-item">{!! apply_filters('the_content', $comment->comment_content) !!}</li>
                                                @endforeach
                                            </ul>
                                            <div class="card-body"><a href="{{ $vacancy['link'] }}" class="card-link">{{__('lees meer ›', 'mooiwerk')}}</a></div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="member-page__message alert alert-dark" role="alert">{{__('Geen reacties.', 'mooiwerk')}}</div>
                                @endif    
                            </div>
                        @else
                            <div class="member-page__message alert alert-dark" role="alert">{{__('Uw account is geen vrijwilliger.', 'mooiwerk')}}</div>
                        @endif
                    @else
                        <div class="member-page__message alert alert-dark" role="alert">{{__('Je moet ingelogd zijn om deze pagina te bekijken.', 'mooiwerk')}}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
