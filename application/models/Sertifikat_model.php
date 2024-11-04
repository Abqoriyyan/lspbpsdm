<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat_model extends CI_Model
{
    public function get_data_pencatatan($id_izin){
        $sql = "SELECT a.*,b.nama AS nama_komite,c.deskripsi as deskripsi_jenjang,c.deskripsi_en AS deskripsi_jenjang_en, d.kbli,d.kbji FROM data_pencatatan_sertifikasi a
                JOIN master_komite b ON b.user_komite = a.user_penetap
                JOIN master_jenjang_permohonan c ON c.jenjang = a.jenjang
                JOIN master_jabatan_kerja d ON d.id_jabatan_kerja = a.id_jabatan_kerja
                WHERE a.id_izin = '$id_izin'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_data_personal_permohonan($id_izin){
        $sql = "SELECT * FROM data_personal_permohonan
        WHERE id_izin = '$id_izin'";

        $query = $this->db->query($sql);
        return $query->row();
    }
}
?>