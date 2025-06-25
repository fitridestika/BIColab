@extends('layouts.index')

@section('title', 'Healthcare BI Dashboard')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Kunjungan Pasien Baru vs Lama</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Statistik Pasien</div>
      <div class="breadcrumb-item">Kunjungan Pasien</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
          <div class="card-header">
            <h4>Statistik Kunjungan Pasien Baru vs Lama</h4>
            <div class="card-header-action">
              <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                <i class="fas fa-plus"></i> Tambah Data
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Pasien Baru</th>
                    <th>Pasien Lama</th>
                    <th>Total Kunjungan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $index => $item)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}</td>
                      <td>{{ $item->tahun }}</td>
                      <td>{{ $item->pasien_baru }}</td>
                      <td>{{ $item->pasien_lama }}</td>
                      <td>{{ $item->total_kunjungan }}</td>
                      <td>
                        <form action="{{ url('/kunjungan/' . $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  @if($data->isEmpty())
                    <tr><td colspan="7" class="text-center">Belum ada data</td></tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

<!-- Modal Tambah Data -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahDataModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ url('/kunjungan') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Kunjungan Pasien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Bulan</label>
              <select name="bulan" class="form-control" required>
                <option value="">Pilih Bulan</option>
                @foreach(range(1, 12) as $bulan)
                  <option value="{{ $bulan }}">{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Tahun</label>
              <select name="tahun" class="form-control" required>
                <option value="">Pilih Tahun</option>
                @foreach(range(2023, 2025) as $tahun)
                  <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Jumlah Pasien Baru</label>
            <input type="number" name="pasien_baru" class="form-control" placeholder="Masukkan jumlah pasien baru" required>
          </div>
          <div class="form-group">
            <label>Jumlah Pasien Lama</label>
            <input type="number" name="pasien_lama" class="form-control" placeholder="Masukkan jumlah pasien lama" required>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
