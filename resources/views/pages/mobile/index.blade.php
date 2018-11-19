@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
@endsection


@section('content')

    <!-- start home-slider-block -->  
    @include('layouts.mobile.home_slider_block')   
    <!-- end home-slider-block -->     

    
    <!-- start home-list_cate-block -->   
    @include('layouts.mobile.home_list_cate_block')  
    <!-- end home-list_cate-block -->     

    <!-- start home-feature-block -->
    @include('layouts.mobile.home_feature_block')
    <!-- end home-feature-block -->

    
    <!-- start home-promotion-block -->
    @include('layouts.mobile.home_promotion_block')
    <!-- end home-promotion-block -->


    <!-- start home-cate-block -->
    @include('layouts.mobile.home_cate_block')
    <!-- end home-cate-block -->


    <!-- start home-cate-hidden-wrap  -->
    @include('layouts.mobile.home_cate_hidden_wrap')
    <!-- End home-cate-hidden-wrap -->

    <!-- start home-view-all-cate -->
    
    <!-- End home-view-all-cate -->



    <!-- start home-multi-cate-block -->
    @include('layouts.mobile.home_multi_cate_block')
    <!-- End home-multi-cate-block -->

@endsection