<?php 
function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Formulir APL 02</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Checklist Using Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<style>
        * {
            padding:0;
            margin:0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            padding:0;
            margin:0;
            font-style: normal;
            font-variant: normal;
        }

        p {
            font-family: Arial, Helvetica, sans-serif; 
        }
        h1 h2 h3 h4 h5 h6 {
            font-family: Arial, Helvetica, sans-serif; 
        }
        li {
            font-family: Arial, Helvetica, sans-serif; 
        }
        .page{
            position: relative; 
            page-break-after:always;
            overflow: hidden; 
            padding:0;
        }
        td {
            font-family: Arial, Helvetica, sans-serif;
        }
        .table_bagian2, .td_bagian2, .th_bagian2 {
            border: 1px solid black;
            padding: 10px;
            font-size: 12px;
        }
        .table_bagian3, .td_bagian3, .th_bagian3 {
            border: 1px solid black;
            padding: 3px;
            font-size: 12px;
        }
        .table4, .td4, .th4 {
            border: 1px solid black;
            padding: 3px;
            font-size: 12px;
        }
        .table5, .td5, .th5 {
            border: 1px solid black;
            padding: 3px;
            font-size: 12px;
        }
        .data_apl02 thead tr, th {
            border:1px solid #111;
            padding:10px;
        }
        .data_apl02 {
            font-size:12px;
            padding:5px;
        }
        .data_apl02 b {
            font-size:12px;
            padding:0px;
        }

        .ttd tbody tr, td {
            border:1px solid #111;
            padding:10px;
        }
        .ttd {
            font-size:14px;
            padding:5px;
        }
        .ttd b {
            font-size:14px;
            padding:0px;
        }
</style>
<body>
    <!-- Header -->
    <?php
        $path = base_url('assets/lsp/kop-lsp.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
        );
        $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
    <img src="<?=$base64 ;?>" style="margin-top:25px; margin-left:50px; max-height:400px; max-width:700px;">
    <!-- //Header -->
    <div style="padding:70px; padding-top:0px;">
        <table class="table_bagian2" style="border-collapse: collapse; border: 1px solid black; width:100%;">
            <tr class="tr_bagian2">
                <td rowspan="2" class="td_bagian2" width="20%">Skema Sertifikasi (KKNI/Okupasi/Klaster)</td>
                <td class="td_bagian2" width="10%">Judul</td>
                <td class="td_bagian2" width="3%">:</td>
                <td class="td_bagian2" width="37%"><?= $get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja;?></td>
            </tr>
            <tr class="tr_bagian2">
                <td class="td_bagian2">Nomor</td>
                <td class="td_bagian2">:</td>
                <td class="td_bagian2"><?= $get_data_klasifikasi_kualifikasi->acuan;?></td>
            </tr>
        </table>

        <!-- Panduan -->
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead style="border:1px solid #111;">
                <tr>
                    <th class="col-sm-12">Panduan Asesment Mandiri (Self Asesment)</th>
                </tr>
            </thead>
            <tbody style="border:1px solid #111;">
                <tr>
                    <td style="padding:10px;">
                        <b>Instruksi :</b><br/>
                        •	Baca setiap pertanyaan dikolom sebelah kiri<br/>
                        •	Beri tanda centang (V) pada kotak jika Anda yakin dapat melakukan tugas yang dijelaskan.<br/>
                        •	Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan bahwa Anda melakukan tugas-tugas ini.<br/>
                        <br/>
                        <b>Catatan :</b> <br/>
                        K = Kompeten<br/>
                        BK = Belum Kompeten
                    </td>
                </tr>
            </tbody>
        </table>
<br/><br/>
        <!-- Data APL 02 -->
        <?php
            foreach($get_master_unit_kompetensi as $master_unit_kompetensi){
                if($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja){
        ?>
        <table class="data_apl02 table table-bordered" width="100%" cellspacing="0">
            <thead style="border:1px solid #111;">
                <tr>
                    <th colspan="1" width="10%">Unit Kompetensi</th>
                    <th colspan="6" width="90%" style="text-align:left;"><?= $master_unit_kompetensi['kode_unit_kompetensi']?> (<?= $master_unit_kompetensi['deskripsi']?>)</th>
                </tr>
                
            </thead>
            
            <tbody style="border:1px solid #111;">
                <tr style="padding:10px; border:0;">
                    <th colspan="4" style="text-align:left; width:70%;">Dapatkah Saya .................?</th>
                    <th style="width:5%;">BK</th>
                    <th style="width:5%;">K</th>
                    <th style="width:20%;">Bukti Relavan</th>
                </tr>
                <?php
                    foreach($get_master_elemen_kompetensi as $master_elemen_kompetensi){
                        if($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']){
                ?>
                    <tr>
                        <td colspan="7" style="border:1px solid #111;">
                        <b>Elemen <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi']?></b> : <?= $master_elemen_kompetensi['deskripsi']?></b>
                        </td>
                    </tr>
                <tr>
                    <td colspan="7"><b>Kriteria Unjuk Kerja :</b></td>
                </tr>
                <?php
                    foreach($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja){
                        if($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']){
                ?>
                    <tr>
                        <td colspan="4">&nbsp;&nbsp; <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi'].'.'.$master_kriteria_unjuk_kerja['no_urut_kuk']?> <?= $master_kriteria_unjuk_kerja['deskripsi']?><br/></td>
                        <td style="text-align:center; border:1px solid #111;">
                            <?php
                            //Cek Status APl 02 di Database
                                foreach($get_data_apl02 as $data_apl02){
                                    if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['status'] == '0')){
                                        echo 'V';
                                    }else{
                                        echo '';
                                    }
                                }
                            ?>
                        </td>
                        <td style="text-align:center; border:1px solid #111;">
                            <?php
                            //Cek Status APl 02 di Database
                                foreach($get_data_apl02 as $data_apl02){
                                    if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['status'] == '1')){
                                        echo 'V';
                                    }else{
                                        echo '';
                                    }
                                }
                            ?>
                        </td>
                        <td style="text-align:center; border:1px solid #111;">
                            <?php
                                //Cek File Bukti APl 02 di Database
                                foreach($get_bukti_relavan_apl02 as $bukti_relavan_apl02){
                                    foreach($get_data_apl02 as $data_apl02){
                                        if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['bukti_relavan'] == $bukti_relavan_apl02['file_bukti'])){
                                            echo "<a href='".base_url('uploads/file_permohonan/bukti_apl02/').$bukti_relavan_apl02['file_bukti']."' target='_blank'>".$bukti_relavan_apl02['nama_bukti']."</a>";
                                        }else{
                                            echo '';
                                        }
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
           
        </table><br/>
        <?php 
                }
            }
        ?>
        <!-- / Data APL 02 -->
        
        <!-- / TTD -->
        <table class="ttd" style="width:100%; border-collapse: collapse; border: 1px solid black; width:100%;">
            <tbody>
                <tr>
                    <td style="text-align:center; border-bottom:0px;" width="34%">Nama Asesi</td>
                    <td style="text-align:center; border-bottom:0px;" width="33%">Tanggal</td>
                    <td style="text-align:center; border-bottom:0px;" width="33%">Tanda Tangan Asesi</td>
                </tr>
                <tr>
                    <td style="text-align:center; border-top:0px;"><b><?= $get_data_personal_permohonan->nama;?></b></td>
                    <td style="text-align:center; border-top:0px;"><b><?= tanggal_indo(date('Y-m-d', strtotime($get_data_apl01->tanggal_ttd_pemohon)))?></b></td>
                    <td style="text-align:center; border-top:0px;">
                    <?php
                        if(!empty($get_data_apl01->ttd_pemohon)){
                            $path = base_url('uploads/file_permohonan/ttd_pemohon_apl01_apl02/').$get_data_apl01->ttd_pemohon;
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                            );
                            $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            echo '<img src="'.$base64.'" style="max-height: 150px; max-width: 125px;">';
                        }else{
                            echo '';
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Ditinjau oleh Asesor :</td>
                </tr>
                <tr>
                    <td style="text-align:center; border-bottom:0px;" width="34%">Nama Asesor</td>
                    <td style="text-align:center; border-bottom:0px;" width="33%">Rekomendasi</td>
                    <td style="text-align:center; border-bottom:0px;" width="33%">Tanda Tangan Asesor</td>
                </tr>
                <tr>
                    <td style="text-align:center; border-top:0px;"><b><?= $get_data_apl01->nama_asesor_ttd_apl02;?></b></td>
                    <td style="text-align:center; border-top:0px;"><b>Asesmen dapat Dilanjutkan</b></td>
                    <td style="text-align:center; border-top:0px;">
                    <?php
                        if(!empty($get_ttd_lead_asesor->ttd_asesor)){
                            $path = base_url('uploads/file_permohonan/ttd_asesor_apl02/').$get_ttd_lead_asesor->ttd_asesor;
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                            );
                            $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            echo '<img src="'.$base64.'" style="max-height: 150px; max-width: 125px;"><br/>';
                            echo "<center>".tanggal_indo(date('Y-m-d', strtotime($get_data_apl01->tanggal_ttd_pemohon)))."</center>";
                        }else{
                            echo '';
                        }
                    ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>