<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StatistikPoli;

class Dashboard1Controller extends Controller
{
    public function index()
    {
        $data = StatistikPoli::all();

        // Ambil dan kelompokkan data berdasarkan jenis_penyakit dan bulan
        $grouped = StatistikPoli::select('jenis_penyakit', 'bulan', DB::raw('SUM(jumlah_pasien) as total'))
            ->groupBy('jenis_penyakit', 'bulan')
            ->get();

        $chartData = [];

        foreach ($grouped->groupBy('jenis_penyakit') as $penyakit => $records) {
            $monthly = array_fill(1, 12, 0);
            foreach ($records as $rec) {
                $monthly[$rec->bulan] = $rec->total;
            }

            // Hanya tampilkan jika ada data selain 0
            if (array_sum($monthly) > 0) {
                $chartData[] = [
                    'label' => $penyakit,
                    'data' => array_values($monthly),
                    'backgroundColor' => '#' . substr(md5($penyakit), 0, 6),
                    'borderColor' => '#' . substr(md5($penyakit), 0, 6),
                    'borderWidth' => 1,
                ];
            }
        }

        return view('pages.dashboard1', compact('data', 'chartData'));
    }
}
