@extends('layouts.app')

@section('content')
  @include('partials.page-header')
    <main class="cv">
        <div class="container">
            @if(have_posts())
                @while (have_posts()) 
                    @php
                        the_post();
                        $title = get_the_title();
                        $category = is_array(get_field('categories'))? implode(', ',get_field('categories')) : get_field('categories');
                        //date("d M Y", strtotime(get_the_date()))
                        $time = date_i18n("j M Y", strtotime(get_the_date())) . __(' - Breda, Nederland', 'mooiwerk');
                        $author = get_the_author_meta( 'ID' );

                        $acf = [
                            'opleidingsniveau' => implode(', ', get_field('requirements')),
                            'ervaring' => implode(', ', get_field('competency')),
                            'vergoeding' => implode(', ', get_field('compensation'))
                        ];
                        $date = date_create_from_format('d/m/Y', get_field('date'));                        
                        $date = date_format($date, 'm/d/Y');
                    @endphp
                    @if(isExpired($date))
                        <div class="alert alert-danger"><strong>{{__('Vacature gesloten:', 'mooiwerk')}}</strong>{{__(' u kunt zich niet meer aanmelden voor deze vacature', 'mooiwerk')}}</div>
                    @endif                
                    <div class="row">
                        <div class="col-sm-10  cv__header">
                            <h1 class="cv__name"> {!! $title !!}</h1>
                            <p class="cv__detail">{{ $category }}</p>
                            <p class="cv__detail"> {{ $time }}</p>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            // Display form
                            $user = wp_get_current_user();
                            $role = ( array ) $user->roles;
                            global $post;
                            if(get_field('favorites','user_'.$user->ID)){
                                $favorites = get_field('favorites','user_'.$user->ID);
                            } else {
                                $favorites = [];
                            }
                            
                            
                            // Handle forms received
                            if (isset($_POST['Favoriet']) && $role[0] == 'volunteer'){
                                $post_id = $_POST['post_id'];
                                
                                if(!in_array($post_id,$favorites)){
                                    $favorites[] = $post_id;
                                    update_field('favorites', $favorites, 'user_'.$user->ID);
                                } else {
                                    $index = array_search($post_id, $favorites);
                                    if($index !== false){
                                        unset($favorites[$index]);
                                        update_field('favorites', $favorites, 'user_'.$user->ID);
                                    }
                                }
                            }
                        @endphp
                        <nav class="col d-flex flex-column flex-sm-row justify-content-between border-top cv__social-bar">
                            <div class="cv__links d-flex">  
                                @if($role[0] == 'volunteer' && !isExpired($date))
                                    <form method="post">
                                        <input type="hidden" name="post_id" value="{{ $post->ID }}">
                                        <input type="hidden" name="Favoriet" value="1">
                                        <button type="submit"><i class="{{in_array($post->ID, $favorites)?'fas' : 'far'}} fa-heart"></i></button>
                                    </form>
                                @elseif (!is_user_logged_in() && !isExpired($date))
                                    <a href="{{ wp_login_url(get_permalink()) }}"  class="cv__link"><i class="far fa-heart"></i></a>
                                @endif
                            </div>     
                        
                            <div class="cv__social-icons">
                                <span class="d-sm-none d-md-inline cv__social-text">{{__('Deel deze pagina', 'mooiwerk')}}</span>
                                <a href="{{$share['facebook']}}" target="_blank">
                                    <img src="@asset('images/facebook.svg')" class="cv__social-link" alt="Facebook">
                                </a>
                                <a href="{{$share['twitter']}}" target="_blank">
                                    <img src="@asset('images/twitter.svg')" class="cv__social-link" alt="Twitter">
                                </a>
                                <a href="{{$share['linkedin']}}" target="_blank">
                                    <img src="@asset('images/linkedin.svg')" class="cv__social-link" alt="Linkedin">
                                </a>
                                <a href="{{$share['gplus']}}" target="_blank">
                                    <img src="@asset('images/google.svg')" class="cv__social-link cv__social-link_last" alt="Google +">
                                </a>
                            </div>
                        </nav>
                    </div>
                    <div class="row cv__content">    
                        <article class="col-lg-8 cv__profile">
                                {!! apply_filters('the_content', get_the_content())  !!}
                                @if( is_user_logged_in() && get_the_author_meta('ID') == get_current_user_id() )
                                    <div class=" vacancy__meta my-5"> 
                                        <h3>{{__('Bewerken', 'mooiwerk')}}</h3>
                                        <div class="vacancy-card__actions my-3">
                                            <a href="{{add_query_arg('id', get_the_ID(), home_url('/bewerk-vacature'))}}" class="btn btn-primary vacancy-card__action mr-2">{{__('Bewerk', 'mooiwerk')}}</a>
                                            <a href="{{add_query_arg(['id'=> get_the_ID(), 'trash'=> 'true'], home_url('/bewerk-vacature'))}}" class="btn btn-primary vacancy-card__action">{{__('Verwijder', 'mooiwerk')}}</a>
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $fields = get_fields();
                                    $labels = array(
                                        'region' => __('Locatie', 'mooiwerk'),
                                        'frequency' => __('Hoe vaak', 'mooiwerk'),
                                        'period' => __('Uren per week', 'mooiwerk'),
                                        'categories' => __('Categorie', 'mooiwerk'),
                                        'target' => __('Doelgroep', 'mooiwerk'),
                                        'date' => __('Vervaldatum', 'mooiwerk')
                                    );
                                @endphp
                                @if( $fields )
                                    <div class=" vacancy__meta my-4"> 
                                        <h3>{{__('Gegevens', 'mooiwerk')}}</h3>
                                        <div class="row mt-3">
                                            @foreach( $labels as $name => $value )
                                                <div class="col-md-6 col-xxl-4 mb-3">
                                                    <div class="card">
                                                        <div class="card-block block-{{$loop->iteration}}">
                                                            <h3 class="card-title">{{$value}}</h3>
                                                            @if( is_array(get_field($name)) )
                                                                <p class="card-text">{{implode(", ", get_field($name))}}</p>
                                                            @else
                                                                <p class="card-text">{{get_field($name)}}</p> 
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach                                            
                                        </div>
                                    </div>
                                @endif
                                @if (is_user_logged_in())
                                    @php comments_template('/partials/comments.blade.php') @endphp
                                @else
                                    <div class="alert alert-dark mt-3"><a href="{{wp_login_url()}}">{{__('Log in', 'mooiwerk')}}</a>{{__(' om te reageren op deze vacature', 'mooiwerk')}}</div> 
                                @endif
                        </article>
                        <aside class="col-lg-4 cv__sidebar sidebar">
                            <div class="sidebar__item cv__extra">
                                <h5 class="sidebar__title">{{__('Extra informatie', 'mooiwerk')}}</h5>
                                <ul class="cv__extra-list">
                                    <li class="cv__extra-list-item academie">
                                        {{$acf['opleidingsniveau']}}
                                    </li>
                                    <li class="cv__extra-list-item work">
                                        {{$acf['ervaring']}}
                                    </li>
                                    <li class="cv__extra-list-item cash">
                                        {{$acf['vergoeding']}}
                                    </li>
                                </ul>
                            </div>                           
                            <div class="sidebar__item company-widget">
                                <h5 class="sidebar__title"><a href="{{get_author_posts_url($author)}}">{{ get_field('name', 'user_' . $author) }}</a></h5>
                                <div>
                                    <div class="d-flex flex-column company-widget__profile">
                                        <div class="company-widget__logo-wrapper my-2">
                                            @php
                                                $image = get_field('logo', 'user_' . $author);
                                                $image = $image ? $image : '//placehold.it/114x76';
                                            @endphp
                                            <img src="{{ $image }}" class="company-widget__logo">
                                        </div>
                                        <div class="company-widget__contact">
                                            <div class="d-flex flex-column company-widget__contact-group">
                                                @if(get_field('address', 'user_' . $author))
                                                <small class="company-widget__address">{{ get_field('address', 'user_' . $author) }}</small>
                                                @endif
                                                @if(get_field('postcode', 'user_' . $author))
                                                <small class="company-widget__phone">{{ get_field('postcode', 'user_' . $author) }}</small>
                                                @endif
                                                @if(get_field('place', 'user_' . $author))
                                                <small class="company-widget__email">{{ get_field('place', 'user_' . $author) }}</small>
                                                @endif
                                                @if(get_field('website', 'user_' . $ID))
                                                <small class="company-widget__website">{{ get_field('website', 'user_' . $author)}}</small>
                                                @endif                                
                                            </div>
                                            <nav class="company-widget__social-links mt-3">
                                                @if(get_field('facebook', 'user_' . $author))
                                                    <a href="{{get_field('facebook', 'user_' . $author)}}" target="_blank" class="company-widget__social-link mr-2">
                                                        <img src="@asset('images/facebook.svg')" alt="Facebook" class="company-widget__social-link-icon">
                                                    </a>
                                                @endif
                                                @if(get_field('twitter', 'user_' . $author))
                                                    <a href="{{get_field('twitter', 'user_' . $author)}}" target="_blank" class="company-widget__social-link mr-2">
                                                        <img src="@asset('images/twitter.svg')" alt="Twitter" class="company-widget__social-link-icon">
                                                    </a>
                                                @endif
                                                @if(get_field('linkedin', 'user_' . $author))
                                                    <a href="{{get_field('linkedin', 'user_' . $author)}}" target="_blank" class="company-widget__social-link mr-2">
                                                        <img src="@asset('images/linkedin.svg')" alt="Linkedin" class="company-widget__social-link-icon">
                                                    </a>
                                                @endif
                                                @if(get_field('instagram', 'user_' . $author))
                                                    <a href="{{get_field('instagram', 'user_' . $author)}}" target="_blank" class="company-widget__social-link">
                                                        <img src="@asset('images/instagram.svg')" alt="Instagram" class="company-widget__social-link-icon">
                                                    </a>
                                                @endif
                                            </nav>
                                            @if(get_field('bio', 'user_' . $author))
                                                <div class="company-widget__bio my-2">{!! wp_kses_post(wp_trim_words(get_field('bio', 'user_' . $author), 25, '...')) !!}</div>                                                    
                                            @endif
                                            <a href="{{ get_author_posts_url($author) }}" class="card-link">{{__('lees meer ›', 'mooiwerk')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </aside>
                    </div>
                @endwhile
            @endif           
        </div>            
    </main>
@endsection
