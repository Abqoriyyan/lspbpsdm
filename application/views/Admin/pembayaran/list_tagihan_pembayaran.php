<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tagihan Pembayaran</title>
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
        <h6 class="m-0 font-weight-bold text-light">List Tagihan Pembayaran</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID IZIN</th>
                        <th>Kualifikasi</th>
                        <th>Jabatan Kerja</th>
                        <th>Jenis Permohonan</th>
                        <th>Link Pembayaran</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID IZIN</th>
                        <th>Kualifikasi</th>
                        <th>Jabatan Kerja</th>
                        <th>Jenis Permohonan</th>
                        <th>Link Pembayaran</th>
                        <th>Action</th>
                        <th>Status</th>
                </tfoot>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($get_list_tagihan_pembayaran as $list_tagihan_pembayaran){
                    ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $list_tagihan_pembayaran['nama']?></td>
                            <td><?= $list_tagihan_pembayaran['id_izin']?></td>
                            <td><?= $list_tagihan_pembayaran['kualifikasi']?></td>
                            <td><?= $list_tagihan_pembayaran['jabatan_kerja']?></td>
                            <td><?= $list_tagihan_pembayaran['jenis_permohonan']?></td>
                            <td class="text-center"><a href="<?= base_url('pembayaran/checkout/').base64_encode($list_tagihan_pembayaran['id_izin']);?>" target="_blank" class="btn btn-info text-center text-light" style="font-size:10px;">Pembayaran</a></td>
                            <td>
                                <?php
                                    if($list_tagihan_pembayaran['kode_status'] == 12){
                                        if($list_tagihan_pembayaran['status_code'] == NULL){
                                            echo "<a href='".base_url('admin/kirim_invoice/').base64_encode($list_tagihan_pembayaran['id_izin'])."' class='btn btn-primary' style='font-size:12px;'>Kirim Invoice</a>";
                                        }
                                    // Konfirmasi Jenis Pembayaran Manual
                                    }elseif($list_tagihan_pembayaran['status_code'] == '201'){
                                        if(!empty($list_tagihan_pembayaran['bukti_pembayaran'])){
                                        //     echo "<a href='".base_url('uploads/file_permohonan/bukti_pembayaran_biaya_sertifikasi/').$list_tagihan_pembayaran['bukti_pembayaran']."' target='_blank' class='btn btn-primary' style='font-size:10px;'>Cek Bukti Pembayaran</a>";
                                    ?>
                                            <a href="<?=base_url('pembayaran/konfrimasi_pembayaran_manual/').base64_encode($list_tagihan_pembayaran['id_izin']);?>" target='_blank' class='btn btn-success' style='font-size:10px;' onclick="return confirm('Apakah sudah yakin bukti Pembayarannya sudah terbayarkan ?');" >Konfirmasi Pembayaran</a>
                                        <?php
                                    }
                                    }elseif($list_tagihan_pembayaran['status_code'] == '200'){
                                        if(!empty($list_tagihan_pembayaran['bukti_pembayaran'])){
                                            echo "<a href='".base_url('uploads/file_permohonan/bukti_pembayaran_biaya_sertifikasi/').$list_tagihan_pembayaran['bukti_pembayaran']."' target='_blank' class='btn btn-primary' style='font-size:10px;'>Cek Bukti Pembayaran</a>";
                                        }else{
                                            echo "Payment Gateway";
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(empty($list_tagihan_pembayaran['status_code'])){
                                        if($list_tagihan_pembayaran['kode_status'] == 12){
                                            echo "Kirimkan Invoice ke Pemohon";
                                        }else{
                                            echo 'Invoice telah Dikirimkan ke Pemohon';
                                        }
                                    }elseif($list_tagihan_pembayaran['status_code'] == 200){
                                        echo 'Biaya Telah Dibayarkan';
                                    }elseif($list_tagihan_pembayaran['status_code'] == 201){
                                        echo 'Pembayaran Pending - Proses Pembayaran oleh Pemohon';
                                    }elseif($list_tagihan_pembayaran['status_code'] == 202){
                                        echo 'Denied / Ditolak';
                                    }elseif($list_tagihan_pembayaran['status_code'] == 401){
                                        echo 'Failur / Melewati Batas Waktu Pembayaran';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>