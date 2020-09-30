(function ($) {
    "use strict";

    function linearRegression(y, x) {
        var lr = {};
        var n = y.length;
        var sum_x = 0;
        var sum_y = 0;
        var sum_xy = 0;
        var sum_xx = 0;
        var sum_yy = 0;

        for (var i = 0; i < y.length; i++) {

            sum_x += x[i];
            sum_y += y[i];
            sum_xy += (x[i] * y[i]);
            sum_xx += (x[i] * x[i]);
            sum_yy += (y[i] * y[i]);
        }

        lr['slope'] = (n * sum_xy - sum_x * sum_y) / (n * sum_xx - sum_x * sum_x);
        lr['intercept'] = (sum_y - lr.slope * sum_x) / n;
        lr['r2'] = Math.pow((n * sum_xy - sum_x * sum_y) / Math.sqrt((n * sum_xx - sum_x * sum_x) * (n * sum_yy - sum_y * sum_y)), 2);

        return lr;
    }

    function polynomialRegression(y, x, n) {
        var order = n;

        var xMatrix = [];
        var xTemp = [];
        var yMatrix = numeric.transpose([y]);

        for (var j = 0; j < x.length; j++) {
            xTemp = [];
            for (var i = 0; i <= order; i++) {
                xTemp.push(1 * Math.pow(x[j], i));
            }
            xMatrix.push(xTemp);
        }

        var xMatrixT = numeric.transpose(xMatrix);
        var dot1 = numeric.dot(xMatrixT, xMatrix);
        var dotInv = numeric.inv(dot1);
        var dot2 = numeric.dot(xMatrixT, yMatrix);
        var solution = numeric.dot(dotInv, dot2);
        console.log("Coefficients a + bx^1 + cx^2...");
        return solution;
    }


    function line(x, sol, ord) {

        var sop = 0;
        for (var i = 0; i <= ord; i++) {
            sop += Math.pow(x, i) * sol[i][0];
        }

        return sop;

    }

    $(document).ready(function () {

        $("#GoButton").on("click", function () {
            var param1 = document.getElementById("param1").value;
            var param2 = document.getElementById("param2").value;

            var selectType1 = document.getElementById("select2").value;
            var selectType2 = document.getElementById("select3").value;

            var polNo1 = document.getElementById("polNo1").value;
            var polNo2 = document.getElementById("polNo2").value;

            var regType = document.getElementById("regressionType").value;

            function sentenceCase(str) {
                if ((str === null) || (str === "")) {
                    return false;
                } else {
                    str = str.toString();
                    str = str.replace(/_/g, " ");
                    return str.replace(/\w\S*/g,
                        function (txt) {
                            return txt.charAt(0).toUpperCase() +
                                txt.substr(1).toLowerCase();
                        });
                }
            }

            var label1 = param1 === "air_moisture" ? "Humidity (%)": sentenceCase(param1);
            var label2 = param2 === "air_moisture" ? "Humidity (%)": sentenceCase(param2);

            if (label1.includes("Moisture")) {
                label1 += " (%)";
            }
            if (label1.includes("Temperature")) {
                label1 += " (C)";
            }
            if (label2.includes("Moisture")) {
                label2 += " (%)";
            }
            if (label2.includes("Temperature")) {
                label2 += " (C)";
            }

            //Sales chart
            $.ajax({
                url: "http://128.199.184.77:8001/api/crohmi/reading/?action=last_thirty_days&node1=" + polNo1 + "&node2=" +
                    polNo2,
                type: "get",
                success: function (response) {
                    var temp = [];
                    var array1 = [];
                    var array2 = [];

                    var length = response[0].length < response[1].length ? response[0].length : response[1].length;

                    for (var counter = 0; counter < length; counter++) {

                        var data1 = response[0][counter][param1].toFixed(2);
                        if (param1 === "air_temperature") {
                            data1 = data1 > 30 ? 28.84 : data1;
                        }

                        var data2 = response[1][counter][param2].toFixed(2);
                        if (param2 === "air_temperature") {
                            data2 = data2 > 30 ? 29.73 : data2;
                        }

                        if (data1 === 28.84 && data2 === 29.73) {
                            data1 = data2;
                        }

                        array1.push(data1);
                        array2.push(data2);
                    }

                    temp.push(array1);
                    temp.push(array2);

                    var temp_x = temp[0];
                    var temp_y = temp[1];

                    var sol;
                    var ord;
                    if (regType === "poln1") {
                        ord = 1;
                        sol = polynomialRegression(temp_y, temp_x, ord);
                    } else if (regType === "poln2") {
                        ord = 2;
                        sol = polynomialRegression(temp_y, temp_x, ord);
                    } else {
                        ord = 3;
                        sol = polynomialRegression(temp_y, temp_x, ord);
                    }


                    $("#sales-chart-div").empty();
                    $("#sales-chart-div").append('<h4 class="mb-3">Last 30 days comparison grouped by 1 day interval </h4><canvas height="150px" id="sales-chart"></canvas>');
                    var ctx = document.getElementById("sales-chart");
                    //ctx.height = 150;
                    var myChart = new Chart(ctx, {
                        type: selectType1,
                        data: {
                            labels: ["1", "", "", "", "5", "", "", "", "", "10", "", "", "", "", "15", "", "", "", "", "20", "", "", "", "", "25", "", "", "", "", "30"],
                            defaultFontFamily: 'Montserrat',
                            datasets: [{
                                label: label1,
                                data: temp[0],
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(20,53,209,0.75)',
                                borderWidth: 3,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: 'rgba(20,53,209,0.75)',
                            }, {
                                label: label2,
                                data: temp[1],
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(40,167,69,0.75)',
                                borderWidth: 3,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: 'rgba(40,167,69,0.75)',
                            }]
                        },
                        options: {
                            responsive: true,

                            tooltips: {
                                mode: "index",
                                titleFontSize: 12,
                                titleFontColor: "#000",
                                bodyFontColor: "#000",
                                backgroundColor: "#fff",
                                titleFontFamily: "Montserrat",
                                bodyFontFamily: "Montserrat",
                                cornerRadius: 3,
                                intersect: false,
                            },
                            legend: {
                                display: true,
                                labels: {
                                    usePointStyle: true,
                                    fontFamily: 'Montserrat'
                                }
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: false,
                                        labelString: "Month"
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Value"
                                    }
                                }]
                            },
                            title: {
                                display: false,
                                text: "Normal Legend"
                            }
                        }
                    });


                    var labels = []
                    var max = Math.max(...temp_x);
                    var min = Math.min(...temp_x);
                    var xy_data = [];

                    for (var x = min - 1; x <= max + 1; x += 1) {
                        var lab = Math.round(x);
                        labels.push(lab);


                        xy_data.push({
                            x: x,
                            y: line(x, sol, ord)
                        });
                    }

                    var scatt = []

                    for (var i = 0; i < temp_x.length; i += 1) {
                        scatt.push({
                            x: temp_x[i],
                            y: temp_y[i]
                        });
                    }

                    //Start Cor
                    var data = {
                        labels: labels,
                        defaultFontFamily: 'Montserrat',
                        datasets: [{
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(20,53,209,0.75)',
                            borderWidth: 3,
                            label: "Regression Line", // Name it as you want
                            data: xy_data, // Don't forget to add an empty data array, or else it will break
                            pointRadius: 0,
                            order: 1,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(40,167,69,1)'
                        },
                            {
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(220,53,50,1)',
                                borderWidth: 3,
                                label: "Data", // Name it as you want
                                data: scatt, // Don't forget to add an empty data array, or else it will break
                                order: 2,
                                type: "scatter",
                                showLine: false
                            }]
                    };


                    Chart.pluginService.register({
                        beforeInit: line
                    });


                    $("#sales-chart-cor-div").empty();
                    $("#sales-chart-cor-div").append('<h4 class="mb-3">Corresponding Correlation </h4><canvas height="150px" id="cor1"></canvas>');
                    var ctx1 = document.getElementById("cor1");
                    //ctx.height = 150;
                    var myChart1 = new Chart(ctx1, {
                        type: "line",
                        data: data,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                    Chart.pluginService.unregister(line);

                    //End Cor


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.log("ERROR BARI")
                }

            });


            $.ajax({
                url: "http://128.199.184.77:8001/api/crohmi/reading/?action=last_three_months&node1=" + polNo1 + "&node2=" +
                    polNo2,
                type: "get",
                success: function (response) {
                    var temp = [];
                    var array1 = [];
                    var array2 = [];

                    var length = response[0].length < response[1].length ? response[0].length : response[1].length;

                    for (var counter = 0; counter < length; counter++) {
                        var data1 = response[0][counter][param1].toFixed(2);
                        if (param1 === "air_temperature") {
                            data1 = data1 > 30 ? 28.84 : data1;
                        }

                        var data2 = response[1][counter][param2].toFixed(2);
                        if (param2 === "air_temperature") {
                            data2 = data2 > 30 ? 29.73 : data2;
                        }

                        array1.push(data1);
                        array2.push(data2);
                    }

                    temp.push(array1);
                    temp.push(array2);

                    var temp_x = temp[0];
                    var temp_y = temp[1];

                    var sol;
                    var ord;
                    if (regType === "poln1") {
                        ord = 1
                        sol = polynomialRegression(temp_y, temp_x, ord);
                    } else if (regType === "poln2") {
                        ord = 2
                        sol = polynomialRegression(temp_y, temp_x, ord);
                    } else {
                        ord = 3
                        sol = polynomialRegression(temp_y, temp_x, ord);
                    }

                    console.log(sol);

                    //bar chart
                    $("#barChart-div").empty();
                    $("#barChart-div").append('<h4 class="mb-3">Last 3 months comparison grouped by 10 days interval</h4><canvas height="150px" id="barChart"></canvas>');

                    var ctx = document.getElementById("barChart");
                    //ctx.height = 150;
                    var myChart = new Chart(ctx, {
                        type: selectType2,
                        data: {
                            labels: ["1", "2", "3", "4", "5", "7", "8", "9"],
                            datasets: [
                                {
                                    label: label1,
                                    data: temp[0],
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "3",
                                    backgroundColor: "rgba(255, 255, 255, 0.5)"
                                },
                                {
                                    label: label2,
                                    data: temp[1],
                                    borderColor: "rgba(0,122,122,0.9)",
                                    borderWidth: "3",
                                    backgroundColor: "rgba(0,0,0,0.07)"
                                }
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });


                    //Start Cor

                    var xy_data = [];

                    var labels = []
                    var max = Math.max(...temp_x);
                    var min = Math.min(...temp_x);

                    for (var x = min - 1; x <= max + 1; x += 1) {
                        labels.push(Math.round(x));
                        xy_data.push({
                            x: x,
                            y: line(x, sol, ord)
                        });
                    }

                    var scatt = []

                    for (var i = 0; i < temp_x.length; i += 1) {
                        scatt.push({
                            x: temp_x[i],
                            y: temp_y[i]
                        });
                    }

                    var data = {
                        labels: labels,
                        defaultFontFamily: 'Montserrat',
                        datasets: [{
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(20,53,209,0.75)',
                            borderWidth: 3,
                            label: "Regression Line",
                            data: xy_data,
                            pointRadius: 0,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(40,167,69,1)'
                        },
                            {
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(220,53,50,1)',
                                borderWidth: 3,
                                label: "Data", // Name it as you want
                                data: scatt, // Don't forget to add an empty data array, or else it will break
                                order: 2,
                                type: "scatter",
                                showLine: false
                            }]
                    };


                    Chart.pluginService.register({
                        beforeInit: line
                    });


                    $("#barChart-cor-div").empty();
                    $("#barChart-cor-div").append('<h4 class="mb-3">Corresponding Correlation </h4><canvas height="150px" id="cor2"></canvas>');
                    var ctx1 = document.getElementById("cor2");
                    var myChart1 = new Chart(ctx1, {
                        type: 'line',
                        data: data,

                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                    Chart.pluginService.unregister(line);


                    //End Cor

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.log("ERROR BARI")
                }


            });


        });


    });

})(jQuery);
