@extends('components.layout_dosen')

@section('sidebar')
    @include('components.sidebar_dosen', ['pertemuanList' => $pertemuanList])
@endsection

@section('content')
<div class="container-fluid py-4 px-5" style="background-color: #f8f9fc; min-height: 100vh;">
    <h3 class="fw-bold">{{ $mataKuliah->mata_kuliah }} - Kelas {{ $kelas->kelas }}</h3>

    @if($pertemuanTerpilih)
        <div class="mt-3 mb-4">
            <h5 class="fw-semibold mb-0">Pertemuan {{ $loop->iteration ?? '' }}</h5>
            <div class="text-muted">{{ $pertemuanTerpilih->nama_pertemuan }}</div>
            <div class="text-muted">{{ $pertemuanTerpilih->tanggal->format('Y-m-d H:i:s') }}</div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dosen.absensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="pertemuan_id" value="{{ $pertemuanTerpilih->id }}">

            <div class="table-responsive">
                <table class="table table-bordered bg-white rounded shadow-sm overflow-hidden">
                    <thead class="text-center align-middle">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th colspan="4">STATUS</th>
                        </tr>
                        <tr class="text-center text-muted">
                            <th></th>
                            <th></th>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alfa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($muridList as $index => $murid)
                        <tr class="align-middle text-center">
                            <td>{{ $index + 1 }}.</td>
                            <td class="text-start">{{ $murid->user->user_name }}</td>
                            @foreach(['Hadir', 'Sakit', 'Izin', 'Alfa'] as $status)
                                <td>
                                    <input type="radio"
                                        name="absensi[{{ $murid->user_id }}]"
                                        value="{{ $status }}"
                                        class="form-check-input"
                                        {{ $murid->absensi_status === $status ? 'checked' : '' }}
                                        required>
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn text-white px-4 py-2" style="background-color: #6a1b9a;">
                    Simpan
                </button>
            </div>
        </form>
    @else
        <p class="text-muted">Silakan pilih pertemuan dari sidebar untuk mulai mengisi absensi.</p>
    @endif
</div>

<!-- Modal Tambah Pertemuan -->
<div class="modal fade" id="modalTambahPertemuan" tabindex="-1" aria-labelledby="modalTambahPertemuanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('dosen.pertemuan.store') }}" method="POST" class="w-100">
      @csrf
      <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
      <input type="hidden" name="mata_kuliah_id" value="{{ $mataKuliah->id }}">
      <div class="modal-content border-0 rounded-4 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold" id="modalTambahPertemuanLabel">Tambah Pertemuan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body pt-2">
          <div class="mb-3">
            <label class="form-label text-muted">Nama Pertemuan</label>
            <input type="text" name="nama_pertemuan" class="form-control rounded-pill px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-muted">Tanggal & Waktu</label>
            <input type="datetime-local" name="tanggal" class="form-control rounded-pill px-3 py-2" required>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0 d-flex justify-content-between">
          <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

@endsection
