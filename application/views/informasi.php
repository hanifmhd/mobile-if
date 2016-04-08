<div class="my-form-challenge" style="text-align: left">
	<div class="row">
		<div class="col-md-4">
			<h3>Lihat Device</h3>
			<p>
				<b>
				Device - status<br>
				0 <i style="color: red">rusak / hilang</i><br>
				1 <i style="color: blue">tersedia</i><br>
				2 <i style="color: orange">proses permintaan</i><br>
				3 <i style="color: limegreen">dipinjam</i><br>
				</b>
			</p>

			<h3>Lihat Peminjaman</h3>
			<p>
				<b>
				Peminjaman - status<br>
				0 <i style="color: orange">request</i> (Waiting to Approve or Reject)<br>
				1 <i style="color: limegreen">approve</i> (Waiting to Return)<br>
				2 <i style="color: red">reject</i> (Archieve)<br>
				3 <i style="color: blue">return</i> (Archieve)<br>
				</b>
			</p>

			<p>
				<b>
				Date Time
				</b>
				 : UTC + 7:00 (Asia/Jakarta)<br>
				<b>
				Now (Server Time)
				</b>
				 : <?php echo Date('Y-m-d H:i:s a')?><br>
			</p>
			</div>

			<div class="col-md-8">
			<h3>No Urut Device</h3>
			<p>
				<table class="table table-striped" style="font-family: 'calibri';">
					<thead>
						<tr><th>Kode</th><th>Tanggal Perolehan</th><th>OS</th><th>Event</th></tr>
					</thead>
					<tbody>
						<tr><td>0xx</td><td>2011</td><td>S60</td><td>NIC ITS Initial</td></tr>
						<tr><td>1xx</td><td>29 Agustus 2012</td><td>S40</td><td>Hadiah Kelas</td></tr>
						<tr><td>2xx</td><td>November 2012</td><td>Windows Phone 7.8</td><td>Pra-Lumia Apps Olympiad</td></tr>
						<tr><td>3xx</td><td>Agustus - Desember 2013</td><td>Windows Phone 8</td><td>Workshop / MGDW 5</td></tr>
						<tr><td>4xx</td><td>Maret - Mei 2014</td><td>Windows Phone 8, Android</td><td>Pra-DVLUP Olympiad 2014</td></tr>
						<tr><td>5xx</td><td>Juli 2014</td><td>S40</td><td>Hadiah DVLUP Olympiad 2014-1</td></tr>
						<tr><td>6xx</td><td>September 2014</td><td>Windows Phone 8/8.1, Android</td><td>Hadiah DVLUP Olympiad 2014-2</td></tr>
					</tbody>
				</table>
			</p>
		</div>
	</div>

	<footer class="modal-footer">
		&copy 2014 - <?php /* (13/2/2015 23:15) */ echo date('Y')?> Microsoft Mobility Lab ITS<br>
		Jl. Teknik Kimia Gedung A Teknik Informatika lt. 4, Kampus ITS Sukolilo - Surabaya<br>
		<i>Developed by</i> Djuned Fernando Djusdek 5112100071
	</footer>
</div>