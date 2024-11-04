<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir APL 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Checklist Using Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<style>
    .table{
        font-size:12px;
    }
</style>
<body>
<div class="row">
    <div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Kembali -->
                <a href="<?= base_url("user/formulir_apl02/").base64_encode($id_izin);?>" class="btn btn-primary"> kembali ke Form APL 02</a>
            <!-- Kembali -->
        <br/>
        <h4 class="m-0 font-weight-bold text-primary text-center">Bukti yang Relavan<br/>Keperluan Formulir APL 02</h4><br/>
        <div class="col-sm-12"><br/>
            <i>Silahkan Tambah/Upload Bukti Relavan untuk sebagai acuan pada Formulir APL 02<br/>Pada permohonan id izin (<?=$id_izin;?>)</i>
        </div><br/>
        
        <form action="<?= base_url('user/save_bukti_relavan_apl02/').base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold"> Nama Bukti :</label>
                        <input type="text" placeholder = "Contoh (CV / Sertifikat Pelatihan K3)" class="form-control" name="nama_bukti" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-bold"> Upload File Bukti :</label>
                        <input type="file" class="form-control" name="file_bukti" required>
                        <i style="font-size:12px;">Catatan : File Uploadan yang di Ijinkan (File Size < 10 Mb dan Ekstensi File jpg | jpeg | png | pdf)</i>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" style="float:right;" value="+ Tambah"/>
        </form><br/><br/><hr/>
        <br/>
        <h5 class="m-0 font-weight-bold text-primary">List Bukti yang Relavan APl-02</h5>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-sm-1 text-center">No</th>
                            <th class="col-sm-2 text-center">Action</th>
                            <th class="col-sm-6 text-center">Nama Bukti</th>
                            <th class="col-sm-3 text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                           foreach($get_bukti_relavan_apl02 as $bukti_relavan_apl02){
                        ?>
                        <tr>
                            <td class="text-center"><?=$no++?></td>
                            <td class="text-center">
                                <a href="<?= base_url('user/delete_bukti_relavan_apl02/').$bukti_relavan_apl02['id']."/".base64_encode($id_izin);?>" class="btn btn-danger" onclick="return confirm('Apakah yakin untuk Hapus Bukti Relavan (<?= $bukti_relavan_apl02['nama_bukti']?>) ?');">Hapus</a>
                            </td>
                            <td style="font-size:15px;"><?= $bukti_relavan_apl02['nama_bukti']?></td>
                            <td class="text-center"><a href="<?= base_url('uploads/file_permohonan/bukti_apl02/').$bukti_relavan_apl02['file_bukti']?>" target="_blank">View File</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>

<!-- Alert Sweet Alert APL 02 -->
<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Bukti Relavan untuk Form APL 02 Berhasil di Tambahkan",
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
  text: "Bukti Gagal di Tambahkan pastikan Ukuran File Tidak lebih dari 10 MB dan Ekstension File jpg|jpeg|png|pdf",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
