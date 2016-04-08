<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class AdminModel extends CI_Model {
	/* All admin (Just for admin panel) for login */
	function getAdminData($param) {
		$adminData = $this->db->query("SELECT * FROM admin WHERE admin.nrp = '$param'")->row();
		return $adminData;
	}

	/* Add new admin (Just for admin panel) */
	function addAdmin() {

	}

	/* Edit admin data (Individual) */
	function editAdmin($param, $nrp) {
		$this->db->query("UPDATE admin SET admin.password = '$param' WHERE admin.nrp = '$nrp'");
	}

	/* Log */
	function logAdmin($param, $nrp) {
		$this->db->query("UPDATE admin SET admin.lastlogin = '$param' WHERE admin.nrp = '$nrp'");
	}
}


/* End of file adminModel.php */
/* Location: ./application/models/adminModel.php */