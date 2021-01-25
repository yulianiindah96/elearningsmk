      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="col-8 mt-3">
              <div class="card">
                  <div class="card-header">
                      Tambah Data Siswa

                  </div>
                  <div class="card-body col">
                      <form action="<?= base_url("civitas/tambah") ?>" method="POST">
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nis" name="nis" placeholder="Nomor Induk Siswa" ?>
                                  <?= form_error("nis", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional" ?>
                                  <?= form_error("nisn", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap Siswa" ?>
                                  <?= form_error("nama_lengkap", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <select class="form-control" aria-label=".form-select-sm example" id="kelas" name="kelas">
                                      <option selected>Pilih Kelas</option>
                                      <?php foreach ($kelas as $ik) : ?>
                                          <option value="<?= $ik; ?>"><?= $ik; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  <?= form_error("kelas", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <div class="form-floating">
                                      <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" style="height: 100px"></textarea>
                                      <?= form_error("alamat", "<small class='text-danger pl-3'>", "</small>"); ?>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" ?>
                                  <?= form_error("tempat_lahir", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <select class="form-control" aria-label=".form-select-sm example" id="jenis_kelamin" name="jenis_kelamin">
                                      <option selected>Jenis Kelamin</option>
                                      <?php foreach ($jenis_kelamin as $jk) : ?>
                                          <option value="<?= $jk; ?>"><?= $jk; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  <?= form_error("jenis_kelamin", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <select class="form-control" aria-label=".form-select-sm example" id="agama" name="agama">
                                      <option selected>Agama</option>
                                      <?php foreach ($agama as $ag) : ?>
                                          <option value="<?= $ag; ?>"><?= $ag; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  <?= form_error("agama", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" ?>
                                  <?= form_error("nama_ayah", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" ?>
                                  <?= form_error("nama_ibu", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="number" class="form-control" id="th_masuk" name="th_masuk" placeholder="Tahun Masuk" ?>
                                  <?= form_error("th_masuk", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" ?>
                                  <?= form_error("email", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telepon" ?>
                                  <?= form_error("no_telp", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="date" class="form-control" id="datae" name="datae" placeholder="Tanggal lahir" ?>
                                  <?= form_error("datae", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <button type="submit" class="btn btn-primary float-right" name="tambah">Tambah Data</button>
                          </div>
                      </form>


                  </div>
              </div>

          </div>


      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->