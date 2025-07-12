<div class="d-flex flex-column bg-white shadow-sm" style="height: 100vh; width: 250px;">
    <!-- Tombol Tambah Pertemuan -->
    <div class="p-3 border-bottom">
        <button class="btn btn-outline-dark w-100 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahPertemuan">
            <i class="bi bi-plus-lg"></i> Tambah Pertemuan
        </button>
    </div>

    <!-- Judul -->
    <div class="px-3 py-2 text-muted border-bottom fw-semibold small text-uppercase">
        List Pertemuan
    </div>

    <!-- Daftar Pertemuan -->
    <div class="flex-grow-1 overflow-auto">
        <ul class="list-group list-group-flush">
            @forelse ($pertemuanList as $p)
                @php
                    $isTerpilih = request('pertemuanId') == $p->id;
                    $sudahAbsen = $p->absensi->isNotEmpty();
                @endphp
                <li class="list-group-item px-3 py-2 {{ $isTerpilih ? 'bg-light fw-semibold' : '' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <a href="{{ route('dosen.pertemuan.index', ['kelasId' => $p->kelas_id, 'mataKuliahId' => $p->mata_kuliah_id, 'pertemuanId' => $p->id]) }}"
                               class="text-decoration-none {{ $sudahAbsen ? 'text-muted' : 'text-dark' }}">
                                <div>Pertemuan {{ $loop->iteration }}</div>
                                <div class="small">{{ $p->nama_pertemuan }}</div>
                                <div class="small text-muted">{{ $p->tanggal->format('Y-m-d H:i:s') }}</div>
                            </a>
                        </div>

                        <!-- Dropdown -->
                        <div class="dropdown">
                            <a href="#" class="text-muted" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="#" class="dropdown-item"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editPertemuanModal{{ $p->id }}">
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
                    </div>
                </li>

                <!-- Modal Edit -->
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pertemuan</label>
                                        <input type="text" name="nama_pertemuan" class="form-control" value="{{ $p->nama_pertemuan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="datetime-local" name="tanggal" class="form-control" value="{{ $p->tanggal->format('Y-m-d\TH:i') }}" required>
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
            @empty
                <li class="list-group-item text-muted text-center">Belum ada pertemuan</li>
            @endforelse
        </ul>
    </div>
</div>
