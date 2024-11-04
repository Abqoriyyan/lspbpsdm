<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesmen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Checklist Using Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
<script>
    $(document).ready(function() {
    $('#dataTableProyek').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    });
} );
</script>
<!-- DataTales Example -->

<h4 class="text-center">Asesmen</h4>
<div class="card shadow mb-4">
    <!-- Pengalaman Proyek -->
    <div class="card-header py-3 bg-gradient-dark text-light">
        <h6 class="m-0 font-weight-bold">Data Pengalaman Proyek & Ijazah - <a href="<?= $get_data_pendidikan_yang_sesuai->scan_ijazah_legalisir;?>" target="_blank" class="btn btn-success">Preview Ijazah</a></h6>
    </div>
    <div class="container">
    <table class="table border" id="dataTableProyek" width="100%" cellspacing="0">
        <thead class="bg-gradient-dark border">
            <tr class="bg-gradient-dark text-light">
                <td width="2%" class="text-center"><b>No</b></td>
                <td width="13%" class="text-center"><b>Nama Proyek</b></td>
                <td width="5%" class="text-center"><b>Jabatan</b></td>
                <td width="10%" class="text-center"><b>Nilai Proyek</b></td>
                <td width="10%" class="text-center"><b>Lama Proyek</b></td>
                <td width="20%" class="text-center"><b>Surat Referensi</b></td>
                <td width="10%" class="text-center"><b>Jenis Pengalaman</b></td>
            </tr>
        </thead>
        <tbody class="border">
            <?php
            // Keperluan No urut agar input data proyek dynamic
            $no = 1;
            foreach($get_data_proyek_permohonan as $data_proyek){
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $data_proyek['nama_proyek'];?></td>
                <td class="text-center"><?php echo $data_proyek['jabatan'];?></td>
                <td class="text-center">
                    <?php 
                        if(!empty($data_proyek['nilai_proyek'])){
                            echo 'Rp. '.number_format($data_proyek['nilai_proyek'],0,',','.');
                        }else{
                            echo '0';
                        }
                    ?>
                </td>
                <td class="text-center">
                    <?php

                    ## Berapa lama proyek ke Bulan
                    $ts1 = strtotime($data_proyek['tanggal_awal']);
                    $ts2 = strtotime($data_proyek['tanggal_akhir']);

                    $year1 = date('Y', $ts1);
                    $year2 = date('Y', $ts2);

                    $month1 = date('m', $ts1);
                    $month2 = date('m', $ts2);

                    $bulan = (($year2 - $year1) * 12) + ($month2 - $month1);
                    
                    ## Berapa lama proyek ke Hari
                    $startDate = new DateTime($data_proyek['tanggal_awal']);
                    $endDate = new DateTime($data_proyek['tanggal_akhir']);

                    $hari = $endDate->diff($startDate);
                    
                    #Output
                    echo $hari->format("%a").' hari ( '.$bulan.' bulan )';
                    ?>
                </td>
                <td class="text-center">
                    <a href="<?php 
                        if(!empty($data_proyek['surat_referensi'])){
                            echo $data_proyek['surat_referensi'].'" target="_blank"';
                        }else{
                            echo base_url('errors/not_upload').'" target="_blank"';
                        }
                        ?>">
                    <i class="fas fa-fw fa-eye"></i>View File</a>
                </td>
                <td class="text-center"><?= $data_proyek['jenis_pengalaman'];?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
        <!-- Total -->
        <tfoot class="bg-gradient-dark text-light border">
            <tr>
                <td class="text-center" colspan="3"><b>Total</b></td>
                <td class="text-center"  style="font-weight:bold;">
                    <?php
                        $sum_nilai_proyek = 0;
                        foreach($get_data_proyek_permohonan as $data_proyek){
                            if(empty($data_proyek['nilai_proyek'])){
                                $data_proyek['nilai_proyek'] = 0; 
                            }
                            $sum_nilai_proyek+= $data_proyek['nilai_proyek'];
                        }
                        echo 'Rp. '.number_format($sum_nilai_proyek,0,',','.');
                    ?>
                </td>
                <td class="text-center" style="font-weight:bold;">
                    <?php
                        $sum_hari = 0;
                        foreach($get_data_proyek_permohonan as $data_proyek){
                            ## Berapa lama proyek ke Hari
                            $startDate = new DateTime($data_proyek['tanggal_awal']);
                            $endDate = new DateTime($data_proyek['tanggal_akhir']);

                            $difference = $endDate->diff($startDate);
                            $sum_hari+= $difference->format("%a");
                        }
                        #Output
                        echo $sum_hari.' hari '.'( '. Floor($sum_hari / 30) .' bulan )';
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- /Pengalaman Proyek -->
    <br/><br/>

    <div class="card-header py-3 bg-gradient-dark text-light">
        <h6 class="m-0 font-weight-bold">Upload File Asesmen</h6>
    </div><br/>
    <div class="container">
        <b>Catatan :</b><br/>
        1. Silahkan Upload File Asesmen pada setiap Pilihan Form, sampai Pilihan sudah tidak bisa di pilih lagi<br/>
        2. File Upload yang di Ijinkan (File Size < 10 Mb dan Ekstensi File pdf)

    </div><br/>
    <form action="<?= base_url('Asesor/upload_file_asesmen/').base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data" >
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <select class="form-select form-control" name="form">
                        <?php foreach($get_maping_asesmen as $maping_asesmen){ ?>
                            <option value="<?= $maping_asesmen['kode_form']?>"><?= $maping_asesmen['deskripsi']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-5">
                    <input class="form-control" type="file" name="file_asesmen"/>
                </div>
                <div class="col-md-2">
                    <input type="submit" value="Upload" class="text-center btn btn-primary"/>
                </div>
            </div>
        </div><br/>
    </form>
    <br/>

     <!-- File Asesmen -->
    <div class="card-header py-3 bg-gradient-dark text-light">
        <h6 class="m-0 font-weight-bold">File Asesmen</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-sm-1 text-center">No</th>
                        <th class="col-sm-2 text-center">Action</th>
                        <th class="col-sm-4 text-center">Form</th>
                        <th class="col-sm-5 text-center">File</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="col-sm-1 text-center">No</th>
                        <th class="col-sm-2 text-center">Action</th>
                        <th class="col-sm-4 text-center">Form</th>
                        <th class="col-sm-5 text-center">File</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($get_data_file_asesmen as $data_file_asesmen){
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++?></td>
                        <td class="text-center"><a href="<?= base_url('Asesor/delete_file_asesmen/').base64_encode($id_izin).'/'.$data_file_asesmen['kode_form'];?>" onclick="return confirm('Yakin untuk Menghapus File Asesmen <?= $data_file_asesmen['deskripsi_form']?>')" class="btn btn-danger">Hapus</a></td>
                        <td class="text-center"><?= $data_file_asesmen['deskripsi_form']?></td>
                        <td class="text-center"><a href="<?= base_url('uploads/file_asesmen/').$data_file_asesmen['kode_form'].'/'.$data_file_asesmen['file'];?>" target="_blank">View File</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div><br/>
</div>
<center>
<?php if(!empty($get_bukti_dokumentasi_asesmen->file)){?>
        Bukti Dokumentasi Asesmen :<br/>
        <a href="<?= base_url('asesor/reset_bukti_dokumentasi_asesmen/').base64_encode($id_izin);?>" class="btn btn-warning" onclick="return confirm('Yakin untuk Reset Bukti Dokumentasi Asesmen!')">Reset Bukti Dokumentasi Asesmen</a><br/>
        <a href="<?= base_url('uploads/file_asesmen/bukti_dokumentasi_asesmen/').$get_bukti_dokumentasi_asesmen->file;?>" class="btn btn-info" target="_blank">Bukti Dokumentasi Asesmen</a><br/><br/>
        
        <form action="<?= base_url("Asesor/rekomendasi_hasil_asesmen/").base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
            <div class="col-sm-4">
                Rekomendasi Asesor :
                <select class="form-control text-center text-dark" name="rekomendasi_asesor">
                    <option value="Kompeten">Kompeten - Lanjut ke Komite Teknis</option>
                    <option value="Belum Kompeten">Belum Kompeten</option>
                </select>
            </div><br/>
            <div class="col-sm-4">
                Metode UJI :
                <select class="form-control text-center" name="metode_uji">
                    <option value="1">Uji Tulis</option>
                    <option value="2">Uji Praktek atau Observasi Lapangan</option>
                    <option value="3">Wawancara</option>
                </select>
            </div><br/>
            <div class="col-sm-4">
                <textarea name="catatan_rekomendasi_asesor" class="form-control text-dark" placeholder="Catatan ..."></textarea>
            </div>
            <div class="col-sm-2"><br/>
                    <input type="submit" value="Submit Rekomendasi" class="btn btn-primary" onclick="return confirm('Pastikan Rekomendasi Asesmen sudah benar!')"/>
            </div><br/>
        </form>
    <?php }elseif(empty($get_bukti_dokumentasi_asesmen->file)){ ?>
        <form action="<?= base_url("Asesor/upload_bukti_dokumentasi_asesmen/").base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
            Silahkan Upload File Bukti Foto Dokumentasi Asesmen <br/>(minimal memperlihatkan foto asesi dan asesor dalam 1 frame) untuk keperluan Laporan ke LPJK <br/><br/>

            Extension (PDF,PNG,JPG,JPEG) <br/>
            <div class="col-sm-4 col-sm-offset-4">
                <input type="file" name="file_bukti_dokumentasi_asesmen" class="form-control"/>
            </div><br/>
            <input type="submit" value="Upload" class="btn btn-primary" onclick="return confirm('Pastikan File Bukti Dokumentasi Asesmen Sudah Benar!')"/><br/><br/>
            Silahkan Upload Bukti Dokumentasi Asesmen terlebih dahulu, baru akan muncul untuk Rekomendasi Asesmen
        </form>
    <?php }?>
</center>
</body>
</html>


<!-- Alert Sweet Alert Upload File Asesmen -->
<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
  title: "Berhasil",
  text: "File Berhasil di Unggah",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagal')): ?>
<script>
swal({
  title: "Gagal",
  text: "File Gagal di Upload pastikan Ukuran File Tidak lebih dari 10 MB dan Ekstension File pdf",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>


<?php if ($this->session->flashdata('success-upload-bukti')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Anda sudah bisa merekomendasikan hasil Asesmen permohonan SKK yang sedang diuji",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagal-upload-bukti')): ?>
<script>
swal({
  title: "gagal-upload-bukti",
  text: "Pastikan File Bukti Dokumentasi Asesmen yang diupload Sesuai dengan Format",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-reset-bukti')): ?>
<script>
swal({
  title: "success-reset-bukti",
  text: "Bukti Dokumentasi Asesmen berhasil di Reset ",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('deleted_file_asesmen')): ?>
<script>
swal({
  title: "Berhasil",
  text: "File Asesmen Berhasil di Hapus",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>