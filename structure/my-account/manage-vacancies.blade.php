{{--
  Template Name: Beheer Vacatures
--}}

@extends('layouts.user')

@section('content')
  @include('partials.page-header')
    <section @php post_class('member-page') @endphp>
        <div class="member-page__body  container">
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
                        @if($role[0] == 'organisation')
                        <div id="magage-vacancies">
                            @php
                                $args = array(
                                    'post_type' => 'vacancies',
                                    'author'    => $user->ID,
                                );
                                $posts = get_posts( $args );
                            @endphp
                        
                            @if ($posts)
                                <h1> {{count($posts)}} Vacature(s) geplaatst </h1>
                                @foreach ($posts as $p) {{-- // variable must NOT be called $post (IMPORTANT) --}}
                                    @php        
                                        $reactions = get_users(array(
                                            'role' => 'volunteer',
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'applications', // name of custom field
                                                    'value' => '"' . $p->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                                    'compare' => 'LIKE'
                                                )
                                            )
                                        ));
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
                                            <div class="col-md-4 col-xs-12 vacancy-card__figure">
                                            <img src="{{ $vacancy['image_link']? $vacancy['image_link'] : '//placehold.it/144x76' }}" class="vacancy-card__image">
                                            </div>
                                            <div class="col-md-8 col-xs-12 vacancy-card__header-group">
                                                <h2 class="card-title vacancy-card__header">{{ $vacancy['title'] }}</h2>
                                                <h3 class="card-subtitle vacancy-card__subheader">{{ $vacancy['subtitle'] }}</h3>
                                            </div>
                                        </div>
                                        <div class="card-body vacancy-card__body">
                                            <div class="vacancy-card__text">{!! $vacancy['excerpt'] !!}<a href="{{ $vacancy['link'] }}" class="card-link vacancy-card__link">lees meer ›</a></div>
                                            <div class="vacancy-card__actions my-3">
                                                <a href="{{home_url('/bewerk-vacature')}}?id={{$p->ID}}" class="btn btn-primary vacancy-card__action mr-2">Bewerk</a>
                                                <a href="{{home_url('/bewerk-vacature')}}?id={{$p->ID}}&trash=true" class="btn btn-primary vacancy-card__action">Verwijder</a>
                                            </div>       
                                        </div>
                                        <div class="card-footer vacancy-card__footer">Aantal reacties: {{count($reactions)}}</div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                <div class="jumbotron mt-3">
                                    <h1>Geen vacature gevonden</h1>
                                    <p class="lead">U moet een vacature aanmaken om te beginnen.</p>
                                    <a class="btn btn-lg btn-primary" href="{{home_url('/nieuwe-vacature')}}" role="button">Maak er nu een »</a>
                                </div>
                            @endif
                        @else
                            <div class="member-page__message alert alert-dark" role="alert">Uw account is geen vrijwilliger.</div>
                        @endif        
                    @else
                        <div class="member-page__message alert alert-dark" role="alert">Je moet ingelogd zijn om deze pagina te bekijken.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
