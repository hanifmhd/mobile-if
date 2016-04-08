<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class HomeModel extends CI_Model {
	/*  Image and name only */
	function getAllDevice($param) {
		$device = $this->db->query("SELECT * FROM device WHERE device.availible = 1 AND device.os like '%$param%' GROUP BY CONCAT(device.model, device.os) ORDER BY device.model, device.os");
		return $device;
	}

	/* Detail */
	function getDeviceData($param) {
		$deviceDetail = $this->db->query("SELECT * FROM device where device.deviceId = '$param'")->row();
		return $deviceDetail;
	}

	/* Add (Admin only) */
	function addDevice($param) {
		$this->db->insert('device', $param);
	}

	/* Update / edit (Admin only) */
	function editDevice($param, $id) {
		$this->db->where('deviceId', $id);
		$this->db->update('device', $param); 
	}

	/* Add dropdown (model) */
	function getDeviceModel() {
		$deviceDetail = $this->db->query("SELECT DISTINCT device.model FROM device ORDER BY device.model");
		return $deviceDetail;
	}

	/* Add dropdown (os) */
	function getDeviceOs() {
		$deviceDetail = $this->db->query("SELECT DISTINCT device.os FROM device ORDER BY device.os");
		return $deviceDetail;
	}

	/* Add dropdown (color) */
	function getDeviceColor() {
		$deviceDetail = $this->db->query("SELECT DISTINCT device.warna FROM device ORDER BY device.warna");
		return $deviceDetail;
	}

	/* List (Admin only) */
	function getListDevice() {
		$device = $this->db->query("SELECT * FROM device ORDER BY device.model");
		return $device;
	}

	/* Update */
	function editDeviceStatus($param, $status) {
		$this->db->query("UPDATE device SET device.availible = '$status' WHERE device.deviceId = '$param'");
	}

	/* Detail using model param (for check image) */
	function getDeviceByModel($param) {
		$deviceDetail = $this->db->query("SELECT DISTINCT device.model FROM device where device.model = '$param'")->row();
		return $deviceDetail;
	}
}


/* End of file homeModel.php */
/* Location: ./application/models/homeModel.php */