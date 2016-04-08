<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<table class="table my-form-challenge" style="text-align: left"">
			<tr><td><label>Nama Lengkap</label></td><td><?=$peminjam->fullname;?></td></tr>
			<tr><td><label>NRP</label></td><td><?=$peminjam->nrp;?></td></tr>
			<tr><td><label>Email</label></td><td><a href="mailto:<?=$peminjam->email;?>"><?=$peminjam->email;?></a></td></tr>
			<tr><td><label>No. HP</label></td><td><?=$peminjam->telpon;?></td></tr>
		</table>
	</div>
</div>
