<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-black-100">
                    <div>
                        <label for="currency-select-treemap">Currency:</label>
                        <select id="currency-select-treemap">
                            <option value="usd">USD</option>
                            <option value="hkd">HKD</option>
                            <option value="aud">AUD</option>
                            <option value="gbp">GBP</option>
                        </select>

                        <label for="table-select-treemap">Table:</label>
                        <select id="table-select-treemap">
                            <option value="jual">Jual</option>
                            <option value="beli">Beli</option>
                        </select>
                    </div>

                    <div id="treemap" style="width:100%;max-width:900px;height:500px;"></div>

                    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var treemapData = [];
                            var treemapLayout = {
                                title: "Treemap Rata-rata Value per Provinsi",
                                treemapcolorway: ['#636efa', '#ef553b'],
                                width: 900,
                                height: 500,
                                margin: {t: 50, l: 25, r: 25, b: 25}
                            };

                            async function fetchTreemapData(table, currency) {
                                const response = await fetch(`/treemap-data?table=${table}&currency=${currency}`);
                                return await response.json();
                            }

                            function updateTreemap(data) {
                                var trace = {
                                    type: "treemap",
                                    labels: data.labels,
                                    parents: data.parents,
                                    values: data.values,
                                    textinfo: "label+value+percent entry",
                                    hoverinfo: "label+value+percent entry",
                                    marker: {
                                        colors: data.colors
                                    },
                                    pathbar: {visible: false}
                                };

                                Plotly.newPlot('treemap', [trace], treemapLayout);
                            }

                            async function updateTreemapData() {
                                const table = document.getElementById('table-select-treemap').value;
                                const currency = document.getElementById('currency-select-treemap').value;

                                const data = await fetchTreemapData(table, currency);
                                updateTreemap(data);
                            }

                            document.getElementById('table-select-treemap').addEventListener('change', updateTreemapData);
                            document.getElementById('currency-select-treemap').addEventListener('change', updateTreemapData);

                            // Initial data load
                            updateTreemapData();
                        });
                    </script>
                </div>
                <div class="p-6 text-black-900 dark:text-black-100">
                    <div>
                        <label for="month-select-bar">Month:</label>
                        <select id="month-select-bar">
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>

                        <label for="currency-select-bar">Currency:</label>
                        <select id="currency-select-bar">
                            <option value="usd">USD</option>
                            <option value="hkd">HKD</option>
                            <option value="aud">AUD</option>
                            <option value="gbp">GBP</option>
                        </select>

                        <label for="table-select-bar">Table:</label>
                        <select id="table-select-bar">
                            <option value="jual">Jual</option>
                            <option value="beli">Beli</option>
                        </select>
                    </div>

                    <canvas id="valueBarChart"></canvas>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var ctxBarChart = document.getElementById('valueBarChart').getContext('2d');
                            var valueBarChart = null;

                            async function fetchBarChartData(table, month, currency) {
                                const response = await fetch(`/chart-data-bar?table=${table}&month=${month}&currency=${currency}`);
                                return await response.json();
                            }

                            function updateBarChart(data) {
                                if (valueBarChart) {
                                    valueBarChart.destroy();
                                }

                                valueBarChart = new Chart(ctxBarChart, {
                                    type: 'bar',
                                    data: {
                                        labels: data.provinces,
                                        datasets: [{
                                            label: data.monthName,
                                            data: data.values,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        plugins: {
                                            tooltip: {
                                                mode: 'index'
                                            }
                                        }
                                    }
                                });
                            }

                            async function updateBarChartData() {
                                const table = document.getElementById('table-select-bar').value;
                                const month = document.getElementById('month-select-bar').value;
                                const currency = document.getElementById('currency-select-bar').value;

                                const data = await fetchBarChartData(table, month, currency);
                                updateBarChart(data);
                            }

                            document.getElementById('table-select-bar').addEventListener('change', updateBarChartData);
                            document.getElementById('month-select-bar').addEventListener('change', updateBarChartData);
                            document.getElementById('currency-select-bar').addEventListener('change', updateBarChartData);

                            // Initial data load
                            updateBarChartData();
                        });
                    </script>
                </div>

                <div class="p-6 text-black-900 dark:text-black-100">
                    <select id="table-select-line">
                        <option value="jual">Jual</option>
                        <option value="beli">Beli</option>
                    </select>
                    
                    <select id="province-select-line">
                        <!-- Populate dynamically -->
                    </select>
                    
                    <select id="currency-select-line">
                        <option value="usd">USD</option>
                        <option value="hkd">HKD</option>
                        <option value="aud">AUD</option>
                        <option value="gbp">GBP</option>
                    </select>
                    
                    <canvas id="biRateChart"></canvas>

                    <script>
                        document.addEventListener('DOMContentLoaded', async function() {
                            let ctxLineChart = document.getElementById('biRateChart').getContext('2d');
                            let biRateChart = null;

                            async function fetchLineChartData(table, province, currency) {
                                const response = await fetch(`/chart-data?table=${table}&province=${province}&currency=${currency}`);
                                return await response.json();
                            }

                            function updateLineChart(data) {
                                if (biRateChart) {
                                    biRateChart.destroy();
                                }

                                biRateChart = new Chart(ctxLineChart, {
                                    type: 'line',
                                    data: {
                                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                        datasets: [
                                            {
                                                label: 'Bi Rate',
                                                data: data.bi_rate,
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                yAxisID: 'y1',
                                                fill: false
                                            },
                                            {
                                                label: 'Value',
                                                data: data.value,
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                yAxisID: 'y2',
                                                fill: false
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y1: {
                                                type: 'linear',
                                                position: 'left',
                                                beginAtZero: false
                                            },
                                            y2: {
                                                type: 'linear',
                                                position: 'right',
                                                beginAtZero: false,
                                                grid: {
                                                    drawOnChartArea: false
                                                }
                                            }
                                        },
                                        plugins: {
                                            tooltip: {
                                                mode: 'index'
                                            }
                                        }
                                    }
                                });
                            }

                            async function updateLineChartData() {
                                const table = document.getElementById('table-select-line').value;
                                const province = document.getElementById('province-select-line').value;
                                const currency = document.getElementById('currency-select-line').value;

                                const data = await fetchLineChartData(table, province, currency);
                                updateLineChart(data);
                            }

                            // Fetch provinces dynamically
                            const provinceSelectLine = document.getElementById('province-select-line');
                            const response = await fetch('/provinces');
                            const provinces = await response.json();

                            provinces.forEach(province => {
                                let option = document.createElement('option');
                                option.value = province;
                                option.text = province;
                                provinceSelectLine.appendChild(option);
                            });

                            // Event listeners for all dropdowns
                            document.getElementById('table-select-line').addEventListener('change', updateLineChartData);
                            document.getElementById('province-select-line').addEventListener('change', updateLineChartData);
                            document.getElementById('currency-select-line').addEventListener('change', updateLineChartData);

                            // Initial data load
                            updateLineChartData();
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    

</x-app-layout>
