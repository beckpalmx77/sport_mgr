$(document).ready(function () {
    showTotalGraph();
});

function showTotalGraph(){{
    // This is the database.php file we created earlier, its JSON output will be processed in this function
    $.post("database.php",
        function (data){
            console.log(data);
            // Declare the variables for your graph (for X and Y Axis)
            var formStatusVar = []; // X Axis Label
            var total = []; // Value and Y Axis basis

            for (var i in data) {
                // formStatus is taken from JSON output (see above)
                formStatusVar.push(data[i].formStatus);
                total.push(data[i].total);
            }

            var options = {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: true
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            var chartdata = {
                labels: formStatusVar,
                datasets: [
                    {
                        label: 'Total',
                        backgroundColor: '#7B7979',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: total
                    }
                ]
            };

            //This is the div ID (within the HTML content) where you want to display the chart
            var graphTarget = $("#bar-chartcanvas");
            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata,
                options: options
            });
        });
}}