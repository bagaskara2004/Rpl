# Dokumentasi Fitur Transfer Nilai Statis

## Overview

Fitur ini memungkinkan tampilan hasil transfer nilai yang statis ketika user sudah memiliki data transfer nilai yang telah diproses sebelumnya.

## Alur Kerja

1. **Pengecekan Data**: Saat user mengklik "Transfer Nilai", sistem akan mengecek apakah user sudah memiliki data transfer nilai di database.
2. **Conditional Rendering**:
    - Jika sudah ada data transfer nilai (`hasTransferNilai = true`), maka akan menampilkan tampilan statis hasil transfer nilai
    - Jika belum ada data (`hasTransferNilai = false`), maka akan menampilkan form input transfer nilai seperti biasa

## File yang Dimodifikasi

### 1. Controller: `app/Http/Controllers/assessor/AssessorController.php`

**Method: `transferNilai()`**

-   Menambahkan pengecekan data transfer nilai yang sudah ada
-   Menambahkan flag `hasTransferNilai` untuk menentukan tampilan
-   Menambahkan data `transferNilai` untuk tampilan statis

```php
$hasTransferNilai = $existingTransfers->count() > 0;

return view('Assessor.pendaftar.transfer_nilai', [
    // ... existing data
    'hasTransferNilai' => $hasTransferNilai,
    'transferNilai' => $existingTransfers,
]);
```

### 2. View Utama: `resources/views/Assessor/pendaftar/transfer_nilai.blade.php`

**Perubahan:**

-   Menambahkan conditional check di awal file
-   Jika `$hasTransferNilai = true`, akan include `transfer_nilai_statis.blade.php`
-   Jika `$hasTransferNilai = false`, akan menampilkan form input seperti biasa

```php
@if(isset($hasTransferNilai) && $hasTransferNilai)
    @include('Assessor.pendaftar.transfer_nilai_statis')
@else
    {{-- Form input transfer nilai --}}
@endif
```

### 3. View Statis: `resources/views/Assessor/pendaftar/transfer_nilai_statis.blade.php`

**Fitur:**

-   Menampilkan hasil transfer nilai dalam format read-only
-   Search functionality untuk mencari mata kuliah
-   Progress bar menunjukkan persentase konversi SKS
-   Status badge (Disetujui/Ditolak/Pending)
-   Tombol cetak dan kembali
-   Responsive design dengan AJAX/Normal support

## Database Structure

### Table: `transfer_nilai`

```sql
- id
- asesor_id (foreign key ke users)
- kurikulum_id (foreign key ke kurikulum)
- transkrip_id (foreign key ke transkrip_nilai)
- nilai (A, B, C, D, E)
- catatan (text)
- status (0: ditolak, 1: disetujui, null: pending)
- created_at
- updated_at
```

## Model Relationships

### TransferNilai Model

```php
public function asesor() {
    return $this->belongsTo(User::class, 'asesor_id');
}

public function kurikulum() {
    return $this->belongsTo(Kurikulum::class);
}

public function transkripNilai() {
    return $this->belongsTo(TranskripNilai::class, 'transkrip_id');
}
```

## Fitur Tampilan Statis

### 1. Header Section

-   Status badge "Transfer Nilai Telah Disetujui"
-   Tanggal pemrosesan

### 2. Summary Section

-   Total SKS dari mata kuliah lampau
-   SKS yang berhasil dikonversi
-   Progress bar persentase konversi
-   Search bar untuk filter data

### 3. Tabel Hasil

Kolom yang ditampilkan:

-   No urut
-   Mata Kuliah Lampau (dengan SKS)
-   Nilai Lama
-   Mata Kuliah TRPL (dengan SKS)
-   Nilai Baru
-   Status (dengan color coding)
-   Keterangan

### 4. Action Buttons

-   Tombol "Cetak Hasil" (window.print())
-   Tombol "Kembali ke Pendaftar"

## JavaScript Functionality

### 1. Search Feature

-   Real-time search pada nama mata kuliah
-   Update nomor urut otomatis untuk baris yang terlihat

### 2. Progress Bar

-   Kalkulasi otomatis persentase konversi
-   Animasi smooth transition

### 3. Responsive Design

-   Support untuk AJAX request dan normal request
-   Conditional layout dengan/tanpa layout assessor

## Usage Example

1. User pertama kali mengklik "Transfer Nilai" → Tampil form input
2. User mengisi dan menyimpan data transfer nilai
3. User mengklik "Transfer Nilai" lagi → Tampil hasil statis
4. User dapat mencari, melihat detail, dan mencetak hasil

## Security & Validation

-   Data hanya dapat dilihat oleh assessor yang berwenang
-   Pengecekan user ID untuk memastikan akses data yang benar
-   Validasi input melalui controller

## Future Enhancements

-   Export to PDF functionality
-   Edit transfer nilai (jika diperlukan)
-   History/log perubahan
-   Approval workflow yang lebih kompleks
