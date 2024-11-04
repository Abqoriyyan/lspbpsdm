<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Sertifikat Terbit</title>
</head>
<body>
<?php
    ##for ($i = 0; $i < count($array['data']); $i++){
    #    echo $array['data'][$i]['nik'];
   # }
?>

<style>
    th {
        text-align:center;
    }
    td {
        text-align:center;
    }
</style>

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-dark">
        <h6 class="m-0 font-weight-bold text-light">List Sertifikat Terbit</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" style="font-size:12px;" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID IZIN</th>
                        <th>Klasifikasi</th>
                        <th>Subklasifikasi</th>
                        <th>Kualifikasi</th>
                        <th>BA Rekomendasi Asesor</th>
                        <th>BA Pleno Komite Teknis</th>
                        <th>SK Komite Teknis</th>
                        <th>Preview Sertifikat</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID IZIN</th>
                        <th>Klasifikasi</th>
                        <th>Subklasifikasi</th>
                        <th>Kualifikasi</th>
                        <th>BA Rekomendasi Asesor</th>
                        <th>BA Pleno Komite Teknis</th>
                        <th>SK Komite Teknis</th>
                        <th>Preview Sertifikat</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($get_data_terbit_sertifikat as $data_terbit_sertifikat){
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++?></td>
                        <td class="text-center"><?= $data_terbit_sertifikat['nama'] ?></td>
                        <td class="text-center"><?= $data_terbit_sertifikat['id_izin'] ?></td>
                        <td class="text-center"><?= $data_terbit_sertifikat['klasifikasi'] ?></td>
                        <td class="text-center"><?= $data_terbit_sertifikat['subklasifikasi'] ?></td>
                        <td class="text-center"><?= $data_terbit_sertifikat['kualifikasi'] ?></td>
                        <td class="text-center"><a href="<?= base_url('asesor/cetak_berita_acara_rekomendasi_asesor/').base64_encode($data_terbit_sertifikat['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview</a></td>
                        <td class="text-center"><a href="<?= base_url('komite/cetak_berita_acara_pleno_komite/').base64_encode($data_terbit_sertifikat['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview</a></td>
                        <td class="text-center"><a href="<?= base_url('komite/cetak_surat_keputusan_komite/').base64_encode($data_terbit_sertifikat['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview</a></td>
                        <td class="text-center"><a href="<?= base_url('sertifikat/').base64_encode($data_terbit_sertifikat['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview Sertifikat</a></td>
                    </tr>
                    <?php 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<?php if ($this->session->flashdata('success-tinjau-permohonan')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Tinjau Permohonan Telah Selesai",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
</html>