<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Check - Hasil Penetapan Komite Teknis</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <h6 class="m-0 font-weight-bold text-light">Quality Check - Hasil Penetapan Komite Teknis</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" style="font-size:10px;" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID IZIN</th>
                        <th>Klasifikasi</th>
                        <th>Subklasifikasi</th>
                        <th>Kualifikasi</th>
                        <th>ID Jadwal Asesmen BNSP</th>
                        <th>BA Rekomendasi Asesor</th>
                        <th>BA Pleno Komite Teknis</th>
                        <th>SK Komite Teknis</th>
                        <th>Blanko</th>
                        <th>Preview Sertifikat</th>
                        <th>Action</th>
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
                        <th>ID Jadwal Asesmen BNSP</th>
                        <th>BA Rekomendasi Asesor</th>
                        <th>BA Pleno Komite Teknis</th>
                        <th>SK Komite Teknis</th>
                        <th>Blanko</th>
                        <th>Preview Sertifikat</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($get_data_selesai_penetapan as $data_selesai_penetapan){
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++?></td>
                        <td class="text-center"><?= $data_selesai_penetapan['nama'] ?></td>
                        <td class="text-center"><?= $data_selesai_penetapan['id_izin'] ?></td>
                        <td class="text-center"><?= $data_selesai_penetapan['klasifikasi'] ?></td>
                        <td class="text-center"><?= $data_selesai_penetapan['subklasifikasi'] ?></td>
                        <td class="text-center"><?= $data_selesai_penetapan['kualifikasi'] ?></td>
                        <td class="text-center"><?= $data_selesai_penetapan['id_jadwal_asesmen'] ?></td>
                        <td class="text-center"><a href="<?= base_url('asesor/cetak_berita_acara_rekomendasi_asesor/').base64_encode($data_selesai_penetapan['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview</a></td>
                        <td class="text-center"><a href="<?= base_url('komite/cetak_berita_acara_pleno_komite/').base64_encode($data_selesai_penetapan['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview</a></td>
                        <td class="text-center"><a href="<?= base_url('komite/cetak_surat_keputusan_komite/').base64_encode($data_selesai_penetapan['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview</a></td>
                        <td class="text-center">
                            <?php
                                if($data_selesai_penetapan['nomor_blangko_bnsp'] !== "Menunggu Approve BNSP"){
                                    echo $data_selesai_penetapan['nomor_blangko_bnsp'];

                                    if($data_selesai_penetapan['nomor_registrasi_lpjk'] == "Menunggu Approve BNSP" || $data_selesai_penetapan['nomor_registrasi_lpjk'] == NULL){
                            ?>
                                        <a href="<?= base_url('admin/get_blanko_bnsp/').base64_encode($data_selesai_penetapan['id_izin']);?>" class='btn btn-info' style='font-size:10px;'>Get Blanko Ulang</a>
                            <?php
                                    }
                                }else{
                            ?>
                                    <a href="<?= base_url('admin/get_blanko_bnsp/').base64_encode($data_selesai_penetapan['id_izin']);?>" class='btn btn-warning' style='font-size:10px;'>Get Blanko</a>
                            <?php
                                }
                            ?>    
                        </td>
                        <td class="text-center"><a href="<?= base_url('sertifikat/').base64_encode($data_selesai_penetapan['id_izin']);?>" class="btn btn-primary" target="_blank" style="font-size:12px;">Preview Sertifikat</a></td>
                        <?php
                            if($data_selesai_penetapan['nomor_blangko_bnsp'] == "Menunggu Approve BNSP" || $data_selesai_penetapan['nomor_registrasi_lpjk'] == "Menunggu Approve BNSP" || $data_selesai_penetapan['nomor_registrasi_lpjk'] == NULL){
                                echo "<td class='text-center'><a href='#' class='btn btn-success' style='font-size:12px;' disabled>Menunggu Blanko</td>";
                            }else{
                        ?>
                            <td class="text-center"><a href="<?= base_url('admin/izin_final_siki_portal/').base64_encode($data_selesai_penetapan['id_izin']);?>" class="btn btn-success" style="font-size:12px;" onclick="return confirm('QC Sudah Lengkap - Permohonan Sertifikasi dan Sertifikat Sudah Sesuai ?')">Izin Final</a></td>
                        <?php
                            }
                        ?> 
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


<?php if ($this->session->flashdata('message_pencatatan_siki')): ?>
<script>
swal({
  title: "Warning",
  text: "<?= $this->session->flashdata('message_pencatatan_siki')?>",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 12000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('message_pelaporan_asesor')): ?>
<script>
swal({
  title: "Warning",
  text: "<?= $this->session->flashdata('message_pelaporan_asesor')?>",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 10000,
});
</script>
<?php endif; ?>
</html>