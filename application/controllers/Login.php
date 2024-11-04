<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','system'));
	}

	public function index()
	{

        if ($this->ion_auth->ceklogin()){
			if($this->ion_auth->super_admin()){
            	redirect('super_admin');
			}elseif($this->ion_auth->login_admin()){
            	redirect('admin');
            }elseif($this->ion_auth->login_user()){
            	redirect('user');
            }elseif($this->ion_auth->login_asesor()){
				redirect('asesor');
            }elseif($this->ion_auth->login_komite()){
				redirect('komite');
            }elseif($this->ion_auth->login_tuk()){
				redirect('tuk');
			}elseif($this->ion_auth->login_audit()){
				redirect('audit');
			}else{
				redirect('login/keluar');
			}
        }
        
		if (isset($_POST) && !empty($_POST))
		{

			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$secret_key = "6LfXw2QqAAAAADsUN4qaVFuvWUQST99Pqs5JxriD";
			$verifikasi = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key .'&response=' .
			$_POST['g-recaptcha-response']);
			
			$response = json_decode($verifikasi);
	
			if($response->success){
				if ($this->User_model->login($username,$password))
				{
					$status = $this->User_model->select($username,$password);
						if($status[0]['status'] == 1){
							$sessionarray = array(
								'nik' => $status[0]['nik'],
								'username' => $status[0]['username'],
								'level' => $status[0]['user_level'],
								'email' => $status[0]['email'],
								'login' => TRUE,
								'id_login'=>session_id()
							);
							$this->session->set_userdata($sessionarray);
							$this->session->set_flashdata('title','Login Sukses');
							$this->session->set_flashdata('text','Selamat Datang '.$status[0]['username']);
							$this->session->set_flashdata('class', "bg-success ");

							//Creeate session logged_in
							$this->session->set_userdata('logged_in', TRUE);
							//print_r($status);								
							redirect('login','refresh');
						} else
						{
							// $this->session->set_flashdata('title','Login Gagal');
							// $this->session->set_flashdata('text','Username dan Password salah, Silahkan Ulangi Lagi');
							// $this->session->set_flashdata('class', "bg-warning");
							echo "<script>alert('Username dan Password salah, Silahkan Ulangi Lagi');history.go(-1);</script>";
							redirect('login','refresh');
						}
				}else{
					// $this->session->set_flashdata('title','Login Gagal');
					// $this->session->set_flashdata('text','Username dan Password salah, Silahkan Ulangi Lagi');
					// $this->session->set_flashdata('class', "bg-warning");
					echo "<script>alert('Username atau Password salah, Silahkan Ulangi Lagi');history.go(-1);</script>";
					redirect('login','refresh');
			}
			} else {
			// $this->session->set_flashdata('title','Login Gagal');
			// $this->session->set_flashdata('text','Username dan Password salah, Silahkan Ulangi Lagi');
			// $this->session->set_flashdata('class', "bg-warning");
			echo "<script>alert('Silahkan Isi Recaptcha terlebih dahulu');history.go(-1);</script>";
			redirect('login','refresh');
		}
	}
		

		$this->data['title'] = $this->session->flashdata('title');
		$this->data['text'] = $this->session->flashdata('text');
		$this->data['class'] = $this->session->flashdata('class');
		$this->load->view('login',$this->data);
	
	}

    function keluar(){
        $this->session->sess_destroy();
        redirect('login','refresh');
    }
	


    public function profile(){
		if (!$this->ion_auth->ceklogin()){
			redirect('login/keluar');
		}

        $data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
        );
        $this->template->load('menu','profile', $data);
    }

	public function update_password(){
		$get_data_user = $this->User_model->get_data_user($this->session->userdata('username'));
		echo $get_data_user->username;

		if($get_data_user->password == md5($this->security->xss_clean($this->input->post('current_password')))){
			// Update untuk mencatatkan ke Database
			$data = array(
				'password' => md5($this->security->xss_clean($this->input->post('new_password'))),
			);
			$where = array(
				'username' => $this->session->userdata('username'),
			);
		 
			$this->User_model->update_data($where,$data,'user_login');

			echo '<script language="javascript">';
			echo 'alert("Password Berhasil di Ubah")';
			echo '</scriphttps:>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Current Password Salah, atau Tidak sesuai dengan password yang saat ini.")';
			echo '</script>';
		}
		redirect("profile","refresh");
	}
}
