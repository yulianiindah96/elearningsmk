      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
              <div class="col-lg-6">
                  <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                  <?= $this->session->flashdata("message"); ?>
                  <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal" href="">Tambah Menu</a>
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Menu</th>
                              <th scope="col">Aksi</th>

                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($menu as $m) : ?>
                              <tr>
                                  <th scope="row"><?= $i ?></th>
                                  <td><?= $m['menu'] ?></td>
                                  <td>
                                      <a class="badge badge-success" href="">Edit</a>
                                      <a class="badge badge-danger" href="">Delete</a>
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
      <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="newMenuModalLabel">Tambah Menu</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="<?= base_url('menu'); ?>" method="POST">
                      <div class="modal-body">
                          <div class="form-group">
                              <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
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