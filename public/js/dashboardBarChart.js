const ctx = document.getElementById('barChart');
const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Daily Working Hours ( Current Month )',
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Working Hours'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Working Date'
                }
            },
        }
    }
});

$.ajax({
    url:"/get_dashboard_bar_chart/",
    type:"GET",
    cache: false,
    success: function(response) {
        barChart.data.labels= response[0]
        barChart.data.datasets[0].data=response[1]
        barChart.update()
       //console.log(response);
    },
    failure: function (response) {
        swal.fire(
            "Bar Chart Internal Error",
            "Oops, Missing Something.",
            "error"
        )
        localStorage.clear();
    }
})
