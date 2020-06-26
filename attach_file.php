<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"
      prefix="og: http://ogp.me/ns#" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>

    <link rel="shortcut icon" href="https://learncodeweb.com/demo/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="vender/attachfiles/css/style.css" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="ml-2 col-sm-4">
            <div id="msg"></div>
            <form method="post" id="image-form" enctype="multipart/form-data" onSubmit="return false;">

                <div class="form-group">
                    <label for="default"
                           class="input-group my-3">ประเภทเอกสาร/ภาพถ่าย</label>

                    <div class="col-sm-10">
                        <select name="class" class="form-control" id="class">
                            <option value="">เลือก ประเภทเอกสาร/ภาพถ่าย</option>
                            <?php $sql = "SELECT * from tbldoctype";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <option
                                        value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->document_type_name); ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <input type="file" name="file" class="file">

                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file">

                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Browse...</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Upload" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>


<!--Only these JS files are necessary-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script>
    $(document).on("click", ".browse", function () {
        var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });


    $(document).ready(function (e) {
        $("#image-form").on("submit", function () {
            $("#msg").html('<div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please wait...!</div>');
            $.ajax({
                type: "POST",
                url: "vender/attachfiles/ajax/action.ajax.php",
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data) {
                    if (data == 1 || parseInt(data) == 1) {
                        $("#msg").html(
                            '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Data updated successfully.</div>'
                        );
                    } else {
                        $("#msg").html(
                            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Extension not good only try with <strong><?php $data?> GIF, JPG, PNG, JPEG</strong>.</div>'
                        );
                    }
                },
                error: function (data) {
                    $("#msg").html(
                        '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong.</div>'
                    );
                }
            });
        });
    });
</script>
</body>
</html>