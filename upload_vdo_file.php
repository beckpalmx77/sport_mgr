<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>New webpage</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <script type="text/javascript">
        window.onload = function(){
            var fm = document.getElementsByTagName('form')[0];
            fm.onsubmit = function(evt){
                //① Collect form information FormData
                var fd = new FormData(this);
                //② Ajax transfers the form information to the server
                var xhr = new XMLHttpRequest();

                //console.log(xhr);
                //Perceive the attachment upload situation through the xhr.upload.onprogress event, and trigger the onprogress event every 100 milliseconds
                xhr.upload.onprogress = function(event){
                    //Perceive the attachment upload situation through the event object event
                    //console.log(event);//output once every 100ms or so
                    //Get the ratio of the uploaded size to the total size
                    var loaded = event.loaded; //The size that has been uploaded
                    var total = event.total; //Total size
                    var per = Math.floor((loaded/total)*100)+"%"; //Upload percentage
                    //Set the upload percentage to id=son style width width
                    document.getElementById('son').innerHTML = per;
                    document.getElementById('son').style.width = per;
                }

                xhr.onreadystatechange = function(){
                    if(xhr.readyState==4){
                        alert(xhr.responseText);
                    }
                }
                xhr.open('post','./process_upload_file.php');
                xhr.send(fd);

                evt.preventDefault(); //Prevent the browser form submission action
            }
        }
    </script>
    <style type="text/css">
        #pat {width:450px; height:35px; border:5px solid blue;}
        #son {width:0; height:100%; background-color:lightblue;}
    </style>
</head>
<body>
<h2>Uploading large attachment progress bar settings</h2>
<form method="post" action="">
    <p>User name: <input type="text" id="username" name="mingzi" /></p>
    <p>Password: <input type="password" id="userpwd" name="mima" /></p>
    <p>Email: <input type="text" id="useremail" name="youxiang" /></p>
    <div id="pat"><div id="son"></div></div>
    <p>Media file: <input type="file" id="userpic" name="touxiang" /></p>
    <p><input type="submit" value="register" /></p>
</form>
</body>
</html>