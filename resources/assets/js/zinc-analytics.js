"use strict";

(function ($) {
    $(function() {
        var za = document.getElementById("zinc-analytics");

        if (null !== za) {
            $.get('/zinc/manage/analytics/data', function(data) {
                var chartData = {
                    labels: data.date,

                    datasets: [
                        {
                            label: "Visitors",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: data.visitors
                        },
                        {
                            label: "Page Views",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: data.pageViews
                        }
                    ]
                };

                new Chart(za.getContext("2d")).Line(chartData, {
                    responsive: true
                });
            });
        }
    });
})(jQuery);
