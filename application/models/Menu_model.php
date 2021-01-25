<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu_model extends CI_model
{
    public function getSubMenu()
    {
        $query =  "SELECT `user_sub_menu`.*, `menu`.`menu`
        FROM `user_sub_menu` JOIN `menu` 
        ON `user_sub_menu`.`menu_id`  = `menu`.`id` ";
        //untuk menampilkan semua datanya
        return $this->db->query($query)->result_array();
    }
}
