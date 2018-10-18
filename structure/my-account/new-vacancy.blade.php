@extends('layouts.user')

@section('content')
    @include('partials.page-header')
    @php
        if(!is_user_logged_in()){
            wp_redirect(home_url());
            exit;
        }

        $user = wp_get_current_user();        
        $role = ( array ) $user->roles;

        if($role[0] != 'organisation') {
            wp_redirect(home_url('/mijn-account'));
            exit;
        }          
        
        $title = "";

        if(isset($_GET['stage'])){
            $stage = $_GET['stage'];
        } else {
            $stage = 1;
        }

        if(isset($_GET['post'])){
            $id = $_GET['post'];
        } else {
            $id = 'new_post';
        }

        switch($stage){
            case 1:
                $options = array(
                    'id' => 'new-vacancy-'.$stage,
                    'form' => false, 
                    'post_id' => $id,
                    'post_title'	=> true,
                    'post_content'	=> true,                                      
                    'fields' => array(
                        'field_5b7ef8e109d65', //region
                        'field_5b7ef92009d66', //frequency
                        'field_5bb63cbfae382', //period
                        'field_5b7ef9ba09d68' , //categories
                        'field_5b7ef9f609d69', //competency
                        'field_5b7efba009d6d', //date
                        'field_5bc8a669b23c2', //status
                    ),
                    'new_post'	=> array(
                        'post_type'		=> 'vacancies',
                        'post_status'	=> 'publish' // You could change the status to a custom review status here
                    )
                );
                $title = __("Nieuwe Vacature", 'mooiwerk');
                break;
            case 2:
                $options = array(
                    'post_id' => $id,
                    'id' => 'new-vacancy-'.$stage,
                    'form' => false,                                       
                    'fields' => array(                        
                        'field_5b7efa5509d6a', //target
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = __('Doelgroep', 'mooiwerk');
                break;
            case 3:
                $options = array(
                    'post_id' => $id,
                    'id' => 'new-vacancy-'.$stage,
                    'form' => false,                                       
                    'fields' => array(                        
                        'field_5b7efab409d6b', //requirements
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = __("Benodigde vaardigheden", 'mooiwerk');
                break;
            case 4:
                $options = array(
                    'post_id' => $id,
                    'id' => 'new-vacancy-'.$stage,
                    'form' => false,                                       
                    'fields' => array(                        
                        'field_5b7efb4209d6c', //compensation
                    ),
                    'html_before_fields' => '',
                    'html_after_fields' => '',
                );
                $title = __("Beloning", 'mooiwerk');
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
                                <input type="submit" class="acf-button" value="{{__('Save', 'mooiwerk')}}"><span class="acf-spinner"></span>			
                            </div>
                        </form>
                        @if ($stage != 1)
                            @php
                                $post = get_post($post);
                                //error prone, object might be null
                                $link = home_url('/vacatures/').$post->post_name;
                            @endphp
                            <a href="{{$link}}">{{__('Done', 'mooiwerk')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
