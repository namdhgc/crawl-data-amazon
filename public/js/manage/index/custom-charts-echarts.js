var ChartsEcharts = function() {

    var callbackLoadDataAnalyticsMoney = function(resutls) {

        // ECHARTS
        require.config({
            paths: {
                echarts: '../assets/global/plugins/echarts/'
            }
        });

        // DEMOS
        require(
            [
                'echarts',
                'echarts/chart/bar',
                'echarts/chart/chord',
                'echarts/chart/eventRiver',
                'echarts/chart/force',
                'echarts/chart/funnel',
                'echarts/chart/gauge',
                'echarts/chart/heatmap',
                'echarts/chart/k',
                'echarts/chart/line',
                'echarts/chart/map',
                'echarts/chart/pie',
                'echarts/chart/radar',
                'echarts/chart/scatter',
                'echarts/chart/tree',
                'echarts/chart/treemap',
                'echarts/chart/venn',
                'echarts/chart/wordCloud'
            ],
            function(ec) {
                //--- BAR ---
                var myChart = ec.init(document.getElementById('echarts_bar'));

                var array_month         = [];
                var array_total_amount  = [];
                var array_amount_paid   = [];

                if ( resutls['response'] != null  ) {

                    $.each( resutls['response'], function(key, value) {

                        array_month.push(value['month']);
                        array_total_amount.push(value['total_amount']);
                        array_amount_paid.push(value['amount_paid']);
                    });
                }

                myChart.setOption({
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: ['Doanh thu', 'Thực thu']
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            mark: {
                                show: false
                            },
                            dataView: {
                                show: false,
                                readOnly: false
                            },
                            magicType: {
                                show: false,
                                type: ['line', 'bar']
                            },
                            restore: {
                                show: false
                            },
                            saveAsImage: {
                                show: false
                            }
                        }
                    },
                    calculable: true,
                    xAxis: [{
                        type: 'category',
                        data: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12']
                    }],
                    yAxis: [{
                        type: 'value',
                        splitArea: {
                            show: true
                        }
                    }],
                    series: [{
                        name: 'Doanh thu',
                        type: 'bar',
                        data: array_total_amount
                    }, {
                        name: 'Thực thu',
                        type: 'bar',
                        data: array_amount_paid
                    }]
                });
            }
        );
    }


    return {
        //main function to initiate the module

        init: function(data) {

            var url = $('#echarts_bar').attr('data-url');
            Spr.ajaxDefault(url, {}, callbackLoadDataAnalyticsMoney,".block-main");
        }

    };

}();