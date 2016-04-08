<div class="row">
<?php
	foreach($list->result() as $row) {
?>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<a href="<?php echo base_url()?>home/adminDevice/edit/<?=$row->deviceId?>" title="Edit"><img src="<?php echo base_url()?>image/edit.png" alt="Edit" width=27px height=27px style="float: right; margin-top: 8px; margin-right: -2px; z-index: 100; position: relative;"></a>
		<form role="form" class="my-form-challenge" action="#" method="post">
			<div class="row" style="margin-top: 0px; height: 180px"> <!-- 170 -->
				<div class="col-sm-6 col-xs-6">
					<img style="text-align: center; margin-top: 32px;" height="80px" src="<?php echo base_url(); ?>image/<?=$row->model?>.jpg"><br>
					<h4><?=$row->model?></h4>
				</div>
				<div class="col-sm-6 col-xs-6" style="text-align: left; margin-top: -14px; font-size: 9pt; margin-left: -14px">
					<p><i><?=$row->deviceId?></i> 
					<b><?php
						if ($row->availible == 0)
							echo '<i style="color: red">rusak / hilang';
						elseif ($row->availible == 1)
							echo '<i style="color: blue">tersedia';
						elseif ($row->availible == 2)
							echo '<i style="color: orange">proses permintaan';
						elseif ($row->availible == 3)
							echo '<i style="color: limegreen">dipinjam';
					?></i></b></p>
					<p>
					<?=$row->os?><br>
					<?php if ($row->warna != '-')
						echo $row->warna.'<br>';
					?>
					<?=$row->imei1?><br>
					<?php if ($row->imei2 != null) 
						echo $row->imei2.'<br>';
					?>
					
					<i style="color: purple"><?=$row->keterangan?></i></p>
				</div>
			</div>
		</form>
	</div>

<?php
	}
?>
</div>