<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Penunjukkan Asesor</title>
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
        <h6 class="m-0 font-weight-bold text-light">List Penunjukan Asesor</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" style="font-size:8px;" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID Izin</th>
                        <th>Subklasifikasi</th>
                        <th>Kualifikasi</th>
                        <th>Tanggal Permohonan</th>
                        <th>Asesor</th>
                        <th>Nama TUK</th>
                        <th>Penunjukan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID Izin</th>
                        <th>Subklasifikasi</th>
                        <th>Kualifikasi</th>
                        <th>Tanggal Permohonan</th>
                        <th>Asesor</th>
                        <th>Nama TUK</th>
                        <th>Penunjukan</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($get_list_penunjukan_asesor as $data){
                    ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $data['nama'];?></td>
                        <td><?= $data['id_izin'];?></td>
                        <td><?= $data['subklasifikasi'];?></td>
                        <td><?= $data['kualifikasi'];?></td>
                        <td><?= date("Y-M-d",strtotime($data['created']));?></td>
                        <td>
                            <?php
                                if(!empty($data['nama_asesor'])){
                                    echo $data['nama_asesor'];
                                }else{
                                    echo 'Belum Penunjukan';
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if(!empty($data['nama_tuk'])){
                                    echo $data['nama_tuk'];
                                }else{
                                    echo 'Belum Penunjukan';
                                }
                            ?>
                        </td>
                        <td>
                            <?php if(empty($data['id_asesor'])){
                                echo "<a href='".base_url('admin/penunjukan_asesor/').base64_encode($data['id_izin'])."' class='btn btn-primary text-center' style='font-size:12px;'>Mulai Penunjukkan</a>";
                            }else{
                                echo "<p class='btn btn-success' style='font-size:12px;'>Sudah Penunjukan</p>";
                            }
                            ?>
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
</html>