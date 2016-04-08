<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
	<form role="form" class="my-form-challenge" action="<?php echo base_url(); ?>home/pinjam/<?=$detail->deviceId;?>" method="post">
		<div class="form-group" style="margin-top: 8px">
			<img width=75% src="<?php echo base_url(); ?>image/<?=$detail->model?>.jpg"><br/>
			Device Type: <b><?= $detail->model ?></b><br/>
			Operating System: <b><?= $detail->os ?></b><br/>
			Color: <b><?= $detail->warna ?></b>
		</div>
		<div style="width: 90%; margin: auto">
		  <div class="form-group <?= $nrp01; ?> has-feedback">
		    <label for="nrp">NRP</label>
		    <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" value="<?= $nrpvalue; ?>">
		    <span class="glyphicon <?= $nrp02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('nrp'); ?></span>
		  </div>
		  <div class="form-group <?= $fullname01; ?> has-feedback">
		    <label for="fullname">Nama Lengkap</label>
		    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap" value="<?= $namevalue; ?>">
		    <span class="glyphicon <?= $fullname02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('fullname'); ?></span>
		  </div>
		  <div class="form-group <?= $telpon01; ?> has-feedback">
		    <label for="telpon">No. HP</label>
		    <input type="text" class="form-control" id="telpon" name="telpon" placeholder="+62" value="<?php echo set_value('telpon'); ?>">
		    <span class="glyphicon <?= $telpon02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('telpon'); ?></span>
		  </div>
		  <div class="form-group <?= $email01; ?> has-feedback">
		    <label for="email">Email</label>
		    <input type="text" class="form-control" id="email" name="email" placeholder="mahasiswa@its.ac.id" value="<?php echo set_value('email'); ?>">
		    <span class="glyphicon <?= $email02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('email'); ?></span>
		  </div>
		  <div class="form-group <?= $keperluan01; ?> has-feedback">
		    <label for="keperluan">Keperluan</label>
		    <textarea class="form-control" rows="3" id="keperluan" name="keperluan" placeholder="Keperluan? Lama peminjaman?"><?= $keperluanvalue; ?></textarea>
		    <span class="glyphicon <?= $keperluan02; ?> form-control-feedback"></span>
		    <span class="help-inline" style="color: red;"><?php echo form_error('keperluan'); ?></span>
		  </div>
		  </div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary confirm" title="Apakah data yang Anda masukkan sudah benar?" name="submit">Pinjam</button>
		</div>
	</form>
</div>

<?php if ( $ehem == 1 ) {
	echo '
		<script>
			window.alert("Terima Kasih telah men-request device Microsoft Mobility Lab ITS\nDimohon untuk segera mengambil device di Microsoft Mobility Lab ITS\n\nApabila dalam kurun waktu 3x24 jam setelah permintaan diajukan\ndevice tidak segera diambil, maka request Anda akan dibatalkan secara otomatis.");
			window.location.href = "'.base_url().'";
		</script>
	';
} ?>