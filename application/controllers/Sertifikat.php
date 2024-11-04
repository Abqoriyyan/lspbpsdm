<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sertifikat extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','email','pdfgenerator','system'));
		$this->load->config('email');


		// $this->load->library('../controllers/mail','mail');
		## GET Model Admin Model
		$this->load->model('master_model');
		$this->load->model('asesor_model');
		$this->load->model('api_model');
		$this->load->model('komite_model');
		$this->load->model('admin_model');
		$this->load->model('sertifikat_model');
		## GET Model Admin Model
		date_default_timezone_set('Asia/Jakarta');
	}

    public function file_sertifikat($id_izin){
		$id_izin = base64_decode($id_izin);

		// Get Data Permohonan yang sudah lolos sertifikasi / Tercatat
		$get_data_pencatatan = $this->sertifikat_model->get_data_pencatatan($id_izin);
		$get_data_personal_permohonan = $this->sertifikat_model->get_data_personal_permohonan($id_izin);
		$data_lsp = $this->api_model->get_token();

		$data = array(
			"get_data_pencatatan" => $get_data_pencatatan,
			"get_data_personal_permohonan" => $get_data_personal_permohonan,
			"data_lsp" => $data_lsp,
			'id_izin' => $id_izin,
		);
        
        $this->load->view('Sertifikat/cetak_sertifikat',$data);
    }

	public function validasi_signature($id_izin){
		$id_izin = base64_decode($id_izin);
		$get_data_pencatatan = $this->sertifikat_model->get_data_pencatatan($id_izin);
		$data_lsp = $this->api_model->get_token();
		
		$data = array(
			"data_lsp" => $data_lsp,
			"get_data_pencatatan" => $get_data_pencatatan,
		);
        
        $this->load->view('Sertifikat/validasi_signature',$data);
	}
}