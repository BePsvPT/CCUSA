const za = document.getElementById('zinc-analytics')

if (null !== za) {
  $.get('/zinc/manage/analytics/data', function(data) {
    new Chart(za.getContext("2d"), {
      type: 'line',
      data: {
        labels: data.date,

        datasets: [
          {
            label: "Visitors",
            backgroundColor: "rgba(220,220,220,0.2)",
            borderColor: "rgba(220,220,220,1)",
            pointBackgroundColor: "rgba(220,220,220,1)",
            pointBorderColor: "#fff",
            data: data.visitors
          },
          {
            label: "Page Views",
            backgroundColor: "rgba(151,187,205,0.2)",
            borderColor: "rgba(151,187,205,1)",
            pointBackgroundColor: "rgba(151,187,205,1)",
            pointBorderColor: "#fff",
            data: data.pageViews
          }
        ]
      }
    })
  })
}
