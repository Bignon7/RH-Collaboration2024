<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="relative flex justify-center items-center" style="transform: scale(0.85);">
    <canvas id="hoursPieChart"></canvas>
    <div class="absolute">
        <span id="workedHoursText" class="text-xl font-bold text-gray-500"></span>
    </div>
</div>
<script>
    $(function() {

        function loadWorkedHours() {
            $.ajax({
                url: '{{ route('dashboard.getWorkedHours') }}',
                method: 'GET',

                success: function(response) {
                    const workedHours = response;
                    const totalHours = 220; // Exemple d'heures totales pour le mois

                    $('#workedHoursText').text(`${workedHours}h`);

                    const ctx = document.getElementById('hoursPieChart').getContext('2d');
                    if (window.pieChart) {
                        window.pieChart.destroy();
                    }
                    window.pieChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Heures Travaillées', 'Heures Restantes'],
                            datasets: [{
                                data: [workedHours, totalHours - workedHours],
                                backgroundColor: ['#696cff', '#e0e0e0']
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            //radius: '90%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' +
                                                tooltipItem.raw.toFixed(2) + 'h';
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        loadWorkedHours();
    });
</script>
