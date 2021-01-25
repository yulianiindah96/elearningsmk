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
                      <form action="" method="POST">
                          <input type="hidden" name="id_siswa" value="<?= $siswa["id_siswa"]; ?>">

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nis" name="nis" placeholder="Nomor Induk Siswa" value="<?= $siswa["nis"]; ?>">
                                  <?= form_error("nis", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional" value="<?= $siswa["nisn"]; ?>">
                                  <?= form_error("nisn", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap Siswa" value="<?= $siswa["nama_lengkap"]; ?>">
                                  <?= form_error("nama_lengkap", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <select class="form-control" aria-label=".form-select-sm example" id="kelas" name="kelas">
                                      <?php foreach ($kelas as $ik) : ?>
                                          <?php if ($ik === $siswa["kelas"]) : ?>
                                              <option value="<?= $ik; ?>" selected><?= $ik; ?></option>
                                          <?php else : ?>
                                              <option value="<?= $ik; ?>"><?= $ik; ?></option>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                  </select>

                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <div class="form-floating">
                                      <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" style="height: 100px" ?><?= $siswa["alamat"]; ?></textarea>
                                      <?= form_error("alamat", "<small class='text-danger pl-3'>", "</small>"); ?>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $siswa["tempat_lahir"]; ?>">
                                  <?= form_error("tempat_lahir", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class=" form-group row">
                              <div class="col">
                                  <select class="form-control" aria-label=".form-select-sm example" id="jenis_kelamin" name="jenis_kelamin" value="<?= $siswa["jenis_kelamin"]; ?>">
                                      <option selected>Jenis Kelamin</option>
                                      <?php foreach ($jenis_kelamin as $jk) : ?>
                                          <?php if ($jk === $siswa["jenis_kelamin"]) : ?>
                                              <option value="<?= $jk; ?>" selected><?= $jk; ?></option>
                                          <?php else : ?>
                                              <option value="<?= $jk; ?>"><?= $jk; ?></option>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                  </select>

                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <select class="form-control" aria-label=".form-select-sm example" id="agama" name="agama">
                                      <?php foreach ($agama as $ag) : ?>
                                          <?php if ($ag === $siswa["agama"]) : ?>
                                              <option value="<?= $ag; ?>" selected><?= $ag; ?></option>
                                          <?php else : ?>
                                              <option value="<?= $ag; ?>"><?= $ag; ?></option>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                  </select>

                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" value="<?= $siswa["nama_ayah"]; ?>">
                                  <?= form_error("nama_ayah", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" value="<?= $siswa["nama_ibu"]; ?>">
                                  <?= form_error("nama_ibu", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="number" class="form-control" id="th_masuk" name="th_masuk" placeholder="Tahun Masuk" value="<?= $siswa["th_masuk"]; ?>">
                                  <?= form_error("th_masuk", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $siswa["email"]; ?>" readonly>
                                  <?= form_error("email", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telepon" value="<?= $siswa["no_telp"]; ?>">
                                  <?= form_error("no_telp", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <input type="date" class="form-control" id="datae" name="datae" placeholder="Tanggal lahir" value="<?= $siswa["tgl_lahir"]; ?>">
                                  <?= form_error("datae", "<small class='text-danger pl-3'>", "</small>"); ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <button type="submit" class="btn btn-primary float-right" name="ubah">Ubah Data</button>
                          </div>
                      </form>


                  </div>
              </div>

          </div>


      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->