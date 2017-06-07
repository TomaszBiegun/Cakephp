<div>
    <canvas id="results-chart" height="250" width="600" data-goal="<?php echo $goal; ?>"></canvas>
</div>

<script>
    //przypisać wartość , która użytkownik chce otrzymać
    var os_x = null;


    var myGoal = $('#results-chart').data('goal');

    var randomScalingFactor = function () {
        //randomowe BMI dla przykladu wykresu (zakres 18-30)
        return Math.round((Math.random() * (30 - 18)) + 18)
    };

    Chart.types.Line.extend({
        name: "LineAlt",
        initialize: function (data) {
            console.log('Bar chart extension to add red line');
            Chart.types.Line.prototype.initialize.apply(this, arguments);
        },
        draw: function () {
            Chart.types.Line.prototype.draw.apply(this, arguments);
            this.chart.ctx.beginPath();
            this.chart.ctx.lineWidth = 2;
            this.chart.ctx.moveTo(this.scale.calculateX(0), this.scale.calculateY(myGoal));
            this.chart.ctx.lineTo(this.scale.calculateX(myLine.datasets[0].points.length - 1), this.scale.calculateY(myGoal));
            this.chart.ctx.strokeStyle = "rgba(255,0,0,0.4)";
            this.chart.ctx.stroke();
            this.chart.ctx.font = "bold 20px Alegreya Sans', sans-serif";
            this.chart.ctx.fillStyle = "rgba(255,0,0,0.6)";
            this.chart.ctx.fillText("Twój cel", 100, this.scale.calculateY(myGoal) + 10);
        }
    });

    var lineChartData = {
            labels: ["1 Sty", "2 Sty", "3 Sty", "4 Sty", "5 Sty", "6 Sty", "7 Sty", "8 Sty", "9 Sty", "10 Sty", "11 Sty", "12 Sty", "13 Sty", "14 Sty"],
            datasets: [
                {
                    label: "Moja waga",
                    fillColor: "rgba(115, 195, 63,0.08)",
                    strokeColor: "rgba(115, 195, 63,1)",
                    pointColor: "rgba(115, 195, 63,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [65, 65, 65, 64, 64, 64, 64, 63, 63, 63, 62, 62, 61]
//                                            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                },
                {
                    label: "Moja bmi",
                    fillColor: "rgba(220,220,220,0.1)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                }
            ],


        }
        ;


    window.onload = function () {

        $.ajax({
            type: "POST",
            url: "/users/get_chart_data",
            dataType: "json",
            error: function (response) {
            }

            ,
            success: function (response) {
                lineChartData.labels = response['x'];
                lineChartData.datasets[0].data = response['weights'];
                lineChartData.datasets[1].data = response['bmis'];


                var ctx = document.getElementById("results-chart").getContext("2d");
                window.myLine = new Chart(ctx).LineAlt(lineChartData, {
                    responsive: true,
                    animation: true,
                    maintainAspectRatio: false,
                    multiTooltipTemplate: "<%= datasetLabel %>:  <%= value %>",
                    tooltipTemplate: function (valuesObject) {
                        console.log(valuesObject);
                        // do different things here based on whatever you want;

                        var label = valuesObject.label
                        var objLen = label.length;
                        // 111-1
                        var string = label.substring(0, objLen - 2);

                        console.log(string);

                        return "Order nr: " + string;
                    }
                });
            }
            ,
            done: function (response) {
            }
        });


    }


</script>