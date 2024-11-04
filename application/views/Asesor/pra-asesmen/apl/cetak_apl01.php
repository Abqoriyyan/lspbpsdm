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
    <title>Formulir APL 01</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
</style>
<body>
    <!-- Header -->
    <table style="padding:50px; padding-bottom:0px;">
            <!-- Kop -->
            <td>
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
                <img src="<?=$base64 ;?>" style="margin-top:-30px; max-height:400px; max-width:700px;">
            </td>
    </table>
    <!-- //Header -->
<div style="padding:70px; padding-top:0px;">
    <h4>Bagian 1 :  Rincian Data Pemohon Sertifikasi</h4><br/>
    <p>Pada bagian ini, Cantumkan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini.</p><br/>
    <p>a. Data Pribadi</p><br/>
    <table border="0" style="padding-left:20px;" width="100%">
        <tr>
            <td width="27%">
                <p>Nama Lengkap</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->nama;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>No. KTP/NIK/Paspor</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->nik;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Tempat / tgl. Lahir</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->tempat_lahir.' / '. tanggal_indo($get_data_personal_permohonan->tanggal_lahir);?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Jenis kelamin</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->jenis_kelamin;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Kebangsaan</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->negara;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Alamat Rumah</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->alamat;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Kode Pos</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->kodepos;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>No. Telepon/Email</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_personal_permohonan->telepon.' / '.$get_data_personal_permohonan->email;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Pendidikan</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <?= $get_data_pendidikan_yang_sesuai->nama_sekolah_perguruan_tinggi . " - " . $get_data_pendidikan_yang_sesuai->program_studi;?>
            </td>
        </tr>
    </table>
    <br/><br/><br/>
    <p>b. Data Pekerjaan Sekarang</p><br/>
    <table border="0" style="padding-left:20px;" width="100%">
        <tr>
            <td width="27%">
                <p>Nama Institusi / Perusahaan</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_apl01->pekerjaan_sekarang_perusahaan;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Jabatan</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_apl01->pekerjaan_sekarang_jabatan;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Alamat Kantor</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_apl01->pekerjaan_sekarang_alamat_kantor;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>No. Telepon/Fax/Email</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_apl01->pekerjaan_sekarang_notlp_kantor;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Fax</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_apl01->pekerjaan_sekarang_fax_kantor;?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Email</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php echo $get_data_apl01->pekerjaan_sekarang_email_kantor;?></p>
            </td>
        </tr>
    </table>
</div>

    <div style="page-break-after: always;"></div> 

<!-- Header -->
<table style="padding:50px; padding-bottom:0px;">
            <!-- Kop -->
            <td>
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
                <img src="<?=$base64 ;?>" style="margin-top:-30px; max-height:400px; max-width:700px;">
            </td>
    </table>
    <!-- //Header -->
<div style="padding:70px; padding-top:0px;">
    <h4>Bagian  2 :  Data Sertifikasi</h4><br/>
    <p>Tuliskan Judul dan Nomor Skema Sertifikasi yang anda ajukan berikut Daftar Unit Kompetensi sesuai kemasan pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda miliki.</p>
    <br/>
<table class="table_bagian2" style="border-collapse: collapse; border: 1px solid black; width:100%;">
    <tr class="tr_bagian2">
        <td rowspan="2" class="td_bagian2" width="50%">Skema Sertifikasi (KKNI/Okupasi/Klaster)</td>
        <td class="td_bagian2" width="10%">Judul</td>
        <td class="td_bagian2" width="3%">:</td>
        <td class="td_bagian2" width="37%"><?= $get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja;?></td>
    </tr>
    <tr class="tr_bagian2">
        <td class="td_bagian2">Nomor</td>
        <td class="td_bagian2">:</td>
        <td class="td_bagian2"><?= $get_data_klasifikasi_kualifikasi->acuan;?></td>
    </tr>
    <tr class="tr_bagian2">
        <td rowspan="2" colspan="2" class="td_bagian2">Tujuan Asesmen</td>
        <td class="td_bagian2">
            <?php if($get_data_apl01->tujuan_asesment == 'Sertifikasi'){
                    echo 'v';
                }else{
                    echo '';
                }
            ?>
        </td>
        <td class="td_bagian2">
            Sertifikasi
        </td>
    </tr>
    <tr class="tr_bagian2">
        <td class="td_bagian2">
            <?php if($get_data_apl01->tujuan_asesment == 'Sertifikasi Ulang'){
                    echo 'v';
                }else{
                    echo '';
                }
            ?>
        </td>
        <td class="td_bagian2">Sertifikasi Ulang</td>
    </tr>
</table>
<br/>
    <p>Daftar Unit Kompetensi sesuai kemasan :</p>
    <table style="width:100%; border-collapse: collapse; padding:0px;" class="table_bagian3">
        <tr class="tr_bagian3" style="background-color:#fabf8f;">
            <td class="td_bagian3" style="width:3%; text-align:center;">No. </td>
            <td class="td_bagian3" style="width:37%; text-align:center;">Kode Unit</td>
            <td class="td_bagian3" style="width:40%; text-align:center;">Judul Unit</td>
            <td class="td_bagian3" style="width:20%; text-align:center;">Jenis Standar (Standar Khusus/Standar Internasional/SKKNI)</td>
        </tr>
        <?php 
            $no = 1;
            foreach($get_data_unit_kompetensi as $data_unit_kompetensi){
        ?>
        <tr class="tr_bagian3">
            <td class="td_bagian3" style="text-align:center;"><?php echo $no++?></td>
            <td class="td_bagian3" style="text-align:center;"><?php echo $data_unit_kompetensi['kode_unit_kompetensi'];?></td>
            <td class="td_bagian3"><?php echo $data_unit_kompetensi['judul_unit_kompetensi'];?></td>
            <td class="td_bagian3" style="text-align:center;"><?php echo $data_unit_kompetensi['skkni'];?></td>
        </tr>
        <?php
            }
        ?>
    </table> 
</div>
        <div style="page-break-after: always;"></div> 

<!-- Header -->
<table style="padding:50px; padding-bottom:0px;">
            <!-- Kop -->
            <td>
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
                <img src="<?=$base64 ;?>" style="margin-top:-30px; max-height:400px; max-width:700px;">
            </td>
    </table>
    <!-- //Header -->
<div style="padding:70px; padding-top:0px;">
    <h4>Bagian  3  :  Bukti Kelengkapan Pemohon</h4><br/>
    <p>Bukti Persyaratan Dasar Pemohon</p>
    <table style="width:100%; border-collapse: collapse; padding:0px;" class="table4">
        <tr class="tr4" style="background-color:#fabf8f;">
            <td rowspan="2" class="td4" style="text-align:center; width:67%;">Bukti Persyaratan Dasar</td>
            <td colspan="2" class="td4" style="text-align:center; width:15%;">Ada</td>
            <td rowspan="2" class="td4" style="text-align:center; width:15%;">Tidak Ada</td>
        </tr>
        <tr class="tr4" style="background-color:#fabf8f;">
            <td class="td4" style="text-align:center;">Memenuhi Syarat</td>
            <td class="td4" style="text-align:center;">Tidak Memenuhi Syarat</td>
        </tr>
        <!-- Persyaratan Kompetensi -->
        <tr>
            <td class="td4" >
                <?php 
                    foreach($get_master_persyaratan_kompeten as $master_persyaratan_kompeten_apl){
                        if($master_persyaratan_kompeten_apl['id'] == $get_data_apl01->id_persyaratan_kompeten){
                            echo $master_persyaratan_kompeten_apl['persyaratan_pendidikan'].'( Pengalaman Proyek '.$master_persyaratan_kompeten_apl['persyaratan_pengalaman_proyek']." )";
                        }  
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_persyaratan_kompeten == 'Ada (Memenuhi Syarat)'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_persyaratan_kompeten == 'Ada (Tidak Memenuhi Syarat)'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_persyaratan_kompeten == 'Tidak Ada'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
        </tr>
        <!-- File KTP -->
        <tr>
            <td class="td4" >
                File KTP
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_ktp == 'Ada (Memenuhi Syarat)'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_ktp == 'Ada (Tidak Memenuhi Syarat)'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_ktp == 'Tidak Ada'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
        </tr>
        <!-- File Pas Foto -->
        <tr>
            <td class="td4" >
                Pas Foto
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_pas_foto == 'Ada (Memenuhi Syarat)'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_pas_foto == 'Ada (Tidak Memenuhi Syarat)'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
            <td class="td4" style="text-align:center;">
                <?php
                    if($get_data_apl01->status_pas_foto == 'Tidak Ada'){
                        echo 'v';
                    }else{
                        echo '';
                    }
                ?>
            </td>
        </tr>
    </table>
    <br/><br/><br/>
    <!-- TTD -->
    <table style="width:100%; border-collapse: collapse; float:bottom; padding:0px; " class="table5">
        <tr class="tr5">
            <td rowspan="3" class="td5" style="width:65%;">
                <p style="margin-left:5px;">Rekomendasi (diisi oleh LSP):<br/>
                Berdasarkan ketentuan persyaratan dasar, maka pemohon:<br/>
                Diterima/ <?php if(!empty($get_data_apl01->tanggal_ttd_peninjau)){ echo "<s>Tidak diterima</s>";}else{echo "Tidak diterima";}?> *) sebagai peserta  sertifikasi<br/>
                * coret yang tidak sesuai</p>
            </td>
            <td colspan="2" class="td5" style="text-align:center; width:35%; font-weight:bold;">Pemohon/ Kandidat</td>
        </tr>
        <tr class="tr5">
            <td class="td5" style="width:10%;">Nama</td>
            <td class="td5" style="width:20%;"><?= $get_data_personal_permohonan->nama;?></td>
        </tr>
        <tr class="tr5">
            <td class="td5" style="width:10%;">Tanda tangan<br/></td>
            <td class="td5" style="width:20%;">
                <!-- TTD Pemohon -->
                <?php
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
                ?>
                <center><img src="<?=$base64 ;?>" style="border: 1px; max-height: 100px; max-width: 75px; "></center>
                <!-- /TTD Pemohon -->
            </td>
        </tr>
        <tr class="tr5">
            <td rowspan="3" class="td5" style="width:65%;">
                <p style="margin-left:5px;">Catatan</p>
            </td>
            <td colspan="2" class="td5" style="text-align:center; width:35%; font-weight:bold;">Admin LSP</td>
        </tr>
        <tr class="tr5">
            <td class="td5" style="width:10%;">Nama</td>
            <td class="td5" style="width:20%;"><?= $get_nama_peninjau_apl01->nama_peninjau;?></td>
        </tr>
        <tr class="tr5">
            <td class="td5" style="width:10%;">Tanda tangan/<br/> Tanggal</td>
            <td class="td5" style="width:20%;">
                <!-- TTD Peninjau / Admin -->
                <?php
                $path = base_url('uploads/file_permohonan/ttd_admin_apl01/').$get_data_apl01->ttd_peninjau;
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
                <center><img src="<?=$base64 ;?>" style="border: 1px; max-height: 100px; max-width: 75px; "></center>
                <!-- /TTD Peninjau / Admin --><br/>
                <center>
                <?php
                    echo tanggal_indo(date('Y-m-d', strtotime($get_data_apl01->tanggal_ttd_peninjau)));
                ?>
                </center>
            </td>
        </tr>
    </table>
</div>
</body>
</html>