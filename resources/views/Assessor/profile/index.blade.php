<x-layout_assessor>
    @vite('resources/css/app.css')

    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Profile Assessor</h1>
                    <p class="text-purple-100">Kelola informasi personal dan pengaturan akun Anda</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-16 h-16 text-purple-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
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
                            <div id="photo-container" class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center">
                                @if($user->foto)
                                <img id="profile-photo" src="{{ asset('storage/profile_photos/' . $user->foto) }}" alt="Profile Photo" class="w-full h-full object-cover">
                                @else
                                <span id="profile-initial" class="text-white text-4xl font-bold">{{ strtoupper(substr($user->user_name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <button id="change-photo-btn" class="absolute bottom-0 right-0 bg-purple-600 text-white p-2 rounded-full hover:bg-purple-700 transition">
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
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">Assessor</span>
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
                        <button id="edit-profile-btn" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profile
                        </button>
                    </div>

                    <form id="profile-form" class="space-y-4">
                        @csrf
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                                disabled>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                                disabled>
                        </div>

                        <div id="profile-form-actions" class="hidden pt-4 border-t border-gray-200">
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancel-edit-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
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
                inputs.forEach(input => input.disabled = false);
                formActions.classList.remove('hidden');
                editBtn.style.display = 'none';
            });

            cancelBtn.addEventListener('click', function() {
                inputs.forEach(input => input.disabled = true);
                formActions.classList.add('hidden');
                editBtn.style.display = 'block';
                form.reset();
                // Restore original values
                document.getElementById('user_name').value = '{{ $user->user_name }}';
                document.getElementById('email').value = '{{ $user->email }}';
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                updateProfile();
            });
        }

        function setupPasswordForm() {
            const changeBtn = document.getElementById('change-password-btn');
            const cancelBtn = document.getElementById('cancel-password-btn');
            const form = document.getElementById('password-form');
            const info = document.getElementById('password-info');

            changeBtn.addEventListener('click', function() {
                form.style.display = 'block';
                info.style.display = 'none';
                changeBtn.style.display = 'none';
            });

            cancelBtn.addEventListener('click', function() {
                form.style.display = 'none';
                info.style.display = 'block';
                changeBtn.style.display = 'block';
                form.reset();
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                changePassword();
            });
        }

        function setupPhotoUpload() {
            const changePhotoBtn = document.getElementById('change-photo-btn');
            const photoInput = document.getElementById('photo-input');

            changePhotoBtn.addEventListener('click', function() {
                photoInput.click();
            });

            photoInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    uploadPhoto(e.target.files[0]);
                }
            });
        }

        function updateProfile() {
            const form = document.getElementById('profile-form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const loadingText = submitBtn.querySelector('.loading-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            // Show loading state
            loadingText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const formData = new FormData(form);

            fetch('{{ route("assesor.profile.update") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#7C3AED'
                        });

                        // Reset form state
                        const inputs = form.querySelectorAll('input');
                        inputs.forEach(input => input.disabled = true);
                        document.getElementById('profile-form-actions').classList.add('hidden');
                        document.getElementById('edit-profile-btn').style.display = 'block';

                        // Update display values
                        if (data.user) {
                            document.getElementById('user_name').value = data.user.user_name;
                            document.getElementById('email').value = data.user.email;
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonColor: '#EF4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memperbarui profile.',
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                })
                .finally(() => {
                    // Hide loading state
                    loadingText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                });
        }

        function changePassword() {
            const form = document.getElementById('password-form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const loadingText = submitBtn.querySelector('.loading-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            // Validate password confirmation
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;

            if (newPassword !== confirmPassword) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Konfirmasi password tidak cocok.',
                    icon: 'error',
                    confirmButtonColor: '#EF4444'
                });
                return;
            }

            // Show loading state
            loadingText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const formData = new FormData(form);

            fetch('{{ route("assesor.profile.change-password") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#7C3AED'
                        });

                        // Reset form state
                        form.style.display = 'none';
                        document.getElementById('password-info').style.display = 'block';
                        document.getElementById('change-password-btn').style.display = 'block';
                        form.reset();
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonColor: '#EF4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengubah password.',
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                })
                .finally(() => {
                    // Hide loading state
                    loadingText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                });
        }

        function uploadPhoto(file) {
            const formData = new FormData();
            formData.append('photo', file);

            // Show loading indicator
            const photoContainer = document.getElementById('photo-container');
            const originalContent = photoContainer.innerHTML;
            photoContainer.innerHTML = `
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="animate-spin h-8 w-8 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            `;

            fetch('{{ route("assesor.profile.upload-photo") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        photoContainer.innerHTML = `<img id="profile-photo" src="${data.photo_url}" alt="Profile Photo" class="w-full h-full object-cover">`;

                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#7C3AED'
                        });
                    } else {
                        photoContainer.innerHTML = originalContent;
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonColor: '#EF4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    photoContainer.innerHTML = originalContent;
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengupload foto.',
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                });
        }
    </script>
</x-layout_assessor>