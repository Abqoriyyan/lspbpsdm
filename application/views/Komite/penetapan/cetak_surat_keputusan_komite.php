<?php

function getRomawi($bln){
    switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
      }
}


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
    <title>Surat Keputusan Komite - Permohonan ID Izin (<?= $id_izin ?>)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
</style>
<body>
    <!-- KOP Surat -->
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
    <img src="<?=$base64 ;?>" width="100%" height="200px" style="margin:0;">
    <!-- /KOP Surat -->
    
    <div style="margin:30px; margin-top:-20px;">
        <h4 style="text-align:center;">SURAT KEPUTUSAN<br/>
        KETUA LEMBAGA SERTIFIKASI PROFESI<br/>
        BPSDM KEMENTRIAN PUPR<br/><br/></h4>
        <h5 style="text-align:center;">NOMOR : <?= $get_data_pencatatan->nomor_sertifikasi; ?> /KPTS-PLK/LSP/<?= getRomawi(date('n',strtotime($get_data_pencatatan->tanggal_ditetapkan)))?>/<?= substr($get_data_pencatatan->nomor_registrasi_lsp, -4);?></h5><br/><br/>

        <h4 style="text-align:center;">
            TENTANG<br/>
            HASIL UJI KOMPETENSI SKEMA SERTIFIKASI <br/><?= $get_data_pencatatan->jabatan_kerja?>
        </h4>
    </div>

    <div style="margin:80px; margin-top:40px;">
        <h4 style="text-align:center;">Ketua Lembaga Sertifikasi Profesi Badan Pengembangan Sumber Daya Manusia Kementerian Pekerjaan Umum dan Perumahan Rakyat</h4>
        <table style="width:100%; text-align:justify; font-size:15px;   border-spacing: 0 15px;">
            <tr>
                <td style="width:30%; vertical-align: baseline;" >Menimbang</td>
                <td style="width:5%; vertical-align: baseline;"> : </td>
                <td style="width:65%; vertical-align: baseline;">
                    <ol type="a">
                        <li>Bahwa dalam rangka menetapkan hasil uji kompetensi skema <b><?= $get_data_pencatatan->jabatan_kerja; ?></b> yang ditetapkan dalam pleno oleh Komite Teknis Hasil Uji Kompetensi sebagai Tim Pengambil Keputusan Sertifikasi yang dikeluarkan oleh Lembaga Sertifikasi Profesi <?= $token->username;?>;</li>
                        <li>Bahwa hasil dari keputusan pleno Komite Teknis Hasil Uji Kompetensi skema <b><?= $get_data_pencatatan->jabatan_kerja; ?></b> perlu ditetapkan dalam surat keputusan;</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;" >Mengingat</td>
                <td style="width:5%; vertical-align: baseline; "> : </td>
                <td style="width:65%; vertical-align: baseline;">
                    <ol>
                        <li>Pedoman Badan Nasional Sertifikasi Profesi (BNSP) 301 Nomor: 09/BNSP.301/XI/2013 tentang Pedoman Pelaksanaan Uji Kompetensi.</li>
                        <li>Standar Operasional Prosedur (SOP) LSP BPSDM Kementerian PUPR tentang Sertifikasi Kompetensi.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>

    <!-- // New Page -->
    <div style="page-break-after: always;"></div> 

    <div style="margin:80px;">
        <h4 style="text-align:center;">MEMUTUSKAN</h4><br/>
        <table style="width:100%; text-align:justify; font-size:16px; border-spacing: 0 15px;">
            <tr>
                <td style="width:30%; vertical-align: baseline;"><b>Menetapkan</b></td>
                <td style="width:5%; vertical-align: baseline; "> : </td>
                <td style="width:65%; vertical-align: baseline;">
                   <!-- <b>KOMITE PENGAMBILAN KEPUTUSAN (KOMITE TEKNIS)</b> -->
                </td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;">Pertama</td>
                <td style="width:5%; vertical-align: baseline; "> : </td>
                <td style="width:65%; vertical-align: baseline;">
                    Hasil Uji Kompetensi skema <b><?= $get_data_pencatatan->jabatan_kerja; ?></b> di LSP <?= $token->username;?> pada tanggal <b><?= tanggal_indo($get_data_pencatatan->tanggal_mulai);?> s/d <?= tanggal_indo($get_data_pencatatan->tanggal_selesai);?></b> sebagaimana tercantum dalam lampiran yang tidak terpisahkan dari Surat Keputusan Ketua LSP <?= $token->username;?>.
                </td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;">Kedua</td>
                <td style="width:5%; vertical-align: baseline; "> : </td>
                <td style="width:65%; vertical-align: baseline;">
                    Menetapkan Kompeten atau Belum Kompeten terhadap nama-nama peserta uji kompetensi sebagaimana tercantum dalam lampiran surat keputusan ini.           
                </td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;">Ketiga</td>
                <td style="width:5%; vertical-align: baseline; "> : </td>
                <td style="width:65%; vertical-align: baseline;">
                    Keputusan ini mulai berlaku pada tanggal ditetapkan.            
                </td>
            </tr>
        </table>
        <br/><br/><br/><br/>
        <table style="width:100%; border:none; font-size:14px;">
            <tr>
                <td style="width:70%;"> </td>
                <td style="width:13%; vertical-align: baseline;">Ditetapkan di</td>
                <td style="width:2%; vertical-align: baseline; "> :</td>
                <td style="width:15%; vertical-align: baseline;">
                    Bandung
                </td>
            </tr>
            <tr>
                <td style="width:70%;"> </td>
                <td style="width:13%; vertical-align: baseline;">Pada tanggal</td>
                <td style="width:2%; vertical-align: baseline; "> :</td>
                <td style="width:15%; vertical-align: baseline;">
                    <?= tanggal_indo($get_data_pencatatan->tanggal_ditetapkan);?>
                </td>
            </tr>
        </table>
        <br/><br/><br/><br/><br/><br/>
        
        <h4 style="text-align:center;">Ketua Lembaga Sertifikasi Profesi <?= $token->username;?></h4>
        <br/>
        <!-- KOP Surat -->
        <?php
            $path = base_url('assets/lsp/ttd_ketua_pelaksana/').$get_data_pencatatan->ttd_ketua_pelaksana;
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
        <center><img src="<?=$base64 ;?>" style="max-height: 190px; max-width: 120px;"></center>
        <!-- /KOP Surat -->
        <center><b><u><?= $get_data_pencatatan->ketua_pelaksana;?></u></b><br/>NIP 196310171990031002</center>
    </div>


    <!-- // New Page -->
    <div style="page-break-after: always;"></div> 


    <div style="margin:80px;">
        * Lampiran<br/>
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <th width="5%" style="text-align:center; border: 1px solid; padding:5px;">No.</th>
                <th width="30%" style="border: 1px solid; padding:5px;">Nama</th>
                <th width="10%" style="border: 1px solid; padding:5px;">Jenjang</th>
                <th width="20%" style="border: 1px solid; padding:5px;">NIK</th>
                <th width="35%" style="border: 1px solid; padding:5px;">Keterangan (K/BK)</th>
            </tr>
            <?php
                $no = 1;
                foreach($get_data_hasil_penetapan_komite_teknis as $data){
            ?>
            <tr>
                <td style="text-align:center; border: 1px solid; padding:5px;;"><?= $no++?></td>
                <td style="text-align:left; border: 1px solid; padding:5px;"><?=$data['nama'];?></td>
                <td style="text-align:center; border: 1px solid; padding:5px;"><?=$data['jenjang'];?></td>
                <td style="text-align:center; border: 1px solid; padding:5px;"><?=$data['nik'];?></td>
                <td style="text-align:center; border: 1px solid; padding:5px;">
                    <?php
                        if($data['hasil_penetapan'] == "Kompeten"){
                            echo "K";
                        }elseif($data['hasil_penetapan'] == "Belum Kompeten"){
                            echo "BK";
                        }
                    ?>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
    
     
</body>
</html>