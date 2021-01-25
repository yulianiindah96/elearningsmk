<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
        $data["title"] = "Menu Management";
        $data['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get("menu")->result_array(); //agar bisa di looping di menu/index
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) { //saat masuk ke menu management pastikan form validationnya false, kemudian nanti dipnggil melalui menu index 
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("menu/index", $data);
            $this->load->view("templates/footer", $data);
        } else {
            $this->db->insert("menu", ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru telah di tambahkan!</div>');
            redirect("menu");
        }
    }

    public function subMenu()
    {
        $dt["title"] = "SubMenu Management";
        $dt['user'] = $this->db->get_where("pengguna", ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model("Menu_model", "menu");
        $dt['subMenu'] = $this->menu->getSubMenu(); //$this->db->get("user_sub_menu")->result_array();
        $dt['menu'] = $this->db->get("menu")->result_array(); //agar bisa di looping di menu/index
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view("templates/header", $dt);
            $this->load->view("templates/sidebar", $dt);
            $this->load->view("templates/topbar", $dt);
            $this->load->view("menu/submenu", $dt);
            $this->load->view("templates/footer", $dt);
        } else {
            $dt = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $dt);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Sub Menu Added</div>');
            redirect("menu/submenu");
        }
    }
}
