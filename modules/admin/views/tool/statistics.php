<h3 class="mt-1 mb-5 text-center">Статистика использования инструментов (статусы)</h3>

<div id="chart"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Данные из PHP
        var chartCategories = <?= json_encode($categories) ?>; // Месяцы
        var chartSeries = <?= json_encode($series) ?>; // Данные для графика

        // Настройки графика
        var options = {
            series: chartSeries, // Данные для графика
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: chartCategories, // Месяцы
                title: {
                    text: 'Месяц'
                }
            },
            yaxis: {
                title: {
                    text: 'Количество инструментов'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val;
                    }
                }
            }
        };

        // Инициализация графика
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    });
</script>