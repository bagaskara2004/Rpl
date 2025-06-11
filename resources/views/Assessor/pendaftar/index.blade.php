<x-lyout_asesor>
    @vite('resources/css/app.css')
    @vite('resources/css/pendaftar-custom.css')
    <!-- Tambahkan Bootstrap CSS dan JS jika belum ada -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Import Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS custom sudah dipindahkan ke resources/css/pendaftar-custom.css -->

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftar</h1>
        <div class="bg-white rounded-2xl shadow flex items-center px-2 py-1 mb-6 overflow-x-auto w-full max-w-3xl">
            <div class="flex items-center justify-center w-10 h-10">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 4a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-.293.707l-6.414 6.414A1 1 0 0 0 13 14.414V19a1 1 0 0 1-1.447.894l-2-1A1 1 0 0 1 9 18v-3.586a1 1 0 0 0-.293-.707L2.293 6.707A1 1 0 0 1 2 6V4z" />
                </svg>
            </div>
            <div class="flex-1 grid grid-cols-4 gap-0">
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <span class="text-gray-800 font-medium text-sm">Filter By</span>
                </div>
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <select class="w-full bg-transparent focus:outline-none text-gray-800 font-medium text-sm py-1">
                        <option>Date</option>
                    </select>
                </div>
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <select class="w-full bg-transparent focus:outline-none text-gray-800 font-medium text-sm py-1">
                        <option>Major Type</option>
                    </select>
                </div>
                <div class="flex items-center border-l border-gray-200 px-2 h-10">
                    <select class="w-full bg-transparent focus:outline-none text-gray-800 font-medium text-sm py-1">
                        <option>Status</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center border-l border-gray-200 px-2 h-10">
                <button class="flex items-center text-pink-600 hover:text-pink-700 font-medium text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                        <path d="M12 8v4l3 3" />
                    </svg>
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-2 overflow-x-auto">
        <table class="min-w-full text-sm border-separate border-spacing-0 rounded-2xl overflow-hidden" id="pendaftar-table">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">No</th>
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">NAME</th>
                    <th class="py-3 px-4 text-left font-bold text-gray-700 border-b">MAJOR</th>
                    <th class="py-3 px-4 text-center font-bold text-gray-700 border-b">ACTION</th>
                    <th class="py-3 px-4 text-center font-bold text-gray-700 border-b">ACTION</th>
                </tr>
            </thead>
            <tbody id="pendaftar-tbody">
                <tr>
                    <td colspan="5" class="text-center py-4">Loading...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="modal-container"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("{{ route('assesor.pendaftar.data') }}")
                .then(response => response.json())
                .then(data => renderTable(data));

            function renderTable(data) {
                const tbody = document.getElementById('pendaftar-tbody');
                const modalContainer = document.getElementById('modal-container');
                tbody.innerHTML = '';
                modalContainer.innerHTML = '';
                if (!data.length) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">Tidak ada data</td></tr>';
                    return;
                }
                data.forEach((diri, i) => {
                    tbody.innerHTML += `
        <tr class="border-b hover:bg-gray-50 transition">
            <td class="py-3 px-4">${i+1}</td>
            <td class="py-3 px-4">${diri.nama_lengkap}</td>
            <td class="py-3 px-4">Jurusan ${diri.pendidikan?.jurusan ?? '-'}</td>
            <td class="py-3 px-4 text-center">
                <div class="inline-flex gap-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 border border-gray-200">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                    <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 border border-gray-200">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </td>
            <td class="py-3 px-4 text-center">
                <div class="inline-flex gap-2">
                    <button class="px-4 py-1 rounded border border-primary text-primary bg-white hover:bg-primary hover:text-white text-xs font-semibold" data-bs-toggle="modal" data-bs-target="#modalDataDiri${diri.id}" onclick="loadModalData(${diri.id})">Data</button>
                    <button class="px-4 py-1 rounded border border-yellow-400 text-yellow-700 bg-white hover:bg-yellow-50 text-xs font-semibold" data-bs-toggle="modal" data-bs-target="#modalAsesmen${diri.id}" onclick="loadModalAsesmen(${diri.id})">Asesmen</button>
                    <button class="px-4 py-1 rounded border border-purple-600 text-purple-700 bg-white hover:bg-purple-50 text-xs font-semibold">Transfer</button>
                </div>
            </td>
        </tr>
        `;
                    // Modal skeleton (akan diisi AJAX saat tombol Data diklik)
                    modalContainer.innerHTML += `
    <div class="modal fade" id="modalDataDiri${diri.id}" tabindex="-1" aria-labelledby="modalDataDiriLabel${diri.id}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" id="modal-content-${diri.id}">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDataDiriLabel${diri.id}">Detail Data Diri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center text-muted">Loading...</div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAsesmen${diri.id}" tabindex="-1" aria-labelledby="modalAsesmenLabel${diri.id}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" id="modal-asesmen-content-${diri.id}">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAsesmenLabel${diri.id}">Asesmen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center text-muted">Loading...</div>
            </div>
        </div>
    </div>
`;
                });
            }
        });

        window.loadModalData = function(id) {
            const modalContent = document.getElementById('modal-content-' + id);
            fetch(`/assesor/modal/pendaftar/${id}`)
                .then(res => res.json())
                .then(diri => {
                    modalContent.innerHTML = `
                <div class="modal-header position-relative align-items-start flex-wrap">
                    <div class="flex-grow-1">
                        <h5 class="modal-title" id="modalDataDiriLabel${diri.id}">Detail Data Diri</h5>
                    </div>
                    ${diri.foto ? `<div class='d-none d-md-block' style='margin-left:auto;'><img src='/assets/${diri.foto}' alt='Foto' style='width:80px;height:80px;object-fit:cover;border-radius:50%;border:3px solid #eee;background:#fff;'/></div>` : ''}
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        ${diri.foto ? `<div class='col-12 d-block d-md-none text-center mb-3'><img src='/assets/${diri.foto}' alt='Foto' style='width:80px;height:80px;object-fit:cover;border-radius:50%;border:3px solid #eee;background:#fff;'/></div>` : ''}
                        <div class="col-md-6 mb-2"><strong>Nama Lengkap:</strong> ${diri.nama_lengkap ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Email:</strong> ${diri.email ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>NIK:</strong> ${diri.nik ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Tempat Lahir:</strong> ${diri.tempat_lahir ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Tanggal Lahir:</strong> ${diri.tgl_lahir ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Jenis Kelamin:</strong> ${diri.jenis_kelamin ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>No HP:</strong> ${diri.hp ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>No Telepon:</strong> ${diri.tlp ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Alamat:</strong> ${diri.alamat ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Kab/Kota:</strong> ${diri.kab_kota ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Provinsi:</strong> ${diri.provinsi ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Kode Pos:</strong> ${diri.kode_pos ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Sumber Biaya Pendidikan:</strong> ${diri.sumber_biaya_pen ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Nama Ibu:</strong> ${diri.nama_ibu ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Pekerjaan Ibu:</strong> ${diri.pekerjaan_ibu ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Nama Ayah:</strong> ${diri.nama_ayah ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Pekerjaan Ayah:</strong> ${diri.pekerjaan_ayah ?? '-'}</div>
                    </div>
                    <hr>
                    <h6 class="fw-bold mt-3">Pendidikan</h6>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2"><strong>Prodi:</strong> ${diri.pendidikan?.prodi ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Jurusan:</strong> ${diri.pendidikan?.jurusan ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Pembimbing 1:</strong> ${diri.pendidikan?.pembimbing1 ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Judul TA:</strong> ${diri.pendidikan?.judul_ta ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Tahun Lulus:</strong> ${diri.pendidikan?.tahun_lulus ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>IPK:</strong> ${diri.pendidikan?.ipk ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>NIM:</strong> ${diri.pendidikan?.nim ?? '-'}</div>
                        <div class="col-md-6 mb-2"><strong>Jenjang Pendidikan:</strong> ${diri.pendidikan?.jenjang_pendidikan ?? '-'}</div>
                    </div>
                    <hr>
                    <h6 class="fw-bold mt-3">Pengalaman Kerja</h6>
                    <div>
                        ${(diri.pengalaman_kerja && diri.pengalaman_kerja.length > 0) ? `
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>Kota/Kab</th>
                                            <th>Provinsi</th>
                                            <th>Negara</th>
                                            <th>Sejak</th>
                                            <th>Sampai</th>
                                            <th>Nama Staf</th>
                                            <th>Posisi Staf</th>
                                            <th>Telp Staf</th>
                                            <th>Email Staf</th>
                                            <th>Fax Staf</th>
                                            <th>Dokumen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${diri.pengalaman_kerja.map((kerja, idx) => `
                                            <tr>
                                                <td>${idx+1}</td>
                                                <td>${kerja.nama_perusahaan ?? '-'}</td>
                                                <td>${kerja.alamat_perusahaan ?? '-'}</td>
                                                <td>${kerja.kota_kab_perusahaan ?? '-'}</td>
                                                <td>${kerja.provinsi_perusahaan ?? '-'}</td>
                                                <td>${kerja.negara_perusahaan ?? '-'}</td>
                                                <td>${kerja.sejak ?? '-'}</td>
                                                <td>${kerja.sampai ?? '-'}</td>
                                                <td>${kerja.nama_staf ?? '-'}</td>
                                                <td>${kerja.posisi_staf ?? '-'}</td>
                                                <td>${kerja.tlp_staf ?? '-'}</td>
                                                <td>${kerja.email_staf ?? '-'}</td>
                                                <td>${kerja.fax_staf ?? '-'}</td>
                                                <td>${kerja.dokumen_pendukung ? `<a href="/assets/${kerja.dokumen_pendukung}" target="_blank">Lihat</a>` : '-'}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>
                        ` : '<div class="text-muted">Tidak ada pengalaman kerja</div>'}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            `;
                });
        }

        window.loadModalAsesmen = function(id) {
            const modalContent = document.getElementById('modal-asesmen-content-' + id);
            // TODO: Ganti dengan AJAX fetch data asesmen jika sudah ada endpointnya
            modalContent.innerHTML = `
        <div class="modal-header">
            <h5 class="modal-title">Asesmen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="text-center">Form/Detail asesmen untuk user ID <b>${id}</b> tampil di sini.</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    `;
        }
    </script>
</x-lyout_asesor>