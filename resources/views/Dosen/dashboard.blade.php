@extends('components.layout_dosen')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Data Kelas</h2>
    </div>

    <div class="row">
        @forelse ($mataKuliah as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <div style="height: 150px; background: linear-gradient(to right, #c7b3f1, #b4a0e3);">
                        {{-- Placeholder background image --}}
                    </div>
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-1">
                            [{{ $item->kode ?? 'UMK-21235' }}] {{ $item->mata_kuliah }} - Kelas {{ $item->kelas->kelas }}
                        </h6>
                        <span class="badge bg-light text-muted small">
                            {{ $item->semester }} {{ $item->tahun }}
                        </span>
                        <div class="mt-3">
                            <a href="{{ route('dosen.pertemuan.index', ['kelasId' => $item->kelas_id, 'mataKuliahId' => $item->id]) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                Lihat Pertemuan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada mata kuliah terdaftar.</p>
        @endforelse
    </div>

    <!-- FAB Tambah Kelas -->
    <button class="btn btn-primary rounded-circle shadow-lg"
        style="position: fixed; bottom: 30px; right: 30px; width: 55px; height: 55px; font-size: 24px; background-color: #4b0082;"
        data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
        +
    </button>

    <!-- Modal Tambah Kelas -->
<div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('dosen.kelas.store') }}" method="POST" class="w-100">
      @csrf
      <div class="modal-content border-0 rounded-4 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold" id="modalTambahKelasLabel">Tambah Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body pt-2">
          <div class="mb-3">
            <label class="form-label text-muted">Mata Kuliah</label>
            <input type="text" name="mata_kuliah" class="form-control rounded-pill px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-muted">Semester</label>
            <input type="text" name="semester" class="form-control rounded-pill px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-muted">Tahun</label>
            <input type="number" name="tahun" class="form-control rounded-pill px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-muted">Nama Kelas</label>
            <input type="text" name="kelas" class="form-control rounded-pill px-3 py-2" required>
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
