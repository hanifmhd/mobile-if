<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
	<form role="form" class="my-form-challenge" action="<?php echo base_url(); ?>home/adminDevice/edit/<?= $deviceIdpil; ?>" method="post" ><!-- enctype="multipart/form-data" -->
		<div style="width: 90%; margin: auto; margin-top: 15px">
		  <!-- <input type="file" name="photo"> -->
		  <div class="form-group <?= $deviceId01; ?> has-feedback">
		    <label for="deviceId">#</label>
		    <input type="text" class="form-control" id="deviceId" name="deviceId" placeholder="No urut device" value="<?= $deviceIdpil; ?>" readonly>
		    <span class="glyphicon <?= $deviceId02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('deviceId'); ?></span>
		  </div>
		  <div class="form-group <?= $model01; ?> has-feedback">
		    <label for="model">Model</label>
		    <input type="text" class="form-control" id="model" name="model" placeholder="Model / tipe HP" value="<?= $modelpil; ?>" readonly>
		    <span class="glyphicon <?= $model02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('model'); ?></span>
		  </div>
		  <div class="form-group <?= $os01; ?> has-feedback">
		    <label for="os">OS</label>
		    <input type="text" class="form-control" id="os" name="os" placeholder="Sistem operasi" value="<?= $ospil; ?>">
		    <span class="glyphicon <?= $os02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('os'); ?></span>
		  </div>
		  <div class="form-group <?= $color01; ?> has-feedback">
		    <label for="color">Warna</label>
		    <input type="text" class="form-control" id="color" name="color" placeholder="Warna" value="<?= $warnapil; ?>" readonly>
		    <span class="glyphicon <?= $color02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('color'); ?></span>
		  </div>
		  <div class="form-group <?= $imei101; ?> has-feedback">
		    <label for="imei1">Imei 1</label>
		    <input type="text" class="form-control" id="imei1" name="imei1" placeholder="Imei 1" value="<?= $imei1pil; ?>" readonly>
		    <span class="glyphicon <?= $imei102; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('imei1'); ?></span>
		  </div>
		  <div class="form-group <?= $imei201; ?> has-feedback">
		    <label for="imei2">Imei 2</label>
		    <input type="text" class="form-control" id="imei2" name="imei2" placeholder="Imei 2 (If available)" value="<?= $imei2pil; ?>" readonly>
		    <span class="glyphicon <?= $imei202; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('imei2'); ?></span>
		  </div>
		  <div class="form-group <?= $keterangan01; ?> has-feedback">
		    <label for="keterangan">Keterangan</label>
		    <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Keterangan (If available)"><?= $keteranganpil; ?></textarea>
		    <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan (If available)" value="<?php echo set_value('keterangan'); ?>"> -->
		    <span class="glyphicon <?= $keterangan02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('keterangan'); ?></span>
		  </div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary confirm" title="Apakah data yang Anda masukkan sudah benar?" name="submit">Update</button>
		</div>
	</form>
</div>

<?php if ( $ehem == 1 ) {
	echo '
		<script>
			window.alert("Data'.$modelpil.' dengan no urut '.$deviceIdpil.' telah terupdate");
			window.location.href = "'.base_url().'home/adminDevice/list";
		</script>
	';
} ?>