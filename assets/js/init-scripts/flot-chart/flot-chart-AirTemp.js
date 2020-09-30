(function ($) {

    "use strict"; // Start of use strict

    var SufeeAdmin = {

        //FIRST
        cpuLoad: function (pn) {

            var id = "#nodechart" + pn;
            var data = [];

            $.ajax({
                url: "http://128.199.184.77:8001/api/crohmi/reading/?action=node&node=" + pn,
                type: "get",
                success: function (response) {
                    for (var counter = 0; counter < response.length ;counter++) {
                        data.push([counter + 1, response[counter]["air_temperature"]]);
                    }
                }});
            var counter = 1;

            function getRandomData(times) {
                if (data.length === 0) {
                    return [];
                } else if (times > 99) {
                    return data;
                }
                // Zip the generated y values with the x values
                counter++;
                return data.slice(0, times);
            }

            // Set up the control widget
            var updateInterval = 1000;
            $("#updateInterval").val(updateInterval).change(function () {
                var v = $(this).val();
                if (v && !isNaN(+v)) {
                    updateInterval = +v;
                    if (updateInterval < 1) {
                        updateInterval = 1;
                    } else if (updateInterval > 3000) {
                        updateInterval = 3000;
                    }
                    $(this).val("" + updateInterval);
                }
            });

            var plot = $.plot(id, [getRandomData(counter)], {
                series: {
                    shadowSize: 0 // Drawing is faster without shadows
                },
                axisLabels: {
                    show: true
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    tickDecimals: 2,
                    position: "right",
                    axisLabel: "Air Temperature (C)"
                },
                xaxis: {
                    min: 0,
                    max: 100,
                    show: false
                },
                colors: ["#007BFF"],
                grid: {
                    color: "transparent",
                    hoverable: true,
                    borderWidth: 0,
                    backgroundColor: 'transparent'
                },
                tooltip: true,
                tooltipOpts: {
                    content: "Air Temperature: %y",
                    defaultTheme: false
                }


            });

            function update() {

                plot.setData([ getRandomData(counter) ]);

                // Since the axes don't change, we don't need to call plot.setupGrid()
                plot.setupGrid();
                plot.draw();
                setTimeout(update, 800);
            }

            update();

        },


        barFlot: function () {

            $.ajax({
                url: "http://128.199.184.77:8001/api/crohmi/reading/?action=last_seven_days",
                type: "get",
                success: function (response) {
                    var d1 = [];
                    for (var counter in response) {
                        var obj = response[parseInt(counter)];
                        d1.push([new Date(obj["datetime"]), obj["air_temperature"]]);
                    }
                    //flot options
                    var options = {
                        legend: {
                            show: false
                        },
                        axisLabels: {
                            show: true
                        },
                        series: {
                            label: "Curved Lines Test",
                            curvedLines: {
                                active: true,
                                nrSplinePoints: 20
                            }
                        },
                        xaxis: {
                            mode: "time",
                            timeformat: "%m/%d",
                            minTickSize: [1, "day"],
                            axisLabel: "Date"
                        },
                        grid: {
                            color: "#fff",
                            hoverable: true,
                            borderWidth: 0,
                            backgroundColor: 'transparent'
                        },
                        tooltip: {
                            show: true,
                            content: "Date: %x, Value: %y"
                        },
                        yaxes: [{
                            tickDecimals: 1,
                            axisLabel: "Air Temperature (C)"
                        }, {
                            position: 'right'
                        }]
                    };

                    //plotting
                    $.plot($("#flotBar"), [
                        {
                            data: d1,
                            lines: {
                                show: true,
                                fill: true,
                                fillColor: "rgb(255,255,255)",
                                lineWidth: 3
                            },
                            //curve the line  (old pre 1.0.0 plotting function)
                            curvedLines: {
                                apply: true,
                                show: true,
                                fill: true,
                                fillColor: "rgb(255,255,255)",

                            }
                        }, {
                            data: d1,
                            points: {
                                show: true,
                                fill: true,
                                fillColor: "rgba(0,123,255,.15)",
                            }
                        }
                    ], options);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.log("ERROR BARI")
                }


            });

        },

        plotting: function () {
            $.ajax({
                url: "http://128.199.184.77:8001/api/crohmi/reading/?action=last_day",
                type: "get",
                success: function (response) {
                    var d1 = [];
                    for (var counter in response) {
                        var obj = response[parseInt(counter)];
                        d1.push([new Date(obj["datetime"]), obj["air_temperature"]]);
                    }

                    //flot options
                    var options = {
                        legend: {
                            show: false
                        },
                        axisLabels: {
                            show: true
                        },
                        series: {
                            label: "Curved Lines Test",
                            curvedLines: {
                                active: true,
                                nrSplinePoints: 20
                            }
                        },
                        xaxis: {
                            mode: "time",
                            timeformat: "%I:00 %P",
                            minTickSize: [1, "hour"],
                            axisLabel: "Hour"
                        },
                        grid: {
                            color: "#fff",
                            hoverable: true,
                            borderWidth: 0,
                            backgroundColor: 'transparent'
                        },
                        tooltip: {
                            show: true,
                            content: "Hour: %x, Value: %y"
                        },
                        yaxes: [{
                            tickDecimals: 1,
                            axisLabel: "Air Temperature (C)"
                        }, {
                            position: 'right'
                        }]
                    };

                    //plotting
                    $.plot($("#flotCurve"), [
                        {
                            data: d1,
                            lines: {
                                show: true,
                                fill: true,
                                fillColor: "rgb(255,255,255)",
                                lineWidth: 3
                            },
                            //curve the line  (old pre 1.0.0 plotting function)
                            curvedLines: {
                                apply: true,
                                show: true,
                                fill: true,
                                fillColor: "rgb(255,255,255)",

                            }
                        }, {
                            data: d1,
                            points: {
                                show: true,
                                fill: true,
                                fillColor: "rgba(0,123,255,.15)",
                            }
                        }
                    ], options);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.log("ERROR BARI")
                }


            });

        }

    };

    $(document).ready(function () {
        SufeeAdmin.cpuLoad(1);
        SufeeAdmin.cpuLoad(2);
        SufeeAdmin.cpuLoad(3);
        SufeeAdmin.cpuLoad(4);
        SufeeAdmin.cpuLoad(5);
        SufeeAdmin.cpuLoad(6);
        SufeeAdmin.cpuLoad(7);
        SufeeAdmin.cpuLoad(8);
        SufeeAdmin.cpuLoad(9);


        SufeeAdmin.plotting();
        SufeeAdmin.barFlot();

    });

})(jQuery);

