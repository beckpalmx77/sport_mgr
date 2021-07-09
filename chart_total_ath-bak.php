<?php
$con = mysqli_connect("localhost", "sadmin", "sadmin", "sport_mgr_dbs") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT SportName,Total FROM v_student_sport_quantity order by id ";
$result = mysqli_query($con, $query);
$resultchart = mysqli_query($con, $query);


//for chart
$datesave = array();
$Total = array();

while ($rs = mysqli_fetch_array($resultchart)) {
    $SportName[] = "\"" . $rs['SportName'] . "\"";
    $Total[] = "\"" . $rs['Total'] . "\"";
}
$SportName = implode(",", $SportName);
$Total = implode(",", $Total);

?>

<!--h3 align="center">สรุปจำนวนนักกีฬาตามประเภทต่างๆ</h3-->
<!--table width="200" border="1" cellpadding="0"  cellspacing="0" align="center">
    <thead>
    <tr>
        <th width="10%">ปี</th>
        <th width="10%">ยอดขาย</th>
    </tr>
    </thead>

    <?php while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td align="center"><?php echo $row['SportName']; ?></td>
            <td align="right"><?php echo number_format($row['Total'], 2); ?></td>
        </tr>
    <?php } ?>

</table-->

<?php mysqli_close($con); ?>

<p align="center">

    <!--devbanban.com-->

    <!--canvas id="myChart" width="800px" height="300px"></canvas-->
<div class="container-fluid">
        <div class="chart-container" style="position: relative; height:45vh; width:65vw">
            <canvas id="myChart"></canvas>
        </div>
</div>

</p>


<script type="text/javascript" src="vender/customjs/chart_293.js"></script>
<!--canvas style="height:40vh; width:80vw"></canvas-->
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $SportName;?>
            ],
            datasets: [{
                label: 'สรุปนักกีฬาตามประเภท (จำนวนคน)',
                data: [<?php echo $Total; ?>
                ],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.2)',
                    'rgba(255, 0, 0, 0.2)',
                    'rgba(255, 255, 0, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(255, 255, 0, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


