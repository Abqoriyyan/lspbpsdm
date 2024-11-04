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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
        <br/>
        <h4 class="m-0 font-weight-bold text-primary text-center">Self Asesment (Pra-Assesment)<br/>Formulir APL 02</h4><br/>
        <div class="col-sm-12"><br/>
            <i>Silahkan Lengkapi Self Assesment pada Form APL 02 dibawah ini<br/>untuk permohonan id izin (<?=$id_izin;?>)</i>
        </div><br/>

        <!-- Panduan -->
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="col-sm-12">Panduan Asesmen Mandiri (Self Assesment)</th>
                </tr>
            </thead>
            <tbody>
                </tr>
                    <td>
                        <b>Instruksi :</b><br/>
                        •	Baca setiap pertanyaan dikolom sebelah kiri<br/>
                        •	Switch tanda <img src="<?= base_url('assets/img/switch-on.png')?>"/> pada kotak jika Anda yakin dapat melakukan tugas yang dijelaskan.<br/>
                        •	Silahkan Tambahkan terlebih dahulu bukti-bukti untuk lampiran pilihan Bukti pada kolom <b>Bukti yang Relevan</b> Pada Tombol <button class="btn btn-primary" style="font-size:10px;"> + Tambah Bukti Relevan</button><br/>
                        •	Pilih kolom disebelah kanan sesuai bukti yang Anda miliki untuk menunjukkan bahwa Anda melakukan tugas-tugas ini.<br/>
                        <br/>
                        <b>Catatan :</b> <br/>
                        K = Kompeten<br/>
                        BK = Belum Kompeten
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Tambah Bukti Relevan -->
            <a href="<?= base_url("user/bukti_relavan_apl02/").base64_encode($id_izin);?>" class="btn btn-primary text-center" style="float:right; font-size:12px;"><b> + Tambah Bukti Relevan</b></a>
        <!-- Tambah Bukti Relevan -->
        
        <form action="<?= base_url('user/save_data_apl02/').base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
        <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
        <?php
            foreach($get_master_unit_kompetensi as $master_unit_kompetensi){
                if($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja){
        ?>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr style="background-color:#FFA279; color:#111;">
                        <th class="col-sm-2 text-center" rowspan="2">Unit Kompetensi :</th>
                        <th class="col-sm-10" colspan="4"><?= $master_unit_kompetensi['kode_unit_kompetensi']?> (<?= $master_unit_kompetensi['deskripsi']?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color:#F9CEBB; color:#111;">
                        <th class="col-sm-8" colspan="2">
                            Dapatkah Saya ............... ?
                        </th>
                        <th class="col-sm-1 text-center">
                            BK / K
                        </th>
                        <th class="col-sm-3 text-center">
                           Bukti yang Relevan
                        </th>
                    </tr>
                    <?php
                        foreach($get_master_elemen_kompetensi as $master_elemen_kompetensi){
                            if($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']){
                    ?>
                    <tr>
                        <td class="col-sm-6" colspan="5">
                            <b>Elemen <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi']?></b> : <?= $master_elemen_kompetensi['deskripsi']?><br/><br/>

                            <!-- KUK-->
                            <table class="table border-0" width="100%" cellspacing="0">
                            <b>Kriteria Unjuk Kerja :</b>
                                <?php
                                    foreach($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja){
                                        if($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']){
                                ?>
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-8">
                                                <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi'].'.'.$master_kriteria_unjuk_kerja['no_urut_kuk']?> <?= $master_kriteria_unjuk_kerja['deskripsi']?><br/>
                                            </td>
                                            <td class="col-sm-1 text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <?php
                                                        $kode_kuk_clear = str_replace(".", "", $master_kriteria_unjuk_kerja['kode_kuk']);
                                                    ?>
                                                    <input type="checkbox" class="custom-control-input" value="1" id="<?=$kode_kuk_clear?>" name="<?='status_'.$kode_kuk_clear?>"
                                                       <?php
                                                        //Cek Status APl 02 di Database
                                                            foreach($get_data_apl02 as $data_apl02){
                                                                if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['status'] == '1')){
                                                                    echo 'checked';
                                                                }else{
                                                                    echo '';
                                                                }
                                                            }

                                                            // Ceklis semua jika baru mengisi
                                                            if(empty($get_data_apl02)){
                                                                echo 'checked';
                                                            }
                                                        ?>
                                                    >
                                                    <label class="custom-control-label" for="<?=$kode_kuk_clear?>"></label>
                                                </div>
                                            </td>
                                            <td class="col-sm-3">
                                                <select name="<?='bukti_relavan_'.$kode_kuk_clear?>" class="form-select" style="font-size:12px;" required>
                                                    <option value="">Pilih Bukti..</option>
                                                    <?php foreach($get_bukti_relavan_apl02 as $bukti_relavan_apl02){?>
                                                        <option value="<?= $bukti_relavan_apl02['file_bukti']?>"
                                                            <?php
                                                                //Cek File Bukti APl 02 di Database
                                                                foreach($get_data_apl02 as $data_apl02){
                                                                    if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['bukti_relavan'] == $bukti_relavan_apl02['file_bukti'])){
                                                                        echo 'selected';
                                                                    }else{
                                                                        echo '';
                                                                    }
                                                                }
                                                            ?>
                                                        ><?= $bukti_relavan_apl02['nama_bukti']?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php
                                        }
                                    }
                                ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        <?php
                }
            }
        ?>
            <div>
                <center><input class="btn btn-primary" type="submit" value="Simpan Data"/></center>
            </div>
        </form>
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
  text: "Data Berhasil di Simpan",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
