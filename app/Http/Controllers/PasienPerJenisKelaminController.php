<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasienPerJenisKelamin;

class PasienPerJenisKelaminController extends Controller
{
    public function index()
    {
        $data = PasienPerJenisKelamin::all();
        return view('pages.pasien-jenis-kelamin', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'required',
            'jumlah_pasien' => 'required|numeric',
            'bulan' => 'required',
            'tahun' => 'required',
            'wilayah' => 'nullable',
        ]);

        PasienPerJenisKelamin::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = PasienPerJenisKelamin::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}