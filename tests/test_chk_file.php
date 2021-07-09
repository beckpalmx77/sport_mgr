<script>
    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML = '<ul>'+children+'</ul>';
    }
</script>

<form>
<input type="file" multiple
       name="file"
       id="file"
       onchange="javascript:updateList()" />
<p>Selected files:</p>
<div id="fileList"></div>
</form>