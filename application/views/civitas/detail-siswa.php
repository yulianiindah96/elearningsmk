      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="col-8 mt-3">
              <div class="card">

                  <div class="card-body">
                      <h5 class="card-title"><?= $siswa['nama_lengkap']; ?></h5>
                      <h6 class="card-title mb-2 text-muted"><?= $siswa['email']; ?></h6>
                      <p class="card-text"><?= $siswa['nis']; ?></p>
                      <p class="card-text"><?= $siswa['kelas']; ?></p>
                  </div>
                  <div class="card-header">
                      <a href="<?= base_url("civitas/index") ?>" class="btn btn-primary">Kembali</a>

                  </div>

              </div>
          </div>



      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->