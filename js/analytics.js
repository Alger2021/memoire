let chart;
let line;

fetch("php/dataCharts.php?chart=4")
.then(response=>response.json())
.then(data=>{
    let label = data.labels;
    let counts = data.counts;
    const ctx = document.getElementById("lineChart");
    line = new Chart(ctx, {
        type: "line",
        data: {
        labels: label,
        datasets: [{
            label: '# of Votes',
            data: counts,
            fill:false,
            borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allow the chart to grow larger
            scales: {
                x: {
                    type: 'time', // If using time-based data
                    time: {
                        unit: 'day' // Change this to 'week', 'month', etc., as needed
                    },
                    ticks: {
                        autoSkip: true, // Automatically skip ticks for better readability
                        maxTicksLimit: 10 // Set a maximum number of ticks
                    }
                },
                y: {
                    beginAtZero: true, // Always start at zero
                    suggestedMin: 0, // Suggested minimum value
                    suggestedMax: Math.max(...counts) + 10, // Extend max value by 10
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
})




fetchCreateChart("myChart",3,"pie");

function destroyChart(){
    chart.destroy();
}

function createChart(id,type,label,data){
    const ctx = document.getElementById(id);
    chart = new Chart(ctx, {
        type: type,
        data: {
        labels: label,
        datasets: [{
            label: '# of Votes',
            data: data,
            fill:true,
            borderWidth: 1
            }]
        },
        options: { // Allow the chart to grow larger
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
}

function fetchCreateChart(id,chart,type){
    fetch("php/dataCharts.php?chart="+chart.toString())
    .then(response=>response.json())
    .then(data=>{
        let label = data.labels;
        let counts = data.counts;
        createChart(id,type,label,counts);
    })

}