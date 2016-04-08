<hr style="margin-top: 7px"/> <!-- class="my-form-challenge" style="margin-top: 7px; height: 0px" -->                  <!-- -32.25px -->                       <!--  margin-right: -10px -->
<form role="form form-inline" method="post" action="<?php echo base_url(); ?>" style="margin-top: -19px ; text-align: right; height: 18px;">
	<!-- <b>Sistem Operasi:</b> -->                                                                              <!--  text-align: center; padding-right: 5px; -->
	<select name="byos" class="btn btn-default btn-xs" onchange='this.form.submit()' style="border: 1 solid #2596CA; height: inherit; text-align: left; border-radius: 6px;"> <!--  border-bottom: 2px solid #D4D4D4; -->
		<option value="" <?=$all?>>Semua Sistem Operasi</option>
		<option value="NXSP" <?=$nxsp?>>Nokia X</option>
		<option value="S40" <?=$s40?>>Symbian S40</option>
		<option value="S60" <?=$s60?>>Symbian S60</option>
		<option value="WP 7" <?=$wp7?>>Windows Phone 7</option>
		<option value="WP 8" <?=$wp8?>>Windows Phone 8 / 8.1</option>
	</select>
	<noscript>
		<button type="submit" class="btn btn-primary btn-xs" style="height: inherit; width: 50px; border-radius: 6px">Submit</button>
		<!-- <input type="submit" value="Submit" style="border: 0; background: #FFF; height: inherit"> -->
	</noscript>
</form>

<div class="row">
<?php
	if ($list->result() != null) {
		foreach($list->result() as $row) {
?>

	<div class="col-md-3 col-sm-4 col-xs-6">
		<form role="form" class="my-form-challenge" action="<?php echo base_url(); ?>home/device/<?=$row->deviceId;?>" method="post">
			<div class="form-group" style="margin-top: 8px">
				<img width=75% src="<?php echo base_url(); ?>image/<?=$row->model?>.jpg">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="submit" id="home-button"><?=$row->model?> <br> <?=$row->os?></button>
			</div>
		</form>
	</div>

<?php
		}
	} else {
		echo '
		<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<form class="my-form-challenge" style="height: 130px">
				<h3> Maaf data tidak ditemukan </h3>
				<a href="'.base_url().'" class="btn btn-primary" type="submit">Beranda</a>
			</form>
		</div>
		';
	}
?>
</div>