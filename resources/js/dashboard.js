// // Simple filter functionality
// document.querySelectorAll('input').forEach(input => {
//     input.addEventListener('input', function() {
//         filterTable();
//     });
// });

// function filterTable() {
//     let provinceFilter = document.getElementById('filter-province').value.toLowerCase();
//     let currencyFilter = document.getElementById('filter-currency').value.toLowerCase();
//     let monthFilter = document.getElementById('filter-month').value.toLowerCase();
//     let valueFilter = document.getElementById('filter-value').value;
//     let biRateFilter = document.getElementById('filter-bi-rate').value;

//     filterRows(document.getElementById('jual-table-body'), provinceFilter, currencyFilter, monthFilter, valueFilter, biRateFilter);
//     filterRows(document.getElementById('beli-table-body'), provinceFilter, currencyFilter, monthFilter, valueFilter, biRateFilter);
// }

// function filterRows(tableBody, provinceFilter, currencyFilter, monthFilter, valueFilter, biRateFilter) {
//     let rows = tableBody.querySelectorAll('tr');
//     rows.forEach(row => {
//         let province = row.cells[0].textContent.toLowerCase();
//         let currency = row.cells[1].textContent.toLowerCase();
//         let month = row.cells[2].textContent.toLowerCase();
//         let value = row.cells[3].textContent;
//         let biRate = row.cells[4].textContent;

//         if (province.includes(provinceFilter) &&
//             currency.includes(currencyFilter) &&
//             month.includes(monthFilter) &&
//             (valueFilter === '' || value.includes(valueFilter)) &&
//             (biRateFilter === '' || biRate.includes(biRateFilter))) {
//             row.style.display = '';
//         } else {
//             row.style.display = 'none';
//         }
//     });
// }