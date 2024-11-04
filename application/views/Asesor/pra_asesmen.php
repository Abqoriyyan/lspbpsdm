<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pra Asesmen</title>
</head>
<body>
<?php
    ##for ($i = 0; $i < count($array['data']); $i++){
    #    echo $array['data'][$i]['nik'];
   # }
?>

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-dark">
        <h6 class="m-0 font-weight-bold text-light">Pra Asesmen</h6>
    </div>
    <div class="container">
    <!-- Catatan -->
    <b>Catatan :</b><br/>
    • Pastikan Semua Data / Form Pra-Asesmen Telah dilengkapi sebelum lanjut ke tahap asesmen<br/>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <a href="<?= base_url('asesor/form_apl01/').base64_encode($id_izin);?>" class="btn btn-danger">Form APL 01</a>
                </div>
                <div class="col-sm-6 text-center">
                    <a href="<?= base_url('asesor/form_apl02/').base64_encode($id_izin);?>" class="btn btn-warning">Form APL 02</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>