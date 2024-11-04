<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tugas Asesmen</title>
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
        font-size:12px;
    }
    td {
        text-align:center;
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
        <h6 class="m-0 font-weight-bold text-light">List Tugas Asesmen</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID-Izin</th>
                        <th>Nama</th>
                        <th>Jabatan Kerja</th>
                        <th>Jenjang</th>
                        <th>Jenis Permohonan</th>
                        <th>Surat Tugas</th>
                        <th>Pra Asesmen</th>
                        <th>Form Asesmen</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID-Izin</th>
                        <th>Nama</th>
                        <th>Jabatan Kerja</th>
                        <th>Jenjang</th>
                        <th>Jenis Permohonan</th>
                        <th>Surat Tugas</th>
                        <th>Pra Asesmen</th>
                        <th>Form Asesmen</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($get_list_tugas_asesmen as $list_tugas_asesmen){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $list_tugas_asesmen['id_izin'] ?></td>
                            <td><?= $list_tugas_asesmen['nama'] ?></td>
                            <td><?= $list_tugas_asesmen['jabatan_kerja'] ?></td>
                            <td><?= $list_tugas_asesmen['jenjang'] ?></td>
                            <td><?= $list_tugas_asesmen['jenis_permohonan'] ?></td>
                            <td><a href="<?= base_url('asesor/cetak_surat_tugas/').base64_encode($list_tugas_asesmen['id_izin'])?>" class="btn btn-primary" style="font-size:10px;" target="_blank">View</a></td>
                            <td><a href="<?= base_url('asesor/pra_asesmen/').base64_encode($list_tugas_asesmen['id_izin'])?>" class="btn btn-warning" style="font-size:10px;">Detail</a></td>
                            <td><a href="<?= base_url('asesor/asesmen/').base64_encode($list_tugas_asesmen['id_izin'])?>" class="btn btn-success" style="font-size:10px;">Detail</a></td>
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
</html>