<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data["title"] = "Dashboard";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/index", $data);
        $this->load->view("templates/footer", $data);
    }


    public function role()
    {
        $data["title"] = "Akses";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get("user_role")->result_array(); //mengenalkan var role sebagai tempat mengmbil data di db user_role



        $this->form_validation->set_rules("role", "Role", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("admin/role", $data);
            $this->load->view("templates/footer", $data);
        } else {

            $role = $this->input->post('role', true);
            $data = [
                'role' => $role
            ];
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses baru telah ditambahkan!</div>');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data["title"] = "Hak Akses";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where("user_role", ['id' => $role_id])->row_array(); //satu berbaris
        $this->db->where('id != ', 1); //menampilkan semua kecuali id 1
        $data['menu'] = $this->db->get('menu')->result_array(); //memanggil semua data menu  
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view("admin/role-access", $data); //meampilkan view role
        $this->load->view("templates/footer", $data);
    }


    public function changeAccess()
    {
        //AMBIL DARI AJAX FOOTER
        $menu_id = $this->input->post("menuId");
        $role_id = $this->input->post("roleId");
        $data = [
            "level" => $role_id,
            "menu_id" => $menu_id
        ];
        $result = $this->db->get_where("user_access_menu", $data);
        if ($result->num_rows() < 1) {
            $this->db->insert("user_access_menu", $data);
        } else {
            $this->db->delete("user_access_menu", $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access changed!</div>');
    }


    public function ubahRole($role_id)
    {
        $data["title"] = "Hak Akses";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where("user_role", ['id' => $role_id])->row_array(); //satu berbaris

        $this->db->where('id != ', 1); //menampilkan semua kecuali id 1

        $data['menu'] = $this->db->get('menu')->result_array(); //memanggil semua data menu 

        $this->form_validation->set_rules("rolebaru", "Role baru", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("admin/ubah-role", $data); //meampilkan view role
            $this->load->view("templates/footer", $data);
        } else {
            $rolebaru = $this->input->post('rolebaru');
            $this->db->set('role', $rolebaru);
            $this->db->where("id", $role_id);
            $this->db->update('user_role');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Nama Role sudah di ubah. </div>');
            redirect("admin/role");
        }
    }
}
