@extends('frontend.layouts.master')
@section('content')
        <!-- Tranding news  carousel-->
        @include('frontend.components.tranding-news')

        <!-- End Tranding news carousel -->
    
        <!-- start slider news-->
        <section>
            @include('frontend.components.hero')
        </section>
        <!-- End slider news -->
    
        <div class="large_add_banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="large_add_banner_img">
                            <img src="{{ asset('frontend/assets') }}/images/placeholder_large.jpg" alt="adds">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Popular news category -->
    
        @include('frontend.components.main')
        <!-- End Popular news category -->
@endsection