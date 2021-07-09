$(function() {
    $.ajax({

        url: ' http://localhost:8888/sport_mgr/tests/chart/chart_data.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "สรุปจำนวนนักกีฬาตามประเภทต่างๆ",
                "xAxisName": "ประเภทกีฬา",
                "yAxisName": "จำนวน",
                "rotatevalues": "1",
                "theme": "Zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '800',
                height: '600',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
});