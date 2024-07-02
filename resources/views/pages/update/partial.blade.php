<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .custom-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px #898bffbb;
        border-color: #697a8d;
    }

    .hidden {
        display: none;
    }
</style>

<div class="container flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
    @php
        $user = App\Models\User::find($id);
        $name = $user->prenom . ' ' . $user->nom;
    @endphp
    <div class="w-full mt-6 px-6 py-3">
        <h1 class="xs:text-base md:text-2xl font-semibold mb-6 text-start text-gray-500">Evaluation des heures
            travaillées
            par l'employé
            {{ $name }}</h1>
        <div class="w-full max-w-full mx-auto">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="w-full lg:w-1/4">
                    <div class="card mb-3 px-5 py-4 bg-white shadow-md rounded-md justify-center items-center">
                        <form method="GET" action="{{ route('worked_hours.page', ['id' => $id]) }}" id="workHoursForm"
                            class="flex flex-col gap-4 w-full">
                            <div class="w-full">
                                <label for="start_date" class="block text-gray-500">Date de début:</label>
                                <input type="date" id="start_date" name="start_date" max="<?php echo date('Y-m-d'); ?>"
                                    class="w-full p-2 border rounded-lg text-gray-500 custom-input"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="w-full">
                                <label for="end_date" class="block text-gray-500">Date de fin:</label>
                                <input type="date" id="end_date" name="end_date" max="<?php echo date('Y-m-d'); ?>"
                                    class="w-full p-2 border rounded-lg text-gray-500 custom-input"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="w-full">
                                <button type="submit"
                                    class="w-full bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-[#697a8d]">Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full lg:w-3/4 flex justify-center items-center hidden" id="graphContainer">
                    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
                        <canvas id="hoursChart"></canvas>
                    </div>
                </div>
            </div>
            @if ($attendances->isEmpty())
                <div class="text-red-500 my-5 px-5 py-8 bg-red-100 shadow-md rounded-md">
                    <p class="text-xl font-semibold text-center">Aucune heure travaillée trouvée pour la période
                        sélectionnée.</p>
                </div>
            @else
                <table class="min-w-full my-5 bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th colspan="4"
                                class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-center text-xl leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Détails des Heures Travaillées
                            </th>
                        </tr>
                        <tr>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Heure d'arrivée</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Heure de départ</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Heures travaillées</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalHours = 0;
                        @endphp
                        @foreach ($attendances as $attendance)
                            @php
                                $totalHours += $attendance['hours_worked'];
                            @endphp
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ $attendance['date'] }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ $attendance['clock_in'] }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ $attendance['clock_out'] }}</td>
                                <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ $attendance['hours_worked'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"
                                class="px-6 py-3 whitespace-no-wrap border-b border-gray-200 font-bold text-gray-500">
                                Total</td>
                            <td class="px-6 py-3 whitespace-no-wrap border-b border-gray-200 font-bold text-gray-500">
                                {{ $totalHours }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        if (startDate && endDate) {
            loadChartData(startDate, endDate);
        }

        function loadChartData(startDate, endDate) {
            $.ajax({
                url: '{{ route('attendance.hoursWorked', $id) }}',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    const labels = response.map(entry => entry.date);
                    const data = response.map(entry => entry.hours_worked);

                    if (data.length > 0) {
                        $('#graphContainer').removeClass('hidden');

                        const ctx = document.getElementById('hoursChart').getContext('2d');

                        if (window.chartInstance) {
                            window.chartInstance.destroy();
                        }

                        window.chartInstance = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Heures Travaillées',
                                    data: data,
                                    borderColor: '#696cff',
                                    backgroundColor: 'rgba(105, 108, 255, 0.2)',
                                    borderWidth: 2,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                animation: {
                                    duration: 1500,
                                    easing: 'easeInOutCubic'
                                },
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            tooltipFormat: 'll',
                                            displayFormats: {
                                                day: 'MMM D'
                                            }
                                        },
                                        ticks: {
                                            color: '#697a8d'
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: '#697a8d'
                                        }
                                    }
                                }
                            }
                        });
                    } else {
                        $('#graphContainer').addClass('hidden');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
</script>
