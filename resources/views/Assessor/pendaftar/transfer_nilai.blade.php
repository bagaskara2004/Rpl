@vite('resources/css/app.css')
@vite('resources/css/pendaftar-custom.css')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container--default .select2-selection--single {
        height: 44px !important;
        border: 2px solid #e5e7eb !important;
        border-radius: 12px !important;
        padding: 8px 16px !important;
        background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%) !important;
        transition: all 0.3s ease !important;
    }

    .select2-container--default .select2-selection--single:hover {
        border-color: #d1d5db !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px !important;
        padding-left: 0 !important;
        font-weight: 500 !important;
        color: #374151 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
        right: 12px !important;
    }

    .select2-dropdown {
        border: 2px solid #e5e7eb !important;
        border-radius: 12px !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        background: white !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    .select2-results__option {
        padding: 12px 16px !important;
        font-weight: 500 !important;
    }

    .select2-results__option--highlighted {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
    }

    .transfer-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
    }

    .table-header {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }

    .grade-badge {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border: 1px solid #93c5fd;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border: none;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        box-shadow: 0 6px 8px -1px rgba(59, 130, 246, 0.4);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
        transform: translateY(-1px);
    }

    .form-input-enhanced {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 16px;
        background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .form-input-enhanced:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background: white;
    }

    .form-input-enhanced:hover {
        border-color: #d1d5db;
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .table-row:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .header-title {
        background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

@if(request()->ajax())
{{-- Hanya tampilkan form --}}
<div class="mb-8">
    <div class="text-center mb-6">
        <h1 class="header-title text-4xl font-bold mb-2">Transfer Nilai</h1>
        <p class="text-gray-600 text-lg">Kelola transfer nilai mata kuliah dengan mudah</p>
    </div>
    <form method="POST" action="">
        @csrf
        <div class="transfer-card rounded-3xl shadow-xl p-8">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Data Transfer Nilai</h2>
                </div>
            </div>
            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="table-header">
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tl-2xl">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 bg-white rounded-full flex items-center justify-center text-xs font-bold text-gray-600">#</span>
                                    No
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH LAMPAU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    NILAI
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH TRPL
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    NILAI BARU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tr-2xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    KETERANGAN
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transkrip as $i => $row)
                        <tr class="table-row transition-all duration-300">
                            <td class="py-5 px-6 text-gray-800">
                                <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full text-sm font-bold text-blue-700">
                                    {{ $i+1 }}
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="font-semibold text-gray-800">{{ $row->mata_kuliah }}</div>
                                <div class="text-xs text-gray-500 mt-1">Mata Kuliah Sebelumnya</div>
                            </td>
                            <td class="py-5 px-6">
                                <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold text-blue-800">
                                    {{ $row->nilai_huruf }}
                                </span>
                            </td>
                            <input type="hidden" name="transkrip_id[]" value="{{ $row->id }}" />
                            <td class="py-5 px-6">
                                <select class="kurikulum-select w-full" name="kurikulum[]" data-row="{{ $i }}">
                                    <option value="">Pilih Mata Kuliah TRPL</option>
                                    @foreach($kurikulum as $kuri)
                                    <option value="{{ $kuri->id }}">{{ $kuri->mata_kuliah_trpl }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <select class="form-input-enhanced w-full" name="nilai_trpl[]">
                                    <option value="">Pilih Nilai</option>
                                    <option value="A">A - Sangat Baik</option>
                                    <option value="B">B - Baik</option>
                                    <option value="C">C - Cukup</option>
                                    <option value="D">D - Kurang</option>
                                    <option value="E">E - Sangat Kurang</option>
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <input type="text" class="form-input-enhanced w-full" name="keterangan[]" value="" placeholder="Tambahkan catatan..." />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-8 gap-4">
            <button type="button" class="btn-secondary px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="submit" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                Simpan Transfer Nilai
            </button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Store all available options
        const allOptions = [];
        $('.kurikulum-select option').each(function() {
            if ($(this).val() !== '') {
                allOptions.push({
                    id: $(this).val(),
                    text: $(this).text()
                });
            }
        });

        // Initialize Select2 for all kurikulum dropdowns
        $('.kurikulum-select').select2({
            placeholder: 'Pilih Mata Kuliah TRPL',
            allowClear: true,
            width: '100%'
        });

        // Function to update dropdown options
        function updateDropdownOptions() {
            const selectedValues = [];
            $('.kurikulum-select').each(function() {
                const val = $(this).val();
                if (val) {
                    selectedValues.push(val);
                }
            });

            $('.kurikulum-select').each(function() {
                const currentSelect = $(this);
                const currentValue = currentSelect.val();

                // Clear and rebuild options
                currentSelect.empty();
                currentSelect.append('<option value="">Pilih Mata Kuliah TRPL</option>');

                allOptions.forEach(function(option) {
                    // Include option if it's not selected elsewhere or if it's the current selection
                    if (!selectedValues.includes(option.id) || option.id === currentValue) {
                        currentSelect.append('<option value="' + option.id + '">' + option.text + '</option>');
                    }
                });

                // Restore current value
                currentSelect.val(currentValue);
                currentSelect.trigger('change.select2');
            });
        }

        // Handle selection change
        $('.kurikulum-select').on('change', function() {
            updateDropdownOptions();
        });

        // Initial update
        updateDropdownOptions();
    });
</script>

@else
<x-layout_assessor>
    <div class="mb-8">
        <div class="flex items-center gap-6 mb-6">
            <a href="{{ route('assesor.pendaftar') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-300 bg-white rounded-xl px-4 py-2 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali ke Pendaftar
            </a>
        </div>
        <div class="text-center mb-6">
            <h1 class="header-title text-4xl font-bold mb-2">Transfer Nilai</h1>
            <p class="text-gray-600 text-lg">Kelola transfer nilai mata kuliah dengan mudah</p>
        </div>
    </div>

    <form method="POST" action="">
        @csrf
        <div class="transfer-card rounded-3xl shadow-xl p-8">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Data Transfer Nilai</h2>
                </div>
            </div>
            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="table-header">
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tl-2xl">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 bg-white rounded-full flex items-center justify-center text-xs font-bold text-gray-600">#</span>
                                    No
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH LAMPAU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    NILAI
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    MATA KULIAH TRPL
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    NILAI BARU
                                </div>
                            </th>
                            <th class="py-4 px-6 text-left font-bold text-gray-700 rounded-tr-2xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    KETERANGAN
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transkrip as $i => $row)
                        <tr class="table-row transition-all duration-300">
                            <td class="py-5 px-6 text-gray-800">
                                <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full text-sm font-bold text-blue-700">
                                    {{ $i+1 }}
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="font-semibold text-gray-800">{{ $row->mata_kuliah }}</div>
                                <div class="text-xs text-gray-500 mt-1">Mata Kuliah Sebelumnya</div>
                            </td>
                            <td class="py-5 px-6">
                                <span class="grade-badge inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold text-blue-800">
                                    {{ $row->nilai_huruf }}
                                </span>
                            </td>
                            <input type="hidden" name="transkrip_id[]" value="{{ $row->id }}" />
                            <td class="py-5 px-6">
                                <select class="kurikulum-select w-full" name="kurikulum[]" data-row="{{ $i }}">
                                    <option value="">Pilih Mata Kuliah TRPL</option>
                                    @foreach($kurikulum as $kuri)
                                    <option value="{{ $kuri->id }}">{{ $kuri->mata_kuliah_trpl }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <select class="form-input-enhanced w-full" name="nilai_trpl[]">
                                    <option value="">Pilih Nilai</option>
                                    <option value="A">A - Sangat Baik</option>
                                    <option value="B">B - Baik</option>
                                    <option value="C">C - Cukup</option>
                                    <option value="D">D - Kurang</option>
                                    <option value="E">E - Sangat Kurang</option>
                                </select>
                            </td>
                            <td class="py-5 px-6">
                                <input type="text" class="form-input-enhanced w-full" name="keterangan[]" value="" placeholder="Tambahkan catatan..." />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-8 gap-4">
            <button type="button" class="btn-secondary px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="submit" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                Simpan Transfer Nilai
            </button>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Store all available options
            const allOptions = [];
            $('.kurikulum-select option').each(function() {
                if ($(this).val() !== '') {
                    allOptions.push({
                        id: $(this).val(),
                        text: $(this).text()
                    });
                }
            });

            // Initialize Select2 for all kurikulum dropdowns
            $('.kurikulum-select').select2({
                placeholder: 'Pilih Mata Kuliah TRPL',
                allowClear: true,
                width: '100%'
            });

            // Function to update dropdown options
            function updateDropdownOptions() {
                const selectedValues = [];
                $('.kurikulum-select').each(function() {
                    const val = $(this).val();
                    if (val) {
                        selectedValues.push(val);
                    }
                });

                $('.kurikulum-select').each(function() {
                    const currentSelect = $(this);
                    const currentValue = currentSelect.val();

                    // Clear and rebuild options
                    currentSelect.empty();
                    currentSelect.append('<option value="">Pilih Mata Kuliah TRPL</option>');

                    allOptions.forEach(function(option) {
                        // Include option if it's not selected elsewhere or if it's the current selection
                        if (!selectedValues.includes(option.id) || option.id === currentValue) {
                            currentSelect.append('<option value="' + option.id + '">' + option.text + '</option>');
                        }
                    });

                    // Restore current value
                    currentSelect.val(currentValue);
                    currentSelect.trigger('change.select2');
                });
            }

            // Handle selection change
            $('.kurikulum-select').on('change', function() {
                updateDropdownOptions();
            });

            // Initial update
            updateDropdownOptions();
        });
    </script>
</x-layout_assessor>
@endif