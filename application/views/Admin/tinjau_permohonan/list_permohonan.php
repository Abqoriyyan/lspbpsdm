<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Permohonan</title>
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
        <h6 class="m-0 font-weight-bold text-light">List Permohonan SKKK</h6>
        <a href="<?= base_url('admin/get_data_list_permohonan')?>" class="btn btn-primary" style="float:right; font-size:12px;">Update Get Data Permohonan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>ID Izin</th>
                        <th>Create At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>ID Izin</th>
                        <th>Create At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($list_permohonan as $data_list_permohonan)
                        {
                    ?>
                    <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php if($data_list_permohonan['kode_status'] == '11'){ echo $data_list_permohonan['nik'] . ' - Perbaikan';}else{ echo $data_list_permohonan['nik'];} ?></td>
                        <td><?php echo $data_list_permohonan['id_izin'];?></td>
                        <td><?php echo $data_list_permohonan['created_at'];?></td>
                        <td><?php echo $data_list_permohonan['updated_at'];?></td>
                        <td>
                            <?php if($data_list_permohonan['kode_status'] == '11'){?>
                                <a href="<?= base_url('admin/cek_status_perbaikan/').base64_encode($data_list_permohonan['id_izin']);?>" onclick="return confirm('Cek Status Perbaikan')" class="btn btn-warning" style="font-size:10px;">Cek Status Perbaikan</a>
                            <?php }else{?>
                                <a href="<?= base_url('admin/entry_data_permohonan/').base64_encode($data_list_permohonan['id_izin']);?>" onclick="return confirm('Mulai Tinjau Permohonan')" class="btn btn-primary" style="font-size:10px;">Mulai Tinjau Permohonan</a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>