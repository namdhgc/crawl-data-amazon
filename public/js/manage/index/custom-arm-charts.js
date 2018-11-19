var ChartsAmcharts = function() {

    var callbackLoadDataAnalyticsTotalEnergy = function(resutls) {

       var $data ;
       if(resutls.meta.success && resutls.response.length > 0) {

           $data = resutls.response;
       }
       
    
       var chart = AmCharts.makeChart("chart_transaction", {

           "type": "serial",
           "theme": "light",

           "fontFamily": 'Open Sans',
           "color":    '#888888',

           "legend": {
               "equalWidths": false,
               "useGraphSettings": true,
               "valueAlign": "left",
               "valueWidth": 120
           },
           "dataProvider": $data,
           "valueAxes": [{
               "id": "purchaseAxis",
               "axisAlpha": 0,
               "gridAlpha": 0,
               "position": "left",
               "title": "Tong don hang"
           },{
               "id": "usedAxis",
               "axisAlpha": 0,
               "gridAlpha": 0,
               "position": "right",
               "title": "don hang thanh cong"
           }],
           "graphs": [{
               "alphaField": "alpha",
               "balloonText": "[[value]] ",
               "dashLengthField": "dashLength",
               "fillAlphas": 0.7,
               "legendPeriodValueText": ": [[value.sum]] ",
               "legendValueText": "[[value]] ",
               "title": "Tong don hang",
               "type": "column",
               "valueField": "total",
               "valueAxis": "purchaseAxis"
           }, {
               "bullet": "square",
               "bulletBorderAlpha": 1,
               "bulletBorderThickness": 1,
               "dashLengthField": "dashLength",
               "legendValueText": "[[value]]",
               "title": "Don hang thanh cong",
               "fillAlphas": 0,
               "valueField": "success",
               "valueAxis": "usedAxis"
           }],
           "chartCursor": {
               "categoryBalloonDateFormat": "DD",
               "cursorAlpha": 0.1,
               "cursorColor": "#000000",
               "fullWidth": true,
               "valueBalloonsEnabled": false,
               "zoomable": false
           },
           "dataDateFormat": "YYYY-MM-DD",
           "categoryField": "date",
           "categoryAxis": {
               "dateFormats": [{
                   "period": "DD",
                   "format": "DD"
               }, {
                   "period": "WW",
                   "format": "MMM DD"
               }, {
                   "period": "MM",
                   "format": "MMM"
               }, {
                   "period": "YYYY",
                   "format": "YYYY"
               }],
               "parseDates": true,
               "autoGridCount": false,
               "axisColor": "#555555",
               "gridAlpha": 0.1,
               "gridColor": "#FFFFFF",
               "gridCount": 50
           },
           "exportConfig": {
               "menuBottom": "20px",
               "menuRight": "22px",
               "menuItems": [{
                   "format": 'png'
               }]
           }
       });
   }
    

    return {
        //main function to initiate the module

        init: function(data) {

            var url = $('#chart_transaction').attr('data-url');
            Spr.ajaxDefault(url, {}, callbackLoadDataAnalyticsTotalEnergy,".block-main");         
        }

    };

}();
