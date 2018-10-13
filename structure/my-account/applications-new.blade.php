{{--
  Template Name: Reacties
--}}
//DELETE: Template to list applications/feedbacks via comment status
@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    <section @php post_class('member-page') @endphp>
        <div class="member-page__body container">
            <div class="row">
                <aside class="col-lg-4 sidebar">
                    <a href="#sidebarnav" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">Menu</a>
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
                                    $reactions = get_field('reacties', 'user_' . $user->ID);
                                @endphp
                                @if ($reactions)
                                    <h1>{{__('Reacties', 'mooiwerk')}}</h1>
                                    @foreach ($reactions as $p => $status) {{-- variable must NOT be called $post (IMPORTANT) --}}
                                        @php
                                        $p = get_post($p);
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
                                        
                                        if ($status == "Reageer" ) {
                                            $status = "gereageerd";
                                        } elseif ($status == "Weiger") {
                                           $status = "geweigerd"; 
                                        } elseif ($status == "Accepteer") {
                                           $status = "geaccepteerd"; 
                                        }
                                        @endphp
                                        <div class="card shadow border-light vacancy-list__item  vacancy-card">
                                            <div class="row vacancy-card__header-wrapper">
                                                <div class="col-xxl-2 col-md-3 col-xs-12 vacancy-card__figure d-flex align-items-center">
                                                <a href="{{ $vacancy['link'] }}" ><img src="{{ $vacancy['image_link']? $vacancy['image_link'] : '//placehold.it/114x76' }}" class="vacancy-card__image"></a>
                                                </div>
                                                <div class="col-xxl-10 col-md-9 col-xs-12 vacancy-card__header-group">
                                                    <h2 class="card-title vacancy-card__header"><a href="{{ $vacancy['link'] }}" >{!! $vacancy['title'] !!}</a></h2>
                                                    <h3 class="card-subtitle vacancy-card__subheader">{{ $vacancy['subtitle'] }}</h3>
                                                    <h6><strong>{{__('status: ', 'mooiwerk')}} {{$status}}</strong></h6>
                                                </div>
                                            </div>
                                            <div class="card-body vacancy-card__body">
                                                <div class="vacancy-card__text">{!! $vacancy['excerpt'] !!}<a href="{{ $vacancy['link'] }}" class="card-link vacancy-card__link">lees meer ›</a></div>       
                                            </div>
                                            <div class="card-footer vacancy-card__footer">{{ $vacancy['footer'] }}</div>
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
