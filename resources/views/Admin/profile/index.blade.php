@extends('components.layout_admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Profile Admin</h1>
                <p class="text-blue-100">Kelola informasi personal dan pengaturan akun Anda</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Photo Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Foto Profile</h2>

                <div class="text-center">
                    <div class="relative inline-block">
                        <div id="photo-container" class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                            @if($user->foto)
                            <img id="profile-photo" src="{{ asset('storage/profile_photos/' . $user->foto) }}" alt="Profile Photo" class="w-full h-full object-cover">
                            @else
                            <span id="profile-initial" class="text-white text-4xl font-bold">{{ strtoupper(substr($user->user_name ?? $user->name ?? 'A', 0, 1)) }}</span>
                            @endif
                        </div>
                        <button id="change-photo-btn" class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>

                    <input type="file" id="photo-input" accept="image/*" class="hidden">

                    <div class="text-sm text-gray-600">
                        <p class="mb-2">Format yang didukung: JPG, PNG, GIF</p>
                        <p>Ukuran maksimal: 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Account Status -->
            <div class="bg-white rounded-2xl shadow p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Akun</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Role</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Administrator</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Aktif</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Bergabung</span>
                        <span class="text-gray-900">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Informasi Personal</h2>
                    <button id="edit-profile-btn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Profile
                    </button>
                </div>

                <form id="profile-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="user_name" name="user_name" value="{{ $user->user_name ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            disabled>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ $user->name ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            disabled>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            disabled>
                    </div>

                    <div id="profile-form-actions" class="hidden pt-4 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancel-edit-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <span class="loading-text">Simpan Perubahan</span>
                                <span class="loading-spinner hidden">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Menyimpan...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Ubah Password</h2>
                    <button id="change-password-btn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Ubah Password
                    </button>
                </div>

                <form id="password-form" class="space-y-4" style="display: none;">
                    @csrf
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                            required>
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" id="new_password" name="new_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                            required minlength="8">
                        <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                            required>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancel-password-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                <span class="loading-text">Ubah Password</span>
                                <span class="loading-spinner hidden">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Mengubah...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>

                <div id="password-info" class="text-gray-600">
                    <p class="text-sm">Untuk keamanan akun, disarankan untuk mengubah password secara berkala.</p>
                    <p class="text-sm mt-2">Password terakhir diubah: <span class="font-medium">{{ $user->updated_at->format('d M Y, H:i') }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setupProfileForm();
        setupPasswordForm();
        setupPhotoUpload();
    });

    function setupProfileForm() {
        const editBtn = document.getElementById('edit-profile-btn');
        const cancelBtn = document.getElementById('cancel-edit-btn');
        const form = document.getElementById('profile-form');
        const formActions = document.getElementById('profile-form-actions');
        const inputs = form.querySelectorAll('input');

        editBtn.addEventListener('click', function() {
            inputs.forEach(input => {
                if (input.type !== 'hidden') {
                    input.disabled = false;
                }
            });
            formActions.classList.remove('hidden');
            editBtn.style.display = 'none';
        });

        cancelBtn.addEventListener('click', function() {
            inputs.forEach(input => {
                if (input.type !== 'hidden') {
                    input.disabled = true;
                }
            });
            formActions.classList.add('hidden');
            editBtn.style.display = 'inline-flex';
            form.reset();
            // Reset to original values
            document.getElementById('user_name').value = '{{ $user->user_name ?? "" }}';
            document.getElementById('name').value = '{{ $user->name ?? "" }}';
            document.getElementById('email').value = '{{ $user->email }}';
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const loadingText = submitBtn.querySelector('.loading-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            // Show loading state
            loadingText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const formData = new FormData(form);

            fetch('{{ route("admin.profile.update") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Gagal memperbarui profile'
                    });
                })
                .finally(() => {
                    // Reset loading state
                    loadingText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                });
        });
    }

    function setupPasswordForm() {
        const changePasswordBtn = document.getElementById('change-password-btn');
        const cancelPasswordBtn = document.getElementById('cancel-password-btn');
        const passwordForm = document.getElementById('password-form');
        const passwordInfo = document.getElementById('password-info');

        changePasswordBtn.addEventListener('click', function() {
            passwordForm.style.display = 'block';
            passwordInfo.style.display = 'none';
            changePasswordBtn.style.display = 'none';
        });

        cancelPasswordBtn.addEventListener('click', function() {
            passwordForm.style.display = 'none';
            passwordInfo.style.display = 'block';
            changePasswordBtn.style.display = 'inline-flex';
            passwordForm.reset();
        });

        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = passwordForm.querySelector('button[type="submit"]');
            const loadingText = submitBtn.querySelector('.loading-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            // Show loading state
            loadingText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const formData = new FormData(passwordForm);

            fetch('{{ route("admin.profile.change-password") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            passwordForm.reset();
                            passwordForm.style.display = 'none';
                            passwordInfo.style.display = 'block';
                            changePasswordBtn.style.display = 'inline-flex';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Gagal mengubah password'
                    });
                })
                .finally(() => {
                    // Reset loading state
                    loadingText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                });
        });
    }

    function setupPhotoUpload() {
        const changePhotoBtn = document.getElementById('change-photo-btn');
        const photoInput = document.getElementById('photo-input');
        const photoContainer = document.getElementById('photo-container');

        changePhotoBtn.addEventListener('click', function() {
            photoInput.click();
        });

        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar!',
                        text: 'Ukuran file maksimal 2MB'
                    });
                    return;
                }

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Tidak Valid!',
                        text: 'Hanya file gambar yang diperbolehkan'
                    });
                    return;
                }

                const formData = new FormData();
                formData.append('photo', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('{{ route("admin.profile.upload-photo") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update photo display
                            photoContainer.innerHTML = `<img id="profile-photo" src="${data.photo_url}" alt="Profile Photo" class="w-full h-full object-cover">`;

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            text: 'Gagal mengupload foto'
                        });
                    });
            }
        });
    }
</script>
@endsection