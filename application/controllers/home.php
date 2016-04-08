<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	/* Main home */
	public function index()	{
		if ( $this->session->userdata('logged_in') != TRUE ) {
			
			/* authenticate */
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
				
			$nrp = $this->input->post('username');
			$pwd = $this->input->post('password');

			if ( $nrp != "" ) {
				$this->load->model('AdminModel','',TRUE);
				
				if ( $this->AdminModel->getAdminData($nrp) == null ) {
					redirect('/');

				} elseif ( $this->AdminModel->getAdminData($nrp)->password == md5(sha1($pwd))
							&& $this->AdminModel->getAdminData($nrp)->status == 1 ) {
					$login_user = $_POST['username'];
					$user_data = array('nrp' => $login_user, 'logged_in' => TRUE);
					$this->session->set_userdata($user_data);

					$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
					$data["status"] = 1;

					/* log (last login) */
					$this->load->model('AdminModel','',TRUE);
					$nrp = $this->session->userdata('nrp');
					$this->AdminModel->logAdmin(date('Y-m-d H:i:s'), $nrp);

				} else {
					$data["status"] = 0;
				}

			} else {
				$data["status"] = 0;
			}

		} else {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
		}

		$this->load->view('header', $data);

		$this->load->model('HomeModel','',TRUE);

		$this->form_validation->set_rules('byos', 'Sistem Operasi', 'trim|required|xss_clean');
		$os = $this->input->post('byos');

		$data2['all'] = '';
		$data2['nxsp'] = '';
		$data2['s40'] = '';
		$data2['s60'] = '';
		$data2['wp7'] = '';
		$data2['wp8'] = '';

		if ( $os == '' ) {
			$data2['all'] = 'selected';
		} elseif ( $os == 'NXSP' ) {
			$data2['nxsp'] = 'selected';
		} elseif ( $os == 'S40' ) {
			$data2['s40'] = 'selected';
		} elseif ( $os == 'S60' ) {
			$data2['s60'] = 'selected';
		} elseif ( $os == 'WP 7' ) {
			$data2['wp7'] = 'selected';
		} elseif ( $os == 'WP 8' ) {
			$data2['wp8'] = 'selected';
		} else {
			$data2['all'] = 'selected';
			$os = '';
		}
		
		$data2["list"] = $this->HomeModel->getAllDevice($os);
		$this->load->view('home', $data2);
	}

	/* Admin login action */
	public function admin($param = null) {
		if ($param == null) {
			show_404();
			//redirect('/');
		} else {
			/* login */
			if ($param == 'login') {
				if ( $this->session->userdata('logged_in') == TRUE ) {
					show_404();
					//redirect('/');
				}
				$data["status"] = 0;
				$this->load->view('header', $data);
				$this->load->view('admin');
			}
			/* edit */
			elseif ($param == 'edit') {
				if ( $this->session->userdata('logged_in') == TRUE ) {
					$nrp = $this->session->userdata('nrp');
					$this->load->model('AdminModel','',TRUE);
					$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
					$data["status"] = 1;
					$this->load->view('header', $data);
					$templeft = 0;
					$data2['ehem'] = 0;
					$data2['oldpassword01'] = "";
					$data2['oldpassword02'] = "";
					$data2['newpassword01'] = "";
					$data2['newpassword02'] = "";
					$data2['confpassword01'] = "";
					$data2['confpassword02'] = "";

					$oldpwd = $this->input->post('oldpassword');
					$newpwd = $this->input->post('newpassword');
					$confpwd = $this->input->post('confpassword');

					$this->form_validation->set_rules('oldpassword', 'Password Lama', 'trim|required|min_length[5]|xss_clean');
					$this->form_validation->set_rules('newpassword', 'Password Baru', 'trim|required|min_length[5]|xss_clean');
					$this->form_validation->set_rules('confpassword', 'Konfirmasi Password Baru', 'trim|required|matches[newpassword]|min_length[5]|xss_clean');

					$data2["old"] = "";

					if ($this->form_validation->run() == FALSE)  {
						if ( form_error('oldpassword') == "" ) {
							$data2['oldpassword01'] = "has-success";
							$data2['oldpassword02'] = "glyphicon-ok";
							$templeft++;
						} else {
							$data2['oldpassword01'] = "has-error";
							$data2['oldpassword02'] = "glyphicon-remove";
						}
						if ( form_error('newpassword') == "" ) {
							$data2['newpassword01'] = "has-success";
							$data2['newpassword02'] = "glyphicon-ok";
							$templeft++;
						} else {
							$data2['newpassword01'] = "has-error";
							$data2['newpassword02'] = "glyphicon-remove";
						}
						if ( form_error('confpassword') == "" ) {
							$data2['confpassword01'] = "has-success";
							$data2['confpassword02'] = "glyphicon-ok";
							$templeft++;
						} else {
							$data2['confpassword01'] = "has-error";
							$data2['confpassword02'] = "glyphicon-remove";
						}

						if ($templeft == 3) {
							$data2['oldpassword01'] = "";
							$data2['oldpassword02'] = "";
							$data2['newpassword01'] = "";
							$data2['newpassword02'] = "";
							$data2['confpassword01'] = "";
							$data2['confpassword02'] = "";
						}
						$data2["old"] .= form_error('oldpassword');

					} elseif ( $oldpwd == $newpwd ) {
						$data2['oldpassword01'] = "has-error";
						$data2['oldpassword02'] = "glyphicon-remove";
						$data2['newpassword01'] = "has-error";
						$data2['newpassword02'] = "glyphicon-remove";
						$data2['confpassword01'] = "has-error";
						$data2['confpassword02'] = "glyphicon-remove";
						$data2["old"] .= "Your old Password and new Password are same";

					} else {
						if ( $this->AdminModel->getAdminData($nrp)->password == md5(sha1($oldpwd)) ) {
							$this->AdminModel->editAdmin(md5(sha1($newpwd)), $nrp);
							$data2['oldpassword01'] = "has-success";
							$data2['oldpassword02'] = "glyphicon-ok";
							$data2['newpassword01'] = "has-success";
							$data2['newpassword02'] = "glyphicon-ok";
							$data2['confpassword01'] = "has-success";
							$data2['confpassword02'] = "glyphicon-ok";

							$data2['ehem'] = 1;

						} else {
							$data2['oldpassword01'] = "has-error";
							$data2['oldpassword02'] = "glyphicon-remove";
							$data2['newpassword01'] = "has-error";
							$data2['newpassword02'] = "glyphicon-remove";
							$data2['confpassword01'] = "has-error";
							$data2['confpassword02'] = "glyphicon-remove";
							$data2["old"] .= "Your old Password isn't match";
						}
					}
					$this->load->view('ubah', $data2);

				} else {
					show_404();
					//redirect('/');
				}
			}
			/* logout */
			elseif ($param == 'logout') {
				if ( $this->session->userdata('logged_in') == TRUE ) {
					$this->session->unset_userdata('nrp');
					$this->session->unset_userdata('logged_in');
					$this->session->sess_destroy();

					redirect('/home'); /* /admin/login (13/2/2015 23:14) */
				} else {
					show_404();
					//redirect('/');
				}
			}
			/* add */
			elseif ($param == 'tambah') {
				if ( $this->session->userdata('logged_in') == TRUE ) {
					$nrp = $this->session->userdata('nrp');
					$this->load->model('AdminModel','',TRUE);
					$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
					$data["status"] = 1;
					$this->load->view('header', $data);

					/* ... */
					$this->load->view('maintenance');

				} else {
					show_404();
					//redirect('/');
				}
			} else {
				show_404();
				//redirect('/');
			}
		}
	}

	/* Show device detail */
	public function device($param = null) {
		if ($param == null) {
			show_404();
			//redirect('/');

		} else {
			if ( $this->session->userdata('logged_in') != TRUE ) {
				$data["status"] = 0;

			} else {
				$nrp = $this->session->userdata('nrp');
				$this->load->model('AdminModel','',TRUE);
				$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
				$data["status"] = 1;
			}

			$this->load->view('header', $data);

			$this->load->model('HomeModel','',TRUE);
			$data2["availible"] = "";
			$data2["detail"] = $this->HomeModel->getDeviceData($param);

			if ($data2["detail"]->availible != 1 || $data2["detail"] == null) {
				$data2["availible"] = 'disabled';
				
				//show_404();
				if ( $data["status"] == 1 ) {
					redirect('home/reserved');
				} else {
					show_404();
				}
			}
			/* admin */
			//elseif ($data["status"] == 1) {
			//	$data2["availible"] = 'disabled';
			//}
			$this->load->view('device', $data2);
		}
	}

	/* Pinjam button action */
	public function pinjam($param = null) {
		if ($param == null) {
			show_404();
			//redirect('/');

		} else {
			if ( $this->session->userdata('logged_in') != TRUE ) {
				$data["status"] = 0;
				$data2['nrpvalue'] = '';
				$data2['namevalue'] = '';
				$data2['keperluanvalue'] = '';

			} else {
				
				$nrp = $this->session->userdata('nrp');
				$this->load->model('AdminModel','',TRUE);
				$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
				$data["status"] = 1;
				$data2['nrpvalue'] = $nrp;
				$data2['namevalue'] = $data["name"];
				$data2['keperluanvalue'] = 'Admin';
				
				/* admin */
				//show_404();
				//redirect('/');
			}

			$this->load->view('header', $data);

			$this->load->model('HomeModel','',TRUE);
			$data2["detail"] = $this->HomeModel->getDeviceData($param);
			if ($data2["detail"]->availible != 1 || $data2["detail"] == null) {
				$data2["availible"] = 'disabled';
				
				//show_404();
				if ( $data["status"] == 1 ) {
					redirect('home/reserved');
				} else {
					show_404();
				}
			}
			$templeft = 0;
			$data2['ehem'] = 0;
			$data2['nrp01'] = "";
			$data2['nrp02'] = "";
			$data2['fullname01'] = "";
			$data2['fullname02'] = "";
			$data2['telpon01'] = "";
			$data2['telpon02'] = "";
			$data2['email01'] = "";
			$data2['email02'] = "";
			$data2['keperluan01'] = "";
			$data2['keperluan02'] = "";

			/* form peminjaman */
			$this->form_validation->set_rules('nrp', 'NRP', 'trim|required|min_length[10]|max_length[10]|xss_clean');
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('telpon', 'No. HP', 'trim|required|min_length[10]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE) {
				if ( form_error('nrp') == "" ) {
					$data2['nrp01'] = "has-success";
					$data2['nrp02'] = "glyphicon-ok";
					$templeft++;
				} else {
					$data2['nrp01'] = "has-error";
					$data2['nrp02'] = "glyphicon-remove";
					
				}
				if ( form_error('fullname') == "" ) {
					$data2['fullname01'] = "has-success";
					$data2['fullname02'] = "glyphicon-ok";
					$templeft++;
				} else {
					$data2['fullname01'] = "has-error";
					$data2['fullname02'] = "glyphicon-remove";
					
				}
				if ( form_error('telpon') == "" ) {
					$data2['telpon01'] = "has-success";
					$data2['telpon02'] = "glyphicon-ok";
					$templeft++;
				} else {
					$data2['telpon01'] = "has-error";
					$data2['telpon02'] = "glyphicon-remove";
				}
				if ( form_error('email') == "" ) {
					$data2['email01'] = "has-success";
					$data2['email02'] = "glyphicon-ok";
					$templeft++;
				} else {
					$data2['email01'] = "has-error";
					$data2['email02'] = "glyphicon-remove";
				}
				if ( form_error('keperluan') == "" ) {
					$data2['keperluan01'] = "has-success";
					$data2['keperluan02'] = "glyphicon-ok";
					$templeft++;
				} else {
					$data2['keperluan01'] = "has-error";
					$data2['keperluan02'] = "glyphicon-remove";
					
				}

				if ($templeft == 5) {
					$data2['nrp01'] = "";
					$data2['nrp02'] = "";
					$data2['fullname01'] = "";
					$data2['fullname02'] = "";
					$data2['telpon01'] = "";
					$data2['telpon02'] = "";
					$data2['email01'] = "";
					$data2['email02'] = "";
					$data2['keperluan01'] = "";
					$data2['keperluan02'] = "";
				} else {

					$data2['nrpvalue'] = set_value('nrp');
					$data2['namevalue'] = set_value('fullname');
					$data2['keperluanvalue'] = set_value('keperluan');
				}

				/* 2 */ //$this->load->view('pinjam', $data2);

			} else {
				$data2['nrpvalue'] = set_value('nrp');
				$data2['namevalue'] = set_value('fullname');
				$data2['keperluanvalue'] = set_value('keperluan');

				$nrp = $this->input->post('nrp');
				$fullname = $this->input->post('fullname');
				$telpon = $this->input->post('telpon');
				$email = $this->input->post('email');
				$keperluan = $this->input->post('keperluan');
				//$datestring = "%Y-%m-%d %h:%i:%s";
				//$time = time();
				//$now = '\''.mdate($datestring, $time).'\'';

				$data3 = array (
									'nrp' => $nrp,
									'fullname' => $fullname,
									'telpon' => $telpon,
									'email' => $email
								);

				$this->load->model('PinjamModel','',TRUE);
				if ($this->PinjamModel->checkPeminjam($nrp) == null)
				{
					$this->PinjamModel->addPeminjam($data3);
				} else {
					$this->PinjamModel->updatePeminjam($data3);
				}

				$data4 = array (
									'peminjamId' => $nrp,
									'deviceId' => $param,
									'statusPeminjaman' => 0,
									'tanggalRequest' => date('Y-m-d H:i:s'),
									'catatan' => $keperluan
								);

				$this->PinjamModel->request($data4);

				/* keterangan (device) */
				/*
				if ( $data["status"] == 1 ) {
					$data5 = array (
										'keterangan' => 'Admin, '.$fullname
									);

					$this->HomeModel->editDevice($data5, $param);
				}
				*/
				/*
				else {
					$data5 = array (
										'keterangan' => 'Non admin, '.$fullname
									);

					$this->HomeModel->editDevice($data5, $param);
				}
				*/

				$this->load->model('HomeModel','',TRUE);
				$this->HomeModel->editDeviceStatus($param, 2);

				$data2['ehem'] = 1;
				$data2['nrp01'] = "has-success";
				$data2['nrp02'] = "glyphicon-ok";
				$data2['fullname01'] = "has-success";
				$data2['fullname02'] = "glyphicon-ok";
				$data2['telpon01'] = "has-success";
				$data2['telpon02'] = "glyphicon-ok";
				$data2['email01'] = "has-success";
				$data2['email02'] = "glyphicon-ok";
				$data2['keperluan01'] = "has-success";
				$data2['keperluan02'] = "glyphicon-ok";

				/* 2 */ //$this->load->view('notif');
				/* 1 */ //redirect('/home/device/'.$param);
			}
			
			$this->load->view('pinjam', $data2);
			
		}
	}

	/* Approve/Reject/Return device status (Admin only) */
	public function peminjaman($page = null) {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);

			/* Paginaton for efficient */
			$this->load->library('pagination');
			$config['base_url'] = 'http://'.$_SERVER["HTTP_HOST"].'/MicrosoftMobilityLabITS/home/peminjaman';
			$this->load->model('PinjamModel','',TRUE);
			$foo = $this->PinjamModel->getTotalRequest();
			
			$config['total_rows'] = $foo->total;
			if ($page == null) $page = 0;
			$offset = $config['per_page'] = 8;
			
			$this->pagination->initialize($config);

			$data2['peminjaman'] = $this->PinjamModel->getAllRequest($page, $offset);
			$data2['hoho'] = $this->pagination->create_links();

			$this->load->view('peminjaman', $data2);

		} else {
			show_404();
			//redirect('/');
		}
	}

	public function aksiPeminjaman($param = null, $deviceId = null, $peminjamanId = null) {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);

			$this->load->model('PinjamModel','',TRUE);
			$this->load->model('HomeModel','',TRUE);

			if ($param == 'accept') {
				$this->PinjamModel->change($peminjamanId, 1, $nrp);
				$this->HomeModel->editDeviceStatus($deviceId, 3);
				redirect('/home/peminjaman');
			} elseif ($param == 'reject') {
				$this->PinjamModel->change($peminjamanId, 2, $nrp);
				$this->HomeModel->editDeviceStatus($deviceId, 1);
				redirect('/home/peminjaman');
			} elseif ($param == 'return') {
				$this->PinjamModel->change($peminjamanId, 3, $nrp);
				$this->HomeModel->editDeviceStatus($deviceId, 1);
				redirect('/home/peminjaman');
			} elseif ($param == 'peminjam') {
				$data2['peminjam'] = $this->PinjamModel->getPeminjamData($peminjamanId);
				$this->load->view('peminjam', $data2);
			}

		} else {
			show_404();
			//redirect('/');
		}
	}

	/* add device (Admin only) */
	public function adminDevice($param = null, $param2 = null) {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);

			/* list */
			if ($param == 'list') {
				$this->load->model('HomeModel','',TRUE);
				$data2["list"] = $this->HomeModel->getListDevice();
				$this->load->view('adminDevice', $data2);

			}
			/* add */
			elseif ($param == 'tambah') {
				$templeft = 0;
				$data2['deviceId01'] = "";
				$data2['deviceId02'] = "";
				$data2['model01'] = "";
				$data2['model02'] = "";
				$data2['os01'] = "";
				$data2['os02'] = "";
				$data2['color01'] = "";
				$data2['color02'] = "";
				$data2['imei101'] = "";
				$data2['imei102'] = "";
				$data2['imei201'] = "";
				$data2['imei202'] = "";
				$data2['keterangan01'] = "";
				$data2['keterangan02'] = "";

				$this->load->model('HomeModel','',TRUE);
				$data2['modelpil'] = $this->HomeModel->getDeviceModel();
				$data2['ospil'] = $this->HomeModel->getDeviceOs();
				$data2['warnapil'] = $this->HomeModel->getDeviceColor();

				/* form peminjaman */
				$this->form_validation->set_rules('deviceId', 'No urut device', 'trim|required|is_unique[device.deviceId]|xss_clean');
				$this->form_validation->set_rules('model', 'Model / tipe HP', 'trim|required|xss_clean');
				$this->form_validation->set_rules('os', 'Sistem Operasi', 'trim|required|xss_clean');
				$this->form_validation->set_rules('color', 'Warna', 'trim|required|xss_clean');
				$this->form_validation->set_rules('imei1', 'Imei 1', 'trim|required|min_length[15]|max_length[15]|is_unique[device.imei1]|is_unique[device.imei2]|xss_clean');
				$this->form_validation->set_rules('imei2', 'Imei 2', 'trim|min_length[15]|max_length[15]|is_unique[device.imei1]|is_unique[device.imei2]|xss_clean');
				$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) {
					if ( form_error('deviceId') == "" ) {
						$data2['deviceId01'] = "has-success";
						$data2['deviceId02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['deviceId01'] = "has-error";
						$data2['deviceId02'] = "glyphicon-remove";
					}
					if ( form_error('model') == "" ) {
						$data2['model01'] = "has-success";
						$data2['model02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['model01'] = "has-error";
						$data2['model02'] = "glyphicon-remove";
					}
					if ( form_error('os') == "" ) {
						$data2['os01'] = "has-success";
						$data2['os02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['os01'] = "has-error";
						$data2['os02'] = "glyphicon-remove";
					}
					if ( form_error('color') == "" ) {
						$data2['color01'] = "has-success";
						$data2['color02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['color01'] = "has-error";
						$data2['color02'] = "glyphicon-remove";
					}
					if ( form_error('imei1') == "" ) {
						$data2['imei101'] = "has-success";
						$data2['imei102'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['imei101'] = "has-error";
						$data2['imei102'] = "glyphicon-remove";
					}
					if ( form_error('imei2') == "" ) {
						$data2['imei201'] = "has-success";
						$data2['imei202'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['imei201'] = "has-error";
						$data2['imei202'] = "glyphicon-remove";
					}
					if ( form_error('keterangan') == "" ) {
						$data2['keterangan01'] = "has-success";
						$data2['keterangan02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['keterangan01'] = "has-error";
						$data2['keterangan02'] = "glyphicon-remove";
					}

					if ($templeft == 7) {
						$data2['deviceId01'] = "";
						$data2['deviceId02'] = "";
						$data2['model01'] = "";
						$data2['model02'] = "";
						$data2['os01'] = "";
						$data2['os02'] = "";
						$data2['color01'] = "";
						$data2['color02'] = "";
						$data2['imei101'] = "";
						$data2['imei102'] = "";
						$data2['imei201'] = "";
						$data2['imei202'] = "";
						$data2['keterangan01'] = "";
						$data2['keterangan02'] = "";
					}
					$this->load->view('tambahDevice', $data2);

				} else {
					$deviceId = $this->input->post('deviceId');
					$model = $this->input->post('model');
					$os = $this->input->post('os');
					$warna = $this->input->post('color');
					$imei1 = $this->input->post('imei1');
					$imei2 = $this->input->post('imei2');
					$keterangan = $this->input->post('keterangan');
					if ( $imei2 == '' ) {
						$imei2 = null;
					}
					if ( $keterangan == '' ) {
						$keterangan = null;
					}
					//$datestring = "%Y-%m-%d %h:%i:%s";
					//$time = time();
					//$now = '\''.mdate($datestring, $time).'\'';

					$data3 = array (
										'deviceId' => $deviceId,
										'model' => $model,
										'os' => $os,
										'warna' => $warna,
										'imei1' => $imei1,
										'imei2' => $imei2,
										'keterangan' => $keterangan
									);

					//$this->load->model('HomeModel','',TRUE);

					if ( $this->HomeModel->getDeviceByModel($model) != null ) {
						$this->HomeModel->addDevice($data3);
						redirect('/home/adminDevice/list');
					} else {
						$this->HomeModel->addDevice($data3);
						$this->load->view('uploadDevice', $data3);
					}

					/*
					echo '<br><br><br>';
					echo $this->HomeModel->getDeviceByModel($model)->model;
					echo $model;
					*/
				}
			}
			/* edit */
			elseif ($param == 'edit') {
				if ($param2 == null) {
					show_404();
					//redirect('/');
				}

				$templeft = 0;
				$data2['ehem'] = 0;
				$this->load->model('HomeModel','',TRUE);

				$data2['deviceIdpil'] = $this->HomeModel->getDeviceData($param2)->deviceId;
				$data2['modelpil'] = $this->HomeModel->getDeviceData($param2)->model;
				$data2['ospil'] = $this->HomeModel->getDeviceData($param2)->os;
				$data2['warnapil'] = $this->HomeModel->getDeviceData($param2)->warna;
				$data2['imei1pil'] = $this->HomeModel->getDeviceData($param2)->imei1;
				$data2['imei2pil'] = $this->HomeModel->getDeviceData($param2)->imei2;
				$data2['keteranganpil'] = $this->HomeModel->getDeviceData($param2)->keterangan;

				/* form peminjaman */
				$this->form_validation->set_rules('deviceId', 'No urut device', 'trim|required|xss_clean');
				$this->form_validation->set_rules('model', 'Model / tipe HP', 'trim|required|xss_clean');
				$this->form_validation->set_rules('os', 'Sistem Operasi', 'trim|required|xss_clean');
				$this->form_validation->set_rules('color', 'Warna', 'trim|required|xss_clean');
				$this->form_validation->set_rules('imei1', 'Imei 1', 'trim|required|min_length[15]|max_length[15]|xss_clean');
				$this->form_validation->set_rules('imei2', 'Imei 2', 'trim|min_length[15]|max_length[15]|xss_clean');
				$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) {
					if ( form_error('deviceId') == "" ) {
						$data2['deviceId01'] = "has-success";
						$data2['deviceId02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['deviceId01'] = "has-error";
						$data2['deviceId02'] = "glyphicon-remove";
					}
					if ( form_error('model') == "" ) {
						$data2['model01'] = "has-success";
						$data2['model02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['model01'] = "has-error";
						$data2['model02'] = "glyphicon-remove";
					}
					if ( form_error('os') == "" ) {
						$data2['os01'] = "has-success";
						$data2['os02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['os01'] = "has-error";
						$data2['os02'] = "glyphicon-remove";
					}
					if ( form_error('color') == "" ) {
						$data2['color01'] = "has-success";
						$data2['color02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['color01'] = "has-error";
						$data2['color02'] = "glyphicon-remove";
					}
					if ( form_error('imei1') == "" ) {
						$data2['imei101'] = "has-success";
						$data2['imei102'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['imei101'] = "has-error";
						$data2['imei102'] = "glyphicon-remove";
					}
					if ( form_error('imei2') == "" ) {
						$data2['imei201'] = "has-success";
						$data2['imei202'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['imei201'] = "has-error";
						$data2['imei202'] = "glyphicon-remove";
					}
					if ( form_error('keterangan') == "" ) {
						$data2['keterangan01'] = "has-success";
						$data2['keterangan02'] = "glyphicon-ok";
						$templeft++;
					} else {
						$data2['keterangan01'] = "has-error";
						$data2['keterangan02'] = "glyphicon-remove";
					}

					if ($templeft != 7) {
						$data2['deviceIdpil'] = set_value('deviceId');
						$data2['modelpil'] = set_value('model');
						$data2['ospil'] = set_value('os');
						$data2['warnapil'] = set_value('color');
						$data2['imei1pil'] = set_value('imei1');
						$data2['imei2pil'] = set_value('imei2');
						$data2['keteranganpil'] = set_value('keterangan');
					}
					$data2['ehem'] = 0;

				} else {
					$data2['deviceIdpil'] = set_value('deviceId');
					$data2['modelpil'] = set_value('model');
					$data2['ospil'] = set_value('os');
					$data2['warnapil'] = set_value('color');
					$data2['imei1pil'] = set_value('imei1');
					$data2['imei2pil'] = set_value('imei2');
					$data2['keteranganpil'] = set_value('keterangan');

					$deviceId = $this->input->post('deviceId');
					$model = $this->input->post('model');
					$os = $this->input->post('os');
					$warna = $this->input->post('color');
					$imei1 = $this->input->post('imei1');
					$imei2 = $this->input->post('imei2');
					$keterangan = $this->input->post('keterangan');
					if ( $imei2 == '' ) {
						$imei2 = null;
					}
					if ( $keterangan == '' ) {
						$keterangan = null;
					}

					$data3 = array (
										'os' => $os,
										'keterangan' => $keterangan
									);

					$this->HomeModel->editDevice($data3, $deviceId);
					$data2['ehem'] = 1;

					$data2['deviceId01'] = "has-success";
					$data2['deviceId02'] = "glyphicon-ok";
					$data2['model01'] = "has-success";
					$data2['model02'] = "glyphicon-ok";
					$data2['os01'] = "has-success";
					$data2['os02'] = "glyphicon-ok";
					$data2['color01'] = "has-success";
					$data2['color02'] = "glyphicon-ok";
					$data2['imei101'] = "has-success";
					$data2['imei102'] = "glyphicon-ok";
					$data2['imei201'] = "has-success";
					$data2['imei202'] = "glyphicon-ok";
					$data2['keterangan01'] = "has-success";
					$data2['keterangan02'] = "glyphicon-ok";
				}
				$this->load->view('ubahDevice', $data2);
			}
			/* upload photo */
			elseif ($param == 'upload') {
				/* image */
				$param2 = $_POST["name"];

				$config['upload_path'] = './image/';
				$config['allowed_types'] = 'jpg';
				$config['remove_spaces'] = FALSE;
				$config['file_name'] = $param2;

				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('userfile')) {

				} else {
					echo $this->upload->display_errors();
				}

				redirect('/home/adminDevice/list');
			}

		} else {
			show_404();
			//redirect('/');
		}
	}

	/* achive */
	public function archieve($page = null) {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);

			/* Paginaton for efficient */
			$this->load->library('pagination');
			$config['base_url'] = 'http://'.$_SERVER["HTTP_HOST"].'/MicrosoftMobilityLabITS/home/archieve';
			$this->load->model('PinjamModel','',TRUE);
			$foo = $this->PinjamModel->getTotal();
			
			$config['total_rows'] = $foo->total;
			if ($page == null) $page = 0;
			$offset = $config['per_page'] = 6;
			
			$this->pagination->initialize($config);

			$data2['peminjaman'] = $this->PinjamModel->getAllPeminjaman($page, $offset);
			$data2['hoho'] = $this->pagination->create_links();
			
			$this->load->view('arsip', $data2);

		} else {
			show_404();
			//redirect('/');
		}
	}

	/* information for Admin */
	public function information() {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);
			
			$this->load->view('informasi');

		} else {
			show_404();
			//redirect('/');
		}
	}
	
	/* information reserved device for Admin */
	public function reserved() {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);
			
			$this->load->view('notif');

		} else {
			show_404();
			//redirect('/');
		}
	}
	
	/* 11/4/2015 */
	public function development() {
		if ( $this->session->userdata('logged_in') == TRUE ) {
			$nrp = $this->session->userdata('nrp');
			$this->load->model('AdminModel','',TRUE);
			$data["name"] = $this->AdminModel->getAdminData($nrp)->fullname;
			$data["status"] = 1;
			$this->load->view('header', $data);
			
			$this->load->view('development');
			
		} else {
			show_404();
			//redirect('/');
		}
	}
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */