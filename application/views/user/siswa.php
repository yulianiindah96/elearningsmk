      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="row">
              <?= $this->session->flashdata("message"); ?>
              <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#dataModal" href="">Tambah Data Siswa Baru</a>
              <div class="content table-responsive">



                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">NIS</th>
                              <th scope="col">NISN</th>
                              <th scope="col">NAMA</th>
                              <th scope="col">KELAS</th>
                              <th scope="col">ALAMAT</th>
                              <th scope="col">TEMPAT LAHIR</th>
                              <th scope="col">TANGGAL LAHIR</th>
                              <th scope="col">JENIS KELAMIN</th>
                              <th scope="col">AGAMA</th>
                              <th scope="col">NAMA AYAH</th>
                              <th scope="col">NAMA IBU</th>
                              <th scope="col">TAHUN MASUK</th>
                              <th scope="col">EMAIL</th>
                              <th scope="col">NOMOR TELEPON</th>

                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($siswa as $sw) : ?>
                              <!--mengmbil dari Admin-> Role Access > $data['menu'] = $this->db->get('menu')->result_array(); -->
                              <tr>
                                  <th scope="row"><?= $i++ ?></th>
                                  <td><?= $sw->nis ?></td>
                                  <td><?= $sw->nisn ?></td>
                                  <td><?= $sw->nama_lengkap ?></td>
                                  <td><?= $sw->id_kelas ?></td>
                                  <td><?= $sw->alamat ?></td>
                                  <td><?= $sw->tempat_lahir ?></td>
                                  <td><?= $sw->jenis_kelamin ?></td>
                                  <td><?= $sw->agama ?></td>
                                  <td><?= $sw->nama_ayah ?></td>
                                  <td><?= $sw->nama_ibu ?></td>
                                  <td><?= $sw->th_masuk ?></td>
                                  <td><?= $sw->no_telp ?></td>
                                  <td><?= $sw->email ?></td>

                              </tr>

                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>

      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Modal -->
      <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="dataModalLabel">Tambah data siswa Baru</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <!--menambahkan role-->
                  <form action="<?= base_url('admin/role'); ?>" method="POST">
                      <div class="modal-body">
                          <div class="form-group">
                              <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                              <!--$this->form_validation->set_rules('menu', 'Menu', 'required');-->
                          </div>


                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary">Tambah</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>