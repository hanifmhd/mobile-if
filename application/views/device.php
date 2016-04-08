<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
	<form role="form" class="my-form-challenge" action="#" method="post">
		<div class="form-group" style="margin-top: 8px">
			<img width=75% src="<?php echo base_url(); ?>image/<?=$detail->model?>.jpg"><br/>
			Device Type: <b><?= $detail->model ?></b><br/>
			Operating System: <b><?= $detail->os ?></b><br/>
			Color: <b><?= $detail->warna ?></b>
		</div>
		<div class="form-group">
			<a href="<?php echo base_url(); ?>home/pinjam/<?=$detail->deviceId;?>" class="btn btn-primary <?=$availible?>" type="submit">Pinjam</a>
			<!-- <button type="submit" class="btn btn-primary <?=$availible?>" name="submit">Pinjam</button> -->
		</div>
	</form>
</div>
