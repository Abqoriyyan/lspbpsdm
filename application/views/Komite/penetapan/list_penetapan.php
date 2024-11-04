<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Penetapan</title>
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
    table {
        font-size:12px;
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
        <h6 class="m-0 font-weight-bold text-light">List Penetapan Permohonan Sertifikasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID IZIN</th>
                        <th>Klasifikasi</th>
                        <th>Subklasifikasi</th>
                        <th>Kualifikasi</th>
                        <th>Nama TUK</th>
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
                        <th>Nama TUK</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach($get_list_penetapan as $list_penetapan){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $list_penetapan['nama'];?></td>
                        <td><?= $list_penetapan['id_izin'];?></td>
                        <td><?= $list_penetapan['klasifikasi'];?></td>
                        <td><?= $list_penetapan['subklasifikasi'];?></td>
                        <td><?= $list_penetapan['deskripsi_kualifikasi'];?></td>
                        <td><?= $list_penetapan['nama_tuk'];?></td>
                        <td>
                            <a href="<?= base_url('Komite/penetapan/').base64_encode($list_penetapan['id_izin']);?>" class="btn btn-success" style="font-size:12px;">Mulai Penetapan</a>
                        </td>
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