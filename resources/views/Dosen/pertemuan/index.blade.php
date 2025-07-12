@extends('components.layout_dosen')

@section('sidebar')
    @include('components.sidebar_dosen', ['pertemuanList' => $pertemuanList])
@endsection

@section('content')
<div class="container mt-4">
    <h4>{{ $mataKuliah->mata_kuliah }} - Kelas {{ $kelas->kelas }}</h4>

    @if($pertemuanTerpilih)
        <hr>
        <h5>Absensi - {{ $pertemuanTerpilih->nama_pertemuan }} ({{ $pertemuanTerpilih->tanggal->format('d M Y') }})</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dosen.absensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="pertemuan_id" value="{{ $pertemuanTerpilih->id }}">

            <table class="table table-bordered mt-3">
                <thead class="text-center align-middle">
                    <tr>
                        <th class="text-start">Nama Mahasiswa</th>
                        <th class="text-center">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($muridList as $murid)
                    <tr>
                        <td>{{ $murid->user->user_name }}</td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center flex-wrap gap-3">
                                @foreach (['Hadir', 'Izin', 'Sakit', 'Alfa'] as $value)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="absensi[{{ $murid->user_id }}]"
                                            id="{{ $value }}_{{ $murid->user_id }}"
                                            value="{{ $value }}"
                                            {{ isset($absensiList[$murid->user_id]) && $absensiList[$murid->user_id] === $value ? 'checked' : '' }}
                                            required>
                                        <label class="form-check-label" for="{{ $value }}_{{ $murid->user_id }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <a href="{{ route('dosen.pertemuan.index', ['kelasId' => $kelas->id, 'mataKuliahId' => $mataKuliah->id]) }}"
                   class="btn btn-secondary">
                   Kembali
                </a>
                <button type="submit" class="btn btn-success">Simpan Absensi</button>
            </div>
        </form>
    @else
        <p class="text-muted">Silakan pilih pertemuan dari sidebar untuk mulai mengisi absensi.</p>
    @endif
</div>
@endsection
