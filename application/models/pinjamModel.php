<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class PinjamModel extends CI_Model {
	/*  Request [0] */
	function request($param) {
		$this->db->insert('peminjaman', $param);
	}

	/* List Request */
	function getAllRequest($page, $offset) {
		$request = $this->db->query("SELECT DISTINCT peminjaman.peminjamanId as peminjaman, device.deviceId as deviceId, CONCAT(device.model, ' / ', device.os) as model, peminjam.nrp as peminjam, peminjaman.tanggalRequest as tanggal, peminjaman.statusPeminjaman as status, peminjaman.catatan as catatan FROM peminjam, peminjaman, device WHERE peminjam.nrp = peminjaman.peminjamId AND peminjaman.deviceId = device.deviceId AND peminjaman.statusPeminjaman < 2 ORDER BY peminjaman.statusPeminjaman ASC, peminjaman.tanggalRequest ASC LIMIT $page, $offset");
		return $request;
	}

	/* Total List Request */
	function getTotalRequest() {
		$total = $this->db->query("SELECT COUNT(peminjaman.peminjamanId) as total FROM peminjaman WHERE peminjaman.statusPeminjaman < 2")->row();
		return $total;
	}

	/* Approve [1], Reject [2], Return [3] (if return before/after end date), also use for auto return */
	function change($param, $status, $nrp) {
		$now = date('Y-m-d H:i:s');
		if ($status == 1) {
			$this->db->query("UPDATE peminjaman SET peminjaman.statusPeminjaman = '$status', peminjaman.tanggalApprove = '$now', peminjaman.perubahanTerakhirOleh = '$nrp' WHERE peminjaman.peminjamanId = '$param'");
		} elseif ($status == 2) {
			$this->db->query("UPDATE peminjaman SET peminjaman.statusPeminjaman = '$status', peminjaman.tanggalReject = '$now', peminjaman.perubahanTerakhirOleh = '$nrp' WHERE peminjaman.peminjamanId = '$param'");
		} elseif ($status == 3) {
			$this->db->query("UPDATE peminjaman SET peminjaman.statusPeminjaman = '$status', peminjaman.tanggalReturn = '$now', peminjaman.perubahanTerakhirOleh = '$nrp' WHERE peminjaman.peminjamanId = '$param'");
		}
	}

	/* Data peminjam */
	function addPeminjam($param) {
		$this->db->insert('peminjam', $param);
	}

	/* cek peminjam */
	function checkPeminjam($param) {
		$peminjam = $this->db->query("SELECT * FROM peminjam WHERE peminjam.nrp = '$param'")->row();
		return $peminjam;
	}

	/* Update data peminjam */
	function updatePeminjam($param) {
		$telpon = $param['telpon'];
		$email =  $param['email'];
		$nrp =  $param['nrp'];
		$this->db->query("UPDATE peminjam SET peminjam.telpon = '$telpon' , peminjam.email = '$email' WHERE peminjam.nrp = '$nrp'");
	}

	/* Detail */
	function getPeminjamData($param) {
		$peminjamData = $this->db->query("SELECT peminjam.nrp as nrp, peminjam.fullname as fullname, peminjam.telpon as telpon, peminjam.email as email FROM peminjam, peminjaman WHERE peminjam.nrp = peminjaman.peminjamId AND peminjaman.peminjamanId = '$param'")->row();
		return $peminjamData;
	}

	/* Archieve peminjaman (Reject/Return or device available) */
	function getAllPeminjaman($page, $offset) {
		$peminjaman = $this->db->query("SELECT DISTINCT peminjaman.peminjamanId as urut, peminjaman.peminjamanId as peminjaman, device.deviceId as deviceId, CONCAT(device.model, ' / ', device.os) as model, peminjam.nrp as peminjam, peminjaman.tanggalRequest as tanggalRequest, peminjaman.tanggalApprove as tanggalApprove, peminjaman.tanggalReject as tanggalReject, peminjaman.tanggalReturn as tanggalReturn, admin.fullname as admin, peminjaman.statusPeminjaman as status FROM peminjam, peminjaman, device, admin WHERE peminjam.nrp = peminjaman.peminjamId AND peminjaman.deviceId = device.deviceId AND peminjaman.perubahanTerakhirOleh = admin.nrp AND peminjaman.statusPeminjaman > 1 ORDER BY peminjaman.peminjamanId DESC LIMIT $page, $offset");
		return $peminjaman;
	}

	/* Total archieve peminjaman (Reject/Return or device available) */
	function getTotal() {
		$total = $this->db->query("SELECT COUNT(peminjaman.peminjamanId) as total FROM peminjaman WHERE peminjaman.statusPeminjaman > 1")->row();
		return $total;
	}
}


/* End of file pinjamModel.php */
/* Location: ./application/models/pinjamModel.php */