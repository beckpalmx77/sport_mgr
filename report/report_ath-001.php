<style>
    body {
        font-family: sarabun;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<?php

require_once('../includes/config.php');

//เรียกใช้ไฟล์ autoload.php ที่อยู่ใน Folder vendor
use Mpdf\Mpdf;
require_once '../vendor/autoload.php';

if ($_POST["subject"] != "-") {
    $where = " WHERE RollId like '" . $_POST["rollid"] . "%'";
} else {
    $where = "";
}

//ตั้งค่าการเชื่อมต่อฐานข้อมูล
//$conn = getDbInstance();
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($conn, "utf8");



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT tblstudents.*
,(select tblsporttype.SportName from tblsporttype where tblsporttype.id = tblstudents.sport_type1) as SportName1
from tblstudents ";

$result = mysqli_query($conn, $sql);
$content = "";
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while($row = mysqli_fetch_assoc($result)) {
        $content .= '<tr style="border:1px solid #000;">
                <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="10%">'.$row['RollId'].'</td>
                <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="10%">'.$row['FirstName'].' ' . " " .$row['LastName'].'</td>
                <td  style="border-right:1px solid #000;padding:4px;text-align:left;"  width="10%">'.$row['Class_Education'].'</td>
                <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">'.$row['DOB'].'</td>
                <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">'.$row['SportName1'].'</td>

            </tr>';
        $i++;
    }
}

mysqli_close($conn);

$mpdf = new mPDF();

$head = '
<style>
    body{
        font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
    }
</style>

<h2 style="text-align:center">รายงานผลคะแนนนักเรียน</h2>
 
<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;" repeat_header="1">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">รหัสประจำตัว</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="30%">ชื่อ - นามสกุล</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ระดับการศึกษา</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">วันเกิด</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">ประเภทกีฬา</td>
    </tr>
 
</thead>
    <tbody>';

$end = "</tbody>
</table>";

$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();