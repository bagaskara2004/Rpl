@extends('components.layout_dosen')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Selamat datang, {{ $user->user_name }}</h2>

        <div class="row">
            @forelse ($mataKuliah as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $item->mata_kuliah }} - Kelas {{ $item->kelas->kelas }}
                            </h5>
                            <p class="card-text">
                                <span class="badge bg-light text-muted">
                                    Semester {{ $item->semester }} -
                                    Tahun {{ $item->tahun }}
                                </span>
                            </p>
                            <a href="{{ route('dosen.pertemuan.index', ['kelasId' => $item->kelas_id, 'mataKuliahId' => $item->id]) }}" class="btn btn-primary">
                                Lihat Pertemuan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada mata kuliah terdaftar.</p>
            @endforelse
        </div>
    </div>

    <!-- FAB Tambah Kelas -->
    <button class="btn btn-primary rounded-circle fab" data-bs-toggle="modal" data-bs-target="#modalTambahKelas"
        style="position: fixed; bottom: 30px; right: 30px; z-index: 999;">
        <i class="bi bi-plus fs-4 text-white"></i>
    </button>

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('dosen.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahKelasLabel">Tambah Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" name="semester" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Nama Kelas</label>
                            <input type="text" name="kelas" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
