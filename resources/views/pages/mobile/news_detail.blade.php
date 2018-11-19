@extends('layouts/mobile/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="{{ URL::Route('web-get-news') }}">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">Tin tức</h1>
            </a>
        </div>
    </div>
</section>

<section class="news-detail-block">
    <div class="block-main">
    	@if(isset($data))
            @foreach($data['data']['response'] as $key => $item)
        		<div class="date">{{ gmdate("Y-m-d", $item->created_at) }}</div>
        		<div class="content editor-content">
		            <div style="text-align:justify;">
						<?php echo $item->description; ?>
		            </div>
		        </div>
            @endforeach
        @endif
    </div>
</section>

@endsection