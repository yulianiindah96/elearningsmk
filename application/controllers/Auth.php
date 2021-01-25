<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    //agar form_validation dapat berjalan pada semua function yg ada pada auth maka buat contruct
    public function __construct()
    {
        parent::__construct();
        //mencegah ketika sudah login tapi menekan tombol back, maka dialihkan ke halaman user
        $this->load->library('form_validation');
        //simpan kode ini di method nya saja ke login dan register
        //if ($this->session->userdata('email')) {
        //    redirect('user');
        // }
    }


    public function index()
    {
        //dari construct ke sini
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("password", "Password", "trim|required");
        if ($this->form_validation->run() == false) {
            $dt['title'] = "Login";
            $this->load->view('templates/auth_header', $dt);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi sukses
            $this->_login(); //method private (tidak menggunakan URL)
        }
    }

    private function _login()
    {
        //menginisialisasi variabel yang ada di name email dan password
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        $user = $this->db->get_where("pengguna", ["email" => $email])->row_array();
        // var_dump($user);
        // die(); //supaya script tdk jalan lagi

        //jika usernya ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['level'] == 1) {
                        redirect("admin");
                    } else {
                        redirect("user");
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }
    public function registration()
    {
        //dari construct ke sini
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $data["sebagai"] = ["Siswa", "Guru"];

        $this->form_validation->set_rules("name", "Name", "required|trim"); //set rules("nama_variabel_textboxnya","nama_lain_dari_name","harus_diisi|agar_spasi tidak_masuk_di_DB");
        $this->form_validation->set_rules("email", "Email", "required|trim|valid_email|is_unique[pengguna.email]", [
            "is_unique" => "This Email has already registered!"
        ]/*|is_unique[registrasi_siswa.email"*/); //yang ada didalam tanda () semua sudah ada di dokumentasi CI "FORM VALIDATION-->RULE REFERENCE"
        $this->form_validation->set_rules("password1", "Password", "required|trim|min_length[3]|matches[password2],[
            'matches'=>'Password tidak sama!',
            'min_length'=>'Password terlalu pendek!'
            ]"); //set rules("nama_variabel_password","nama_lain_dari_password","harus_diisi|agar_spasi_tidak_masuk_di_DB"|panjang_teks_minimal|cocokkan_dengan_password2);
        $this->form_validation->set_rules("password2", "Password", "required|trim|matches[password1]"); //set rules("nama_variabel_password","nama_lain_dari_password","harus_diisi|agar_spasi_tidak_masuk_di_DB"|cocokkan_dengan_password1);

        //$this->load->library("form_validation");
        if ($this->form_validation->run() == false) {
            //tampilkan kembali form validasi lagi
            $dt['title'] = "Daftar Akun";
            $this->load->view('templates/auth_header', $dt);
            $this->load->view('auth/registration', $data);
            $this->load->view('templates/auth_footer');
        } else {
            //echo "Data Berhasil di tambahkan..";
            $email = $this->input->post('email', true);
            $sebagai = $this->input->post('sebagai', true);
            if ($sebagai === "Siswa") {
                $level = 3;
            } else {
                $level = 2;
            }

            $data = [
                //'name' = $this->input->post('name'),
                'nama' => htmlspecialchars($this->input->post('name', true)), //true untuk menghindari dari serangan XSS
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'email' => htmlspecialchars($email),
                'foto' => 'default.jpg',
                'is_active' => 0,
                'date_created' => time(),
                'level' => $level
            ];
            $dt = [
                //'name' = $this->input->post('name'),
                'nama_lengkap' => htmlspecialchars($this->input->post('name', true)), //true untuk menghindari dari serangan XSS
                'email' => htmlspecialchars($email)
            ];

            //SIAPKAN TOKEN
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];
            $this->db->insert('pengguna', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendGmail($token, 'verify');
            if ($sebagai === "Siswa") {
                $this->db->insert('siswa', $dt);
            } else {
                $this->db->insert('pengajar', $dt);
            }


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun sudah dibuat. Silakan aktivasi akun!</div>');
            redirect('auth');
        }
        //$data['title'] = "Elearning SWARA | User Registration";
        //$this->load->view('templates/auth_header', $data);
        //$this->load->view('auth/registration');
        //$this->load->view('templates/auth_footer');

    }

    private function _sendGmail($token, $type)
    {
        $config = [

            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'isari6751@gmail.com',
            'smtp_pass' => 'Indahcpns2021',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"

        ];

        $this->load->library("email", $config);
        $this->email->initialize($config);  //tambahkan baris ini
        $this->email->from("isari6751@gmail.com", "SMK Walisongo Rambipuji");
        $this->email->to($this->input->post('email'));

        if ($type === "verify") {
            $this->email->subject("Verifikasi Akun");
            $this->email->message("Klik link ini untuk verifikasi akun Anda : <a href = '" . base_url() . "auth/verify?email=" . $this->input->post("email") . "&token=" . urlencode($token) . "'> <b>Activate</b> </a>");
        } else if ($type === "lupapass") {
            $this->email->subject("Reset Password");
            $this->email->message("Klik link ini untuk reset password Anda : <a href = '" . base_url() . "auth/resetpassword?email=" . $this->input->post("email") . "&token=" . urlencode($token) . "'> <b>Reset Password</b> </a>");
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $email = $this->input->get("email");
        $token = $this->input->get("token");
        $user = $this->db->get_where('pengguna', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token["date_created"] < (60 * 60 * 24)) {
                    $this->db->set("is_active", 1);
                    $this->db->where("email", $email);
                    $this->db->update("pengguna");
                    $this->db->delete("user_token", ["email" => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' Sudah aktif! Silakan login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete("pengguna", ["email" => $email]);
                    $this->db->delete("user_token", ["email" => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktifasi akun gagal! Token Kadaluarsa.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktifasi akun gagal! Token salah.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktifasi akun gagal! Email salah.</div>');
            redirect('auth');
        }
    }

    public function lupaPassword()
    {
        $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");
        if ($this->form_validation->run() === false) {

            $data['title'] = "Lupa Password";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post("email");
            $user = $this->db->get_where("pengguna", ["email" => $email, "is_active" => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert("user_token", $user_token);
                $this->_sendGmail($token, "lupapass");

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Silakan cek Email untuk reset password Anda!</div>');
                redirect('auth/lupapassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar atau akun belum di verifikasi!</div>');
                redirect('auth/lupapassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where("pengguna", ["email" => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where("user_token", ["token" => $token])->row_array();
            if ($user_token) {
                //kalau email dan token benar maka
                $this->session->set_userdata("reset_email", $email); //ini haya muncul ketika user melalui link email
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Email Salah.</div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu sudah Logout!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view("auth/blocked");
        //echo "access blocked";
    }

    public function changePassword()
    {
        if (!$this->session->userdata("reset_email")) {
            redirect("auth");
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Password";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post("password1"), PASSWORD_DEFAULT);
            $email = $this->session->userdata("reset_email");

            $this->db->set("password", $password);
            $this->db->where("email", $email);
            $this->db->update("pengguna");

            $this->session->unset_userdata("reset_email");

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah berubah! Silakan login.</div>');
            redirect('auth');
        }
    }
}
