<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jual;
use App\Models\Beli;
use Illuminate\View\View;

class datacontroller extends Controller
{
    public function index()
    {

    }

    public function dataset()
    {
        $jualData = jual::all();
        $beliData = beli::all();

        return view('dashboard', compact('jualData','beliData'));
    }

    public function getData(Request $request)
    {  

        $table = $request->input('table');
        $province = $request->input('province');
        $currency = $request->input('currency');

        if ($table === 'jual') {
            $data = Jual::where('Province', $province)
                        ->where('Currency', $currency)
                        ->orderBy('Month', 'asc')
                        ->get(['Month', 'Bi_rate', 'Value']);
        } else {
            $data = Beli::where('Province', $province)
                        ->where('Currency', $currency)
                        ->orderBy('Month', 'asc')
                        ->get(['Month', 'Bi_rate', 'Value']);
        }

        $months = [];
        $bi_rate = [];
        $value = [];

        foreach ($data as $entry) {
            $months[] = $entry->Month;
            $bi_rate[] = $entry->Bi_rate;
            $value[] = $entry->Value;
        }

        return response()->json([
            'months' => $months,
            'bi_rate' => $bi_rate,
            'value' => $value
        ]);
    }

    public function getProvinces()
    {
        $provinces = [
            'Nanggroe Aceh Darussalam', 'Sumatera Utara', 'Sumatera Barat',
            'Riau', 'Jambi', 'Sumatera Selatan', 'Bengkulu', 'Lampung',
            'Bangka Belitung', 'Kepulauan Riau', 'DKI Jakarta', 'Jawa Barat',
            'Jawa Tengah', 'DI. Yogyakarta', 'Jawa Timur', 'Banten', 'Bali',
            'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Kalimantan Barat',
            'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur',
            'Kalimantan Utara', 'Sulawesi Utara', 'Sulawesi Tengah',
            'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo',
            'Sulawesi Barat', 'Maluku', 'Maluku Utara', 'Papua', 'Papua Barat'
        ];
        return response()->json($provinces);
    }

    
    public function getBarChartData(Request $request)
    {
        // Mengambil input dari request
        $table = $request->input('table');
        $month = $request->input('month');
        $currency = $request->input('currency');

        // Ambil data berdasarkan tabel yang dipilih
        if ($table === 'jual') {
            $data = jual::where('Month', $month)
                        ->where('Currency', $currency)
                        ->get(['Province', 'Value']);
        } else {
            $data = beli::where('Month', $month)
                        ->where('Currency', $currency)
                        ->get(['Province', 'Value']);
        }

        // Cek apakah data ditemukan
        if ($data->isEmpty()) {
            return response()->json(['error' => 'No data found'], 404);
        }

        // Memproses data menjadi array
        $provinces = [];
        $values = [];

        foreach ($data as $entry) {
            $provinces[] = $entry->Province;
            $values[] = $entry->Value;
        }

        // Mengembalikan response JSON
        return response()->json([
            'provinces' => $provinces,
            'values' => $values,
            'monthName' => $month
        ]);
    }

    public function getTreemapData(Request $request)
    {
        $table = $request->input('table');
        $currency = $request->input('currency');

        if ($table === 'jual') {
            $model = Jual::class;
        } else {
            $model = Beli::class;
        }

        // Menghitung rata-rata nilai per provinsi
        $data = $model::selectRaw('Province, AVG(Value) as avg_value')
            ->where('Currency', $currency)
            ->groupBy('Province')
            ->get();

        // Mempersiapkan data untuk treemap
        $labels = [];
        $parents = [];
        $values = [];
        $colors = [];
        $colorIndex = 0;

        foreach ($data as $entry) {
            $labels[] = $entry->Province;
            $parents[] = ''; // Provinsi sebagai level utama
            $values[] = $entry->avg_value;
            $colors[] = $this->getColor($colorIndex++);
        }

        // Menambahkan kategori 'Jual' dan 'Beli'
        $parents = array_merge($parents, $labels); // Sesuaikan parent

        return response()->json([
            'labels' => $labels,
            'parents' => $parents,
            'values' => $values,
            'colors' => $colors
        ]);
    }

    private function getColor($index)
    {
        $colors = [
            '#a0d911', '#52c41a', '#13c2c2', '#1890ff', '#2f54eb',
            '#722ed1', '#eb2f96', '#fa541c', '#faad14', '#f6ffed',
            '#d9f7be', '#b7eb8f', '#95de64', '#73d13d', '#52c41a',
            '#389e0d', '#237804', '#135200', '#fff1f0', '#ffccc7',
            '#ffa39e', '#ff7875', '#ff4d4f', '#f5222d', '#cf1322',
            '#a8071a', '#820014'
        ];
        return $colors[$index % count($colors)];
    }

}