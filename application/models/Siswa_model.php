<?php

class Siswa_model extends CI_model
{
    public function getAllSiswa()
    {
        return $this->db->get("siswa")->result_array(); //memanggil nilai tabel
    }
    public function getAllKelas()
    {
        return $this->db->get("kelas")->result_array(); //memanggil nilai tabel
    }
    public function tambahDataSiswa()
    {
        $data = [

            "nis" => $this->input->post("nis", true),
            "nisn" => $this->input->post("nisn", true),
            "nama_lengkap" => $this->input->post("nama_lengkap", true),
            "kelas" => $this->input->post("kelas", true),
            "alamat" => $this->input->post("alamat", true),
            "tempat_lahir" => $this->input->post("tempat_lahir", true),
            "tgl_lahir" => $this->input->post("datae", true),
            "jenis_kelamin" => $this->input->post("jenis_kelamin", true),
            "agama" => $this->input->post("agama", true),
            "nama_ayah" => $this->input->post("nama_ayah", true),
            "nama_ibu" => $this->input->post("nama_ibu", true),
            "th_masuk" => $this->input->post("th_masuk", true),
            "email" => $this->input->post("email", true),
            "no_telp" => $this->input->post("no_telp", true)

        ];
        $this->db->insert("siswa", $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data <strong>Berhasil</strong> tersimpan!</div>');
        redirect("civitas/index");
    }

    public function hapusDataSiswa($id_siswa)
    {
        $this->db->where("id_siswa", $id_siswa);
        $this->db->delete("siswa");
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data <strong>Berhasil</strong> dihapus!</div>');
        redirect("civitas/index");
        //$this->db->delete("siswa", ["id_siswa" => $id_siswa]);
    }

    public function getSiswaById($id_siswa)
    {
        return $this->db->get_where("siswa", ["id_siswa" => $id_siswa])->row_array();
    }
    public function ubahDataSiswa()
    {
        $data = [

            "nis" => $this->input->post("nis", true),
            "nisn" => $this->input->post("nisn", true),
            "nama_lengkap" => $this->input->post("nama_lengkap", true),
            "kelas" => $this->input->post("kelas", true),
            "alamat" => $this->input->post("alamat", true),
            "tempat_lahir" => $this->input->post("tempat_lahir", true),
            "tgl_lahir" => $this->input->post("datae", true),
            "jenis_kelamin" => $this->input->post("jenis_kelamin", true),
            "agama" => $this->input->post("agama", true),
            "nama_ayah" => $this->input->post("nama_ayah", true),
            "nama_ibu" => $this->input->post("nama_ibu", true),
            "th_masuk" => $this->input->post("th_masuk", true),
            "email" => $this->input->post("email", true),
            "no_telp" => $this->input->post("no_telp", true)

        ];
        $this->db->where("id_siswa", $this->input->post("id_siswa"));
        $this->db->update("siswa", $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data <strong>Berhasil</strong> diubah!</div>');
        redirect("civitas/index");
    }
}
