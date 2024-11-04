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
	return $split[0] . ' ' .$bulan[ (int)$split[1] ];
}

function tanggal_indo_full($tanggal)
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
    <title>BA Pleno Komite Teknis - <?= $id_izin ?></title>
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
        table, td, th 
        {
            border: 1px solid;
            padding:5px;
        }

        table 
        {
            width: 100%;
            border-collapse: collapse;
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
    <img src="<?=$base64 ;?>" style="margin-top:25px; margin-left:50px; max-height:400px; max-width:700px;">
    <!-- /KOP Surat -->
    
    <div style="margin:30px; ">
        <h4 style="text-align:center;"><b><u>BERITA ACARA RAPAT PLENO</u></b><br/>
        HASIL UJI SERTIFIKASI KOMPETENSI<br/>
    </div>
    <div style="margin:80px; margin-top:-20px;">
        <?php
            $hari_array = array(
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                "Jum'at",
                'Sabtu'
            );
            $hr = date('w', strtotime($get_data_hasil_penetapan_komite_teknis[0]['tanggal_penetapan']));
            $hari = $hari_array[$hr];
        ?>
        <p style="text-align:justify;">Pada hari <b><?= $hari;?></b> tanggal <b><?= tanggal_indo(date('d-m-Y', strtotime($get_data_hasil_penetapan_komite_teknis[0]['tanggal_penetapan'])));?></b> 
        tahun <b><?= date('Y', strtotime($get_data_hasil_penetapan_komite_teknis[0]['tanggal_penetapan']));?></b>, telah dilaksanakan sidang pleno hasil Uji Sertifikasi Kompetensi dengan anggota sidang sebagai berikut :</p>
        
        <table width="100%">
            <thead>
                <tr>
                    <th width="5%" style="text-align:center; ">No.</th>
                    <th width="55%">Nama</th>
                    <th width="40%">Jabatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center;">1</td>
                    <td><?= $get_data_hasil_penetapan_komite_teknis[0]['nama_komite'];?></td>
                    <td style="text-align:center;">Ketua Komite Skema</td>
                </tr>
                <tr>
                    <td style="text-align:center;">2</td>
                    <td>Dr. Rudy Febrijanto, S.T., M.T.</td>
                    <td style="text-align:center;">Anggota Komite Skema</td>
                </tr>
                <tr>
                    <td style="text-align:center;">3</td>
                    <td>Nur Fajri Arifiani, S.T., M.T., M.Eng</td>
                    <td style="text-align:center;">Anggota Komite Skema</td>
                </tr>
            </tbody>
        </table>
            
        <p style="text-align:justify;">Adapun hasil dari sidang pleno adalah kepada peserta Uji Kompetensi berikut :
        </p>
 
        <table width="100%">
            <thead>
                <tr>
                    <th width="5%" style="text-align:center; ">No.</th>
                    <th width="30%">Nama</th>
                    <th width="10%">Jenjang</th>
                    <th width="20%">NIK</th>
                    <th width="35%">Keterangan (K/BK)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach($get_data_hasil_penetapan_komite_teknis as $data){
                ?>
                <tr>
                    <td style="text-align:center;"><?= $no++?></td>
                    <td style="text-align:center;"><?=$data['nama'];?></td>
                    <td style="text-align:center;"><?=$data['jenjang'];?></td>
                    <td style="text-align:center;"><?=$data['nik'];?></td>
                    <td style="text-align:center;">
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
            </tbody>
        </table><br/>

        <p style="text-align:justify;">
            Demikian berita acara ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.<br/>
        </p><br/>

        <p style="text-align:center;">
            <?= $hari;?>, <?= Tanggal_indo_full(date("Y-m-d",strtotime($get_data_hasil_penetapan_komite_teknis[0]['tanggal_penetapan'])))?><br/>
            Ketua Komite Pengambil Keputusan<br/>
            (Komite Teknis)<br/>

             <!-- TTD Komite -->
            <?php
                $path = base_url('assets/lsp/ttd_komite/').$get_data_hasil_penetapan_komite_teknis[0]['file_ttd'];
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
            <img src="<?=$base64 ;?>" width="100px" height="100px" style="margin:0;"><br/>
            <!-- /TTD Komite -->
            (<?= $get_data_hasil_penetapan_komite_teknis['0']['nama_komite']?>)
        </p>


    </div>

</body>
</html>