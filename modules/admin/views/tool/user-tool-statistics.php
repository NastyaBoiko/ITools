<?php
// Текущая дата
$currentDate = new DateTime();
$currentYearToday = $currentDate->format('Y');
$currentMonthToday = $currentDate->format('m');

// Расчет предыдущего месяца и года
$prevMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
$prevYear = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

// Расчет следующего месяца и года
$nextMonth = ($currentMonth == 12) ? 1 : $currentMonth + 1;
$nextYear = ($currentMonth == 12) ? $currentYear + 1 : $currentYear;

// Флаги для отключения кнопок
$isPreviousMonthDisabled = false;

$isNextMonthDisabled = ($currentYear > $currentYearToday) ||
    ($currentYear == $currentYearToday && $currentMonth >= $currentMonthToday);
?>

<h3 class="mt-1 mb-5 text-center">Статистика использования инструментов (пользователи)</h3>

<div style="display: flex; justify-content: center; gap: 2rem; align-items: center; margin-bottom: 20px;">
    <!-- Кнопка "Предыдущий месяц" -->
    <?php if (!$isPreviousMonthDisabled): ?>
        <a href="?year=<?= $prevYear ?>&month=<?= $prevMonth ?>" style="text-decoration: none;">
            <button class="arrow-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>
        </a>
    <?php else: ?>
        <button class="arrow-button" disabled>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
        </button>
    <?php endif; ?>

    <!-- Текущий месяц на русском языке -->
    <span style="font-size: 18px; font-weight: bold;"><?= $formattedMonth ?></span>

    <!-- Кнопка "Следующий месяц" -->
    <?php if (!$isNextMonthDisabled): ?>
        <a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>" style="text-decoration: none;">
            <button class="arrow-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"></path>
                </svg>
            </button>
        </a>
    <?php else: ?>
        <button class="arrow-button" disabled>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18l6-6-6-6"></path>
            </svg>
        </button>
    <?php endif; ?>
</div>



<?php if (empty($chartData)): ?>
    <!-- Оповещение об отсутствии данных -->
    <div style="text-align: center; margin-top: 50px; font-size: 14px; color: #6c757d;">
        В этом месяце никто не использовал инструменты
    </div>
<?php else: ?>

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
                    height: 400 // Увеличенная высота графика
                },
                labels: labels,
                legend: {
                    position: 'bottom', // Легенда снизу по умолчанию
                    fontSize: '12px', // Размер шрифта
                    markers: {
                        width: 10, // Размер маркеров
                        height: 10
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: false,
                                value: {
                                    show: false,
                                    fontSize: '16px',
                                    fontWeight: 'bold',
                                    color: '#373d3f',
                                    offsetY: -10
                                },
                                total: {
                                    show: false
                                }
                            }
                        },
                        dropShadow: {
                            enabled: false
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetY: 10, // Отступ для подписей
                    style: {
                        fontSize: '14px',
                        fontFamily: 'Nunito, sans-serif',
                        fontWeight: 'bold',
                        colors: ['#373d3f']
                    },
                    dropShadow: {
                        enabled: false
                    }
                },
                responsive: [{
                        breakpoint: 601, // Для экранов шириной менее 601px
                        options: {
                            legend: {
                                position: 'right' // Легенда перемещается вправо
                            }
                        }
                    },
                    {
                        breakpoint: 600, // Для экранов шириной менее 600px
                        options: {
                            chart: {
                                height: 300 // Уменьшенная высота графика
                            },
                            legend: {
                                position: 'bottom', // Легенда возвращается вниз
                                fontSize: '10px' // Уменьшен размер шрифта
                            }
                        }
                    }
                ]
            };

            // Инициализация графика
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
<?php endif; ?>