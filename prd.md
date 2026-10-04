# Dokumentasi Produk: Website Ekstrakurikuler & Seni Budaya (EkstraKita)

## Highlight
Siswa dapat melakukan pendaftaran, lalu pembina & admin dapat melakukan pengelolaan jadwal, penilaian, dan absensi kegiatan ekstrakurikuler serta seni budaya secara digital. Sistem ini mencakup peringatan jadwal bentrok, pembatasan pendaftaran (maksimal 1 ekskul dan 1 seni budaya), serta rekapitulasi penilaian kompetensi secara terpusat dan transparan. 

## Background and Problem Statement
Setiap memasuki tahun ajaran baru atau masa orientasi siswa, proses pendaftaran kegiatan ekstrakurikuler dan kelompok seni budaya di sekolah masih sering dilakukan secara manual menggunakan form sederhana. Hal ini memicu berbagai kendala teknis, seperti penumpukan pendaftaran, risiko data hilang, serta kesulitan bagi siswa dan pembina dalam memantau jadwal kegiatan yang saling bentrok. Selain itu, perekapan absensi kehadiran dan evaluasi nilai kompetensi siswa di akhir semester belum terintegrasi secara sistematis.

### Problem Statement
1. **Pendaftaran Manual:** Proses pendaftaran berbasis kertas tidak efisien dan berisiko menyebabkan kecurangan atau penggandaan data.
2. **Jadwal Bentrok:** Siswa sering mendaftar beberapa kegiatan yang memiliki jadwal latihan pada hari dan jam yang sama tanpa adanya peringatan dari sistem.
3. **Pencatatan Presensi & Nilai Un-structured:** Rekapitulasi kehadiran dan penilaian kompetensi siswa oleh pembina masih dilakukan secara terpisah, sehingga sulit diakses oleh siswa maupun pihak sekolah secara akurat, dan juga masih menggunakan kertas untuk mencatat nilai dan absensi siswa, ini bisa menyebabkan faktor hilangnya kertas tersebut.

## Objective
Pengembangan aplikasi Website Ekstrakurikuler ini dilaksanakan secara bertahap melalui 5 fase utama:
- **Phase 1. Autentikasi & Otorisasi:** Pengaturan Login, Register, dan Middleware Hak Akses berdasarkan Role (Admin, Pembina, Siswa).
- **Phase 2. CRUD Data Master:** Pengelolaan Data Master Ekstrakurikuler, Seni Budaya, Data Ruangan, dan User oleh Admin/pembina.
- **Phase 3. Pendaftaran & Approval:** Alur pendaftaran online oleh Siswa dengan aturan batas maksimal mendaftar serta persetujuan (Approve/Reject) oleh Pembina.
- **Phase 4. Pengelolaan Jadwal & Deteksi Bentrok:** Penjadwalan kegiatan latihan serta fitur deteksi otomatis jika terjadi bentrok jadwal pada siswa.
- **Phase 5. Absensi & Assessment:** Pencatatan kehadiran (Attendance) harian dan modul evaluasi penilaian (Assessment) di akhir semester.

---

## Tech Proposal

### ERD
*(Diagram ERD)*

### DFD
*(Diagram DFD)*

### Data Type

**Users**
- `id` => integer, primary key, auto increment
- `name` => string(255)
- `email` => string(255), unique
- `password` => string(255) (hashed)
- `role` => enum ["admin", "pembina", "siswa"]
- `nip_nis` => string(50), nullable
- `created_at` => timestamp
- `updated_at` => timestamp

**Ruangan**
- `id` => integer, primary key, auto increment
- `nama_ruangan` => string(100)
- `kode_ruangan` => string(50), unique
- `lokasi` => string(255)
- `created_at` => timestamp
- `updated_at` => timestamp

**Ekstrakurikuler**
- `id` => integer, primary key, auto increment
- `nama_ekskul` => string(100)
- `kategori` => enum ["ekstrakurikuler", "seni_budaya"]
- `deskripsi` => text
- `pembina_id` => foreign key ke users.id (nullable)
- `ruangan_id` => foreign key ke ruangan.id (nullable)
- `logo` => string(255), nullable
- `created_at` => timestamp
- `updated_at` => timestamp

**Pendaftaran**
- `id` => integer, primary key, auto increment
- `siswa_id` => foreign key ke users.id
- `ekskul_id` => foreign key ke ekstrakurikuler.id
- `status` => enum ["pending", "diterima", "ditolak"], default "pending"
- `tanggal_daftar` => date (Y-m-d)
- `created_at` => timestamp
- `updated_at` => timestamp

**Jadwal**
- `id` => integer, primary key, auto increment
- `ekskul_id` => foreign key ke ekstrakurikuler.id
- `nama_kegiatan` => string(150)
- `hari` => enum ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"]
- `jam_mulai` => time
- `jam_selesai` => time
- `ruangan_id` => foreign key ke ruangan.id
- `created_at` => timestamp
- `updated_at` => timestamp

**Absensi**
- `id` => integer, primary key, auto increment
- `jadwal_id` => foreign key ke jadwal.id
- `siswa_id` => foreign key ke users.id
- `status` => enum ["hadir", "izin", "sakit", "alpa"]
- `tanggal_absen` => date
- `created_at` => timestamp
- `updated_at` => timestamp

**Ulangan** *(Tabel Baru)*
- `id` => integer, primary key, auto increment
- `ekskul_id` => foreign key ke ekstrakurikuler.id
- `judul_ulangan` => string(150)
- `tanggal` => date
- `deskripsi` => text, nullable
- `created_at` => timestamp
- `updated_at` => timestamp

**Penilaian** *(Tabel Revisi)*
- `id` => integer, primary key, auto increment
- `siswa_id` => foreign key ke users.id
- `ulangan_id` => foreign key ke ulangan.id
- `nilai_keterampilan` => integer (0-100)
- `nilai_kedisiplinan` => integer (0-100)
- `nilai_partisipasi` => integer (0-100)
- `catatan_pembina` => text, nullable
- `created_at` => timestamp
- `updated_at` => timestamp

---

## User and Data Flow

### Stories, Data Source, Form Validation

**Phase 1. Login & Register**
Halaman pertama yang tampil adalah halaman sign-in. Untuk user siswa yang belum memiliki akun, diharuskan membuat akun dengan menekan button “Buat Akun”. Setelah sukses mendaftar, user secara otomatis akan diberikan role "siswa". Apabila terdapat isian yang tidak valid, laman akan menampilkan teks pemberitahuan merah pada input form terkait. 
- **Data Source:** Input Form Pendaftaran/Login -> Tabel `users`. 
- **Form Validation:**
  - Nama Lengkap (`name`): `required|string|max:255`
  - Email (`email`): `required|email|unique:users,email`
  - Password (`password`): `required|string|min:8` (akan di-hash)

**Phase 2. CRUD Data Master (Admin)**
Admin / pembina memiliki hak akses untuk mengelola data master fasilitas sekolah (Ruangan) dan data kegiatan (Ekstrakurikuler & Seni Budaya), seperti menambahkan Kegiatan Baru, memperbarui hingga menghapus.
- **Data Source:** Form Input Admin -> Tabel `ruangan` dan Tabel `ekstrakurikuler`. 
- **Form Validation:**
  - Nama Kegiatan (`nama_ekskul`): `required|string|max:100`
  - Kategori (`kategori`): `required|in:ekstrakurikuler,seni_budaya`
  - Nama Ruangan (`nama_ruangan`): `required|string|max:100`

**Phase 3. Pendaftaran & Persetujuan Ekstrakurikuler**
Pada halaman beranda/dashboard, siswa dapat melihat card daftar kegiatan yang tersedia.
- Siswa menekan tombol "Daftar" pada card ekskul yang diminati.
- Sistem mengecek batasan kuota pendaftaran (Siswa maksimal hanya boleh mendaftar 1 Ekstrakurikuler dan 1 Seni Budaya).
- Sistem menyimpan data ke tabel pendaftaran dengan menyertakan `siswa_id`, `ekskul_id`, dan `status = pending`.
- Muncul notifikasi pemberitahuan: "Pendaftaran berhasil diajukan, menunggu persetujuan pembina". 

Dari sisi Pembina:
- Pembina mengakses halaman "Daftar Pengajuan Anggota".
- Ditampilkan tabel siswa yang mendaftar pada ekskul binaannya dengan status "pending".
- Pembina menekan tombol/ikon Ceklis (Terima) atau Silang (Tolak). Apabila tombol Terima ditekan, status di tabel pendaftaran berubah menjadi diterima. 
- **Data Source:** Session User dan Pilihan Button -> Tabel `pendaftaran`. 
- **Form Validation:** `ekskul_id`: `required|exists:ekstrakurikuler,id`.

**Phase 4. Pengelolaan jadwal & Deteksi Bentrok**
- Saat Admin/Pembina membuat jadwal baru, sistem memvalidasi ketersediaan ruangan agar tidak ada dua kegiatan yang menggunakan ruangan yang sama.
- Jika siswa terdaftar pada dua ekskul dengan jadwal hari dan jam yang sama, siswa akan menerima Alert Banner "Potensi Bentrok Jadwal Terdeteksi".
- **Empty State:** Jika siswa belum mendaftar ekskul apapun, halaman jadwal akan menampilkan ilustrasi kosong dengan ajakan mendaftar. 
- **Data Source:** Form Input Pembina -> Tabel `jadwal`. 
- **Form Validation:**
  - Hari (`hari`): `required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu`
  - Jam Mulai (`jam_mulai`): `required|date_format:H:i`
  - Jam Selesai (`jam_selesai`): `required|date_format:H:i|after:jam_mulai`
  - Ruangan (`ruangan_id`): `required|exists:ruangan,id`

**Phase 5. Absensi & Assessment**
- **Attendance (Kehadiran):** Pembina memasukkan data kehadiran siswa setiap jadwal pertemuan. Siswa dapat melihat rekap persentase kehadiran (Hadir/Tidak Hadir/Izin) pada dashboardnya.
- **Assessment (Penilaian):** Pembina dapat membuat jadwal Ulangan/Tugas baru untuk ekskulnya. Setelah ulangan selesai, pembina menginput nilai keterampilan, kedisiplinan, dan partisipasi. Siswa dapat melihat hasil nilai ulangan pada dashboardnya. 
- **Data Source:** Form Input Ulangan -> Tabel `ulangan`. Form Penilaian -> Tabel `penilaian`. 
- **Form Validation (Tambah Ulangan Baru):**
  - Judul Ulangan (`judul_ulangan`): `required|string|max:150`
  - Tanggal (`tanggal`): `required|date`
  - Deskripsi (`deskripsi`): `nullable|string`
- **Form Validation (Input Nilai):**
  - Ulangan ID (`ulangan_id`): `required|exists:ulangan,id`
  - Nilai Keterampilan, Kedisiplinan, Partisipasi: `required|integer|min:0|max:100`

---

## User Interface
[Link Desain Figma EkstraKita](https://www.figma.com/design/FYHTGxTDXvOAoKl1dTiGBv/Design-CBT?node-id=54-2134&t=1sZ3wDOOScHBDjkt-1)

## Glossary
- **Pembina:** Guru atau staf yang diberikan tanggung jawab khusus untuk membina dan mengelola sebuah ekstrakurikuler.
- **Pending:** Status menunggu proses validasi atau persetujuan dari pihak yang berwenang (Pembina).
- **Assessment:** Modul penilaian kompetensi dan performa siswa selama mengikuti kegiatan ekstrakurikuler.
- **Attendance:** Modul pencatatan dan rekapitulasi persentase kehadiran siswa.

## Discussion
**Selasa, 22 September — Diskusi:**
- Perlu ditambahkan validasi agar satu siswa maksimal hanya boleh mendaftar 2 kegiatan, yaitu 1 ekstrakurikuler dan 1 seni budaya.