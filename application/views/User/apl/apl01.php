<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir APL 01</title>
	<script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" ></script> 
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/signature-pad.js"></script> 

</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <br/>
            <h4 class="m-0 font-weight-bold text-primary text-center">Formulir APL 01</h4><br/>
            <div class="col-sm-12"><br/>
                <i>Lengkapi Data dibawah ini untuk keperluan Formulir APL 01 <br/>untuk permohonan id izin (<?=$get_data_apl01->id_izin?>)</i>
            </div><br/>

            <!-- Form -->
            <form action="<?php echo base_url('User/insert_pekerjaan_sekarang_apl01/').base64_encode($get_data_apl01->id_izin)?>" method="POST">
            <div class="col-sm-12">
            <hr/><h6 class="m-0 font-weight-bold text-primary text-center" style="font-size:18px">Data Pekerjaan</h6><hr/>
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Perusahaan/Lembaga :</label>
                        <input type="text" class="form-control" name="perusahaan" value="<?php echo $get_data_apl01->pekerjaan_sekarang_perusahaan;?>">
                    </div>
                    <div class="form-group">
                        <label> Alamat Kantor :</label>
                        <input type="text" class="form-control" name="alamat_kantor" value="<?php echo $get_data_apl01->pekerjaan_sekarang_alamat_kantor;?>">
                    </div>
                    <div class="form-group">
                        <label> Kode Pos :</label>
                        <input type="number" class="form-control" name="kodepos_kantor" value="<?php echo $get_data_apl01->pekerjaan_sekarang_kodepos_kantor;?>">
                    </div>
                    <div class="form-group">
                        <label> Telepon Kantor :</label>
                        <input type="text" class="form-control" name="telepon_kantor" value="<?php echo $get_data_apl01->pekerjaan_sekarang_notlp_kantor;?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label> Jabatan :</label>
                        <input type="text" class="form-control" name="jabatan" value="<?php echo $get_data_apl01->pekerjaan_sekarang_jabatan;?>">
                    </div>
                    <div class="form-group">
                        <label> Jenis Pekerjaan :</label>
                        <select name="id_pekerjaan" class="form-control">
                            <?php
                                foreach($get_master_pekerjaan as $master_pekerjaan){
                            ?>
                                <option value="<?= $master_pekerjaan['id']?>"
                                    <?php
                                        if(!empty($get_data_apl01->id_pekerjaan) && $get_data_apl01->id_pekerjaan == $master_pekerjaan['id']){
                                            echo 'selected';
                                        }
                                    ?>
                                ><?= $master_pekerjaan['deskripsi']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Fax Kantor :</label>
                        <input type="text" class="form-control" name="fax_kantor" value="<?php echo $get_data_apl01->pekerjaan_sekarang_fax_kantor;?>"> 
                    </div>
                    <div class="form-group">
                        <label> Email Kantor :</label>
                        <input type="email" class="form-control" name="email_kantor" value="<?php echo $get_data_apl01->pekerjaan_sekarang_email_kantor;?>"> 
                    </div>
                </div>
                </div>
                <div class="col-sm-12">
                    <center><input type="submit" value="Simpan Data" class="btn btn-primary" onclick="confirm('Konfirmasi Simpan Data Form APl-01?')"/></center>
                </div>
            </div>
            </form><br/><hr style="border:2px solid #999; background-color:#999;"/><br/>
            <!-- Form -->

            <!-- Signature -->
            <div class="container">
                <b>Catatan :</b></br>
                    <i>Tanda tangan di bawah ini akan digunakan untuk keperluan kelengkapan pada Form APL 01 dan APL 02</i></br></br>
                <div class="row">
                    <div class="col-md-6">
                        <section>
                            <div class="container">
                                <div class="boxarea">
                                    <div class="signature-pad" id="signature-pad">
                                        <div class="m-signature-pad" style="border:3px solid #111;">
                                            <div class="m-signature-pad-body">
                                            <canvas id="signature-pad" width="530" height="200"></canvas>
                                            </div>
                                        </div>
                                        <div class="m-signature-pad-footer" style="margin-top:5px;">
                                            <center><button type="button"  id="save2" data-action="save" onclick="confirm('Simpan Signature / TTD ?')" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                                            <button type="button" data-action="clear"  class="btn btn-danger"><i class="fa fa-trash-o"></i> Clear</button></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo rand();?>" id="rowno">
                        </section><br/>
                    </div>
                    <div class="col-md-6">
                        <?php
                            if($get_data_apl01->ttd_pemohon == NULL){
                                echo "<center style='color:red;'>Belum di Tanda Tangani untuk Keperluan Apl-01, Silahkan Tanda Tangani terlebih dahulu !</center>";
                            }else{
                                echo "<img src='".base_url('uploads/file_permohonan/ttd_pemohon_apl01_apl02/').$get_data_apl01->ttd_pemohon."'/>";
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- / Signature -->

        </div>
    </div>
</div>

</body>
</html>
<script>
    $('#modal-dialog').on('show', function() {
        var link = $(this).data('link'),
            confirmBtn = $(this).find('.confirm');
    })

    $('#btnYes').click(function() {
        // handle form processing here
    //  	alert('submit form');
        $('form').submit();
    });
</script>


<!-- Signature / TTD -->
<script>
    var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;


    function resizeCanvas() {

    var ratio =  window.devicePixelRatio || 1;
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    }
    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
    });
    saveButton.addEventListener("click", function (event) {
    
    if (signaturePad.isEmpty()) {
        $('#myModal').modal('show');
    }

    else {
        $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>User/insert_signature_apl01/<?= base64_encode($get_data_apl01->id_izin)?>",
        data: {'image': signaturePad.toDataURL(),'rowno':$('#rowno').val()},
        success: function(datas1)
        {            
            // signaturePad.clear();
            // $('.previewsign').html(datas1);
            top.location.href="<?= base_url('User/formulir_apl01/').base64_encode($get_data_apl01->id_izin)?>";
        }
        });
    }
    }); 
</script>
<!-- Signature / TTD -->