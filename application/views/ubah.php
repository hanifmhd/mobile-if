<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
	<form role="form" class="my-form-challenge" action="<?php echo base_url(); ?>home/admin/edit" method="post">
		<div class="form-group" style="margin-top: 15px">
			<div class="row">
				<div style="width: 90%; margin: auto">
				  <div class="form-group <?= $oldpassword01; ?> has-feedback">
				    <label for="oldpassword">Password Lama</label>
				    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Password Lama" value="<?php echo set_value('oldpassword'); ?>">
				    <span class="glyphicon <?= $oldpassword02; ?> form-control-feedback"></span>
				    <span class="help-inline" style="color: red;"><?= $old; ?></span>
				  </div>
				  <div class="form-group <?= $newpassword01; ?> has-feedback">
				    <label for="newpassword">Password Baru</label>
				    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Password Baru" value="<?php echo set_value('newpassword'); ?>">
				    <span class="glyphicon <?= $newpassword02; ?> form-control-feedback"></span>
				    <span class="help-inline" style="color: red;"><?php echo form_error('newpassword'); ?></span>
				  </div>
				  <div class="form-group <?= $confpassword01; ?> has-feedback">
				    <label for="confpassword">Konfirmasi Password Baru</label>
				    <input type="password" class="form-control" id="confpassword" name="confpassword" placeholder="Konfirmasi Password Baru" value="<?php echo set_value('confpassword'); ?>">
				    <span class="glyphicon <?= $confpassword02; ?> form-control-feedback"></span>
				    <span class="help-inline" style="color: red;"><?php echo form_error('confpassword'); ?></span>
				  </div>
				  <button type="submit" class="btn btn-primary confirm" title="Apakah Anda yakin ingin merubah sandi Anda?" name="submit">Ubah</button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php if ( $ehem == 1 ) {
	echo '
		<script>
			window.alert("Sandi Anda telah berhasil diubah");
			window.location.href = "'.base_url().'";
		</script>
	';
} ?>