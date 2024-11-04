<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','email','system','system'));
		$this->load->config('email');

		// $this->load->library('../controllers/mail','mail');
		## GET Model Admin Model
		$this->load->model('admin_model');
		$this->load->model('asesor_model');
		$this->load->model('master_model');
		$this->load->model('api_model');
		$this->load->model('report_model');

		## GET Model Admin Model
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$report_dashboard_admin = $this->report_model->report_dashboard_admin();

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'report_dashboard_admin'=>$report_dashboard_admin,
		);
		$this->template->load('menu','Admin/dashboard', $this->data);
	}

	################################### Tinjau Permohonan #######################################

	public function list_permohonan()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$list_permohonan = $this->admin_model->get_list_permohonan();
		$this->data=array(
		 	'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'list_permohonan' => $list_permohonan,
		 );
		$this->template->load('menu','Admin/tinjau_permohonan/list_permohonan', $this->data);
	}

	public function get_data_list_permohonan(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$token = $this->api_model->get_token();
		## Set Configuration Header.
		$headers = array(
			'Content-Type: application/json',
			'token:'.$token->token
		);
		## Set Variable From POST Kategori

		## Set URL Source Data ##
		$baseUrl = $token->host . "/siki-api/v1/permohonan-skk";

		//Set the headers that we want our cURL client to use.
		$ch = curl_init();
		//Set the headers that we want our cURL client to use.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		$responseBody = curl_exec($ch);
		$responseInfo = curl_getinfo($ch);
		curl_close($ch);

		$array = json_decode($responseBody, True);

		if ($responseInfo["http_code"]!=200 && $responseInfo["http_code"]!=201) {
		#print_r($responseInfo);
		// echo 'Silahkan refresh ulang';
		echo "<script>alert('Belum Ada Permohonan Sertifikasi Lagi');history.go(-1);</script>";
		}else{
			for ($i = 0; $i < count($array['data']); $i++){
				$get_list_data_permohonan['nik'] = $array['data'][$i]['nik'];
				$get_list_data_permohonan['id_izin'] = $array['data'][$i]['id_izin'];
				$get_list_data_permohonan['id_lsp'] = $array['data'][$i]['id_lsp'];
				$get_list_data_permohonan['created_at'] = $array['data'][$i]['created_at'];
				$get_list_data_permohonan['updated_at'] = $array['data'][$i]['updated_at'];
				$this->db->replace('list_permohonan', $get_list_data_permohonan);
			}

			echo "<script>alert('Data List Permohonan Berhasil Di Update');</script>";
			redirect('admin/list_permohonan','refresh');
		}
	}

	// public function detail_list_permohonan($id_izin)
	// {
	// 	##/Cek Session Login##
	// 	if (!$this->ion_auth->ceklogin()){
	// 		redirect('login','refresh');
	// 	}else if($this->session->userdata('level') !== 'Admin'){
	// 		redirect('login/keluar','refresh');
	// 	}
	// 	##/Cek Session Login##
	// 	$id_izin = base64_decode($id_izin);

	// 	#Get Data Master
	// 	$get_master_jenis_permohonan =  $this->master_model->get_master_jenis_permohonan();


	// 	$token = $this->api_model->get_token();
	// 	## Set Configuration Header.
	// 	$headers = array(
	// 		'Content-Type: application/json',
	// 		'token:'.$token->token
	// 	);
	// 	## Set Variable From POST Kategori

	// 	## Set URL Source Data ##
	// 	$baseUrl = $token->host . "/siki-api/v1/permohonan-skk/".$id_izin;

	// 	//Set the headers that we want our cURL client to use.
	// 	$ch = curl_init();
	// 	//Set the headers that we want our cURL client to use.
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_URL, "$baseUrl");

	// 	$responseBody = curl_exec($ch);
	// 	$responseInfo = curl_getinfo($ch);
	// 	curl_close($ch);

	// 	$array = json_decode($responseBody, True);

	// 	if ($responseInfo["http_code"]!=200 && $responseInfo["http_code"]!=201) {
	// 	#print_r($responseInfo);
	// 	// echo 'Silahkan refresh ulang';
	// 	echo "<script>alert('data tidak terdapat diperizinan');history.go(-1);</script>";

	// 	}else{
	// 	//  print_r(json_decode($responseBody));
	// 	$array = json_decode($responseBody, True);
	// 		 #echo print_r($array);
	// 		 $this->data=array(
	// 			'username' => $this->session->userdata('username'),
	// 			'level' => $this->session->userdata('level'),
	// 			'array' => $array,
	// 			'id_izin' => $id_izin,
	// 			'get_master_jenis_permohonan' => $get_master_jenis_permohonan,
	// 			);
	// 		 $this->template->load('menu','Admin/tinjau_permohonan/detail_list_permohonan', $this->data);
	// 	}
	// }

	public function cek_status_perbaikan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");
		$token = $this->api_model->get_token();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://siki.pu.go.id/siki-api/v1/status-skk/'.$id_izin,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'token:'.$token->token
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$result = json_decode($response,true);
	
		if($result['current_status'] == NULL){
			// header("location:".base_url('admin/entry_data_permohonan/').base64_encode($id_izin));
			$this->entry_data_permohonan(base64_encode($id_izin));
		}else{
			echo "<script>
				alert('Pemohon belum Submit Final Perbaikan');
				history.go(-1);
				</script>";
		}
		
	}

	public function entry_data_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");
		
		$token = $this->api_model->get_token();
		## Set Configuration Header.
		$headers = array(
			'Content-Type: application/json',
			'token:'.$token->token
		);
		## Set Variable From POST Kategori

		## Set URL Source Data ##
		$baseUrl = $token->host . "/siki-api/v1/permohonan-skk/".$id_izin;

		//Set the headers that we want our cURL client to use.
		$ch = curl_init();
		//Set the headers that we want our cURL client to use.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		$responseBody = curl_exec($ch);
		$responseInfo = curl_getinfo($ch);
		curl_close($ch);

		$array = json_decode($responseBody, True);

		if ($responseInfo["http_code"]!=200 && $responseInfo["http_code"]!=201) {
		#print_r($responseInfo);
		// echo 'Silahkan refresh ulang';
		echo "<script>alert('data tidak terdapat diperizinan');history.go(-1);</script>";

		}else{

		// Insert Log History Permohonan Mulai Tinjau Permohonan Status 20 Validasi
		$data_tinjau['id_izin'] = $id_izin;
		$data_tinjau['kode_status'] = "20";
		$data_tinjau['log'] = date("Y-m-d H:i:s");
		$data_tinjau['username'] =  $this->session->userdata('username');
		$this->admin_model->insert_log_history_permohonan($data_tinjau);
	

		/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
		//API Url
        $url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

        //Initiate cURL.
        $ch = curl_init($url);

        //The JSON data.
        $jsonData = array(
            'kd_status' => '20',
            'keterangan' => 'Validasi'
        );

        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);

        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token:'.$token->token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //Execute the request to array
        $arr = json_decode(curl_exec($ch), true);

		// $log_hit_status_siki_portal['id_izin'] = $id_izin;
		// $log_hit_status_siki_portal['status'] = $arr['status'];
		// $log_hit_status_siki_portal['message'] = $arr['message'];
		// $log_hit_status_siki_portal['log'] = $log;

		// $this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);
		/////////////////////// / Hit Status ke API SIKI & PORTAL ///////////////

		
		// Generate User Pemohon
		$comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$shfl = str_shuffle($comb);
		$pwd = SUBSTR($shfl,0,8);

		$usr = rand();
		$nik_pemohon = $array['personal'][0]['nik'];
		$cek_user = $this->admin_model->cek_user_pemohon($nik_pemohon);


		#Get Data Master
		$get_master_jabatan_kerja =  $this->master_model->get_master_jabatan_kerja();
		$get_data_lsp = $this->api_model->get_token();


		if(!empty($cek_user->nik)){
			#email permohonan sedang di proses user sudah ada
			$from = $this->config->item('smtp_user');
			// $to = $this->input->post('to');
			$to = $array['personal'][0]['email'];
			$subject = 'Pemberitahuan Permohonan SKK';

			$data = array(
				'nama' => $array['personal'][0]['nama'],
				'jabker' => ['klasifikasi_kualifikasi'][0]['jabatan_kerja'],
				'get_data_lsp' => $get_data_lsp,
			);
			$message = $this->load->view('Sendmail/20-validasi_sudah_punya_user',$data,true);

			$this->email->set_newline("\r\n");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->cc($get_data_lsp->cc_email);
			$this->email->subject($subject);
			$this->email->message($message);

			if ($this->email->send()) {
				echo '';
			} else {
				show_error($this->email->print_debugger());
			}
		}else{
			// Kirim User via Email

			//Insert User ke Tabel user_login
			$user_login['nik'] = $nik_pemohon;
			$user_login['username'] = "SKK-".$usr;
			$user_login['password'] = md5($pwd);
			$user_login['email'] = $array['personal'][0]['email'];
			$user_login['user_level'] = 'User';
			$user_login['status'] = '1';
			$this->db->insert('user_login', $user_login);

			#email kirim user hasil generate
				$from = $this->config->item('smtp_user');
				$to = $array['personal'][0]['email'];
				$subject = 'Pemberitahuan Permohonan SKK';

				$data = array(
					'nama' => $array['personal'][0]['nama'],
					'jabker' => ['klasifikasi_kualifikasi'][0]['jabatan_kerja'],
					'username' => "SKK-".$usr,
					'password' => $pwd,
					'get_data_lsp' => $get_data_lsp,
				);
				$message = $this->load->view('Sendmail/20-validasi_belum_punya_user',$data,true);
				
				$this->email->set_newline("\r\n");
				$this->email->from($from);
				$this->email->to($to);
				$this->email->cc($get_data_lsp->cc_email);
				$this->email->subject($subject);
				$this->email->message($message);

				if($this->email->send()) {
					echo '';
				} else {
					show_error($this->email->print_debugger());
				}
		}

		
		//Keperluan Form APl 01
		$apl01['id_izin'] = $id_izin;
		$this->db->insert('data_apl01_permohonan', $apl01);


		//  print_r(json_decode($responseBody));
		$array = json_decode($responseBody, True);
		$log = date("Y-m-d H:i:s");

			// Entry Data Personal Permohonan
			$data_personal['id_izin'] = $id_izin;
			$data_personal['id'] = $array['personal'][0]['id'];
			$data_personal['updated'] = $array['personal'][0]['updated'];
			$data_personal['created'] = $array['personal'][0]['created'];
			$data_personal['creator'] = $array['personal'][0]['creator'];
			$data_personal['data_id'] = $array['personal'][0]['data_id'];
			$data_personal['nik'] = $array['personal'][0]['nik'];
			$data_personal['nama'] = $array['personal'][0]['nama'];
			$data_personal['tempat_lahir'] = $array['personal'][0]['tempat_lahir'];
			$data_personal['tanggal_lahir'] = $array['personal'][0]['tanggal_lahir'];
			$data_personal['email'] = $array['personal'][0]['email'];
			$data_personal['telepon'] = $array['personal'][0]['telepon'];
			$data_personal['npwp'] = $array['personal'][0]['npwp'];
			$data_personal['jenis_kelamin'] = $array['personal'][0]['jenis_kelamin'];
			$data_personal['alamat'] = $array['personal'][0]['alamat'];
			$data_personal['negara'] = $array['personal'][0]['negara'];
			$data_personal['propinsi'] = $array['personal'][0]['propinsi'];
			$data_personal['kabupaten'] = $array['personal'][0]['kabupaten'];
			$data_personal['kodepos'] = $array['personal'][0]['kodepos'];
			$data_personal['ktp'] = $array['personal'][0]['ktp'];
			$data_personal['surat_pernyataan_kebenaran_data'] = $array['personal'][0]['surat_pernyataan_kebenaran_data'];
			$data_personal['file_npwp'] = $array['personal'][0]['file_npwp'];
			$data_personal['pas_foto'] = $array['personal'][0]['pas_foto'];
			$data_personal['log'] = $log;
			$this->db->insert('data_personal_permohonan', $data_personal);

		// Entry Data Pendidikan Permohonan
		for ($i = 0; $i < count($array['pendidikan']); $i++){
			$data_pendidikan['nik'] = $array['personal'][0]['nik'];
			$data_pendidikan['id_izin'] = $id_izin;
			$data_pendidikan['id'] = $array['pendidikan'][$i]['id'];
			$data_pendidikan['updated'] = $array['pendidikan'][$i]['updated'];
			$data_pendidikan['created'] = $array['pendidikan'][$i]['created'];
			$data_pendidikan['creator'] = $array['pendidikan'][$i]['creator'];
			$data_pendidikan['data_id'] = $array['pendidikan'][$i]['data_id'];
			$data_pendidikan['nama_sekolah_perguruan_tinggi'] = $array['pendidikan'][$i]['nama_sekolah_perguruan_tinggi'];
			$data_pendidikan['program_studi'] = $array['pendidikan'][$i]['program_studi'];
			$data_pendidikan['no_ijazah'] = $array['pendidikan'][$i]['no_ijazah'];
			$data_pendidikan['tahun_lulus'] = $array['pendidikan'][$i]['tahun_lulus'];
			$data_pendidikan['jenjang'] = $array['pendidikan'][$i]['jenjang'];
			$data_pendidikan['alamat'] = $array['pendidikan'][$i]['alamat'];
			$data_pendidikan['negara'] = $array['pendidikan'][$i]['negara'];
			$data_pendidikan['propinsi'] = $array['pendidikan'][$i]['propinsi'];
			$data_pendidikan['kabupaten'] = $array['pendidikan'][$i]['kabupaten'];
			$data_pendidikan['scan_ijazah_legalisir'] = $array['pendidikan'][$i]['scan_ijazah_legalisir'];
			$data_pendidikan['scan_surat_keterangan'] = $array['pendidikan'][$i]['scan_surat_keterangan'];
			$data_pendidikan['log'] = $log;

			$this->db->insert('data_pendidikan_permohonan', $data_pendidikan);
		}


		// Entry Data Proyek Permohonan
		for ($i = 0; $i < count($array['proyek']); $i++){
			$data_proyek['nik'] = $array['personal'][0]['nik'];
			$data_proyek['id_izin'] = $id_izin;
			$data_proyek['id'] = $array['proyek'][$i]['id'];
			$data_proyek['updated'] = $array['proyek'][$i]['updated'];
			$data_proyek['created'] = $array['proyek'][$i]['created'];
			$data_proyek['creator'] = $array['proyek'][$i]['creator'];
			$data_proyek['data_id'] = $array['proyek'][$i]['data_id'];
			$data_proyek['nama_proyek'] = $array['proyek'][$i]['nama_proyek'];
			$data_proyek['lokasi_proyek'] = $array['proyek'][$i]['lokasi_proyek'];
			$data_proyek['tanggal_awal'] = $array['proyek'][$i]['tanggal_awal'];
			$data_proyek['tanggal_akhir'] = $array['proyek'][$i]['tanggal_akhir'];
			$data_proyek['jabatan'] = $array['proyek'][$i]['jabatan'];
			$data_proyek['nilai_proyek'] = $array['proyek'][$i]['nilai_proyek'];
			$data_proyek['surat_referensi'] = $array['proyek'][$i]['surat_referensi'];
			$data_proyek['jenis_pengalaman'] = $array['proyek'][$i]['jenis_pengalaman'];
			$data_proyek['pemberi_kerja'] = $array['proyek'][$i]['pemberi_kerja'];
			$data_proyek['no_registrasi'] = $array['proyek'][$i]['no_registrasi'];
			$data_proyek['log'] = $log;
			
			$this->db->insert('data_proyek_permohonan', $data_proyek);
		}


		// Entry Data Pelatihan Permohonan
		for ($i = 0; $i < count($array['pelatihan']); $i++){
			$data_pelatihan['nik'] = $array['personal'][0]['nik'];
			$data_pelatihan['id_izin'] = $id_izin;
			$data_pelatihan['id'] = $array['pelatihan'][$i]['id'];
			$data_pelatihan['updated'] = $array['pelatihan'][$i]['updated'];
			$data_pelatihan['created'] = $array['pelatihan'][$i]['created'];
			$data_pelatihan['creator'] = $array['pelatihan'][$i]['creator'];
			$data_pelatihan['data_id'] = $array['pelatihan'][$i]['data_id'];
			$data_pelatihan['penyelenggara'] = $array['pelatihan'][$i]['penyelenggara'];
			$data_pelatihan['nama_pelatihan'] = $array['pelatihan'][$i]['nama_pelatihan'];
			$data_pelatihan['tanggal_awal'] = $array['pelatihan'][$i]['tanggal_awal'];
			$data_pelatihan['tanggal_akhir'] = $array['pelatihan'][$i]['tanggal_akhir'];
			$data_pelatihan['jumlah_jp'] = $array['pelatihan'][$i]['jumlah_jp'];
			$data_pelatihan['jumlah_hari'] = $array['pelatihan'][$i]['jumlah_hari'];
			$data_pelatihan['file_sertifikat'] = $array['pelatihan'][$i]['file_sertifikat'];
			$data_pelatihan['log'] = $log;

			$this->db->insert('data_pelatihan_permohonan', $data_pelatihan);
		}
		
		// Entry Data klasifikasi_kualifikasi Permohonan
		for ($i = 0; $i < count($array['klasifikasi_kualifikasi']); $i++){
			$data_klasifikasi_kualifikasi['nik'] = $array['personal'][0]['nik'];
			$data_klasifikasi_kualifikasi['id_izin'] = $id_izin;
			$data_klasifikasi_kualifikasi['id'] = $array['klasifikasi_kualifikasi'][$i]['id'];
			$data_klasifikasi_kualifikasi['updated'] = $array['klasifikasi_kualifikasi'][$i]['updated'];
			$data_klasifikasi_kualifikasi['created'] = $array['klasifikasi_kualifikasi'][$i]['created'];
			$data_klasifikasi_kualifikasi['creator'] = $array['klasifikasi_kualifikasi'][$i]['creator'];
			$data_klasifikasi_kualifikasi['data_id'] = $array['klasifikasi_kualifikasi'][$i]['data_id'];
			$data_klasifikasi_kualifikasi['lsp'] = $array['klasifikasi_kualifikasi'][$i]['lsp'];
			$data_klasifikasi_kualifikasi['subklasifikasi'] = $array['klasifikasi_kualifikasi'][$i]['subklasifikasi'];
			
			// Kualifikasi
			if($array['klasifikasi_kualifikasi'][$i]['jenjang'] >= 7){
				$data_klasifikasi_kualifikasi['kualifikasi'] = '1';
			}elseif($array['klasifikasi_kualifikasi'][$i]['jenjang'] >= 4 && $array['klasifikasi_kualifikasi'][$i]['jenjang'] <= 6){
				$data_klasifikasi_kualifikasi['kualifikasi'] = '2';
			}elseif($array['klasifikasi_kualifikasi'][$i]['jenjang'] >= 1 && $array['klasifikasi_kualifikasi'][$i]['jenjang'] <= 3){
				$data_klasifikasi_kualifikasi['kualifikasi'] = '3';
			}
			
			$data_klasifikasi_kualifikasi['jabatan_kerja'] = $array['klasifikasi_kualifikasi'][$i]['jabatan_kerja'];
			$data_klasifikasi_kualifikasi['jenjang'] = $array['klasifikasi_kualifikasi'][$i]['jenjang'];
			$data_klasifikasi_kualifikasi['asosiasi'] = $array['klasifikasi_kualifikasi'][$i]['asosiasi'];
			$data_klasifikasi_kualifikasi['kta'] = $array['klasifikasi_kualifikasi'][$i]['kta'];
			$data_klasifikasi_kualifikasi['tuk'] = $array['klasifikasi_kualifikasi'][$i]['tuk'];
			$data_klasifikasi_kualifikasi['jenis_permohonan'] = $array['klasifikasi_kualifikasi'][$i]['jenis_permohonan'];
			$data_klasifikasi_kualifikasi['berita_acara_vv'] = $array['klasifikasi_kualifikasi'][$i]['berita_acara_vv'];
			$data_klasifikasi_kualifikasi['surat_permohonan'] = $array['klasifikasi_kualifikasi'][$i]['surat_permohonan'];
			$data_klasifikasi_kualifikasi['surat_pengantar_pemohonan_asosiasi'] = $array['klasifikasi_kualifikasi'][$i]['surat_pengantar_pemohonan_asosiasi'];
			$data_klasifikasi_kualifikasi['sertifikat_skk'] = $array['klasifikasi_kualifikasi'][$i]['sertifikat_skk'];
			$data_klasifikasi_kualifikasi['self_asesmen_apl'] = $array['klasifikasi_kualifikasi'][$i]['self_asesmen_apl'];
			$data_klasifikasi_kualifikasi['klasifikasi'] = $array['klasifikasi_kualifikasi'][$i]['klasifikasi'];
			$data_klasifikasi_kualifikasi['log'] = $log;

			$this->db->insert('data_klasifikasi_kualifikasi_permohonan', $data_klasifikasi_kualifikasi);
		}
		
		header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));
		}
	}

	public function list_tinjau_permohonan()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		#Get Master
		$get_master_jenis_permohonan = $this->master_model->get_master_jenis_permohonan();


		$list_tinjau_permohonan = $this->admin_model->get_list_tinjau_permohonan();

		$this->data=array(
		 	'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'list_tinjau_permohonan' => $list_tinjau_permohonan,
			'get_master_jenis_permohonan' => $get_master_jenis_permohonan,
		 );
		$this->template->load('menu','Admin/tinjau_permohonan/list_tinjau_permohonan', $this->data);
	}

	public function tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		
		#Info Data Permohonan
		$info_data_permohonan = $this->admin_model->info_data_permohonan($id_izin);

		#Get Master 
		$get_master_persyaratan_kompeten = $this->master_model->get_master_persyaratan_kompeten();

		#Get Data Detail Permohonan
		$get_data_personal_permohonan = $this->admin_model->get_data_personal_permohonan($id_izin);
		$get_data_pendidikan_permohonan = $this->admin_model->get_data_pendidikan_permohonan($id_izin);
		$data_pendidikan_yang_sudah_dipilih = $this->admin_model->data_pendidikan_yang_sudah_dipilih($id_izin);
		$get_data_proyek_permohonan = $this->admin_model->get_data_proyek_permohonan($id_izin);
		$get_data_pelatihan_permohonan = $this->admin_model->get_data_pelatihan_permohonan($id_izin);
		// $get_data_studi_kasus_permohonan = $this->admin_model->get_data_studi_kasus_permohonan($id_izin);
		// $get_data_sertifikat_surat_keterangan_permohonan = $this->admin_model->get_data_sertifikat_surat_keterangan_permohonan($id_izin);
		$get_data_klasifikasi_kualifikasi_permohonan = $this->admin_model->get_data_klasifikasi_kualifikasi_permohonan($id_izin);

		#Opsi Persyaratan Kompetensi APL 01
		$option_persyaratan_kompetensi_apl01 = $this->admin_model->option_persyaratan_kompetensi_apl01($id_izin);
		$get_data_apl01 = $this->admin_model->get_data_apl01($id_izin);

		#Get Data Tinjau Permohonan
		$get_data_tinjau_permohonan = $this->admin_model->get_data_tinjau_permohonan($id_izin);

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'id_izin' => $id_izin,
			'info_data_permohonan' => $info_data_permohonan,
			'get_data_personal_permohonan' => $get_data_personal_permohonan,
			'get_data_pendidikan_permohonan' => $get_data_pendidikan_permohonan,
			'data_pendidikan_yang_sudah_dipilih' => $data_pendidikan_yang_sudah_dipilih,
			'get_data_proyek_permohonan' => $get_data_proyek_permohonan,
			'get_data_pelatihan_permohonan' => $get_data_pelatihan_permohonan,
			// 'get_data_studi_kasus_permohonan' => $get_data_studi_kasus_permohonan,
			// 'get_data_sertifikat_surat_keterangan_permohonan' => $get_data_sertifikat_surat_keterangan_permohonan,
			'get_data_klasifikasi_kualifikasi_permohonan' => $get_data_klasifikasi_kualifikasi_permohonan,
			'get_data_tinjau_permohonan' => $get_data_tinjau_permohonan,
			'get_master_persyaratan_kompeten' => $get_master_persyaratan_kompeten,
			'option_persyaratan_kompetensi_apl01' => $option_persyaratan_kompetensi_apl01,
			'get_data_apl01' => $get_data_apl01,
			);
		$this->template->load('menu','Admin/tinjau_permohonan/tinjau_permohonan', $this->data);
	}

	#Proses Tinjau Permohonan Administrasi
	public function insert_administrasi_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$log = date("Y-m-d H:i:s");
		$id_izin = base64_decode($id_izin);

		#KTP
		if($this->security->xss_clean($this->input->post('ktp')) == 1){
			$status_ktp = '1';
		}else{
			$status_ktp = '0';
		}

		echo "<script>swal('Hello world!')</script>";
		
		$ktp = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '1a',
			'status' => $status_ktp,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_ktp')),
			'user_peninjau' => $this->session->userdata('username'),
		);
			$this->db->replace('tinjau_permohonan', $ktp);

		#pernyataan_kebenaran_data
		if($this->security->xss_clean($this->input->post('pernyataan_kebenaran_data')) == 1){
			$status_pernyataan_kebenaran_data = '1';
		}else{
			$status_pernyataan_kebenaran_data = '0';
		}
		$pernyataan_kebenaran_data = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '1b',
			'status' => $status_pernyataan_kebenaran_data,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_pernyataan_kebenaran_data')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		 $this->db->replace('tinjau_permohonan', $pernyataan_kebenaran_data);

		#npwp
		if($this->security->xss_clean($this->input->post('npwp')) == 1){
			$status_npwp = '1';
		}else{
			$status_npwp = '0';
		}
		$npwp = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '1c',
			'status' => $status_npwp,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_npwp')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		 $this->db->replace('tinjau_permohonan', $npwp);

		#pas_foto
		if($this->security->xss_clean($this->input->post('pas_foto')) == 1){
			$status_pas_foto = '1';
		}else{
			$status_pas_foto = '0';
		}
		$pas_foto = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '1d',
			'status' => $status_pas_foto,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_pas_foto')),
			'user_peninjau' => $this->security->xss_clean($this->session->userdata('username')),
		);
		$this->db->replace('tinjau_permohonan', $pas_foto);

		#ceklis_administrasi
		if($this->security->xss_clean($this->input->post('ceklis_administrasi')) == 1){
			$status_ceklis_administrasi = '1';
		}else{
			$status_ceklis_administrasi = '0';
		}
		$ceklis_administrasi = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '1',
			'status' => $status_ceklis_administrasi,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_ceklis_administrasi')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $ceklis_administrasi);

		$this->session->set_flashdata('success','Save Ceklis Administrasi');
		header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));
	}

	#Proses Tinjau Permohonan Pendidikan
	public function insert_pendidikan_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$log = date("Y-m-d H:i:s");
		$id_izin = base64_decode($id_izin);

		#scan_ijazah_legalisir
		if($this->security->xss_clean($this->input->post('scan_ijazah_legalisir')) == 1){
			$status_scan_ijazah_legalisir = '1';
		}else{
			$status_scan_ijazah_legalisir = '0';
		}
		$scan_ijazah_legalisir = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '2a',
			'status' => $status_scan_ijazah_legalisir,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_scan_ijazah_legalisir')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $scan_ijazah_legalisir);

		#scan_surat_keterangan_pendidikan
		if($this->security->xss_clean($this->input->post('scan_surat_keterangan_pendidikan')) == 1){
			$status_scan_surat_keterangan_pendidikan = '1';
		}else{
			$status_scan_surat_keterangan_pendidikan = '0';
		}
		$scan_surat_keterangan_pendidikan = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '2b',
			'status' => $status_scan_surat_keterangan_pendidikan,
			'log' => $log,
			'catatan' => $this->input->post('catatan_scan_surat_keterangan_pendidikan'),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $scan_surat_keterangan_pendidikan);

		#ceklis_pendidikan
		if($this->security->xss_clean($this->input->post('ceklis_pendidikan')) == 1){
			$status_ceklis_pendidikan = '1';
		}else{
			$status_ceklis_pendidikan = '0';
		}
		$ceklis_pendidikan = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '2',
			'status' => $status_ceklis_pendidikan,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_ceklis_pendidikan')),
			'jenjang_yang_sesuai' => $this->security->xss_clean($this->input->post('jenjang_yang_sesuai')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $ceklis_pendidikan);

		$this->session->set_flashdata('success','Save Ceklis Pendidikan');
		header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));
	}

	#Proses Tinjau Permohonan Proyek / Pengalaman
	public function insert_proyek_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$log = date("Y-m-d H:i:s");
		$id_izin = base64_decode($id_izin);

		#Surat Referensi Proyek
		if (isset($_POST['submit'])) {
			$count = $_POST['count'];
			for ($i = 1; $i < $count; $i++) {
				$catatan_surat_referensi_proyek = $_POST['catatan_surat_referensi_proyek'][$i]; // check empty and check if interger
				$kode_item = $_POST['kode_item'][$i];
				$id_proyek = $_POST['id_proyek'][$i];

				if(empty($_POST['surat_referensi_proyek'][$i])){
					$status_surat_referensi_proyek = '0';
				}elseif(!empty($_POST['surat_referensi_proyek'][$i]) && $_POST['surat_referensi_proyek'][$i] == '1'){
					$status_surat_referensi_proyek = '1';
				}

				$surat_referensi_proyek = array(
					'id_izin' => $id_izin,
					'status' => $status_surat_referensi_proyek,
					'log' => $log,
					'catatan' => $catatan_surat_referensi_proyek,
					'item_tinjau_permohonan' => $kode_item,
					'data_id_proyek' => $id_proyek,
					'user_peninjau' => $this->session->userdata('username'),
				);
				$this->db->replace('tinjau_permohonan', $surat_referensi_proyek);
			}
		}


		#Ceklis Proyek
		if($this->security->xss_clean($this->input->post('ceklis_proyek')) == 1){
			$status_ceklis_proyek = '1';
		}else{
			$status_ceklis_proyek = '0';
		}
		$ceklis_proyek = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '3',
			'status' => $status_ceklis_proyek,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_ceklis_proyek')),
			'jenjang_yang_sesuai' => $this->security->xss_clean($this->input->post('jenjang_yang_sesuai')),
			'user_peninjau' => $this->security->xss_clean($this->session->userdata('username')),
		);
		$this->db->replace('tinjau_permohonan', $ceklis_proyek);

		$this->session->set_flashdata('success','Save Ceklis Proyek');
		header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));
	}


	#Proses Tinjau Permohonan Pelatihan
	public function insert_pelatihan_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$log = date("Y-m-d H:i:s");
		$id_izin = base64_decode($id_izin);

		#Ceklis Pelatihan
		if($this->security->xss_clean($this->input->post('ceklis_pelatihan')) == 1){
			$status_ceklis_pelatihan = '1';
		}else{
			$status_ceklis_pelatihan = '0';
		}
		$ceklis_pelatihan = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '4',
			'status' => $status_ceklis_pelatihan,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_ceklis_pelatihan')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $ceklis_pelatihan);

		$this->session->set_flashdata('success','Save Ceklis Pelatihan');
		header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));
	}


	#Proses Tinjau Permohonan APL 01
	 public function insert_apl01_tinjau_permohonan($id_izin){
	 	##/Cek Session Login##
	 	if (!$this->ion_auth->ceklogin()){
	 		redirect('login','refresh');
	 	}else if($this->session->userdata('level') !== 'Admin'){
	 		redirect('login/keluar','refresh');
	 	}
	 	##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
	 	$log = date("Y-m-d H:i:s");

		$get_data_apl01 = $this->admin_model->get_data_apl01($id_izin);

	 	$apl01_tinjau_permohonan = array(
	 		'id_izin' => $id_izin,
			'pekerjaan_sekarang_perusahaan' => $get_data_apl01->pekerjaan_sekarang_perusahaan,
			'pekerjaan_sekarang_jabatan' => $get_data_apl01->pekerjaan_sekarang_jabatan,
			'pekerjaan_sekarang_alamat_kantor' => $get_data_apl01->pekerjaan_sekarang_alamat_kantor,
			'pekerjaan_sekarang_kodepos_kantor' => $get_data_apl01->pekerjaan_sekarang_kodepos_kantor,
			'pekerjaan_sekarang_notlp_kantor' => $get_data_apl01->pekerjaan_sekarang_notlp_kantor,
			'pekerjaan_sekarang_fax_kantor' => $get_data_apl01->pekerjaan_sekarang_fax_kantor,
			'pekerjaan_sekarang_email_kantor' => $get_data_apl01->pekerjaan_sekarang_email_kantor,
			'id_pekerjaan' => $get_data_apl01->id_pekerjaan,
			'tujuan_asesment' => $this->security->xss_clean($this->input->post('tujuan_asesment')),
	 		'id_persyaratan_kompeten' => $this->security->xss_clean($this->input->post('id_persyaratan_kompeten')),
	 		'status_persyaratan_kompeten' => $this->security->xss_clean($this->input->post('status_persyaratan_kompeten')),
	 		'status_ktp' => $this->security->xss_clean($this->input->post('status_ktp')),
	 		'status_pas_foto' => $this->security->xss_clean($this->input->post('status_pas_foto')),
			'ttd_pemohon' => $get_data_apl01->ttd_pemohon,
			'ttd_peninjau' => $get_data_apl01->ttd_peninjau,
			'tanggal_ttd_peninjau' => $get_data_apl01->tanggal_ttd_peninjau,
			'user_peninjau' => $this->session->userdata('username'),
			'ttd_asesor_apl02' => $get_data_apl01->ttd_asesor_apl02,
			'tanggal_ttd_asesor_apl02' => $get_data_apl01->tanggal_ttd_asesor_apl02,
			'user_asesor_ttd_apl02' => $get_data_apl01->user_asesor_ttd,
	 	);
	 	$this->db->replace('data_apl01_permohonan', $apl01_tinjau_permohonan);

		#Kirim Email Jika status_persyaratan_kompeten

		$this->session->set_flashdata('success','Save Ceklis Apl01');
	 	header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));
	}

	// Keperluan Signature / TTD Peninjau di APL 01
	public function insert_signature_peninjau_apl01($id_izin){
        if (!$this->ion_auth->ceklogin()){
            redirect('login','refresh');
        }else if($this->session->userdata('level') !== 'Admin'){
            redirect('login/keluar','refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
	 	$log = date("Y-m-d H:i:s");

        $img = $this->input->post('image');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = './uploads/file_permohonan/ttd_admin_apl01/ttd_peninjau_apl01-' . base64_encode($id_izin) . '.png';
        $success = file_put_contents($file, $data);
        $image=str_replace('./','',$file);

		$get_data_apl01 = $this->admin_model->get_data_apl01($id_izin);

		if(empty($get_data_apl01->tanggal_ttd_peninjau)){
			$tanggal_ttd_peninjau = $log;
		}else{
			$tanggal_ttd_peninjau = $get_data_apl01->tanggal_ttd_peninjau;
		}

        // Update untuk mencatatkan ke Database
        $data = array(
            'ttd_peninjau' => 'ttd_peninjau_apl01-' . base64_encode($id_izin) . '.png',
            'tanggal_ttd_peninjau' => $tanggal_ttd_peninjau,
        );
     
        $where = array(
            'id_izin' => $id_izin
        );
     
        $this->admin_model->update_data($where,$data,'data_apl01_permohonan');
        redirect("admin/tinjau_permohonan/".base64_encode($id_izin),"refresh");
	}

	// #Proses Tinjau Permohonan Sertifikat Surat Keterangan
	// public function insert_sertifikat_surat_keterangan_tinjau_permohonan($id_izin){
	// 	##/Cek Session Login##
	// 	if (!$this->ion_auth->ceklogin()){
	// 		redirect('login','refresh');
	// 	}else if($this->session->userdata('level') !== 'Admin'){
	// 		redirect('login/keluar','refresh');
	// 	}
	// 	##/Cek Session Login##
	// 	$log = date("Y-m-d H:i:s");

	// 	#Ceklis Sertifikat Surat Keterangan
	// 	if($this->input->post('ceklis_sertifikat_surat_keterangan') == 1){
	// 		$status_ceklis_sertifikat_surat_keterangan = '1';
	// 	}else{
	// 		$status_ceklis_sertifikat_surat_keterangan = '0';
	// 	}
	// 	$ceklis_sertifikat_surat_keterangan = array(
	// 		'id_izin' => $id_izin,
	// 		'item_tinjau_permohonan' => '6',
	// 		'status' => $status_ceklis_sertifikat_surat_keterangan,
	// 		'log' => $log,
	// 		'catatan' => $this->input->post('catatan_ceklis_sertifikat_surat_keterangan'),
	// 	);
	// 	$this->db->replace('tinjau_permohonan', $ceklis_sertifikat_surat_keterangan);

	// 	header("location:".base_url('admin/tinjau_permohonan/').$id_izin);
	// }

	#Proses Tinjau Klasifikasi & Kualifikasi
	public function insert_klasifikasi_kualifikasi_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$log = date("Y-m-d H:i:s");
		$id_izin = base64_decode($id_izin);
	
		#Berita Acara VV	
		if($this->security->xss_clean($this->input->post('berita_acara_vv')) == 1){
			$status_berita_acara_vv = '1';
		}else{
			$status_berita_acara_vv = '0';
		}
		$berita_acara_vv = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '5a',
			'status' => $status_berita_acara_vv,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_berita_acara_vv')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $berita_acara_vv);
		
		#Surat Permohonan	
		if($this->security->xss_clean($this->input->post('surat_permohonan')) == 1){
			$status_surat_permohonan = '1';
		}else{
			$status_surat_permohonan = '0';
		}
		$surat_permohonan = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '5b',
			'status' => $status_surat_permohonan,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_surat_permohonan')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $surat_permohonan);
	
		#Surat Pengantar Permohonan Asosiasi	
		if($this->security->xss_clean($this->input->post('surat_pengantar_permohonan_asosiasi')) == 1){
			$status_surat_pengantar_permohonan_asosiasi = '1';
		}else{
			$status_surat_pengantar_permohonan_asosiasi = '0';
		}
		$surat_pengantar_permohonan_asosiasi = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '5c',
			'status' => $status_surat_pengantar_permohonan_asosiasi,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_surat_pengantar_permohonan_asosiasi')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $surat_pengantar_permohonan_asosiasi);

		#Sertifikat SKK
		if($this->security->xss_clean($this->input->post('sertifikat_skk')) == 1){
			$status_sertifikat_skk = '1';
		}else{
			$status_sertifikat_skk = '0';
		}
		$sertifikat_skk = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '5d',
			'status' => $status_sertifikat_skk,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_sertifikat_skk')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $sertifikat_skk);

		#Ceklis Klasifikasi Kualifikasi
		if($this->security->xss_clean($this->input->post('ceklis_klasifikasi_kualifikasi')) == 1){
			$status_ceklis_klasifikasi_kualifikasi = '1';
		}else{
			$status_ceklis_klasifikasi_kualifikasi = '0';
		}
		$ceklis_klasifikasi_kualifikasi = array(
			'id_izin' => $id_izin,
			'item_tinjau_permohonan' => '5',
			'status' => $status_ceklis_klasifikasi_kualifikasi,
			'log' => $log,
			'catatan' => $this->security->xss_clean($this->input->post('catatan_ceklis_klasifikasi_kualifikasi')),
			'user_peninjau' => $this->session->userdata('username'),
		);
		$this->db->replace('tinjau_permohonan', $ceklis_klasifikasi_kualifikasi);

		$this->session->set_flashdata('success','Save Ceklis Klasifikasi Kualifikasi');
		header("location:".base_url('admin/tinjau_permohonan/').base64_encode($id_izin));

	}

	###### Hasil Tinjau Permohonan ############
	public function hasil_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");

		#Get Data
		$get_data_tinjau_permohonan = $this->admin_model->get_data_tinjau_permohonan_untuk_hasil_tinjau($id_izin);
		$get_data_personal_permohonan = $this->admin_model->get_data_personal_permohonan($id_izin);
		$info_data_permohonan = $this->admin_model->info_data_permohonan($id_izin);
		$get_data_apl01 = $this->admin_model->get_data_apl01($id_izin);

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'id_izin'=>$id_izin,
			'get_data_tinjau_permohonan'=>$get_data_tinjau_permohonan,
			'get_data_personal_permohonan'=>$get_data_personal_permohonan,
			'info_data_permohonan' => $info_data_permohonan,
			'get_data_apl01' => $get_data_apl01,
		);
	   $this->template->load('menu','Admin/tinjau_permohonan/hasil_tinjau_permohonan', $this->data);
	}
	
	public function insert_hasil_tinjau_permohonan($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");

		#Get Data
		$get_data_personal =  $this->admin_model->get_data_personal($id_izin);

		// Insert Log History Permohonan Selesai Tinjau Permohonan Status 10 / 11
		$data_tinjau['id_izin'] = $id_izin;
		$data_tinjau['kode_status'] = $this->security->xss_clean($this->input->post('hasil_tinjau_permohonan'));
		$data_tinjau['log'] = date("Y-m-d H:i:s");
		$data_tinjau['username'] =  $this->session->userdata('username');
		$this->admin_model->insert_log_history_permohonan($data_tinjau);


		## Kirim Pemberitahuan Hasil Tinjau Permohonan
		if($this->security->xss_clean($this->input->post('hasil_tinjau_permohonan')) == '10'){

			$get_data_lsp = $this->api_model->get_token();

			#email kirim user hasil generate
			$from = $this->config->item('smtp_user');
			$to = $get_data_personal->email;
			$subject = 'Notifikasi Hasil Validasi Permohonan SKK';

			$data = array(
				'id_izin' => $id_izin,
				'get_data_lsp' => $get_data_lsp,
			);
			$message = $this->load->view('Sendmail/10-dokumen_lengkap_tinjau_permohonan',$data,true);

			$this->email->set_newline("\r\n");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->cc($get_data_lsp->cc_email);
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send()) {
				echo '';
			} else {
				show_error($this->email->print_debugger());
			}

			/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
			//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				'kd_status' => '10',
				'keterangan' => 'Dokumen Lengkap'
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$arr = json_decode(curl_exec($ch), true);

			// Ketika gagal hit status 10
			if($arr['status'] == 'errors'){
				$this->session->set_flashdata('message_hasil_pemeriksaan', $arr['message']);
				redirect('admin/hasil_tinjau_permohonan/'.base64_encode($id_izin),'refresh');
			}

			$log_hit_status_siki_portal['id_izin'] = $id_izin;
			$log_hit_status_siki_portal['status'] = $arr['status'];
			$log_hit_status_siki_portal['message'] = $arr['message'];
			$log_hit_status_siki_portal['log'] = $log;

			$this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);
			/////////////////////// / Hit Status ke API SIKI & PORTAL ///////////////

		}elseif($this->security->xss_clean($this->input->post('hasil_tinjau_permohonan')) == '11'){
			#Get Data Perbaikan
			$get_data_perbaikan = $this->admin_model->get_data_perbaikan($id_izin);
			$get_data_lsp = $this->api_model->get_token();

			#email kirim user hasil generate
			$from = $this->config->item('smtp_user');
			$to = $get_data_personal->email;
			$subject = 'Notifikasi Hasil Validasi Permohonan SKK';
			
			$data = array(
				"id_izin" => $id_izin,
				"get_data_perbaikan" => $get_data_perbaikan,
				"get_data_lsp" => $get_data_lsp,
			);
			$message = $this->load->view('Sendmail/11-dokumen_perbaikan_permohonan',$data,true);

			$this->email->set_newline("\r\n");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->cc($get_data_lsp->cc_email);
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send()) {
				echo '';
			} else {
				show_error($this->email->print_debugger());
			}  

			/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
			//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				'kd_status' => '11',
				'keterangan' => 'Dokumen Tidak Lengkap'
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$arr = json_decode(curl_exec($ch), true);

			$log_hit_status_siki_portal['id_izin'] = $id_izin;
			$log_hit_status_siki_portal['status'] = $arr['status'];
			$log_hit_status_siki_portal['message'] = $arr['message'];
			$log_hit_status_siki_portal['log'] = $log;

			$this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);

			// Reset Data untuk Keperluan Perbaikan
			$this->admin_model->reset_data($id_izin);

			/////////////////////// / Hit Status ke API SIKI & PORTAL ///////////////
		}elseif($this->security->xss_clean($this->input->post('hasil_tinjau_permohonan')) == '90'){
			/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
			//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				'kd_status' => '90',
				'keterangan' => $this->security->xss_clean($this->input->post("catatan"))
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$arr = json_decode(curl_exec($ch), true);

			echo "<script>alert('".$arr['keterangan']."');</script>";

			$log_hit_status_siki_portal['id_izin'] = $id_izin;
			$log_hit_status_siki_portal['status'] = $arr['status'];
			$log_hit_status_siki_portal['message'] = $arr['message'];
			$log_hit_status_siki_portal['log'] = $log;

			$this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);
		}

		$this->session->set_flashdata('success-tinjau-permohonan','Hasil Tinjau Permohonan');
		header("location:".base_url('admin/list_tinjau_permohonan'));
	}
	################################### / Tinjau Permohonan #######################################
	
	################################## Pembayaran #####################################
	public function list_tagihan_pembayaran(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$get_list_tagihan_pembayaran = $this->admin_model->get_list_tagihan_pembayaran();

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'get_list_tagihan_pembayaran'=>$get_list_tagihan_pembayaran,
		);
	   $this->template->load('menu','Admin/pembayaran/list_tagihan_pembayaran', $this->data);
	}

	public function kirim_invoice($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");


		// Insert Log History Permohonan Selesai Tinjau Permohonan Status 10 / 11
		$data_tinjau['id_izin'] = $id_izin;
		$data_tinjau['kode_status'] = '30';
		$data_tinjau['log'] = date("Y-m-d H:i:s");
		$data_tinjau['username'] =  $this->session->userdata('username');
		$this->admin_model->insert_log_history_permohonan($data_tinjau);


		/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
			//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				'kd_status' => '30',
				'keterangan' => 'Verifikasi Pembayaran'
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$arr = json_decode(curl_exec($ch), true);

			$log_hit_status_siki_portal['id_izin'] = $id_izin;
			$log_hit_status_siki_portal['status'] = $arr['status'];
			$log_hit_status_siki_portal['message'] = $arr['message'];
			$log_hit_status_siki_portal['log'] = $log;

			$this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);
		/////////////////////// / Hit Status ke API SIKI & PORTAL ///////////////

		/// Send Mail ke Pemohon //
			$get_data_personal = $this->admin_model->get_data_personal($id_izin);
			$get_data_lsp = $this->api_model->get_token();

			$from = $this->config->item('smtp_user');
			$to = $get_data_personal->email;
			$subject = 'Pemberitahuan Permohonan SKK';

			$data = array(
				"id_izin" => $id_izin,
				"nama" => $get_data_personal->email,
				"get_data_lsp" => $get_data_lsp,
			);
			$message = $this->load->view('Sendmail/30-verifikasi_pembayaran',$data,true);;

			$this->email->set_newline("\r\n");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->cc($get_data_lsp->cc_email);
			$this->email->subject($subject);
			$this->email->message($message);

			if ($this->email->send()) {
				echo '';
			} else {
				show_error($this->email->print_debugger());
			}
		/// /Send Mail ke Pemohon //


		header("location:".base_url('admin/list_tagihan_pembayaran'));
	}

	################################## /Pembayaran ####################################


	#################### Penunjukan Asesor #########################################
	public function list_penunjukan_asesor(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$get_list_penunjukan_asesor = $this->admin_model->get_list_penunjukan_asesor();

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'get_list_penunjukan_asesor' => $get_list_penunjukan_asesor,
		);
	   $this->template->load('menu','Admin/penunjukan_asesor/list_penunjukan_asesor', $this->data);
	}

	public function penunjukan_asesor($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);

		## Info Data Permohonan
		$info_data_permohonan = $this->admin_model->info_data_permohonan($id_izin);
		$get_data_personal_permohonan = $this->admin_model->get_data_personal_permohonan($id_izin);
		$get_data_klasifikasi_kualifikasi_permohonan = $this->admin_model->get_data_klasifikasi_kualifikasi_permohonan($id_izin);
		$get_data_jadwal_asesmen = $this->admin_model->get_data_jadwal_asesmen();
		$get_list_asesor = $this->admin_model->get_list_asesor($get_data_klasifikasi_kualifikasi_permohonan[0]['subklasifikasi'],$get_data_klasifikasi_kualifikasi_permohonan[0]['jenjang']);
		
		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'info_data_permohonan' => $info_data_permohonan,
			'id_izin' => $id_izin,
			'get_data_personal_permohonan' => $get_data_personal_permohonan,
			'get_list_asesor' => $get_list_asesor,
			'get_data_jadwal_asesmen' => $get_data_jadwal_asesmen,
		);
	   $this->template->load('menu','Admin/penunjukan_asesor/penunjukan_asesor', $this->data);
	}

	public function insert_penunjukan_asesor($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);

		// // // Insert Peserta ke Jadwal BNSP // // //
		$get_data_pemohon_peserta_dalam_jadwal_asesmen = $this->admin_model->get_data_pemohon_peserta_dalam_jadwal_asesmen($id_izin);
		$get_detail_jadwal_asesmen = $this->admin_model->get_detail_jadwal_asesmen($this->security->xss_clean($this->input->post('kode_jadwal_asesmen')));
		$get_data_asesor = $this->admin_model->get_data_asesor($this->security->xss_clean($this->input->post('asesor1')));
		$token_bnsp = $this->api_model->get_token_bnsp();
		
		//API Url
		$url = $token_bnsp->host."jadwal/peserta";
		
		//Initiate cURL.
		$ch = curl_init($url);

		// kode master
		if($get_data_pemohon_peserta_dalam_jadwal_asesmen->jenis_kelamin == 'Pria'){
			$jenis_kelamin = 1;
		}else{
			$jenis_kelamin = 2;
		}

		//The JSON data.
		$jsonData = array(
			"jadwal_id" => $get_detail_jadwal_asesmen->id,
			"tuk_id" => $get_detail_jadwal_asesmen->id_tuk,
			"asesor_id" => $get_data_asesor->id_asesor_bnsp_penunjukan,
			"nik" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->nik,
			"nib" => null,
			"nama" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->nama,
			"tempat_lahir" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->tempat_lahir,
			"tanggal_lahir" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->tanggal_lahir,
			"jenis_kelamin" => $jenis_kelamin,
			"alamat" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->alamat,
			"kota_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_kabupaten_bnsp,
			"provinsi_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_propinsi_bnsp,
			"negara_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->negara,
			"telepon" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->telepon,
			"email" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->email,
			"jenis_mohon" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->jenis_permohonan,
			"skema_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->skema_id,
			"keterangan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->keterangan_skema,
			"jenjang_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->jenjang_id,
			"prodi" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->program_studi,
			"no_ijasah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->no_ijazah,
			"tanggal_ijazah" => null,
			"tahun_lulus" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->tahun_lulus,
			"kota_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_kabupaten_bnsp_sekolah,
			"prov_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_propinsi_bnsp_sekolah,
			"negara_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->negara_sekolah,
			"nama_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->nama_sekolah_perguruan_tinggi,
			"pekerjaan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_pekerjaan,
			"instansi_pekerjaan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->pekerjaan_sekarang_perusahaan,
			"jabatan_pekerjaan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->pekerjaan_sekarang_jabatan,
			"file_foto" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->pas_foto,
			"file_ktp" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->ktp,
			"file_nib" => null,
			"file_ijazah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->scan_ijazah_legalisir
		);

		//Encode the array into JSON.
		$jsonDataEncoded = json_encode($jsonData);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$responseBody = json_decode(curl_exec($ch), true);

		if($responseBody['code'] == "ERR"){
			echo "<script>alert('".$responseBody['message']."')</script>";
			redirect('admin/penunjukan_asesor/'.base64_encode($id_izin),'refresh');
		}

		// if ($responseBody["code"]="ERR"){
		// 	echo '<script>alert("Insert Peserta ke BNSP Gagal silahkan kontak Admin IT")</script>';
		// 	redirect('admin/list_penunjukan_asesor','refresh');
		// }else{
		// 	// Berhasil	
		// }s
	// // // / Insert Peserta ke Jadwal BNSP // // //

		// Generate No Surat Tugas
		$get_data_bast_terakhir = $this->admin_model->get_data_bast_terakhir();
		if(!empty($get_data_bast_terakhir->no_surat_tugas)){
			$no_surat_tugas = substr($get_data_bast_terakhir->no_surat_tugas,1,7);
		}else{
			$no_surat_tugas = 0;
		}
		$no_surat_tugas = $get_data_bast_terakhir->no_surat_tugas+1;
		$no_surat_tugas = sprintf("%07s",$no_surat_tugas);
		$no_surat_tugas = $no_surat_tugas;
		// Generate No Surat Tugas

		// Insert Data Penunjukan Asesor ke DB Lokal
		// Asesor 1
		$penunjukan_asesor = array(
			'id_izin' => $id_izin,
			'id_asesor' => $this->security->xss_clean($this->input->post('asesor1')),
			'user_penunjuk' => $this->session->userdata('username'),
			'kode_jadwal_asesmen' => $this->security->xss_clean($this->input->post('kode_jadwal_asesmen')),
			'no_surat_tugas' => $no_surat_tugas,
			'log' => date("Y-m-d H:i:s"),
			'asesor' => '1',
		);
		$this->db->replace('data_penunjukan_asesor', $penunjukan_asesor);

		// Asesor 2
		$penunjukan_asesor = array(
			'id_izin' => $id_izin,
			'id_asesor' => $this->security->xss_clean($this->input->post('asesor2')),
			'user_penunjuk' => $this->session->userdata('username'),
			'kode_jadwal_asesmen' => $this->security->xss_clean($this->input->post('kode_jadwal_asesmen')),
			'no_surat_tugas' => $no_surat_tugas,
			'log' => date("Y-m-d H:i:s"),
			'asesor' => '2',
		);
		$this->db->replace('data_penunjukan_asesor', $penunjukan_asesor);

		// // // Surat Tugas Asesor ke BNSP // // //
		//API Url
		$get_detail_jadwal_asesmen = $this->admin_model->get_detail_jadwal_asesmen($this->security->xss_clean($this->input->post('kode_jadwal_asesmen')));
		$get_data_asesor = $this->admin_model->get_data_asesor($this->security->xss_clean($this->input->post('asesor1')));
		$url = $token_bnsp->host."jadwal/asesor/surat-tugas";
			
		//Initiate cURL.
		$ch = curl_init($url);

		//The JSON data.
		$jsonData = array(
			"jadwal_id" =>  $get_detail_jadwal_asesmen->id,
			"asesor_id" => $get_data_asesor->id_asesor_bnsp,
			"url_surat_tugas" => base_url('berkas/surat_tugas_asesor/').base64_encode($id_izin)
		);

		//Encode the array into JSON.
		$jsonDataEncoded = json_encode($jsonData);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//Execute the request
		$result = curl_exec($ch);
		
		// // // / Surat Tugas Asesor ke BNSP // // //


		/// Send Mail ke Asesor 1//
		$get_data_asesor = $this->admin_model->get_data_asesor($this->security->xss_clean($this->input->post('asesor1')));
		$get_data_lsp = $this->api_model->get_token();

		$from = $this->config->item('smtp_user');
		$to = $get_data_asesor->email;
		$subject = 'Pemberitahuan Permohonan SKK';

		$data = array(
			"nama_asesor" => $get_data_asesor->nama,
			"id_izin" => $id_izin,
			"get_data_lsp" => $get_data_lsp,
		);
		$message = $this->load->view('Sendmail/penunjukan_asesor',$data,true);;

		$this->email->set_newline("\r\n");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->cc($get_data_lsp->cc_email);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			echo '';
		} else {
			show_error($this->email->print_debugger());
		}
		/// /Send Mail ke Asesor 1//
		
		/// Send Mail ke Asesor 2//
		$get_data_asesor = $this->admin_model->get_data_asesor($this->security->xss_clean($this->input->post('asesor2')));
		$get_data_lsp = $this->api_model->get_token();

		$from = $this->config->item('smtp_user');
		$to = $get_data_asesor->email;
		$subject = 'Pemberitahuan Permohonan SKK';

		$data = array(
			"nama_asesor" => $get_data_asesor->nama,
			"id_izin" => $id_izin,
			"get_data_lsp" => $get_data_lsp,
		);
		$message = $this->load->view('Sendmail/penunjukan_asesor',$data,true);;

		$this->email->set_newline("\r\n");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->cc($get_data_lsp->cc_email);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			echo '';
		} else {
			show_error($this->email->print_debugger());
		}
		/// /Send Mail ke Asesor 2//

		/// Send Mail ke User //
		$get_data_personal_permohonan = $this->admin_model->get_data_personal_permohonan($id_izin);
		$get_data_penunjukan_asesor = $this->admin_model->get_data_penunjukan_asesor($id_izin);
		$get_data_lsp = $this->api_model->get_token();
		

		$from = $this->config->item('smtp_user');
		$to = $get_data_personal_permohonan[0]['email'];
		$subject = 'Pemberitahuan Permohonan SKK';

		$data = array(
			"id_izin" => $id_izin,
			"get_data_personal_permohonan" => $get_data_personal_permohonan,
			"get_data_penunjukan_asesor" => $get_data_penunjukan_asesor,
		);
		$message = $this->load->view('Sendmail/info_jadwal_asesmen',$data,true);;

		$this->email->set_newline("\r\n");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->cc($get_data_lsp->cc_email);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			echo '';
		} else {
			show_error($this->email->print_debugger());
		}
		/// /Send Mail ke User //

		$this->session->set_flashdata('success','Penunjukan Asesor Berhasil');
		redirect('admin/list_penunjukan_asesor','refresh');
	}
	#################### / Penunjukan Asesor #######################################
	
	
	#################### Master #########################################
	/// TUK
	public function master_tuk(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		# Get Data Master
		$get_master_tuk = $this->master_model->get_master_tuk();
		
		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_master_tuk' => $get_master_tuk,
		);
		$this->template->load('menu','Master/master_tuk', $this->data);
	}

	public function update_data_tuk_bnsp(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$token_bnsp = $this->api_model->get_token_bnsp();
		## Set Configuration Header.
		$headers = array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization
		);
		## Set Variable From POST Kategori

		## Set URL Source Data ##
		$baseUrl = $token_bnsp->host."tuk";

		//Set the headers that we want our cURL client to use.
		$ch = curl_init();
		//Set the headers that we want our cURL client to use.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		$responseBody = curl_exec($ch);
		$responseInfo = curl_getinfo($ch);
		curl_close($ch);

		$array = json_decode($responseBody, True);
	
		for ($i = 0; $i < count($array['data']); $i++){
			$update_tuk_bnsp['id'] = $array['data'][$i]['id'];
			$update_tuk_bnsp['id_lsp'] = $array['data'][$i]['idlsp'];
			$update_tuk_bnsp['kode'] = $array['data'][$i]['kode'];
			$update_tuk_bnsp['jenis_tuk'] = $array['data'][$i]['idjenis'];
			$update_tuk_bnsp['nama_tuk'] = $array['data'][$i]['nama'];
			$update_tuk_bnsp['alamat'] = $array['data'][$i]['alamat'];
			$update_tuk_bnsp['telp'] = $array['data'][$i]['telp'];
			$update_tuk_bnsp['hp'] = $array['data'][$i]['hp'];
			$update_tuk_bnsp['fax'] = $array['data'][$i]['fax'];
			$update_tuk_bnsp['email'] = $array['data'][$i]['email'];
			$update_tuk_bnsp['keterangan'] = $array['data'][$i]['keterangan'];
			$update_tuk_bnsp['id_propinsi'] = $array['data'][$i]['provinsi']['kode'];
			$update_tuk_bnsp['id_kota'] = $array['data'][$i]['kota']['kode'];
			$update_tuk_bnsp['masa_berlaku_tuk'] = '2030-12-31';
			$this->db->replace('master_tuk', $update_tuk_bnsp);
		}

		######### Sync TUK SIKI #####
		$token = $this->api_model->get_token();
		$baseUrl = $token->host . "/siki-api/v2/tuk?id_lsp=".$token->id_lsp;

		## Set Configuration Header.
		$headers = array(
			'Content-Type: application/json',
			'token:'.$token->token
		);

		$baseUrl = $token->host."/siki-api/v2/tuk?id_lsp=".$token->id_lsp;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		$responseBody = curl_exec($ch);
		$responseInfo = curl_getinfo($ch);
		curl_close($ch);

		$array = json_decode($responseBody, True);
		for ($i = 0; $i < count($array['data']); $i++){
			$update_tuk_siki['id'] = $array['data'][$i]['id'];
			$update_tuk_siki['id_lsp'] = $array['data'][$i]['id_lsp'];
			$update_tuk_siki['kode_tuk'] = $array['data'][$i]['kode_tuk'];
			$update_tuk_siki['jenis_tuk'] = $array['data'][$i]['jenis_tuk'];
			$update_tuk_siki['nama_tuk'] = $array['data'][$i]['nama_tuk'];
			$update_tuk_siki['alamat'] = $array['data'][$i]['alamat'];
			$this->db->replace('master_tuk_siki', $update_tuk_siki);
		}

		echo "<script>alert('Data TUK Berhasil Di Update');</script>";
		redirect('admin/master_tuk','refresh');
	}

	public function tambah_tuk(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$token_bnsp = $this->api_model->get_token_bnsp();


		//config upload file izin
		$comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$shfl = str_shuffle($comb);
		$filename_unik_karakter = SUBSTR($shfl,0,10);

		$file_name = "file_izin-".md5($filename_unik_karakter)."_". date("Y-m-d");
		$config['upload_path']          = FCPATH.'uploads/master/tuk/';
		$config['allowed_types']        = 'jpg|jpeg|png|pdf';
		$config['file_name']            = $file_name;
		$config['overwrite']            = true;
		$config['max_size']             = 5120; // 10MB

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload("file_ijin_tuk")){
			$file_ijin_tuk = $this->upload->data();
			$filename_ijin_tuk = $file_ijin_tuk['file_name'];
	
            $this->session->set_flashdata('success','Berhasil Menambahkan');

        }else{
            $this->session->set_flashdata('gagal','Gagal Upload File Size Terlalu Besar dari 10 Mb');
        }

		// Insert Data Bukti Relavan
		$data_bukti_relavan['jenis_tuk'] = '1';
		$data_bukti_relavan['id_lsp'] = $token_bnsp->id_lsp_bnsp;
		$data_bukti_relavan['nama_tuk'] = $this->security->xss_clean($this->input->post('nama_tuk'));
		$data_bukti_relavan['alamat'] = $this->security->xss_clean($this->input->post('alamat'));
		$data_bukti_relavan['file_izin_tuk'] = $filename_ijin_tuk;
		$data_bukti_relavan['masa_berlaku_tuk'] = $this->security->xss_clean($this->input->post('masa_berlaku_tuk'));
		$this->db->insert('master_tuk', $data_bukti_relavan);
		
		redirect('admin/master_tuk','refresh');
	}

	public function delete_tuk($id_tuk){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$this->db->delete('master_tuk', array('id' => $id_tuk));
		redirect('admin/master_tuk','refresh');
	}

/// /TUK

/// Asesor
	public function master_asesor(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		# Get Data Master
		$get_master_asesor = $this->master_model->get_master_asesor();
		$get_master_subklasifikasi = $this->master_model->get_master_subklasifikasi();

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_master_asesor' => $get_master_asesor,
			'get_master_subklasifikasi' => $get_master_subklasifikasi,
		);
		$this->template->load('menu','Master/master_asesor', $this->data);
	}

	public function tambah_asesor(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		// Insert Data Asesor
		$data['id_asesor'] = $this->security->xss_clean($this->input->post('id_asesor'));
		$data['nama'] = $this->security->xss_clean($this->input->post('nama_asesor'));
		$data['nik'] = $this->security->xss_clean($this->input->post('nik'));
		$data['no_hp'] = $this->security->xss_clean($this->input->post('no_telepon'));
		$data['email'] = $this->security->xss_clean($this->input->post('email'));
		$data['klasifikasi'] = substr($this->security->xss_clean($this->input->post('subklasifikasi')), 0, 2);
		$data['subklasifikasi'] = $this->security->xss_clean($this->input->post('subklasifikasi'));
		$data['jenjang'] = $this->security->xss_clean($this->input->post('jenjang'));
		$data['no_reg_bnsp'] = $this->security->xss_clean($this->input->post('no_reg_bnsp'));
		$data['masa_berlaku_sertifikat'] = $this->security->xss_clean($this->input->post('masa_berlaku_sertifikat'));
		$this->db->replace('master_asesor', $data);


		// Generate User Asesor
		$comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$shfl = str_shuffle($comb);
		$pwd = SUBSTR($shfl,0,8);

		$user_login['nik'] = $this->security->xss_clean($this->input->post('nik'));
		$user_login['username'] = $this->security->xss_clean($this->input->post('id_asesor'));
		$user_login['password'] = md5("asesor");
		$user_login['email'] = $this->security->xss_clean($this->input->post('email'));
		$user_login['user_level'] = 'Asesor';
		$user_login['status'] = '1';
		$this->db->insert('user_login', $user_login);
		
		redirect('admin/master_asesor','refresh');
	}

	public function aktivasi_asesor($no_reg_asesor_bnsp){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		#Get Data Master
		$token_bnsp = $this->api_model->get_token_bnsp();


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://konstruksi.bnsp.go.id/api/v1/asesor?no_reg='.$no_reg_asesor_bnsp,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		// echo $response;

		$result = json_decode($response, True);

		if($result['code'] == "OK"){
			// Update Data No Rg
			$data = array(
				'id_asesor_bnsp' => $result['data']['id_asesor'],
				'id_asesor_bnsp_penunjukan' => $result['data']['id'],
			);
			$where = array(
				'no_reg_bnsp' => urldecode($no_reg_asesor_bnsp)
			);
			$this->admin_model->update_data($where,$data,'master_asesor');

			echo '<script>alert("Asesor Berhasil di Aktivasi")</script>';
		}elseif($result['code'] == "ERR"){
			echo '<script>alert("'.$result['message'].' - Pastikan No Registrasi Asesor Sesuai dengan diBNSP & Sertifikat Kompetensi Asesor Telah diUpload di BNSP")</script>';
		}

		redirect('admin/master_asesor','refresh');
	}

	/////// Jadwal Asesmen /////////
	public function jadwal_asesmen(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		# Get Data Master
		$get_data_jadwal_asesmen = $this->master_model->get_data_jadwal_asesmen();
		$get_master_tuk = $this->master_model->get_master_tuk();
		$get_master_jenis_jadwal = $this->master_model->master_bnsp_jenis_jadwal();
		$get_master_jenis_anggaran = $this->master_model->master_bnsp_jenis_anggaran();
		$get_master_jabatan_kerja = $this->master_model->get_master_jabatan_kerja();

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_data_jadwal_asesmen' => $get_data_jadwal_asesmen,
			'get_master_tuk' => $get_master_tuk,
			'get_master_jenis_jadwal' => $get_master_jenis_jadwal,
			'get_master_jenis_anggaran' => $get_master_jenis_anggaran,
			'get_master_jabatan_kerja' => $get_master_jabatan_kerja,
		);
		$this->template->load('menu','Master/jadwal_asesmen', $this->data);
	}

	public function buat_jadwal_asesmen(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$token_bnsp = $this->api_model->get_token_bnsp();
		$get_data_detail_jabker = $this->master_model->get_data_detail_jabker($this->security->xss_clean($this->input->post('skema')));
		
		//API Url
		$url = $token_bnsp->host."jadwal";
		
		//Initiate cURL.
		$ch = curl_init($url);

		//The JSON data.
		$jsonData = array(
			"tuk_id" => $this->security->xss_clean($this->input->post('TUK')),
			"jenis_jadwal" => $this->security->xss_clean($this->input->post('jenis_jadwal')),
			"jenis_anggaran" => $this->security->xss_clean($this->input->post('jenis_anggaran')),
			"nama_jadwal" => $this->security->xss_clean($this->input->post('nama_jadwal')),
			"klasifikasi_id" => $get_data_detail_jabker->lsp_id_klasifikasi,
			"subklasifikasi_id" => $get_data_detail_jabker->lsp_sub_klasifikasi_id,
			"tanggal_mulai" => $this->security->xss_clean($this->input->post('tanggal_mulai')),
			"tanggal_selesai" => $this->security->xss_clean($this->input->post('tanggal_selesai')),
			"keterangan" => $this->security->xss_clean($this->input->post('keterangan')),
			"jabker_id" => [$this->input->post('skema')]
		);

		//Encode the array into JSON.
		$jsonDataEncoded = json_encode($jsonData);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//Execute the request
		$result = curl_exec($ch);
		$arr = json_decode($result, True);

		if($arr['code'] == "ERR"){
			echo "<script>
			alert('".$arr['message']."');
			window.location.href='".base_url('admin/jadwal_asesmen')."';
			</script>";
		}else{
			redirect('admin/update_jadwal_asesmen','refresh');
		}
		//Execute the request to array
		// $arr = json_decode(curl_exec($ch), true);


	}

	public function konfirm_jadwal($id_jadwal){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$token_bnsp = $this->api_model->get_token_bnsp();

		//API Url
		$url = $token_bnsp->host."jadwal/confirm";
					
		//Initiate cURL.
		$ch = curl_init($url);

		//The JSON data.
		$jsonData = array(
			"jadwal_id" => $id_jadwal
		);

		//Encode the array into JSON.
		$jsonDataEncoded = json_encode($jsonData);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//Execute the request
		$result = curl_exec($ch);
		$arr = json_decode($result, True);

		if($arr['code'] == "ERR"){
			echo "<script>alert('".$arr['message']."')</script>";
		}

		// Update Status Konfirm Jadwal di DB Lokal
		$data = array(
			'status_jadwal' => '456',
		);
		$where = array(
			'id' => $id_jadwal
		);
		$this->admin_model->update_data($where,$data,'data_jadwal_asesmen');


		redirect('admin/update_jadwal_asesmen','refresh');
	}

	public function konfirm_terima_blanko($id_jadwal){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$token_bnsp = $this->api_model->get_token_bnsp();

		//API Url
		$url = $token_bnsp->host."jadwal/cetak";
					
		//Initiate cURL.
		$ch = curl_init($url);

		//The JSON data.
		$jsonData = array(
			"jadwal_id" => $id_jadwal
		);

		//Encode the array into JSON.
		$jsonDataEncoded = json_encode($jsonData);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//Execute the request
		$result = curl_exec($ch);


		// Update Status Konfirm Jadwal di DB Lokal
		$data = array(
			'status_jadwal' => '27',
		);
		$where = array(
			'id' => $id_jadwal
		);
		$this->admin_model->update_data($where,$data,'data_jadwal_asesmen');

		redirect('admin/update_jadwal_asesmen','refresh');
	}

	public function update_jadwal_asesmen(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##


		$token_bnsp = $this->api_model->get_token_bnsp();
		## Set Configuration Header.
		$headers = array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization
		);
		## Set Variable From POST Kategori

		## Set URL Source Data ##
		$baseUrl = $token_bnsp->host."jadwal";

		//Set the headers that we want our cURL client to use.
		$ch = curl_init();
		//Set the headers that we want our cURL client to use.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		$responseBody = curl_exec($ch);
		$responseInfo = curl_getinfo($ch);
		curl_close($ch);

		$array = json_decode($responseBody, True);
	
		for ($i = 0; $i < count($array['data']); $i++){
			$update_jadwal_asesmen['id'] = $array['data'][$i]['id'];
			$update_jadwal_asesmen['id_lsp'] = $array['data'][$i]['id_lsp'];
			$update_jadwal_asesmen['id_tuk'] = $array['data'][$i]['id_tuk'];
			$update_jadwal_asesmen['id_jenis_jadwal'] = $array['data'][$i]['id_jns_jadwal'];
			$update_jadwal_asesmen['id_jenis_anggaran'] = $array['data'][$i]['id_jns_anggaran'];
			$update_jadwal_asesmen['kode_jadwal'] = $array['data'][$i]['kode_jadwal'];
			$update_jadwal_asesmen['nama_jadwal'] = $array['data'][$i]['nama_jadwal'];
			$update_jadwal_asesmen['tanggal_mulai'] = $array['data'][$i]['tanggal_mulai'];
			$update_jadwal_asesmen['tanggal_selesai'] = $array['data'][$i]['tanggal_selesai'];
			$update_jadwal_asesmen['id_klasifikasi'] = $array['data'][$i]['id_klas'];
			$update_jadwal_asesmen['id_subklasifikasi'] = $array['data'][$i]['id_sub_klas'];
			$update_jadwal_asesmen['keterangan'] = $array['data'][$i]['keterangan'];
			$update_jadwal_asesmen['status_jadwal'] = $array['data'][$i]['status_jadwal'];
			$update_jadwal_asesmen['created_at'] = $array['data'][$i]['created_at'];
			$update_jadwal_asesmen['update_at'] = $array['data'][$i]['updated_at'];
			$update_jadwal_asesmen['deleted_at'] = $array['data'][$i]['deleted_at'];
			$this->db->replace('data_jadwal_asesmen', $update_jadwal_asesmen);
		}

		echo "<script>alert('Data Jadwal Asesmen Berhasil di Update/Syncron dengan BNSP');</script>";
		redirect('admin/jadwal_asesmen','refresh');
	}

	#################### / Master #######################################

	public function list_selesai_penetapan(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$get_data_selesai_penetapan = $this->admin_model->get_data_selesai_penetapan();

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_data_selesai_penetapan' => $get_data_selesai_penetapan,
		);
		$this->template->load('menu','Admin/selesai_penetapan/list_selesai_penetapan', $this->data);
	}

	public function get_blanko_bnsp($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");
        $token_bnsp = $this->api_model->get_token_bnsp();
		$get_data_pencatatan = $this->admin_model->get_data_pencatatan($id_izin);
		$get_detail_jadwal_asesmen_per_permohonan = $this->admin_model->get_detail_jadwal_asesmen_per_permohonan($id_izin);
		$get_data_rekomendasi_asesor_lpjk = $this->admin_model->get_data_rekomendasi_asesor_lpjk($id_izin);
		$get_bukti_dokumentasi_asesmen = $this->asesor_model->get_bukti_dokumentasi_asesmen($id_izin);
		$get_data_pelaporan_asesor = $this->admin_model->get_data_pelaporan_asesor($id_izin);
		$token = $this->api_model->get_token();
		


		## Set Configuration Header.
		$headers = array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization
		);
		## Set Variable From POST Kategori

		## Set URL Source Data ##
		$baseUrl = $token_bnsp->host."jadwal/blanko?jadwal_id=".$get_detail_jadwal_asesmen_per_permohonan->id_jadwal_asesmen;

		//Set the headers that we want our cURL client to use.
		$ch = curl_init();
		//Set the headers that we want our cURL client to use.
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		$responseBody = curl_exec($ch);
		$responseInfo = curl_getinfo($ch);
		curl_close($ch);

		$array = json_decode($responseBody, True);
		// Update Data Blanko
		if($array['code'] !== 'ERR'){
			for ($i = 0; $i < count($array['data']); $i++){
				if($array['data'][$i]['nik'] == $get_data_pencatatan->nik){
					if($array['data'][$i]['nomor_blanko'] == null){
						echo "<script>alert('Permohonan Blanko Belum di Approve');</script>";
					}else{
						///////////// Pemenuhan Rekomendasi Asesor ke LPJK V2
						$curl = curl_init();

						if($get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor == "Kompeten"){
							$rekomendasi = "K";
						}elseif($get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor == "Belum Kompeten"){
							$rekomendasi = "BK";
						}

						// Metode Uji
						if($get_data_rekomendasi_asesor_lpjk->metode_uji == "1"){
							$metode_uji = 'observasi';
							$uji_praktek_atau_observasi_lapangan = '1';
							$uji_tulis = '1';
							$uji_lisan = '0';
							$wawancara = '0';
						}elseif($get_data_rekomendasi_asesor_lpjk->metode_uji == "2"){
							$metode_uji = 'observasi';
							$uji_praktek_atau_observasi_lapangan = '1';
							$uji_tulis = '1';
							$uji_lisan = '1';
							$wawancara = '0';
						}elseif($get_data_rekomendasi_asesor_lpjk->metode_uji == "3"){
							$metode_uji = 'portofolio';
							$uji_praktek_atau_observasi_lapangan = '0';
							$uji_tulis = '0';
							$uji_lisan = '0';
							$wawancara = '1';
						}

						if($uji_tulis == "1"){
							$url_form_uji_tulis = base_url("berkas/asesmen/").base64_encode($id_izin);
							$tgl_pelaksaaan_form_uji_tulis = $get_data_rekomendasi_asesor_lpjk->tgl_uji;
						}elseif($uji_tulis == "0"){
							$url_form_uji_tulis = "";
							$tgl_pelaksaaan_form_uji_tulis = "";
						}
						
						if($uji_lisan == "1"){
							$url_form_uji_lisan = base_url("berkas/asesmen/").base64_encode($id_izin);
							$tgl_pelaksaaan_form_uji_lisan = $get_data_rekomendasi_asesor_lpjk->tgl_uji;
						}elseif($uji_lisan == "0"){
							$url_form_uji_lisan = "";
							$tgl_pelaksaaan_form_uji_lisan = "";
						}
						
						if($wawancara == "1"){
							$url_form_wawancara = base_url("berkas/asesmen/").base64_encode($id_izin);
							$tgl_pelaksaaan_form_wawancara = $get_data_rekomendasi_asesor_lpjk->tgl_uji;
						}elseif($wawancara == "0"){
							$url_form_wawancara = "";
							$tgl_pelaksaaan_form_wawancara = "";
						}

						if($uji_lisan == "1" || $uji_tulis == "1"){
							$url_form_uji_praktek_atau_observasi_lapangan = base_url("berkas/asesmen/").base64_encode($id_izin);
							$tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan = $get_data_rekomendasi_asesor_lpjk->tgl_uji;
						}else{
							$url_form_uji_praktek_atau_observasi_lapangan = "";
							$tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan = "";
						}

						$jsonData_rekom_asesor = array(
							"id_asesor" => $get_data_rekomendasi_asesor_lpjk->id_asesor,
							"rekomendasi" => $rekomendasi,
							"catatan" => $get_data_rekomendasi_asesor_lpjk->catatan,
							"tgl_surat_tugas" => $get_data_rekomendasi_asesor_lpjk->tgl_surat_tugas,
							"no_surat_tugas" => $get_data_rekomendasi_asesor_lpjk->no_surat_tugas,
							"kode_tuk" => $get_data_rekomendasi_asesor_lpjk->kode_tuk,
							"nama_tuk" => $get_data_rekomendasi_asesor_lpjk->nama_tuk,
							"tgl_uji" => $get_data_rekomendasi_asesor_lpjk->tgl_uji,
							"tgl_selesai_uji" => $get_data_rekomendasi_asesor_lpjk->tgl_uji_selesai,
							"metode_uji" => $metode_uji,
							"uji_praktek_atau_observasi_lapangan" => $uji_praktek_atau_observasi_lapangan,
							"uji_tulis" => $uji_tulis,
							"uji_lisan" => $uji_lisan,
							"wawancara" => $wawancara,
							"penyelenggaraan_uji" => '1',
							"url_surat_tugas" => base_url("berkas/surat_tugas_asesor/").base64_encode($id_izin),
							"url_surat_rekomendasi_akhir" => base_url("berkas/ba_rekomendasi_asesor/").base64_encode($id_izin),
							"url_apl01" => base_url("cetak_form_asesmen/apl01/").base64_encode($id_izin),
							"url_apl02" => base_url("cetak_form_asesmen/apl02/").base64_encode($id_izin),
							"url_dokumentasi_asesmen" => base_url("uploads/file_asesmen/bukti_dokumentasi_asesmen/").$get_bukti_dokumentasi_asesmen->file,
							"url_form_uji_tulis" => $url_form_uji_tulis,
							"tgl_pelaksaaan_form_uji_tulis" => $tgl_pelaksaaan_form_uji_tulis,
							"url_form_uji_lisan" => $url_form_uji_lisan,
							"tgl_pelaksaaan_form_uji_lisan" => $tgl_pelaksaaan_form_uji_lisan,
							"url_form_wawancara" => $url_form_wawancara,
							"tgl_pelaksaaan_form_wawancara" => $tgl_pelaksaaan_form_wawancara,
							"tgl_verifikasi_apl01" => $get_data_pelaporan_asesor->tgl_verifikasi_apl01,
							"tgl_verifikasi_apl02" => $get_data_pelaporan_asesor->tgl_verifikasi_apl02,
							"tgl_dokumentasi" => $get_data_rekomendasi_asesor_lpjk->tgl_uji,
							"url_form_uji_praktek_atau_observasi_lapangan" => $url_form_uji_praktek_atau_observasi_lapangan,
							"tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan" => $tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan,
						);

						$jsonData_rekom_asesor_encode = json_encode($jsonData_rekom_asesor);

						curl_setopt_array($curl, array(
						CURLOPT_URL => $token->host.'/siki-api/v2/asesor-lsp-penugasan/'.$id_izin,
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => $jsonData_rekom_asesor_encode,
						CURLOPT_HTTPHEADER => array(
							'token: ' .$token->token,
							'Content-Type: application/json'
						),
						));
						$response = curl_exec($curl);
						$arr = json_decode(curl_exec($curl), true);

						curl_close($curl);
						print_r($arr);
						## Cek Asesor jika tidak terdaftar
							if(substr($arr['message'],-15) == 'tidak terdaftar'){
								if(substr($arr['message'],-15) == 'tidak terdaftar'){
									$this->session->set_flashdata('message_pelaporan_asesor', $arr['message'].' Pastikan Asesor tersebut telah tercatat di Lisensi LPJK');
									redirect('admin/list_selesai_penetapan','refresh');
								}
							}
						// Pemenuhan Penetapana Komite ke LPJK
						

						// Pemenuhan Penetapana Komite ke LPJK
						$get_data_penetapan_komite_lpjk = $this->admin_model->get_data_penetapan_komite_lpjk($id_izin);
						$curl = curl_init();

						if($get_data_penetapan_komite_lpjk->hasil_penetapan == "Kompeten"){
							$hasil_penetapan = "K";
						}elseif($get_data_penetapan_komite_lpjk->hasil_penetapan == "Belum Kompeten"){
							$hasil_penetapan = "BK";
						}

						$jsonData_penetapan_komite = array(
							"nama_komite_teknis" => $get_data_penetapan_komite_lpjk->nama_komite_teknis,
							"jabatan_komite_teknis" => $get_data_penetapan_komite_lpjk->jabatan_komite_teknis,
							"hasil_penetapan" => $hasil_penetapan,
							"catatan" => $get_data_penetapan_komite_lpjk->catatan,
							"tgl_surat_tugas" => $get_data_penetapan_komite_lpjk->tgl_surat_tugas,
							"no_surat_tugas" => $get_data_penetapan_komite_lpjk->no_surat_tugas,
							"tgl_penetapan" => $get_data_penetapan_komite_lpjk->tgl_penetapan,
							"url_surat_tugas" => base_url("berkas/surat_tugas_komite_teknis/").base64_encode($id_izin),
							"url_ba_penetapan" => base_url("berkas/ba_pleno_komite_teknis/").base64_encode($id_izin),
						);

						$jsonData_penetapan_komite_encode = json_encode($jsonData_penetapan_komite);

						curl_setopt_array($curl, array(
						CURLOPT_URL => $token->host.'/siki-api/v1/komtek-lsp-penugasan/'.$id_izin,
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => $jsonData_penetapan_komite_encode,
						CURLOPT_HTTPHEADER => array(
							'token: ' .$token->token,
							'Content-Type: application/json'
						),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						print_r($response);


						// Update data ke Pencatatan Lokal LSP
						$data = array(
							'nomor_blangko_bnsp' => $array['data'][$i]['nomor_blanko'],
							'tanggal_ditetapkan' => date("Y-m-d H:i:s"),
							'tanggal_masa_berlaku' => date('Y-m-d', strtotime('+5 years')), 
							'log' => $log, 
						);
						$where = array(
							'id_izin' => $id_izin
						);
						$this->admin_model->update_data($where,$data,'data_pencatatan_sertifikasi');

						// Update data Pencatatan ke SIKI
							//API Url
							$url = $token->host . '/siki-api/v1/pencatatan-skk/'.$id_izin;

							//Initiate cURL.
							$ch = curl_init($url);

							//The JSON data.
							$jsonData = array(
								"nomor_registrasi_lsp" => $get_data_pencatatan->nomor_registrasi_lsp,
								"nomor_sertifikasi_lsp" => $get_data_pencatatan->nomor_sertifikat_lengkap,
								"nomor_blangko_bnsp" => $array['data'][$i]['nomor_blanko'],
							);

							//Encode the array into JSON.
							$jsonDataEncoded = json_encode($jsonData);

							//Tell cURL that we want to send a POST request.
							curl_setopt($ch, CURLOPT_POST, 1);
							//Attach our encoded JSON string to the POST fields.
							curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
							//Set the content type to application/json
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
							//Execute the request to array
							$arr = json_decode(curl_exec($ch), true);


							// Menyesuaikan Status ke LPJK
							if(substr($arr['message'],-16) == "belum ada status"){
								$this->hit_status_ulang(base64_encode($id_izin),'20');
								$this->hit_status_ulang(base64_encode($id_izin),'10');
								$this->hit_status_ulang(base64_encode($id_izin),'30');
								$this->hit_status_ulang(base64_encode($id_izin),'31');
								redirect('admin/get_blanko_bnsp/'.base64_encode($id_izin),'refresh');

							}elseif(substr($arr['message'],-2) == "20"){
								$this->hit_status_ulang(base64_encode($id_izin),'10');
								$this->hit_status_ulang(base64_encode($id_izin),'30');
								$this->hit_status_ulang(base64_encode($id_izin),'31');
								redirect('admin/get_blanko_bnsp/'.base64_encode($id_izin),'refresh');

							}elseif(substr($arr['message'],-2) == "10"){
								$this->hit_status_ulang(base64_encode($id_izin),'30');
								$this->hit_status_ulang(base64_encode($id_izin),'31');
								redirect('admin/get_blanko_bnsp/'.base64_encode($id_izin),'refresh');

							}elseif(substr($arr['message'],-2) == "30"){
								$this->hit_status_ulang(base64_encode($id_izin),'31');
								redirect('admin/get_blanko_bnsp/'.base64_encode($id_izin),'refresh');

							}

							if($arr['status'] == 'errors'){
								$this->session->set_flashdata('message_pencatatan_siki', $arr['message']);
								redirect('admin/list_selesai_penetapan','refresh');
							}

							// Ketika gagal generate blanko
							if($arr['status'] == 'errors'){
								$this->session->set_flashdata('message_pencatatan_siki', $arr['message']);

								// Penyesuaian Status ke siki
								if(substr($arr['message'],-2) == '32'){
									$this->kirim_ba_ujikom_balai(base64_encode($id_izin));
									$this->konfirm_pembayaran_balai(base64_encode($id_izin));

									// redirect('admin/get_blanko_bnsp/'.base64_encode($id_izin),'refresh');
								}elseif(substr($arr['message'],-2) == '33'){
									$this->konfirm_pembayaran_balai(base64_encode($id_izin));
									// redirect('admin/get_blanko_bnsp/'.base64_encode($id_izin),'refresh');
								}
							}

							// Update Data Pencatatan dari siki ke lsp
							$data = array(
								'nomor_registrasi_lpjk' => $arr['nomor_registrasi'],
								'qr' => $arr['qr'],
								'tanggal_ditetapkan' => date("Y-m-d H:i:s"),
								'tanggal_masa_berlaku' => date('Y-m-d', strtotime('+5 years')), 
							);
							$where = array(
								'id_izin' => $id_izin
							);
							$this->admin_model->update_data($where,$data,'data_pencatatan_sertifikasi');

						echo "<script>alert('Data Blanko Berhasil di GET');</script>";
					}
				}
			}
		}else{
			echo "<script>alert('Permohonan Blanko Belum di Approve');</script>";
		}
		redirect('admin/list_selesai_penetapan','refresh'); 
	}

	public function izin_final_siki_portal($id_izin){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");

	

		///////////////////////{ Pencatatan SKK } //////////////////////////
		//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/izin-final-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				"file_lampiran" => array("link_e_sertifikat" => base_url('sertifikat/').base64_encode($id_izin)),
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$responseBody = json_decode(curl_exec($ch), true);

			if ($responseBody["status"]="errors"){
				echo '<script>alert("Izin Final ke SIKI Gagal silahkan kontak Admin IT")</script>';
			}else{
				// Berhasil	
			}


		///////////// Pencatatan ke BNSP ///////////////////
			$token_bnsp = $this->api_model->get_token_bnsp();
			$get_detail_jadwal_asesmen_per_permohonan = $this->admin_model->get_detail_jadwal_asesmen_per_permohonan($id_izin);
			$get_data_pencatatan = $this->admin_model->get_data_pencatatan($id_izin);

			//API Url
			$url = $token_bnsp->host."jadwal/peserta/sertifikat";
			
			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData =array(
				"jadwal_id" => $get_detail_jadwal_asesmen_per_permohonan->id_jadwal_asesmen,
				"nik_peserta" => "$get_data_pencatatan->nik",
				"nomor_sertifikat" => "$get_data_pencatatan->nomor_sertifikat_lengkap",
				"nomor_reg" => "$get_data_pencatatan->nomor_registrasi_lsp",
				"nomor_reg_lpjk" => "$get_data_pencatatan->nomor_registrasi_lpjk",
				"link_sertifikat" => base_url("sertifikat/").base64_encode($id_izin),
				"tgl_srtf" => $get_data_pencatatan->tanggal_ditetapkan,
				"tgl_srtf_end" => $get_data_pencatatan->tanggal_masa_berlaku,
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);

			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'x-authorization:'.$token_bnsp->x_authorization,
				'token:'.$token_bnsp->x_authorization
			));

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$responseBody = json_decode(curl_exec($ch), true);
			
			// if ($responseBody["code"]="ERR"){
			// 	echo '<script>alert("Izin Final ke BNSP Gagal silahkan kontak Admin IT")</script>';
			// 	redirect('admin/list_selesai_penetapan','refresh');
			// }else{
			// 	// Berhasil	
			// }

			echo '<script>alert("Izin Final ke SIKI & BNSP Berhasil")</script>';

		//////////// /Pencatatan ke BNSP ///////////////////
		// Insert Log History Permohonan Permohonan Status 50 Kompeten ke History Lokal
		$data_tinjau['id_izin'] = $id_izin;
		$data_tinjau['kode_status'] = "50";
		$data_tinjau['log'] = date("Y-m-d H:i:s");
		$data_tinjau['username'] =  $this->session->userdata('username');
		$this->admin_model->insert_log_history_permohonan($data_tinjau);

		redirect('admin/list_selesai_penetapan','refresh');

	}

	public function terbit_sertifikat(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$get_data_terbit_sertifikat = $this->admin_model->get_data_terbit_sertifikat();

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_data_terbit_sertifikat' => $get_data_terbit_sertifikat,
		);
		$this->template->load('menu','Admin/selesai_penetapan/list_sertifikat_terbit', $this->data);
	}

	public function tolak_permohonan(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
		);
		$this->template->load('menu','Master/tolak_permohonan', $this->data);
	}

	public function insert_tolak_permohonan(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		    $get_status_terkahir = $this->master_model->get_status_terkahir($this->security->xss_clean($this->input->post('id_izin')));
			if($get_status_terkahir->kode_status == "50"){
				$this->session->set_flashdata('failed','Sertifikat Sudah Terbit Silahkan menggunakan Metode Pencabutan');
				header("location:".base_url('admin/tolak_permohonan/'));
			}else{
				//API Url
				$token = $this->api_model->get_token($this->session->userdata('id_lsp'));
				$url = $token->host . '/siki-api/v1/permohonan-skk/'.$this->security->xss_clean($this->input->post('id_izin'));
	
				//Initiate cURL.
				$ch = curl_init($url);

				//The JSON data.
				$jsonData = array(
					'kd_status' => '90',
					'keterangan' => $this->security->xss_clean($this->input->post('catatan')),
				);

				//Encode the array into JSON.
				$jsonDataEncoded = json_encode($jsonData);

				//Tell cURL that we want to send a POST request.
				curl_setopt($ch, CURLOPT_POST, 1);
				//Attach our encoded JSON string to the POST fields.
				curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
				//Set the content type to application/json
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				//Execute the request to array
				$arr = json_decode(curl_exec($ch), true);

				$responseInfo = curl_getinfo($ch);
				/////////////////////// / Hit Status ke API SIKI & PORTAL ///////////////
				if ($responseInfo["http_code"]!=200 && $responseInfo["http_code"]!=201) {
					echo "<script>alert('".$arr['message']."');history.go(-1);</script>";
				}else{
					// Insert Log History Permohonan Selesai Tinjau Permohonan Status 12 Pass Kirim Pra-Asesmen
					$status['id_izin'] = $this->security->xss_clean($this->input->post('id_izin'));
					$status['kode_status'] = '90';
					$status['log'] = date("Y-m-d H:i:s");
					$status['username'] =  $this->session->userdata('username');
					$this->admin_model->insert_log_history_permohonan($status);

					$this->session->set_flashdata('success','Tolak Permohonan Berhasil Dilakukan');
					header("location:".base_url('admin/tolak_permohonan/'));
				}
			}
	}
	


	################# Master Subklasifikasi Kualifikasi ################
	function get_master_klasifikasi_json(){
		$data = $this->master_model->get_master_klasifikasi_json()->result();
        echo json_encode($data);
	}

	function get_master_subklasifikasi_json(){
		$data = $this->master_model->get_master_subklasifikasi_json()->result();
        echo json_encode($data);
	}

	############## Fungsi Bantuan ###################
	public function hit_status_ulang($id_izin,$kode_status){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");

		$token = $this->api_model->get_token();

		if($kode_status == "20"){
			$keterangan = "Tinjau Permohonan";
		}elseif($kode_status == "10"){
			$keterangan = "Data Lengkap";
		}elseif($kode_status == "30"){
			$keterangan = "Invoice Dikirimkan";
		}elseif($kode_status == "31"){
			$keterangan = "Konfirmasi Pembayaran";
		}

		
		// Konfrimasi Pembayaran Status 31 Final Permohonan Balai
		$curl = curl_init();
		$jsonData_pembayaran = array(
			"kd_status" => $kode_status,
			"keterangan" => $keterangan
		);

		$jsonData_data_pembayaran_encode = json_encode($jsonData_pembayaran);

		curl_setopt_array($curl, array(
		CURLOPT_URL => $token->host.'/siki-api/v1/permohonan-skk/'.$id_izin,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $jsonData_data_pembayaran_encode,
		CURLOPT_HTTPHEADER => array(
			'token: ' .$token->token,
			'Content-Type: application/json'
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		// redirect("Komite/list_penetapan","refresh");
	} 
	############## /Fungsi Bantuan ###################

}