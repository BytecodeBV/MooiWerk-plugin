{{--
  Template Name: Wijzig Wachtwoord
--}}

@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    <section @php post_class('member-page') @endphp>
        <div class="member-page__body  container">
            <div class="row">
                <aside class="col-sm-4 sidebar">
                    <a href="#sidebarnav" class="list-group-item d-lg-none layered__bar" data-toggle="collapse" aria-expanded="false">{{__('Menu', 'mooiwerk')}}</a>
                    <div id="sidebarnav" class="member-page__menu sidebar__item collapse dont-collapse-lg">
                        {!! my_account_menu() !!}
                    </div>
                </aside>
                <div class="col-lg-8 member-page__content"> 
                    @if(is_user_logged_in())
                        @php
                            $user = wp_get_current_user();
                            $user_id = $user->ID;  
                            $meta = get_user_meta($user_id, 'profile', true);
                            $output='';
                            if(isset($_POST['changepass']) && isset($_POST['opass'])){
                                if(wp_check_password($_POST['opass'], $user->data->user_pass,  $user->ID)){
                                    if($_POST['npass']!=$_POST['cpass']){
                                        $output = __('Uw wachtwoorden kwamen niet overeen', 'mooiwerk');    
                                    } else{
                                    if($_POST['npass']==''){
                                        $password=$_POST['password'];
                                    }  
                                    else{
                                        $password=$_POST['npass'];
                                    }
                                    wp_set_password( $password, $user_id );
                                    wp_set_auth_cookie($user->ID);
                                    wp_set_current_user($user->ID);
                                    do_action('wp_login', $user->user_login, $user);
                                    $output= __('Uw wachtwoord is veranderd', 'mooiwerk');
                                    } 
                                } else{
                                    $output = __('Uw oude wachtwoord was incorrect', 'mooiwerk');
                                }
                            }
                        @endphp
                        <div class="row">
                            <div class="col-lg-10 offset-g-1">
                                <h2>{{__('Wachtwoord Aanpassen', 'mooiwerk')}}</h2>
                                <form class="password_change"  method="post" enctype="multipart/form-data" action="#" onsubmit="return change_password();">                           
                                    <div class="form-group">
                                        <label>{{__('Oude Wachtwoord', 'mooiwerk')}}</label>
                                        <input type="password" name="opass" id="opass" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Nieuw Wachtwoord', 'mooiwerk')}}</label>
                                        <input type="password" name="npass" id="pass" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Bevestig Wachtwoord', 'mooiwerk')}}</label>
                                        <input type="password" name="cpass" id="cpass" class="form-control" />
                                    </div>
                                    <div id="error">{{$output}}</div>
                                    <input type="submit" name="changepass"  value="{{__('Submit', 'mooiwerk')}}" class="btn btn-block" />
                                </form>                            
                            </div>
                        </div>                        
                    @else
                        <div class="member-page__message alert alert-dark" role="alert">{{__('Je moet ingelogd zijn om deze pagina te bekijken.', 'mooiwerk')}}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
