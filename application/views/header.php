<html>
<head>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo base_url(); ?>image/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.0.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
	<style type="text/css">
		.my-form-challenge { border-bottom: 2px solid #D4D4D4; /* 1.42857143px #428bca */
			border-radius: 6px;
			text-align: center;
			display: block;
			margin: -2 -10 12 -10;
			background: #FFF;
			padding: 10 10 0 10;
			font: "Segoe UI" bold;
		}
		#home-button {
			width: 96%;
		}
	</style>
	<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" type="text/css" />
	<script src="<?php echo base_url(); ?>js/jquery.easy-confirm-dialog.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".confirm").easyconfirm();
	});
	</script>
	<title> Microsoft Mobility Lab - ITS </title>
</head>

<body onunload="" style="background: #EDEDED">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <?php if ($status == 1) {
	      	echo'
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>';
	      } ?>
	      <a class="navbar-brand" href="<?php echo base_url(); ?>"><img height=46 src="<?php echo base_url(); ?>image/Microsoft.jpg"></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <?php if ($status == 0) {
	      	/*
	      	echo '
	      <form class="navbar-form navbar-right" method="post" role="form" action="'.base_url().'home">
	        <div class="form-group">
	          <input type="text" class="form-control" name="username" placeholder="Username">
	          <input type="password" class="form-control" name="password" placeholder="Password">
		    </div>
		  <button type="submit" class="btn btn-warning" name="submit">Masuk</button>
	      </form>';
			*/
	  	  } else {
	        echo'
	      <ul class="nav navbar-nav navbar-right">
	        <li  class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$name.'<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li><a href="'.base_url().'home/information">Informasi</a></li>
	            <li class="divider"></li>
	            <li><a href="'.base_url().'home/adminDevice/tambah">Tambah Device</a></li>
	            <li><a href="'.base_url().'home/admin/tambah">Tambah Admin</a></li>
	            <li class="divider"></li>
	            <li><a href="'.base_url().'home/adminDevice/list">Lihat Device</a></li>
	            <li><a href="'.base_url().'home/peminjaman">Lihat Peminjaman</a></li>
	            <li class="divider"></li>
	            <li><a href="'.base_url().'home/admin/edit">Ubah Password</a></li>
	            <li><a href="'.base_url().'home/admin/logout" class="confirm" title="Apakah Anda yakin ingin keluar?">Keluar</a></li>
				<!-- 11/4/2015 -->
				<li class="divider"></li>
				<li><a href="'.base_url().'home/development">Versi Pengembangan</a></li>
	          </ul>
	        </li>
	      </ul>';
	  	  } ?>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div class="container" style="margin-top: 65px">