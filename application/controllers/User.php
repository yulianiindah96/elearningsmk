<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*if (!$this->session->userdata('email')) {
            redirect('auth');
        }*/
        cek_login();
    }
    public function index()
    {
        $data["title"] = "My Profile";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("user/index", $data);
        $this->load->view("templates/footer", $data);
    }
    public function edit_profile()
    {
        $data["title"] = "Edit Profile";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("user/edit_profile", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $nama_lengkap = $this->input->post("nama_lengkap");
            $email = $this->input->post("email");
            //cek apapkah ada file gambar?
            $upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $old_image = $data["user"]["foto"];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama_lengkap);
            $this->db->where("email", $email);
            $this->db->update('pengguna');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your Profile has been updated </div>');
            redirect("user");
        }
    }
    public function changePassword()
    {
        $data["title"] = "Change Password";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules("current_password", "Password Saat ini", "required|trim");
        $this->form_validation->set_rules("new_password1", 'Password Baru', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules("new_password2", 'Konfirmasi Password Baru', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("user/changepassword", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $current_password = $this->input->post("current_password");
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data["user"]["password"])) {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Password saat ini Salah!</div>");
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Password Baru tidak boleh sama dengan dengan Password Saat ini! </div>");
                    redirect('user/changepassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('pengguna'); //table

                    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>Password Diubah! </div>");
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function siswa()
    {
        $data["title"] = "Data Siswa";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->m_siswa->tampil_data()->result();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("user/siswa", $data);
        $this->load->view("templates/footer", $data);
    }
}
