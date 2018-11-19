@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
	<script src="{{ URL::asset('fado/mobile/js/faqs-block.js') }}" type="text/javascript"></script>
	<!-- <script src="{{ URL::asset('fado/mobile/js/script.js') }}" type="text/javascript"></script> -->
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">Câu hỏi tổng quan</h1>
            </a>
        </div>
    </div>
</section>

<section class="faqs-block js-faqs-block">
    <div class="block-main">
    	<?php $i = 0; ?>
        @if(isset($data))
            @foreach($data['data']['response'] as $key => $item)
            <?php $i++; ?>
            <div class="faq-panel">
			    <div class="panel-head">
			        <div class="icon">
			        	<i class="fa">{{ $i }}</i>
			        </div>
			        <div class="text">
			            {{ $item->question  }}
			        </div>
			    </div><!-- .panel-head -->

			    <div class="panel-main" style="display: none;">
			        {{ $item->answer }}
			    </div>
			</div>
            @endforeach
        @endif
    </div>
</section>
@endsection