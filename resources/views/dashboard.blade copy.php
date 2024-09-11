<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="container mx-auto py-8">
                </div>
            </div>
        </div>
        
        <h1 class="text-2xl font-bold mb-6 text-white">Data Jual</h1>

        <!-- Filter Form -->
        <div class="mb-4 grid grid-cols-5 gap-4">
            <input type="text" placeholder="Filter Province" class="border border-gray-300 p-2 rounded" id="filter-province">
            <input type="text" placeholder="Filter Currency" class="border border-gray-300 p-2 rounded" id="filter-currency">
            <input type="text" placeholder="Filter Month" class="border border-gray-300 p-2 rounded" id="filter-month">
            <input type="number" placeholder="Filter Value" class="border border-gray-300 p-2 rounded" id="filter-value">
            <input type="number" placeholder="Filter Bi Rate" class="border border-gray-300 p-2 rounded" id="filter-bi-rate">
        </div>

        <!-- Table for Jual Data -->
        <table class="min-w-full bg-white border-collapse">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border">Province</th>
                    <th class="py-2 px-4 border">Currency</th>
                    <th class="py-2 px-4 border">Month</th>
                    <th class="py-2 px-4 border">Value</th>
                    <th class="py-2 px-4 border">Bi Rate</th>
                </tr>
            </thead>
            <tbody id="jual-table-body">
                @foreach ($jualData as $value)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border">{{ $value->Province }}</td>
                        <td class="py-2 px-4 border">{{ $value->Currency }}</td>
                        <td class="py-2 px-4 border">{{ $value->Month }}</td>
                        <td class="py-2 px-4 border">{{ $value->Value }}</td>
                        <td class="py-2 px-4 border">{{ $value->BI_rate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h1 class="text-2xl font-bold mt-10 mb-6 text-white">Data Beli</h1>

        <!-- Table for Beli Data -->
        <table class="min-w-full bg-white border-collapse">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border">Province</th>
                    <th class="py-2 px-4 border">Currency</th>
                    <th class="py-2 px-4 border">Month</th>
                    <th class="py-2 px-4 border">Value</th>
                    <th class="py-2 px-4 border">Bi Rate</th>
                </tr>
            </thead>
            <tbody id="beli-table-body">
                @foreach ($beliData as $value)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border">{{ $value->Province }}</td>
                        <td class="py-2 px-4 border">{{ $value->Currency }}</td>
                        <td class="py-2 px-4 border">{{ $value->Month }}</td>
                        <td class="py-2 px-4 border">{{ $value->Value }}</td>
                        <td class="py-2 px-4 border">{{ $value->BI_rate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script>
        // Simple filter functionality
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                filterTable();
            });
        });

        function filterTable() {
            let provinceFilter = document.getElementById('filter-province').value.toLowerCase();
            let currencyFilter = document.getElementById('filter-currency').value.toLowerCase();
            let monthFilter = document.getElementById('filter-month').value.toLowerCase();
            let valueFilter = document.getElementById('filter-value').value;
            let biRateFilter = document.getElementById('filter-bi-rate').value;

            filterRows(document.getElementById('jual-table-body'), provinceFilter, currencyFilter, monthFilter, valueFilter, biRateFilter);
            filterRows(document.getElementById('beli-table-body'), provinceFilter, currencyFilter, monthFilter, valueFilter, biRateFilter);
        }

        function filterRows(tableBody, provinceFilter, currencyFilter, monthFilter, valueFilter, biRateFilter) {
            let rows = tableBody.querySelectorAll('tr');
            rows.forEach(row => {
                let province = row.cells[0].textContent.toLowerCase();
                let currency = row.cells[1].textContent.toLowerCase();
                let month = row.cells[2].textContent.toLowerCase();
                let value = row.cells[3].textContent;
                let biRate = row.cells[4].textContent;

                if (province.includes(provinceFilter) &&
                    currency.includes(currencyFilter) &&
                    month.includes(monthFilter) &&
                    (valueFilter === '' || value.includes(valueFilter)) &&
                    (biRateFilter === '' || biRate.includes(biRateFilter))) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
