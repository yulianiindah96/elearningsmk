<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Civitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model("Siswa_model"); //mengidentifikasi model agar bisa diakses semua methode disini
        $this->load->library('form_validation');
    }


    public function index()
    {

        $data["title"] = "Siswa";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();

        $data["siswa"] = $this->Siswa_model->getAllSiswa(); //memanggil model

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("civitas/index", $data);
        $this->load->view("templates/footer", $data);
    }
    public function tambah()
    {
        $data["title"] = "Tambah Data Siswa";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data["siswa"] = $this->Siswa_model->getAllSiswa(); //memanggil model
        $data["kelas"] = $this->Siswa_model->getAllKelas(); //memanggil model
        $data["agama"] = ["Islam", "Kristen", "Hindu", "Budha", "Konghucu", "Lainnya"];
        $data["jenis_kelamin"] = ["L", "P"];
        $data["kelas"] = ["X TKJ", "XI TKJ", "XII TKJ", "X BDP", "XI BDP", "XII BDP"];

        $this->form_validation->set_rules("nis", "NIS", "required");
        $this->form_validation->set_rules("nisn", "NISN", "required");
        $this->form_validation->set_rules("nama_lengkap", "Nama Lengkap Siswa", "required");
        $this->form_validation->set_rules("kelas", "Kelas", "required"); //tidak boleh berisi "Pilih Kelas"
        $this->form_validation->set_rules("alamat", "Alamat", "required");
        $this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", "required");
        $this->form_validation->set_rules("datae", "Tanggal", "required"); //tidak boleh berisi "Tanggal"
        $this->form_validation->set_rules("jenis_kelamin", "Jenis Kelamin", "required"); //tidak boleh berisi "Jenis kelamin"
        $this->form_validation->set_rules("agama", "Agama", "required"); //tidak boleh berisi "Jenis kelamin"
        $this->form_validation->set_rules("nama_ayah", "Nama Ayah", "required");
        $this->form_validation->set_rules("nama_ibu", "Nama Ibu", "required");
        $this->form_validation->set_rules("th_masuk", "Tahun Masuk", "required|numeric");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules("no_telp", "No Telepon", "required");

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("civitas/tambah-siswa", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $this->Siswa_model->tambahDataSiswa();
        }
    }

    public function hapus($id_siswa)
    {
        $this->Siswa_model->hapusDataSiswa($id_siswa);
    }
    public function detail($id_siswa)
    {
        $data["title"] = "Detail Data Siswa";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data["siswa"] = $this->Siswa_model->getSiswaById($id_siswa); //memanggil model

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("civitas/detail-siswa", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $this->Siswa_model->tambahDataSiswa();
        }
    }

    public function ubah($id_siswa)
    {
        $data["title"] = "Edit Profile";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data["siswa"] = $this->Siswa_model->getSiswaById($id_siswa); //memanggil model
        $data["agama"] = ["Islam", "Kristen", "Hindu", "Budha", "Konghucu", "Lainnya"];
        $data["jenis_kelamin"] = ["L", "P"];
        $data["kelas"] = ["X TKJ", "XI TKJ", "XII TKJ", "X BDP", "XI BDP", "XII BDP"];

        $this->form_validation->set_rules("nis", "NIS", "required");
        $this->form_validation->set_rules("nisn", "NISN", "required");
        $this->form_validation->set_rules("nama_lengkap", "Nama Lengkap Siswa", "required");
        $this->form_validation->set_rules("kelas", "Kelas", "required"); //tidak boleh berisi "Pilih Kelas"
        $this->form_validation->set_rules("alamat", "Alamat", "required");
        $this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", "required");
        $this->form_validation->set_rules("datae", "Tanggal", "required"); //tidak boleh berisi "Tanggal"
        $this->form_validation->set_rules("jenis_kelamin", "Jenis Kelamin", "required"); //tidak boleh berisi "Jenis kelamin"
        $this->form_validation->set_rules("agama", "Agama", "required"); //tidak boleh berisi "Jenis kelamin"
        $this->form_validation->set_rules("nama_ayah", "Nama Ayah", "required");
        $this->form_validation->set_rules("nama_ibu", "Nama Ibu", "required");
        $this->form_validation->set_rules("th_masuk", "Tahun Masuk", "required|numeric");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules("no_telp", "No Telepon", "required");

        if ($this->form_validation->run() === false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("civitas/ubah-datasiswa", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $this->Siswa_model->ubahDataSiswa();
        }
    }


    public function guru()
    {
        $data["title"] = "Guru";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("civitas/guru", $data);
        $this->load->view("templates/footer", $data);
    }
}
