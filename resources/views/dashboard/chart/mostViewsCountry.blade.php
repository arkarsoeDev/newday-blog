<script>
    const mostViewCountry = document.getElementById('mostViewCountry');
    const labelsForCountry = [];
    const dataForCountry = [];

    @foreach ($views as $view)
        labelsForCountry.push('{{ $view->country->name }}')
        dataForCountry.push('{{ $view->count }}')
    @endforeach

    new Chart(mostViewCountry, {
        type: 'pie',
        data: {
            labels: labelsForCountry,
            datasets: [{
                label: 'Post Views',
                data: dataForCountry,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        }
    });
</script>
