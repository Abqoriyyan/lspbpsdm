<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-12-07 00:42:46 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 00:42:46 --> Unable to connect to the database
ERROR - 2023-12-07 00:42:56 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 00:42:56 --> Unable to connect to the database
ERROR - 2023-12-07 01:29:34 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 01:29:34 --> Unable to connect to the database
ERROR - 2023-12-07 01:29:44 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 01:29:44 --> Unable to connect to the database
ERROR - 2023-12-07 01:55:50 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 01:55:50 --> Unable to connect to the database
ERROR - 2023-12-07 01:56:00 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 01:56:00 --> Unable to connect to the database
ERROR - 2023-12-07 02:05:49 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 02:05:49 --> Unable to connect to the database
ERROR - 2023-12-07 02:05:59 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 02:05:59 --> Unable to connect to the database
ERROR - 2023-12-07 02:44:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 02:44:17 --> Unable to connect to the database
ERROR - 2023-12-07 02:44:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 02:44:27 --> Unable to connect to the database
ERROR - 2023-12-07 03:25:59 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 03:25:59 --> Unable to connect to the database
ERROR - 2023-12-07 03:26:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 03:26:09 --> Unable to connect to the database
ERROR - 2023-12-07 06:39:35 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 06:39:35 --> Unable to connect to the database
ERROR - 2023-12-07 06:39:45 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 06:39:45 --> Unable to connect to the database
ERROR - 2023-12-07 07:03:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 07:03:18 --> Unable to connect to the database
ERROR - 2023-12-07 07:03:28 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 07:03:28 --> Unable to connect to the database
ERROR - 2023-12-07 07:03:38 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 07:03:38 --> Unable to connect to the database
ERROR - 2023-12-07 07:03:38 --> Query error: Connection timed out - Invalid query: SELECT a.nama,a.email,a.telepon, b.jabatan_kerja,e.jabatan_kerja AS deskripsi_jabatan_kerja, c.kualifikasi, 
                        f.klasifikasi, g.subklasifikasi, d.deskripsi AS jenis_permohonan, b.jenjang, h.biaya
                FROM data_personal_permohonan a 
                JOIN data_klasifikasi_kualifikasi_permohonan b ON a.id_izin = b.id_izin
                JOIN master_kualifikasi c ON c.id = b.kualifikasi
                JOIN master_jenis_permohonan d ON d.id = b.jenis_permohonan
                JOIN master_jabatan_kerja e ON e.id_jabatan_kerja = b.jabatan_kerja
                JOIN master_klasifikasi f ON f.id_klasifikasi = b.klasifikasi
                JOIN master_subklasifikasi g ON g.kode_subklasifikasi = b.subklasifikasi
                JOIN master_biaya_permohonan h ON h.jenjang = b.jenjang
                WHERE a.id_izin = 'I-2023120111092475958' AND h.jenis_permohonan = 'Baru'
ERROR - 2023-12-07 07:03:38 --> Severity: error --> Exception: Call to a member function row() on bool /var/www/bpsdm-portal/lspbpsdm/lsp/application/models/Pembayaran_model.php 21
ERROR - 2023-12-07 08:51:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 08:51:18 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 08:51:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 08:51:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 08:51:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 09:03:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 09:05:54 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 09:05:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 09:16:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 09:16:58 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 10:02:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:02:29 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:02:32 --> Severity: Warning --> Illegal string offset 'jabatan_kerja' /var/www/bpsdm-portal/lspbpsdm/lsp/application/controllers/Admin.php 368
ERROR - 2023-12-07 10:02:35 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:02:55 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 10:03:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:19:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:21:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:29:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:36:35 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 10:36:35 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:36:52 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 10:52:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:29:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:30:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:30:21 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 13:30:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:43:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:43:11 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 13:43:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:43:14 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 13:43:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:43:25 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 13:44:01 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:45:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:46:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:13 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:14 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:38 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:47:44 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:48:29 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:50:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:51:48 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:51:48 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:52:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:22 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:22 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:29 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:44 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:53:52 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 13:57:15 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 14:00:03 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 14:00:32 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:00:47 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:03:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:04:11 --> Query error: Duplicate entry 'I-2023112319445370720' for key 'PRIMARY' - Invalid query: INSERT INTO `data_bukti_dokumentasi_asesmen` (`id_izin`, `file`, `username`, `log`) VALUES ('I-2023112319445370720', 'bukti_dokumentasi_asesmen-f67d58f4560f25fcc56a667aaf2cc45c_2023-12-07.jpg', 'yosi', '2023-12-07 14:04:11')
ERROR - 2023-12-07 14:05:44 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:05:52 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:07:28 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:07:29 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:08:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:09:30 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:10:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:11:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:11:46 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:12:44 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:12:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:12:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:12:58 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:12:58 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:13:08 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:13:52 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:14:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:15:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:15:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:15:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:15:26 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:16:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:17:02 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:17:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:18:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:18:12 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:21:30 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 14:32:07 --> Severity: Warning --> Illegal string offset 'jabatan_kerja' /var/www/bpsdm-portal/lspbpsdm/lsp/application/controllers/Admin.php 368
ERROR - 2023-12-07 14:32:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:36:13 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 14:36:13 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:36:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:39:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:39:14 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:39:14 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:39:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:39:22 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:39:41 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 14:42:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:48:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:48:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:48:10 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 14:48:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:48:14 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:48:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:59:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:59:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection timed out /var/www/bpsdm-portal/lspbpsdm/lsp/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2023-12-07 14:59:18 --> Unable to connect to the database
ERROR - 2023-12-07 14:59:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 14:59:45 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:00:04 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:00:05 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:00:06 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:21:03 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 15:24:09 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 15:37:50 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:37:52 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:37:54 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:37:55 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:40:24 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:40:26 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:41:18 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:41:21 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:41:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:42:55 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:42:57 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:43:57 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:43:59 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:46:41 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:47:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:47:21 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:47:22 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:47:23 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:47:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:47:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:48:01 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:48:04 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:48:05 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:48:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:49:05 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:49:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:49:07 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:49:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:49:53 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:49:55 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:49:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:50:47 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:50:49 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:50:50 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:52:15 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:52:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:52:17 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:52:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:52:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:52:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:53:51 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:53:53 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:54:35 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 15:55:16 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 15:55:18 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 15:55:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 16:08:25 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 16:08:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 16:09:53 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 16:12:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 16:45:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 18:00:43 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 18:49:54 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 19:49:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 19:49:40 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 19:50:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 19:53:53 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 19:53:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 19:54:14 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 19:55:01 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 19:55:03 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 19:55:05 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 19:55:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 19:55:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 20:01:47 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 20:01:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 20:02:02 --> 404 Page Not Found: Assets/js
ERROR - 2023-12-07 20:02:48 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_komite/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_berita_acara_pleno_komite.php 195
ERROR - 2023-12-07 20:02:49 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 20:02:50 --> Severity: Warning --> file_get_contents(https://bpsdm.pu.go.id/lspbpsdm/lsp/assets/lsp/ttd_ketua_pelaksana/): failed to open stream: HTTP request failed! HTTP/1.0 403 Forbidden
 /var/www/bpsdm-portal/lspbpsdm/lsp/application/views/Komite/penetapan/cetak_surat_keputusan_komite.php 209
ERROR - 2023-12-07 21:01:28 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:05:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:05:33 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:05:52 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:06:30 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:06:44 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:07:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:09:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:11:30 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:11:50 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2023-12-07 21:12:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
