<div class="modal-content">
    <div class="modal-header bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-t-lg">
        <h5 class="modal-title text-xl font-bold">Assessment - {{ $user->user_name }}</h5>
    </div>
    <div class="modal-body p-6">
        @if($assessment)
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-700">
                    <strong>Status:</strong> 
                    @if($assessment->status == 1)
                        <span class="text-green-600 font-semibold">Lulus</span>
                    @else
                        <span class="text-red-600 font-semibold">Tidak Lulus</span>
                    @endif
                </p>
            </div>
        @endif

        <form id="assessmentForm" action="{{ route('admin.assessment.update-status', $user->id) }}" method="POST">
            @csrf
            <div class="space-y-4">
                @foreach($pertanyaan as $index => $question)
                <div class="border border-gray-200 rounded-lg p-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $index + 1 }}. {{ $question->pertanyaan }}
                    </label>
                    <textarea 
                        name="jawaban[{{ $question->id }}]" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        rows="3"
                        placeholder="Masukkan jawaban..."
                        required>{{ $assessment && $assessment->jawaban ? (json_decode($assessment->jawaban, true)[$question->id] ?? '') : '' }}</textarea>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Assessment</label>
                <select name="status" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Pilih Status</option>
                    <option value="1" {{ ($assessment && $assessment->status == 1) ? 'selected' : '' }}>Lulus</option>
                    <option value="0" {{ ($assessment && $assessment->status == 0) ? 'selected' : '' }}>Tidak Lulus</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors" onclick="closeModal()">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Assessment
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('assessmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const actionUrl = this.action;
    
    fetch(actionUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                confirmButtonColor: '#3b82f6'
            }).then(() => {
                closeModal();
                // Refresh the data table if it exists
                if (typeof table !== 'undefined' && table.ajax) {
                    table.ajax.reload();
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan',
                confirmButtonColor: '#ef4444'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat memproses data',
            confirmButtonColor: '#ef4444'
        });
    });
});
</script>
