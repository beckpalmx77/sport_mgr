<?php

//echo strtotime("now");

$password=md5("admin");

echo "Encode Display : " . $password;

?>

<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery/jquery-2.2.4.min.js"></script>

<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='date' class="form-control"  data-date-language="th-th"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({
                    locale: 'th'
                });
            });
        </script>
    </div>
</div>