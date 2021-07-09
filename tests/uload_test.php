<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div class="col-xs-12">
    <progress style="width:50%" value="0" max="100" id="progBar">
    	<span id="calcProgress">
        	<!-- Fallback goes here -->
    	</span>
    </progress>
</div>

<div id="progUpdate" class="col-xs-12">
    <!-- Success Message -->
</div>

<script type="text/javascript">

    var counter = 0;
    var rounds = [0, 1];
    var cityNames = ["New York", "Chicago", "Dalas"];
    var poi = ["Musuem", "Library", "Park", "Office"];
    totalCases = rounds.length * cityNames.length * poi.length;

    function myFunction() {
        var roundIndex = parseInt(counter/(cityNames.length * poi.length))
        var cityIndex = parseInt((counter/poi.length)%cityNames.length);
        var poiIndex = parseInt(counter%poi.length);

        // do stuff


        counter++;
        var progress = 	((counter/totalCases)* 100).toFixed(1);

        console.log("Round " + rounds[roundIndex] + "> " + cityNames[cityIndex] + " " + poi[poiIndex]);


        $('#progUpdate').empty().append("(" + progress + "%) Round " + rounds[roundIndex] + "> " + cityNames[cityIndex] + " " + poi[poiIndex]);
        $('#progBar').val((counter/totalCases) * 100);


        if (counter < totalCases) {

            setTimeout(myFunction, 100);
        }
    };

    myFunction();
</script>