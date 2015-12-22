"use strict";

(function ($) {
    $(function() {
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

            new Chart(document.getElementById("ga").getContext("2d")).Line(chartData, {
                responsive: true
            });
        });
    });
})(jQuery);
