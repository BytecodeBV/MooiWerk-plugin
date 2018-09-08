@extends('layouts.app')

@section('content')
    @php
        $ID = get_queried_object()->ID;
        $usermeta = get_user_meta($ID);
        $userdata = get_userdata($ID);

        global $post; 
        $post = get_post( $ID, OBJECT );
        setup_postdata( $post );

        $cover = get_field('profile_pic', 'user_' . $ID);
        $cover= $cover ? $cover : App\asset_path('images/header_u.png');
    @endphp
    <section class="hero-banner" style="background-image:url({{$cover}}); background-size:cover; background-position: center;">
    </section>
    <section class="company">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">                    
                    <h1 class="company__name">{{ $userdata->display_name }}</h1>
                    <div class="d-flex company__profile">
                        <div class="company__logo-wrapper">
                            @php
                                $image = get_field('logo', 'user_' . $ID);
                                $image = $image ? $image : '//placehold.it/114x76';
                            @endphp
                            <img src="{{ $image }}" class="company__logo">
                        </div>
                        <div class="company__contact">
                            <div class="d-flex flex-column company__contact-group">
                                @if(get_field('address', 'user_' . $ID))
                                <small class="company__address">{{ get_field('address', 'user_' . $ID)['address'] }}</small>
                                @endif
                                @if(get_field('postcode', 'user_' . $ID))
                                <small class="company__phone">{{ get_field('postcode', 'user_' . $ID) }}</small>
                                @endif
                                @if(get_field('place', 'user_' . $ID))
                                <small class="company__email">{{ get_field('place', 'user_' . $ID) }}</small>
                                @endif
                                @if(get_field('website', 'user_' . $ID))
                                <small class="company__website">{{ get_field('website', 'user_' . $ID)}}</small>
                                @endif                                
                            </div>
                            <nav class="company__social-links">
                                <a href="{{get_field('facebook', 'user_' . $ID)}}" target="_blank" class="company__social-link">
                                    <img src="@asset('images/facebook.svg')" alt="Facebook" class="company__social-link-icon">
                                </a>
                                <a href="{{get_field('twitter', 'user_' . $ID)}}" target="_blank" class="company__social-link">
                                    <img src="@asset('images/twitter.svg')" alt="Twitter" class="company__social-link-icon">
                                </a>
                                <a href="{{get_field('linkedin', 'user_' . $ID)}}" target="_blank" class="company__social-link">
                                    <img src="@asset('images/linkedin.svg')" alt="Linkedin" class="company__social-link-icon">
                                </a>
                                <a href="{{get_field('instagram', 'user_' . $ID)}}" target="_blank" class="company__social-link">
                                    <img src="@asset('images/instagram.svg')" alt="Instagram" class="company__social-link-icon">
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="row company__bio">
                        {!! get_field('bio', 'user_' . $ID) !!}
                    </div>

                    @php
                        $args = array(
                        'author' => $ID,
                        'post_type' => 'vacancies',
                        );
                        $posts = get_posts($args);
                    @endphp
                    @if ($posts)
                    <h1>Vacancies</h1>    
                        @foreach ($posts as $p)
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
                    @endif
                    @php
                        wp_reset_postdata();
                    @endphp
                </div>
                <aside class="col-sm-4 company__sidebar blog__sidebar sidebar">
                    {!! dynamic_sidebar('sidebar-primary') !!}
                </aside>
            </div>
        </div>
    </section>
@endsection
