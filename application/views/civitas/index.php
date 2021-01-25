      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <?= $this->session->flashdata("message"); ?>

          <div class="row">
              <div class="col-md-6">
                  <a href="<?= base_url("civitas/tambah"); ?>" class="btn btn-primary">Tambah Data Siswa</a>
              </div>
          </div>
          <div class="row mt-3">
              <div class="col">
                  <div class="mt-3">
                      <div class="card">
                          <div class="card-header">
                              <span class="mr-4 mt-4"><strong>No</strong></span>
                              <span class="mr-2 mt-4"><strong>Informasi Siswa</strong></span>
                          </div>
                          <ul class="list-group">
                              <?php $i = 1; ?>
                              <?php foreach ($siswa as $sw) : ?>
                                  <li class="list-group-item">
                                      <span class="mr-4 mt-4"><strong><?= $i++ . '.' ?></strong></span>
                                      <?= $sw["nama_lengkap"]; ?>
                                      <a class="badge badge-danger float-right mr-2 mt-4" onclick="return confirm('yakin?')" href="<?= base_url("civitas/hapus/" . $sw['id_siswa']); ?>">Hapus</a>
                                      <a class="badge badge-warning float-right mr-2 mt-4" href="<?= base_url("civitas/ubah/" . $sw['id_siswa']); ?>">Ubah</a>
                                      <a class="badge badge-primary float-right mr-2 mt-4" href="<?= base_url("civitas/detail/" . $sw['id_siswa']); ?>">Detail</a>
                                  </li>
                              <?php endforeach ?>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->