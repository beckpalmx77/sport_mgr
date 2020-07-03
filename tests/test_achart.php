<?php

$dataPoints = array(
    array("label"=> "WordPress", "y"=> 60.0),
    array("label"=> "Joomla", "y"=> 6.5),
    array("label"=> "Drupal", "y"=> 4.6),
    array("label"=> "Magento", "y"=> 2.4),
    array("label"=> "Blogger", "y"=> 1.9),
    array("label"=> "Shopify", "y"=> 1.8),
    array("label"=> "Bitrix", "y"=> 1.5),
    array("label"=> "Squarespace", "y"=> 1.5),
    array("label"=> "PrestaShop", "y"=> 1.3),
    array("label"=> "Wix", "y"=> 0.9),
    array("label"=> "OpenCart", "y"=> 0.8)
);

echo json_encode($dataPoints);

?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "CMS Market Share - 2017"
                },
                axisY: {
                    suffix: "%",
                    scaleBreaks: {
                        autoCalculate: true
                    }
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0\"%\"",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>