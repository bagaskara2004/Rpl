<!-- Modal Profile -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('dosen.profile.update') }}" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profil Dosen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://i.pravatar.cc/80?img=68' }}"
             class="rounded-circle mb-3" width="80" alt="Avatar">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="user_name" value="{{ Auth::user()->user_name }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil (opsional)</label>
            <input type="file" class="form-control" name="foto">
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" class="form-control" name="password" placeholder="Minimal 8 karakter">
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
