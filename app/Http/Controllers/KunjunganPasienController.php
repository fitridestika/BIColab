<?php

namespace App\Http\Controllers;

use App\Models\KunjunganPasien;
use Illuminate\Http\Request;

class KunjunganPasienController extends Controller
{
    public function index()
    {
        $data = KunjunganPasien::orderBy('tahun')->orderBy('bulan')->get();
        return view('pages.kunjunganpasien', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'pasien_baru' => 'required|integer|min:0',
            'pasien_lama' => 'required|integer|min:0',
        ]);

        $total_kunjungan = $request->pasien_baru + $request->pasien_lama;

        KunjunganPasien::create([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'pasien_baru' => $request->pasien_baru,
            'pasien_lama' => $request->pasien_lama,
            'total_kunjungan' => $total_kunjungan,
        ]);

        return redirect('/kunjungan')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id)
    {
        $data = KunjunganPasien::findOrFail($id);
        $data->delete();

        return redirect('/kunjungan')->with('success', 'Data berhasil dihapus!');
    }
}
