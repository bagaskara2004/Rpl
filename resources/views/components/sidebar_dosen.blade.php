<div class="bg-white p-3 shadow-sm" style="height: 100vh; overflow-y: auto; width: 250px;">
    <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPertemuan">
        + Tambah Pertemuan
    </button>

    <ul class="list-group">
        @forelse ($pertemuanList as $index => $p)
        <li class="list-group-item position-relative 
            {{ $p->absensi->isNotEmpty() ? 'bg-light text-muted' : '' }}">
            
            <!-- Tautan ke absensi -->
            <a href="{{ route('dosen.pertemuan.index', ['kelasId' => $p->kelas_id, 'mataKuliahId' => $p->mata_kuliah_id, 'pertemuanId' => $p->id]) }}"
                class="text-decoration-none d-block pe-4 {{ $p->absensi->isNotEmpty() ? 'text-muted' : 'text-dark' }}">
                <div class="fw-bold">Pertemuan {{ $loop->iteration }}</div>
                {{ $p->nama_pertemuan }} <br>
                <small class="text-muted">{{ $p->tanggal->format('d M Y') }}</small>
            </a>

            <!-- Dropdown titik tiga -->
            <div class="dropdown position-absolute end-0 top-0 mt-2 me-2">
                <a href="#" class="text-muted" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPertemuanModal{{ $p->id }}">
                            Edit
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('dosen.pertemuan.delete', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pertemuan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">Hapus</button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Modal Edit Pertemuan -->
        <div class="modal fade" id="editPertemuanModal{{ $p->id }}" tabindex="-1" aria-labelledby="editPertemuanLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('dosen.pertemuan.update', $p->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="kelas_id" value="{{ $p->kelas_id }}">
                    <input type="hidden" name="mata_kuliah_id" value="{{ $p->mata_kuliah_id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPertemuanLabel{{ $p->id }}">Edit Pertemuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Pertemuan</label>
                                <input type="text" name="nama_pertemuan" class="form-control" value="{{ $p->nama_pertemuan }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $p->tanggal->format('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @empty
            <li class="list-group-item">Belum ada pertemuan</li>
        @endforelse
    </ul>
</div>
