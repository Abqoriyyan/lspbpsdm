<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Pemohon</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <br/><br/>
    <div class="col-sm-12">
        <h2 class="text-center">Tolak Permohonan Sertifikasi</h2>
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <form action="<?= base_url('Admin/insert_tolak_permohonan')?>" method="POST" class="text-center">
                    <input type="text" name="id_izin" placeholder="Input ID-Izin" class='form-control text-center text-dark'><br/>
                    <textarea name="catatan" class="form-control text-center text-dark" placeholder="Input Catatan Alasan Tolak Permohonan"></textarea><br/>
                    <input type="submit" value="Proses Tolak Permohonan" class="btn btn-primary">
                </form><br/>
            </div>
        </div>
    </div>
</body>

<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Tolak Permohonan Berhasil",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
</html>
