      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
              <div class="col-lg-6">
                  <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                  <?= $this->session->flashdata("message"); ?>
                  <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal" href="">Tambah Akses Baru</a>
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Akses</th>
                              <th scope="col">Aksi</th>

                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($role as $r) : ?>
                              <tr>
                                  <th scope="row"><?= $i ?></th>
                                  <td><?= $r['role'] ?></td>
                                  <td>
                                      <a class="badge badge-warning" href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">Pilih hak akses</a>
                                      <a class="badge badge-success" href="<?= base_url('admin/ubahrole/') . $r['id']; ?>">Ubah</a>
                                      <a class="badge badge-danger" href="<?= base_url('admin/hapusrole/') . $r['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
                                  </td>
                              </tr>
                              <?php $i++; ?>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>


      </div>
      <!-- /.container-fluid -->


      </div>
      <!-- End of Main Content -->

      <!-- MODAL-->

      <!-- Modal -->
      <div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="newRoleModalLabel">Tambah Akses Baru</h5>
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