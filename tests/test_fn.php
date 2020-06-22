<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#myDropDown').change(function(){
                //Selected value
                var inputValue = $(this).val();
                alert("value in js "+inputValue);

                //Ajax for calling php function
                $.post('../myfw/myquery.php', { dropdownValue: inputValue }, function(data){
                    alert('ajax completed. Response:  '+data);
                    document.getElementById("sort").value = data;
                    //do after submission operation in DOM
                });
            });
        });
    </script>
</head>
<body>
<select id="myDropDown">
    <option value='' disabled selected>Select Data</option>
    <option value='M001'>Main 1</option>
    <option value='M002'>Main 2</option>
    <option value='M003'>Main 3</option>
</select>
<input type="text" id="sort" value="">

</body>
</html>


