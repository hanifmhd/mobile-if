<div class="my-form-challenge" style="text-align: left">
	<table class="table" cellspacing="0" cellpadding="0">
		<thead>
			<tr class="row">
				<th class="col-md-1"><span>#</span></th>
				<th class="col-md-3"><span>model / os</span></th>
				<th class="col-md-2"><span>NRP peminjam</span></th>
				<th class="col-md-2"><span>tanggal permintaan</span></th>
				<th class="col-md-2"><span>keperluan</span></th>
				<th class="col-md-2"><span><a href="<?php echo base_url();?>home/archieve" class="btn btn-default btn-xs" type="submit">Arsip (Semua)</a></span></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($peminjaman->result() as $row) {
			if ($row->status == 0) {
				$cek1 = 'disabled';
				$cek2 = '';
				$color = 'orange';
			} else {
				$cek1 = '';
				$cek2 = 'disabled';
				$color = 'limegreen';
			}
		?>
			<tr class="row">
				<td class="col-md-1"><?= $row->deviceId; ?></td>
				<td class="col-md-3" style="color: <?php echo $color?>"><?= $row->model; ?></td>
				<td class="col-md-2"><a href="<?php echo base_url();?>home/aksiPeminjaman/peminjam/<?=$row->deviceId?>/<?=$row->peminjaman?>" class="btn btn-default btn-xs" type="submit"><?= $row->peminjam; ?></a></td>
				<td class="col-md-2"><?= $row->tanggal; ?></td>
				<td class="col-md-2"><?= $row->catatan; ?></td>
				<td class="col-md-2">
					<div class="btn-group">
						<a href="<?php echo base_url();?>home/aksiPeminjaman/accept/<?=$row->deviceId?>/<?=$row->peminjaman?>" class="btn btn-primary btn-xs <?php echo $cek2; ?>" type="submit">Pinjami</a>
						<a href="<?php echo base_url();?>home/aksiPeminjaman/reject/<?=$row->deviceId?>/<?=$row->peminjaman?>" class="btn btn-danger btn-xs <?php echo $cek2; ?>" type="submit">Tolak</a>
						<a href="<?php echo base_url();?>home/aksiPeminjaman/return/<?=$row->deviceId?>/<?=$row->peminjaman?>" class="btn btn-success btn-xs <?php echo $cek1; ?>" type="submit">Kembali</a>
					</div>
				</td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>
<div style="text-align: center;">
	<?php echo (isset($hoho)) ? $hoho : ''; ?>
</div>
