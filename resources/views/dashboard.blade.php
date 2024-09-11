<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white text-xl font-bold flex justify-center mb-10">
                <h1>Chart Rata - Rata Harga Valuta Asing Berdasarkan Provinsi di Indonesia 2016 dengan Bi Rate</h1>            
        </div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-[#1e2021] overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-black-900 dark:text-black-100">
            <div id="treemap-title" class="text-center text-white dark:text-black-100 mb-4 text-xl font-semibold">Treemap Rata - rata Jual per Provinsi Mata uang USD</div>
            <div class="mb-4 flex flex-wrap gap-4">
                <div class="flex-1">
                    <label for="currency-select-treemap" class="block text-white mb-1">Currency:</label>
                    <select id="currency-select-treemap" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                        <option value="usd">USD</option>
                        <option value="hkd">HKD</option>
                        <option value="aud">AUD</option>
                        <option value="gbp">GBP</option>
                    </select>
                </div>

                <div class="flex-1">
                    <label for="table-select-treemap" class="block text-white mb-1">Table:</label>
                    <select id="table-select-treemap" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                        <option value="jual">Jual</option>
                        <option value="beli">Beli</option>
                    </select>
                </div>
            </div>


            <div class="flex justify-center items-center">
                <div id="treemap" style="width:100%;max-width:900px;height:500px;"></div>
            </div>

            <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var treemapLayout = {
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
                        var table = document.getElementById('table-select-treemap').value;
                        var currency = document.getElementById('currency-select-treemap').value;
                        // Update the title based on selected options
                        var titleText = `Treemap Rata - rata ${table.charAt(0).toUpperCase() + table.slice(1)} per Provinsi Mata uang ${currency.toUpperCase()}`;
                        document.getElementById('treemap-title').textContent = titleText;

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
                <div id="bar-chart-title" class="text-center text-white dark:text-black-100 mb-4 text-xl font-semibold">Bar Chart Perbandingan Rata - rata Harga Valuta Bulan Januari Mata uang USD Tabel Jual</div>

                <div class="mb-4 flex flex-wrap gap-4">
                    <div class="flex-1">
                        <label for="month-select-bar" class="block text-white mb-1">Month:</label>
                        <select id="month-select-bar" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
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
                    </div>

                    <div class="flex-1">
                        <label for="currency-select-bar" class="block text-white mb-1">Currency:</label>
                        <select id="currency-select-bar" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                            <option value="usd">USD</option>
                            <option value="hkd">HKD</option>
                            <option value="aud">AUD</option>
                            <option value="gbp">GBP</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="table-select-bar" class="block text-white mb-1">Table:</label>
                        <select id="table-select-bar" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                            <option value="jual">Jual</option>
                            <option value="beli">Beli</option>
                        </select>
                    </div>
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

                            // Update the title based on selected options
                            document.getElementById('bar-chart-title').textContent = `Bar Chart Perbandingan Rata - rata Harga Valuta Bulan ${month} Mata uang ${currency.toUpperCase()} Tabel ${table.charAt(0).toUpperCase() + table.slice(1)}`;

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
                <div id="line-chart-title" class="text-center text-white dark:text-black-100 mb-4 text-xl font-semibold">Line Chart Perbandingan Volatility Provinsi (Berdasarkan dropdown) Mata Uang (USD/HKD/AUD/GBP) Tabel (Jual/Beli) dengan Bi Rate</div>
                <div class="mb-4 flex flex-wrap gap-4">
                    <div class="flex-1">
                        <label for="table-select-line" class="block text-white mb-1">Table:</label>
                        <select id="table-select-line" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                            <option value="jual">Jual</option>
                            <option value="beli">Beli</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="province-select-line" class="block text-white mb-1">Province:</label>
                        <select id="province-select-line" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                            <!-- Populate dynamically -->
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="currency-select-line" class="block text-white mb-1">Currency:</label>
                        <select id="currency-select-line" class="block w-full bg-[#1e2021] text-white rounded px-3 py-2">
                            <option value="usd">USD</option>
                            <option value="hkd">HKD</option>
                            <option value="aud">AUD</option>
                            <option value="gbp">GBP</option>
                        </select>
                    </div>
                </div>

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

                                // Update the title based on selected options
                                document.getElementById('line-chart-title').textContent = `Line Chart Perbandingan Volatility Provinsi ${province} Mata Uang ${currency.toUpperCase()} Tabel ${table.charAt(0).toUpperCase() + table.slice(1)} dengan Bi Rate`;

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    

</x-app-layout>
