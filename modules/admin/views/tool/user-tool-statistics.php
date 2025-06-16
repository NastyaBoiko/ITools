<div id="chart"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Данные из PHP
        var chartData = <?= json_encode($chartData) ?>;

        // Формируем данные для диаграммы
        var series = chartData.map(item => item.count); // Количество инструментов
        var labels = chartData.map(item => item.name); // Полные имена пользователей

        // Настройки графика
        var options = {
            series: series,
            chart: {
                type: 'pie',
                height: 350
            },
            labels: labels,
            legend: {
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " инструментов";
                    }
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%', // Увеличиваем размер доната (пустой области в центре)
                        labels: {
                            show: true,
                            name: {
                                show: false // Скрываем название (если нужно)
                            },
                            value: {
                                show: true,
                                fontSize: '16px', // Размер шрифта для процентов
                                fontWeight: 'bold',
                                color: '#373d3f',
                                offsetY: -10 // Поднимаем проценты ближе к центру
                            },
                            total: {
                                show: false // Убираем итоговое значение
                            }
                        }
                    },
                    dropShadow: {
                        enabled: false // Убираем тень
                    }
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '14px',
                    fontFamily: 'Nunito, sans-serif',
                    fontWeight: 'bold',
                    colors: ['#373d3f']
                },
                dropShadow: {
                    enabled: false // Убираем тень у процентов
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        // Инициализация графика
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    });
</script>