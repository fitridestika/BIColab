<?php

namespace App\Http\Controllers;

use App\Models\StatistikPoli;
use Illuminate\Http\Request;

class StatistikPoliController extends Controller
{
    public function index()
    {
        $data = StatistikPoli::all();
        return view('pages.epoli', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_penyakit' => 'required|string',
            'jumlah_pasien' => 'required|integer|min:1',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer',
            'unit_rs' => 'nullable|string'
        ]);

        StatistikPoli::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = StatistikPoli::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_penyakit' => 'required|string',
            'jumlah_pasien' => 'required|integer|min:1',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer',
            'unit_rs' => 'nullable|string'
        ]);

        $data = StatistikPoli::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = StatistikPoli::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
