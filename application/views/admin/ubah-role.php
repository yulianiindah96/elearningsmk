      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
              <div class="col-lg-6">

                  <?= $this->session->flashdata("message"); ?>
                  <h5>Role : <?= $role['role']; ?></h5>
                  <form class="user" method="POST" action="<?= base_url("admin/ubahrole/"); ?>">
                      <div class="form-group row">

                          <div class="col-sm-8">
                              <input type="text" class="form-control" id="rolebaru" name="rolebaru" value="<?= $role['role']; ?>">
                              <?= form_error("nama_lengkap", "<small class='text-danger pl-3'>", "</small>"); ?>
                          </div>
                      </div>
                  </form>
                  <div class="form-group row">
                      <div class="col-sm-8">
                          <button type="submit" class="btn btn-primary">simpan</button>
                      </div>
                  </div>



              </div>
          </div>


      </div>
      <!-- /.container-fluid -->


      </div>
      <!-- End of Main Content -->