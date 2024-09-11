<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto p-6">
            <h1 class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white text-xl font-bold flex justify-center mb-10">Data Tabel Jual</h1>

            <div class="bg-[#1e2021] shadow-md rounded-lg">
                <!-- Filter Section -->
                <div class="p-4 flex space-x-4">
                    <!-- Filter Province -->
                    <div>
                        <label for="filter-province" class="block text-sm font-medium text-white">Province</label>
                        <select id="filter-province" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md" onchange="applyFilters()">
                            <option value="">All Provinces</option>
                            <!-- Populate options dynamically -->
                            @foreach($provinces as $province)
                                <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Currency -->
                    <div>
                        <label for="filter-currency" class="block text-sm font-medium text-white">Currency</label>
                        <select id="filter-currency" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md" onchange="applyFilters()">
                            <option value="">All Currencies</option>
                            <option value="HKD" {{ request('currency') == 'HKD' ? 'selected' : '' }}>HKD</option>
                            <option value="AUD" {{ request('currency') == 'AUD' ? 'selected' : '' }}>AUD</option>
                            <option value="GBP" {{ request('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                            <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        </select>
                    </div>

                    <!-- Filter Month -->
                    <div>
                        <label for="filter-month" class="block text-sm font-medium text-white">Month</label>
                        <select id="filter-month" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md" onchange="applyFilters()">
                            <option value="">All Months</option>
                            <option value="Januari" {{ request('month') == 'Januari' ? 'selected' : '' }}>Januari</option>
                            <option value="Februari" {{ request('month') == 'Februari' ? 'selected' : '' }}>Februari</option>
                            <option value="Maret" {{ request('month') == 'Maret' ? 'selected' : '' }}>Maret</option>
                            <option value="April" {{ request('month') == 'April' ? 'selected' : '' }}>April</option>
                            <option value="Mei" {{ request('month') == 'Mei' ? 'selected' : '' }}>Mei</option>
                            <option value="Juni" {{ request('month') == 'Juni' ? 'selected' : '' }}>Juni</option>
                            <option value="Juli" {{ request('month') == 'Juli' ? 'selected' : '' }}>Juli</option>
                            <option value="Agustus" {{ request('month') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                            <option value="September" {{ request('month') == 'September' ? 'selected' : '' }}>September</option>
                            <option value="Oktober" {{ request('month') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                            <option value="November" {{ request('month') == 'November' ? 'selected' : '' }}>November</option>
                            <option value="Desember" {{ request('month') == 'Desember' ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                </div>

                <!-- Table Section -->
                <table class="min-w-full divide-y divide-gray-700 rounded-lg overflow-hidden border border-white">
                    <thead class="bg-[#111313] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-r border-gray-600">Province</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-r border-gray-600">Currency</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-r border-gray-600">Month</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-r border-gray-600">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Bi Rate</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-[#2a2c2d] text-white divide-y divide-gray-700">
                        @foreach($dataJual as $item)
                        <tr class="border-b border-gray-600">
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-600">{{ $item->Province }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-600">{{ $item->Currency }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-600">{{ $item->Month }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-600">{{ $item->Value }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->BI_rate }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4 bg-[#111313] text-center">
                    {{ $dataJual->links('pagination::tailwind') }}
                </div>
            </div>

            <!-- JavaScript for Filtering and Sorting -->
            <script>
                function applyFilters() {
                    const province = document.getElementById('filter-province').value;
                    const currency = document.getElementById('filter-currency').value;
                    const month = document.getElementById('filter-month').value;

                    // Redirect to the same route with query parameters
                    const url = new URL(window.location.href);
                    url.searchParams.set('province', province);
                    url.searchParams.set('currency', currency);
                    url.searchParams.set('month', month);
                    window.location.href = url.toString(); // Redirect to the new URL
                }
            </script>
        </div>
</x-app-layout>
