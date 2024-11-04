<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">
	<link rel='shortcut icon' type='image/png' href='assets/lsp/logo-lsp.png'>
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="login-container">
<div class="page-container page-content content-wrapper">
	<?php echo form_open_multipart('Login','method="POST"');?>
	<div class="panel panel-body login-form">
		<div class="text-center">
			<img src="<?= base_url('assets/lsp/logo-lsp.png')?>" style="margin-top:10px; width:70px; height:70px;" alt="logo LSP" />
			<h4 class="content-group" style="color:#374774;">LSP BPSDM Kementerian PUPR<br/></h4>
		</div>
		<div class="form-group">
			<input type="text" name='username' class="form-control text-center" placeholder="Username" required>
			<div class="form-control-feedback">
				<i class="icon-user text-center"></i>
			</div>
		</div>
		<div class="form-group">
			<input type="password" name='password' class="form-control text-center" placeholder="Password" required>
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>
		<form action="" method="POST">
			<center><div class="g-recaptcha" data-sitekey="6LfXw2QqAAAAAK5RMpXnSbNfpWN0AB23-N6IwNk7"></div></center><br/>
		</form>
		<div class="form-group">
			<button style="background-color:#374774;" type="submit" class="btn btn-primary btn-block">Log In<i class="icon-circle-right2 text-center"></i></button>
		</div>
	</div>
	<?php echo form_close();?>
</div>

<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
</script>
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/sb-admin-2.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js');?>"></script>
<script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js');?>"></script>
<script src="<?php echo base_url('assets/js/demo/datatables-demo.js');?>"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
<style>
body{
	background: radial-gradient(ellipse at bottom, #374774 0%, #EAB360 100%);
}
form{
    height: 500px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
</style>
</body>
</html>