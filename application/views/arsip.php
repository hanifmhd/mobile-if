<div class=" my-form-challenge" style="text-align: left">
	<table class="table" cellspacing="0" cellpadding="0">
		<thead>
			<tr class="row">
				<th class="col-md-1"><span>#</span></th>
				<th class="col-md-3"><span>model / os</span></th>
				<th class="col-md-2"><span>NRP peminjam</span></th>
				<th class="col-md-1"><span>tanggal permintaan</span></th>
				<th class="col-md-1"><span>tanggal persetujuan</span></th>
				<th class="col-md-1"><span>tanggal penolakan</span></th>
				<th class="col-md-1"><span>tanggal pengembalian</span></th>
				<th class="col-md-3"><span>Admin</span></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($peminjaman->result() as $row) {
			if ($row->status == 2) {
				$color = 'red';
			} else {
				$color = 'blue';
			}
		?>
			<tr class="row">
				<td class="col-md-1"><?= $row->deviceId; ?></td>
				<td class="col-md-3" style="color: <?php echo $color?>"><?= $row->model; ?></a></td>
				<td class="col-md-2"><a href="<?php echo base_url();?>home/aksiPeminjaman/peminjam/<?=$row->deviceId?>/<?=$row->peminjaman?>" class="btn btn-default btn-xs" type="submit"><?= $row->peminjam; ?></a></td>
				<td class="col-md-1"><?= $row->tanggalRequest; ?></td>
				<td class="col-md-1"><?= $row->tanggalApprove; ?></td>
				<td class="col-md-1"><?= $row->tanggalReject; ?></td>
				<td class="col-md-1"><?= $row->tanggalReturn; ?></td>
				<td class="col-md-3"><?= $row->admin; ?></td>
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