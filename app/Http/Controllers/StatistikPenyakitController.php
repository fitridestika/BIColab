<?php

namespace App\Http\Controllers;

use App\Models\StatistikPenyakit;
use Illuminate\Http\Request;

class StatistikPenyakitController extends Controller
{
    public function index()
    {
        $data = StatistikPenyakit::all();
        return view('pages.pbb', compact('data'));
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

        StatistikPenyakit::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = StatistikPenyakit::findOrFail($id);
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

        $data = StatistikPenyakit::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = StatistikPenyakit::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
