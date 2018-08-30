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
                            <div id="organisation-profile">
                                <form id="acf-form" class="acf-form" action="" method="post">
                                    @php 
                                    $options = array(
                                        'post_id' => 'user_'.$user->ID,
                                        'form' => false,                                       
                                        'fields' => array(
                                            'field_5b7ee8f6950e7', //logo
                                            'field_5b7ee9fb950e8', //profile_pic
                                            'field_5b7eea1a950e9', //name
                                            'field_5b7eea36950ea', //address
                                            'field_5b7eea5e950eb', //postcode
                                            'field_5b7eea9a950ec', //place
                                            'field_5b7eeac7950ed', //website
                                            'field_5b7eeb458880a', //facebook
                                            'field_5b7eeb578880b', //twitter
                                            'field_5b7eeb668880c', //linkedin
                                            'field_5b7eeb838880d', //instagram
                                        ),
                                        'html_before_fields' => '',
                                        'html_after_fields' => '',
                                    );
                                    @endphp
                                    {!! acf_form( $options ) !!}
                                    <div class="acf-form-submit">
                                        <input type="submit" class="acf-button button button-primary button-large" value="Update"><span class="acf-spinner"></span>			
                                    </div>
                                </form>
                            </div>
                        @elseif($role[0] == 'volunteer')
                            <div id="volunteer-profile">
                                <form id="acf-form" class="acf-form" action="" method="post">
                                    @php $options = array(
                                        'post_id' => 'user_'.$user->ID,
                                        'form' => false, 
                                        'fields' => array(
                                            'field_5b7ef0fd9487f', //profile_image
                                            'field_5b7ef13794880', //first-name
                                            'field_5b7ef15394881', //initials
                                            'field_5b7ef16094882', //last-name
                                            'field_5b7ef19394884', //telephone                                            
                                            'field_5b7ef21994886', //age
                                            'field_5b7ef4639488e', //bio
                                            'field_5b7eeb458880a', //facebook
                                            'field_5b7eeb578880b', //twitter
                                            'field_5b7eeb668880c', //linkedin
                                            'field_5b7eeb838880d', //instagram
                                            'field_5b7ef1bf94885', //searchable
                                            'field_5b7ef24e94887', //qualifications
                                            'field_5b7ef28594888', //region
                                            'field_5b7ef2f894889', //frequency
                                            'field_5b7ef3339488a', //availability
                                            'field_5b7ef39d9488b', //interest
                                            'field_5b7ef3fc9488c', //competency
                                            'field_5b7ef4229488d', //preference
                                        ),
                                        'html_before_fields' => '',
                                        'html_after_fields' => '',
                                    );
                                    @endphp
                                    {!! acf_form( $options ) !!}
                                    <div class="acf-form-submit">
                                        <input type="submit" class="acf-button button button-primary button-large" value="Update"><span class="acf-spinner"></span>			
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="member-page__message alert alert-dark" role="alert">Uw account is geen vrijwilliger of organisatie.</div>
                        @endif
                    @else
                        <div class="member-page__message alert alert-dark" role="alert">Je moet ingelogd zijn om deze pagina te bekijken.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
