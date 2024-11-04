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
    <title>Surat Tugas Asesor</title>
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
</head>
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
    <h4 style="text-align:center;"><u>SURAT PERINTAH TUGAS ASESOR</u><br/>
        No: <?= $get_data_surat_tugas[0]['no_surat_tugas']?>
    </h4><br/>
    Yang bertanda tangan dibawah ini, atas nama Ketua Pelaksana LSP <?= $token->username?><br/><br/>
    <h4>KESATU:	Memerintahkan kepada Asesor LSP <?= $token->username?> </h4><br/>
    <table style="width:100%; border-collapse: collapse; padding:0px;" class="table_bagian3">
        <tr class="tr_bagian3">
            <td class="td_bagian3" style="width:5%; text-align:center; font-size:14px"><b>No.</b></td>
            <td class="td_bagian3" style="width:40%; text-align:center; font-size:14px"><b>Nama</b></td>
            <td class="td_bagian3" style="width:40%; text-align:center; font-size:14px"><b>No. Reg BNSP</b></td>
        </tr>
        <?php 
            $no = 1;
            foreach($get_data_surat_tugas as $get_data_surat_tugas){
        ?>
        <tr class="tr_bagian3">
            <td class="td_bagian3" style="text-align:center; font-size:14px"><?= $no++?></td>
            <td class="td_bagian3" style="text-center; font-size:14px"><?= $get_data_surat_tugas['nama_asesor']?></td>
            <td class="td_bagian3" style="text-align:center; font-size:14px"><?=  $get_data_surat_tugas['no_reg_bnsp_asesor'];?></td>
        </tr>
        <?php
            }
        ?>
    </table> 
    <br/>
    Untuk melaksanakan Asesmen Skema <b><?= $get_data_surat_tugas['jabatan_kerja'];?></b> pada:<br><br>
    <table border="0" style="padding-left:20px;" width="100%">
        <tr style="padding-top:10px; padding-bottom:10px; vertical-align: baseline;">
            <td width="27%" class="vertical-align: baseline;">
                <p>Nama TUK</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?= $get_data_surat_tugas['nama_tuk']?></p>
            </td>
        </tr>
        <tr style="padding-top:10px; padding-bottom:10px; vertical-align: baseline;">
            <td width="27%">
                <p>Alamat</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?= $get_data_surat_tugas['alamat']?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Tanggal</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <!-- Tanggal Indonesia -->
                <?= tanggal_indo(date('Y-m-d', strtotime($get_data_surat_tugas['tanggal_mulai'])));?> s/d <?= tanggal_indo(date('Y-m-d', strtotime($get_data_surat_tugas['tanggal_selesai'])));?></p>
            </td>
        </tr>
    </table>
<br/>
    Data Asesi:<br/>
    <table border="0" style="padding-left:20px;" width="100%">
        <tr>
            <td width="27%">
                <p>Skema</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?= $get_data_surat_tugas['jabatan_kerja'];?> - (<?= $get_data_surat_tugas['id_jabatan_kerja'];?>)</p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Nama</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?= $get_data_surat_tugas['nama_asesi'];?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Jenis Permohonan</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?php
                    if($get_data_surat_tugas['jenis_permohonan'] == 1){
                        echo 'Baru';
                    }elseif($get_data_surat_tugas['jenis_permohonan'] == 2){
                        echo 'Perpanjangan';
                    }?></p>
            </td>
        </tr>
        <tr>
            <td width="27%">
                <p>Jenjang</p>
            </td>
            <td width="3%">
                <p>:</p>
            </td>
            <td width="70%">
                <p><?= $get_data_surat_tugas['jenjang'];?></p>
            </td>
        </tr>
    </table>
</div>
        <!-- //Header -->
    <div style="padding:70px; padding-top:0px;">
    <h4>KEDUA: Melaksanakan tugas dengan penuh tanggung jawab dan independen serta melaporkan hasil asesmen segera setelah selesai pelaksanaan.</h4>
    Demikian untuk dilaksanakan sebagaimana mestinya. <br/><br/>

    Dikeluarkan di	: Bandung<br/>
    Pada tanggal	: <?= tanggal_indo(date('Y-m-d', strtotime($get_data_surat_tugas['log'])));?><br/><br/>

    Panitia Teknis Uji Kompetensi LSP <?= $token->username?><br/>
    
    <!-- TTD Ketua Pelaksana -->
    <?php
        $path = base_url('assets/lsp/ttd_ketua_pelaksana/'.$get_data_ketua_pelaksana->file_ttd);
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
    <img src="<?=$base64 ;?>" style="margin-top:-20px;border: 1px; max-height: 190px; max-width: 120px;"><br/>
    <b><u><?= $get_data_ketua_pelaksana->nama;?></u></b><br/>
    Ketua Pelaksana<br/><br/>

    Tembusan:<br/>
    1.	Yang bersangkutan;<br/>
    2.	Arsip.<br/>
    </div>
</body>
</html>