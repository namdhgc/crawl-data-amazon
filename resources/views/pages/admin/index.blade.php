@extends('layouts/admin/master')

@section('title')

    <title> {{ Lang::get('menu.dashboard') }} </title>
@endsection

@section('css')
    <!-- <link href="{{ URL::asset('assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" /> -->
    <link href="{{ URL::asset('assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ URL::asset('assets/pages/scripts/charts-amcharts.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('js/manage/index/custom-arm-charts.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ URL::asset('assets/pages/scripts/charts-echarts.min.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('js/manage/index/custom-charts-echarts.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        ChartsAmcharts.init();
        ChartsEcharts.init();
        
    </script>

@endsection

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Bảng điều khiển
                <small>bảng điều khiển & thống kê</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Bảng điều khiển</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Bảng điều khiển</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <!-- BEGIN DASHBOARD STATS 1-->

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        @if(isset($feedBack_pending))
                            <span id="feed-back-pending" data-counter="counterup" data-value-request="{{ $feedBack_pending['data']->total }}">{{ $feedBack_pending['data']->total }}</span>
                        @endif
                    </div>
                    <div class="desc"> Phản hồi mới </div>
                </div>
                <a class="more" href="{{ URL::Route('auth-get-feedback') }}"> Xem thêm
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        @if(isset($request_pending))
                            <span id="request-pending" data-counter="counterup" data-value-request="{{ $request_pending['data']->total }}">{{ $request_pending['data']->total }}</span>
                        @endif
                    </div>
                    <div class="desc"> Tổng số lượng yêu cầu báo giá </div>
                </div>
                <a class="more" href="{{ URL::Route('auth-get-price-request-management') }}"> Xem thêm
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        @if(isset($pending))
                            <span id="order-pending" data-counter="counterup" data-value-order="{{ $pending['data']->total }}">{{ $pending['data']->total }}</span>
                        @endif
                    </div>
                    <div class="desc"> Đơn hàng mới </div>
                </div>
                <a class="more" href="{{ URL::Route('auth-get-transaction') }}"> Xem thêm
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number"> 
                        <span data-counter="counterup" data-value="{{ $total_user }}"></span>{{ $total_user }}</div>
                    <div class="desc"> Tổng số thành viên</div>
                </div>
                <a class="more" href="javascript:;"> Xem thêm
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-haze"></i>
                        <span class="caption-subject bold uppercase font-green-haze"> Biểu đồ</span>
                        <span class="caption-helper">Giá trị trên trục thời gian</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="fullscreen"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_transaction" data-url="{{ URL::Route('auth-post-data-chart') }}" class="chart" style="height: 400px;"> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN : ECHARTS -->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Biểu đồ</span>
                        <span class="caption-helper">Thực thu / Tổng doanh thu theo tháng</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-cloud-upload"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="echarts_bar" data-url="{{ URL::Route('auth-post-data-chart-money') }}" style="height:500px;"></div>
                </div>
            </div>
            <!-- END : ECHARTS -->
        </div>
    </div>



        <!--[if lt IE 9]>
<script src="{{ URL::asset('assets/global/plugins/respond.min.js"></script>
<script src="{{ URL::asset('assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
@endsection