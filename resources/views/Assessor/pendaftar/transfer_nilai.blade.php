@vite('resources/css/app.css')
@vite('resources/css/pendaftar-custom.css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

@if(request()->ajax())
    {{-- Hanya tampilkan form --}}
    <div class="container py-5">
        <h1 class="text-2xl font-bold mb-4">Transfer Nilai</h1>
        <form method="POST" action="">
            @csrf
            <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
                <table class="min-w-full text-sm border-separate border-spacing-0 rounded-2xl overflow-hidden">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-3 px-4 text-left font-bold text-gray-700">No</th>
                            <th class="py-3 px-4 text-left font-bold text-gray-700">MATAKULIAH LAMPAU</th>
                            <th class="py-3 px-4 text-left font-bold text-gray-700">NILAI</th>
                            <th class="py-3 px-4 text-left font-bold text-gray-700">MATAKULIAH TRPL</th>
                            <th class="py-3 px-4 text-left font-bold text-gray-700">NILAI</th>
                            <th class="py-3 px-4 text-left font-bold text-gray-700">KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transkrip as $i => $row)
                        <tr>
                            <td class="py-3 px-4">{{ $i+1 }}</td>
                            <td class="py-3 px-4">{{ $row->mata_kuliah }}</td>
                            <td class="py-3 px-4">{{ $row->nilai_huruf }}</td>
                            <input type="hidden" name="transkrip_id[]" value="{{ $row->id }}" />
                            <td class="py-3 px-4">
                                <select class="form-select rounded border-gray-300" name="kurikulum[]">
                                    @foreach($kurikulum as $kuri)
                                    <option value="{{ $kuri->id }}">{{ $kuri->mata_kuliah_trpl }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-3 px-4">
                                <select class="form-select rounded border-gray-300" name="nilai_trpl[]">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </td>
                            <td class="py-3 px-4">
                                <input type="text" class="form-input rounded border-gray-300 w-full" name="keterangan[]" value="" placeholder="Masukan keterangan di sini" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-2 bg-purple-800 text-white rounded-lg font-semibold shadow hover:bg-purple-900">Save Changes</button>
            </div>
        </form>
    </div>
@else
    <x-layout_assessor>
        <div class="container py-5">
            <h1 class="text-2xl font-bold mb-4">Transfer Nilai</h1>
            <form method="POST" action="">
                @csrf
                <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
                    <table class="min-w-full text-sm border-separate border-spacing-0 rounded-2xl overflow-hidden">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-3 px-4 text-left font-bold text-gray-700">No</th>
                                <th class="py-3 px-4 text-left font-bold text-gray-700">MATAKULIAH LAMPAU</th>
                                <th class="py-3 px-4 text-left font-bold text-gray-700">NILAI</th>
                                <th class="py-3 px-4 text-left font-bold text-gray-700">MATAKULIAH TRPL</th>
                                <th class="py-3 px-4 text-left font-bold text-gray-700">NILAI</th>
                                <th class="py-3 px-4 text-left font-bold text-gray-700">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transkrip as $i => $row)
                            <tr>
                                <td class="py-3 px-4">{{ $i+1 }}</td>
                                <td class="py-3 px-4">{{ $row->mata_kuliah }}</td>
                                <td class="py-3 px-4">{{ $row->nilai_huruf }}</td>
                                <input type="hidden" name="transkrip_id[]" value="{{ $row->id }}" />
                                <td class="py-3 px-4">
                                    <select class="form-select rounded border-gray-300" name="kurikulum[]">
                                        @foreach($kurikulum as $kuri)
                                        <option value="{{ $kuri->id }}">{{ $kuri->mata_kuliah_trpl }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="py-3 px-4">
                                    <select class="form-select rounded border-gray-300" name="nilai_trpl[]">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                </td>
                                <td class="py-3 px-4">
                                    <input type="text" class="form-input rounded border-gray-300 w-full" name="keterangan[]" value="" placeholder="Masukan keterangan di sini" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 bg-purple-800 text-white rounded-lg font-semibold shadow hover:bg-purple-900">Save Changes</button>
                </div>
            </form>
        </div>
    </x-layout_assessor>
@endif