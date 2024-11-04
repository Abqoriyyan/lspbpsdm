<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan SKK</title>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    -->

</head>
<style>
    tr {
       font-size:12px; 
    }
</style>
<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
<body>
<div class="col-sm-12">
    <div class="card shadow mb-4" style="margin-top:30px;">
        <br/><h2 class="m-0 font-weight-bold text-dark text-center">Permohonan SKK</h2><br/><hr/>
        <div class="container">
            <p class="text-dark"> Catatan : <br/>
                - Pastikan Sebelum <b>Kirim Pra-Asesment</b> Lengkapi Terlebih dahulu <b>Form APL 01 dan APL 02</b>
                - Kirim Pra-Asesmen dapat dikirim ketika pada kolom Status sudah dinyatakan (Berkas Permohonan Memenuhi)
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-gradient-dark text-light">
                    <tr>
                        <th class="col-sm-1 text-center align-middle">No</th>
                        <th class="col-sm-3 text-center align-middle">ID_Izin</th>
                        <th class="col-sm-1 text-center align-middle">Kualifikasi</th>
                        <th class="col-sm-1 text-center align-middle">Jabatan Kerja</th>
                        <th class="col-sm-3 text-center align-middle">Keperluan Sertifikasi<br/>(Form APL01 & APL02)</th>
                        <th class="col-sm-3 text-center align-middle">Action</th>
                        <th class="col-sm-3 text-center align-middle">Status Permohonan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                        foreach($get_data_permohonan as $data){
                    ?>
                    <tr>
                        <td class="text-center"><?=$no++?></td>
                        <td class="text-center"><?= $data['id_izin'];?></td>
                        <td class="text-center"><?= $data['kualifikasi']?></td>
                        <td class="text-center"><?= $data['jabatan_kerja']?></td>
                        <td class="text-center">
                            <div class="dropdown mb-4">
                            <?php
                                // if($data['kode_status'] == '10' || $data['kode_status'] == "20" || $data['kode_status']){
                            ?>
                                <!-- <button class="btn btn-primary dropdown-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                </button> -->
                                <!-- <div class="dropdown-menu animated--fade-in text-light" aria-labelledby="dropdownMenuButton"> -->
                                    <a href="<?= base_url('user/formulir_apl01/').base64_encode($data['id_izin']);?>" class="btn btn-primary" style="font-size:10px;"><b>Lengkapi Form APL 01</b></a><br/><br/>
                                    <a href="<?= base_url('user/formulir_apl02/').base64_encode($data['id_izin']);?>" class="btn btn-primary" style="font-size:10px;"><b>Lengkapi Form APL 02</b></a>
                                <!-- </div> -->
                            <?php
                                // }
                            ?>
                            </div>
                        </td>
                        <td class="text-center">
                             <!-- Kirim Pra Asesment jika status 10 / Berkas Memenuhi -->
                            <?php
                                if($data['kode_status'] == '10'){
                            ?>
                                <a href="<?=base_url('user/kirim_pra_asesment/').base64_encode($data['id_izin']);?>" class="btn btn-success text-center" style="font-size:12px;" onclick="return confirm('Pastikan Anda Sudah Melengkapi Form APl-01 dan APL-02, Jika Sudah silahkan klik OK untuk proses ke tahap Pra-Asesment.')"><b>Kirim Pra-Asesment</b></a>
                            <?php 
                                }elseif($data['kode_status'] == '11'){
                            ?>
                                <a href="<?=base_url()?>" class="btn btn-warning text-center" style="font-size:12px;"><b>Perbaikan Data Permohonan</b></a>
                            <?php
                                }else{
                                    echo '';
                                }
                            ?>
                        </td>
                        <td class="text-center"><b>
                            <?php
                                if($data['kode_status'] == '20'){
                                    echo 'Validasi (Tinjau Permohonan)';
                                }elseif($data['kode_status'] == '10'){
                                    echo 'Berkas Permohonan Memenuhi';
                                }elseif($data['kode_status'] == '11'){
                                    echo 'Silahkan Perbaiki Data Permohonan di field Action';
                                }elseif($data['kode_status'] == '12'){
                                    echo 'Pra-Asesment';
                                }elseif($data['kode_status'] == '30'){
                                    echo 'Silahkan Selesaikan Pembayaran';
                                }elseif($data['kode_status'] == '31'){
                                    echo 'Pembayaran sudah Dibayarkan';
                                }else{
                                    echo '';
                                }
                            ?>
                            </b>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>