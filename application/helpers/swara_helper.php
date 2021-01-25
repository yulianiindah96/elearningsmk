<?php
function cek_login()
{
    $ci = get_instance(); //memnggil semua librari CI karena helper ini tdk mengenal sama sekali $this
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');

        $menu = $ci->uri->segment(1);
        $queryMenu = $ci->db->get_where('menu', ['menu' => $menu])->row_array();

        $menu_id = $queryMenu['id'];
        $user_access = $ci->db->get_where('user_access_menu', [
            'level' => $level,
            'menu_id' => $menu_id
        ]);
        if ($user_access->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($level, $menu_id)
{
    $ci = get_instance();
    //$ci->db->where('id', $role_id);
    //$ci->db->where('menu_id', $menu_id);
    //$result = $ci->db->get('user_access_menu');
    //contoh lain query
    $result = $ci->db->get_where('user_access_menu', [
        'level' => $level,
        'menu_id' => $menu_id
    ]);
    //mengecek masing2 nilai id

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
