@extends('layouts.app')

@section('content')
  @include('partials.page-header-image')
    <main class="cv">
        <div class="container">
            @if(have_posts())
                @while (have_posts()) 
                    @php
                        the_post();
                        $title = get_the_title();
                        $category = is_array(get_field('categories'))? implode(', ',get_field('categories')) : get_field('categories');
                        //date("d M Y", strtotime(get_the_date()))
                        $time = date_i18n("j M Y", strtotime(get_the_date())) . ' - Breda, Nederland';

                        $acf = [
                            'opleidingsniveau' => implode(', ',get_field('requirements')),
                            'ervaring' => implode(', ',get_field('competency')),
                            'vergoeding' => implode(', ',get_field('compensation'))
                        ];
                    @endphp                 
                    <div class="row">
                        <div class="col-sm-10  cv__header">
                            <h1 class="cv__name"> {{ $title }}</h1>
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
                            
                            // Handle forms received
                            if (isset($_POST['Favoriet']) && $role[0] == 'volunteer'){
                                $user_id = $_POST['user_id'];
                                $post_id = $_POST['post_id'];
                                $current_array = get_field('favorite','user_'.$user_id);
                                $current_array = (array)$current_array;
                                if(!in_array($post_id,$current_array)){
                                    $current_array[] = $post_id;
                                    update_field('favorite', $current_array, 'user_'.$user_id);
                                }
                            } else if(isset($_POST['Reageer']) && $role[0] == 'volunteer'){
                                $user_id = $_POST['user_id'];
                                $post_id = $_POST['post_id'];
                                $current_array = get_field('applied','user_'.$user_id);
                                $current_array = (array)$current_array;
                                if(!in_array($post_id,$current_array)){
                                    $current_array[] = $post_id;
                                    update_field('applied', $current_array, 'user_'.$user_id);
                                }
                            }
                        @endphp
                        <nav class="col d-flex flex-column flex-sm-row justify-content-between border-top cv__social-bar">
                            <div class="cv__links d-flex">  
                                @if($role[0] == 'volunteer')                  
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="{{ $user->ID  }}">
                                        <input type="hidden" name="post_id" value="{{ $post->ID }}">
                                        <input type="submit" name="Reageer" value="Reageer nu ›" class="cv__link">
                                    </form>
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="{{ $user->ID  }}">
                                        <input type="hidden" name="post_id" value="{{ $post->ID }}">
                                        <input type="submit" name="Favoriet" value="Favoriet ›" class="cv__link">
                                    </form>
                                @elseif (!is_user_logged_in())
                                    <a href="{{ wp_login_url(get_permalink()) }}"  class="cv__link">Reageer nu ›</a>
                                    <a href="{{ wp_login_url(get_permalink()) }}"  class="cv__link">Favoriet ›</a>
                                @endif
                            </div>     
                        
                            <div class="cv__social-icons">
                                <span class="d-sm-none d-md-inline cv__social-text">Deel deze pagina</span>
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
                                {!! get_the_content() !!}
                                @if (is_user_logged_in())
                                    @php comments_template('/partials/comments.blade.php')
                                @else
                                    <div class="alert alert-dark"><a href="{{wp_login_url()}}">Log in</a> om te reageren op deze vacature</div> 
                                @endif
                        </article>
                        <aside class="col-lg-4 cv__sidebar sidebar">
                            <div class="sidebar__item cv__extra">
                                <h5 class="sidebar__title">Extra informatie</h5>
                                <ul class="cv__extra-list">
                                    <li class="cv__extra-list-item">
                                        <img src="@asset('images/academy.svg')" alt="Academic Icon" class="cv__extra-icon">{{$acf['opleidingsniveau']}}
                                    </li>
                                    <li class="cv__extra-list-item">
                                        <img src="@asset('images/work.svg')" alt="Work Icon" class="cv__extra-icon">{{$acf['ervaring']}}
                                    </li>
                                    <li class="cv__extra-list-item">
                                        <img src="@asset('images/cash.svg')" alt="Cash Icon" class="cv__extra-icon">{{$acf['vergoeding']}}
                                    </li>
                                </ul>
                            </div>                           
                            {!! dynamic_sidebar('sidebar-primary') !!}
                        </aside>
                    </div>
                @endwhile
            @endif           
        </div>            
    </main>
@endsection
