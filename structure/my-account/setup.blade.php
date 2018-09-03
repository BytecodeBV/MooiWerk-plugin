@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    @php

        if(!is_user_logged_in()){
            wp_redirect(home_url());
        }

        $user = wp_get_current_user();        
        $role = ( array ) $user->roles;

        //disable redirect to this page after login
        if (get_field('logged-in', "user_".$user->ID) == false) {
            update_field('logged-in', true, 'user_'.$user->ID);
        }           
        
        $title = "";

        if(isset($_GET['stage'])){
            $stage = $_GET['stage'];
        } else {
            $stage = 1;
        }

        switch($stage){
            case 1:
                $options = array(
                    'post_id' => 'user_'.$user->ID,
                    'id' => 'stage-1',
                    'form' => false,                                       
                    'fields' => array(
                        'field_5b7ee8f6950e7', //logo
                        'field_5b7eea1a950e9', //name
                        'field_5b7eec577da37', //phone
                        'field_5b7eea36950ea', //address
                        'field_5b7eea5e950eb', //postcode
                        'field_5b7eea9a950ec', //place
                        'field_5b7eeac7950ed', //website
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = "Organisatie informatie";
                break;
            case 2:
                $options = array(
                    'post_id' => 'user_'.$user->ID,
                    'id' => 'stage-2',
                    'form' => false,                                       
                    'fields' => array(
                        'field_5b7ee9fb950e8', //profile_pic
                        'field_5b7eec737da38', //bio
                        'field_5b7eecca7da39', //show in search
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = "Uitgebreide informatie";
                break;
            case 3:
                $options = array(
                    'post_id' => 'user_'.$user->ID,
                    'id' => 'stage-3',
                    'form' => false,                                       
                    'fields' => array(
                        'field_5b7eed557da3a', //category
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = "Categorie";
                break;
            case 4:
                $options = array(
                    'post_id' => 'user_'.$user->ID,
                    'id' => 'stage-4',
                    'form' => false,                                       
                    'fields' => array(
                        'field_5b7eeb458880a', //facebook
                        'field_5b7eeb578880b', //twitter
                        'field_5b7eeb668880c', //linkedin
                        'field_5b7eeb838880d', //instagram
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = "Social Media";
                break;
        }

    @endphp
    <section @php post_class() @endphp>
        <div class="page__body container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1>{{$title}}</h1>                   
                    <div id="organisation-profile">
                        <form id="acf-form" class="acf-form" action="" method="post">
                            {!! acf_form( $options ) !!}
                            <div class="acf-form-submit">
                                <input type="submit" class="acf-button" value="Update"><span class="acf-spinner"></span>			
                            </div>
                        </form>
                        <a href="{{home_url('/mijn-account')}}">Profielregistratie verlaten?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
