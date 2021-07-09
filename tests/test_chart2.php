<?php
ini_set('display_errors', 1);
error_reporting(~0);

$serverName = "localhost";
$userName = "sadmin";
$userPassword = "sadmin";
$dbName = "sport_mgr_dbs";

$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
$sql = "SELECT * from  v_student_sport_quantity order by id ";

$conn -> set_charset("utf8");

$query = mysqli_query($conn,$sql);
if (!$query) {
    printf("Error: %s\n", $conn->error);
    exit();
}
$resultArray = array();
while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
{
    array_push($resultArray,$result);
}
mysqli_close($conn);

$dataPoints = json_encode($resultArray,JSON_UNESCAPED_UNICODE);

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
