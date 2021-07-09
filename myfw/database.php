<?php

//declare variables for db connection
$servername = "localhost";
$username = "sadmin";
$password = "sadmin";
$dbname = "sport_mgr_dbs";

//db connection
$conn = new mysqli($servername, $username, $password, $dbname);

//error handling
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//sql statement to run
$sql = "SELECT SportName,Total from  v_student_sport_quantity order by id ";

//run sql query and store into variable
$result = mysqli_query($conn,$sql);
$data = array();

foreach ($result as $row) {
    $data[] = $row;
}

//free memory and close db connection
$result->close();
$conn->close();

// IMPORTANT, output to json
echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>