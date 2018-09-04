{{--
  Template Name: Bewerk Vacature
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
                        @endphp
                        @if(isset($_GET['id']))
                            @php
                                $author_id = get_post_field('post_author',$_GET['id']);
                            @endphp
                            @if($user->ID == $author_id)
                                @if(isset($_GET['trash']) && $_GET['trash'] == 'true')
                                    @php wp_trash_post($_GET['id']); @endphp
                                    <div class="member-page__message alert alert-success" role="alert">
                                        Post deleted!
                                    </div>
                                @else
                                    <div id="edit-vacancy-form">
                                    @php 
                                        $options = array(
                                            'post_id' => $_GET['id'],
                                            'post_title' => true,
                                            'post_content' => true,
                                            'fields' => array(
                                                'field_5b7ef8e109d65', //region
                                                'field_5b7ef92009d66', //frequency
                                                'field_5b7ef96709d67', //period
                                                'field_5b7ef9ba09d68' , //categories
                                                'field_5b7ef9f609d69', //competency
                                                'field_5b7efa5509d6a', //target
                                                'field_5b7efab409d6b', //requirements
                                                'field_5b7efb4209d6c', //compensation
                                                'field_5b7efba009d6d', //date
                                            ),
                                            'new_post'		=> array(
                                                'post_type'		=> 'vacancies',
                                                'post_status'	=> 'publish' // You could change the status to a custom review status here
                                            )
                                        );
                                    @endphp
                                    {!! acf_form( $options ) !!}
                                    </div>
                                @endif
                            @else
                                <div class="member-page__message alert alert-dark" role="alert">Uw account: {{$user->ID}} is niet de eigenaar {{$author_id}} van deze vacature.</div>
                            @endif
                        @else
                            <div class="member-page__message alert alert-dark" role="alert">Geen vacature geselecteerd</div>
                        @endif
                    @else
                        <div class="member-page__message alert alert-dark" role="alert">Je moet ingelogd zijn om deze pagina te bekijken.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
