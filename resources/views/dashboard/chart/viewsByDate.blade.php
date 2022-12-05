<script>
    const viewsByDate = document.getElementById('viewsByDate');
    const labelsForDate = [];
    const dataForDate = [];

    @foreach ($viewsByDate as $view)
        labelsForDate.push("{{ $view->date->format('d M') }}")
        dataForDate.push("{{ $view->count }}")
    @endforeach
    
    const dataForDateSet = {
        labels: labelsForDate.reverse(),
        datasets: [{
            label: 'Post views',
            data: dataForDate.reverse(),
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgb(54, 162, 235)',
        }, ]
    };

    new Chart(viewsByDate, {
        type: 'line',
        data: dataForDateSet,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Post Views for last 8 days'
                }
            },
            // scales: {
            //     x: {
            //         ticks: {
            //             // For a category axis, the val is the index so the lookup via getLabelForValue is needed
            //             callback: function(val, index) {
            //                 // Hide every 2nd tick label
            //                 return index % 2 === 0 ? this.getLabelForValue(val) : '';
            //             },
            //             color: 'red',
            //         }
            //     }
            // }
        },
    })
</script>
