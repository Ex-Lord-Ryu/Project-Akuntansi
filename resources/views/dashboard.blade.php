<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Add your links here -->
                    </div>

                    <!-- Year Selector -->
                    <div class="hidden">
                        <div class="year-selector">
                            <select id="yearSelector" multiple>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                    </div>

                    <!-- Yearly Chart -->
                    <div class="chart-container">
                        <h3 class="chart-title">Yearly Stok Data</h3>
                        <div class="canvas-wrapper">
                            <canvas id="yearlyChart"></canvas>
                        </div>
                    </div>

                    <!-- Monthly Chart -->
                    <div class="chart-container">
                        <h3 class="chart-title">Monthly Stok Data</h3>
                        <div class="canvas-wrapper">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearSelector = document.getElementById('yearSelector');
        const currentYear = new Date().getFullYear();

        // Populate year selector with the last 10 years
        for (let year = currentYear; year >= currentYear - 10; year--) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelector.appendChild(option);
        }

        // Ensure at least 5 years are selected by default
        Array.from(yearSelector.options).slice(0, 5).forEach(option => option.selected = true);

        // Fetch data and initialize charts
        function fetchDataAndRenderCharts(years) {
            fetch(`{{ url('dashboard/data') }}?years=${years.join(',')}`)
                .then(response => response.json())
                .then(data => {
                    renderCharts(data);
                });
        }

        // Render charts with fetched data
        function renderCharts(data) {
            // Monthly Data
            const monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                'Dec'
            ];
            const monthlyDatasets = data.map((d, index) => ({
                label: `Year ${d.year}`,
                data: monthlyLabels.map((label, monthIndex) => {
                    const found = d.monthly.find(m => m.month - 1 === monthIndex);
                    return found ? found.count : 0;
                }),
                backgroundColor: `rgba(${index * 25 % 255}, ${index * 75 % 255}, ${index * 125 % 255}, 0.2)`,
                borderColor: `rgba(${index * 25 % 255}, ${index * 75 % 255}, ${index * 125 % 255}, 1)`,
                borderWidth: 1
            }));

            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: monthlyDatasets
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Yearly Data
            const yearlyLabels = data.map(d => d.year);
            const yearlyCounts = data.map(d => d.yearly.reduce((acc, val) => acc + val.count, 0));

            const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
            new Chart(yearlyCtx, {
                type: 'bar',
                data: {
                    labels: yearlyLabels,
                    datasets: [{
                        label: 'Yearly Stok Data',
                        data: yearlyCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Initial fetch and render
        const initialYears = Array.from(yearSelector.selectedOptions).map(option => option.value);
        fetchDataAndRenderCharts(initialYears);

        // Fetch and render charts when year changes
        yearSelector.addEventListener('change', function() {
            const selectedYears = Array.from(this.selectedOptions).map(option => option.value);
            if (selectedYears.length >= 5) {
                fetchDataAndRenderCharts(selectedYears);
            } else {
                alert('Please select at least 5 years.');
            }
        });
    });
</script>
