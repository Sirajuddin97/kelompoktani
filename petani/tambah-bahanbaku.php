<?php
    include "config/koneksi.php";
    error_reporting(E_ALL ^ (E_ALL));
    session_start();
    if (empty($_SESSION['username'])) {
      header("location:../login.php");
      exit(); 
    }
    $active1 = "active";
 ?>
<!DOCTYPE html>
<html lang="en" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Petani - Tambah Data Bahan Baku</title>
  <?php include "head.php"; ?>
</head>

<body data-col="2-columns" class=" 2-columns ">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include "menu.php"; //  Daftar Menu ?>
  <div class="main-panel">
    <div class="main-content">
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Minimal statistics section start -->
          <section id="minimal-statistics">
            <div class="row d-flex align-items-center justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title-wrap bar-danger">
                      <h4 class="card-title" id="basic-layout-icons">Tambah Data Bahan Baku</h4>
                    </div>
                  </div>
                  <?php
                    $username      = $_SESSION['username'];
                    $query2        = "SELECT * FROM tbl_users WHERE username='".$username."'"; 
                    $sql2          = mysqli_query($connection, $query2); 
                    $data2         = mysqli_fetch_array($sql2);
                  ?>
                  <div class="card-body">
                    <div class="px-3">
                      <form class="form" action="config/simpan.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="aksibahan" value="aksibahan">
                        <input type="hidden" name="id_users" value="<?php echo $data2['id_users']; ?>">
                        <div class="form-group">
                          <label>Nama Bahan</label>
                          <div class="position-relative">
                            <input type="text" class="form-control" name="nama_bahan" placeholder=""
                              required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Stok (Kg)</label>
                          <input type="text" class="form-control" name="stok" required>
                        </div>
                        <div class="form-group">
                          <label>Kebutuhan (Kg)</label>
                          <div class="position-relative">
                            <input type="number" class="form-control" name="kebutuhan" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Foto (Bibit/Pupuk/Racun) yang digunakan</label>
                          <div class="position-relative">
                            <input type="file" class="form-control" name="foto" id="text-only" placeholder=""
                              required style=" margin-top: 1px; padding-top: 3px; padding-left: 4px; ">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Tanggal Update (Otomatis)</label>
                          <div class="position-relative">
                            <input type="text" class="form-control" value="<?php echo date("d/m/Y"); ?>" name="tanggal" readonly>
                          </div>
                        </div>
                        <div class="form-actions right">
                          <button type="reset" class="btn btn-danger mr-1">
                            <i class="icon-close"></i> Reset
                          </button>
                          <button type="submit" class="btn btn-teal">
                            <i class="icon-plus"></i> Tambah
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- // Minimal statistics section end -->
          <!-- Minimal statistics with bg color section start -->

        </div>
        </section>
        <!-- Card columns section end -->
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  </div>
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/core/jquery-3.3.1.min.js"></script>
  <script src="app-assets/vendors/js/core/popper.min.js"></script>
  <script src="app-assets/vendors/js/core/bootstrap.min.js"></script>
  <script src="app-assets/vendors/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="app-assets/vendors/js/prism.min.js"></script>
  <script src="app-assets/vendors/js/jquery.matchHeight-min.js"></script>
  <script src="app-assets/vendors/js/screenfull.min.js"></script>
  <script src="app-assets/vendors/js/pace/pace.min.js"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN CONVEX JS-->
  <script src="app-assets/js/app-sidebar.js"></script>
  <script src="app-assets/js/notification-sidebar.js"></script>
  <script src="app-assets/js/customizer.js"></script>
  <!-- Custom js for this page-->
  <script src="app-assets/vendors/js/toastr.min.js"></script>
  <script src="app-assets/js/toastr.min.js"></script>
  <?php
        error_reporting(E_ALL ^ (E_ALL));
          if($status=$_GET["status"]=="duplicate") { ?>
  <script>
    toastr.error('Silahkan Cek Daftar Data', 'Data Tersebut Sudah Ada!')
  </script>
  <?php } ?>
  <script>
    // Restricts input for the given textbox to the given inputFilter.
    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
        textbox.addEventListener(event, function () {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      });
    }
    // Install input filters.
    setInputFilter(document.getElementById("limit1"), function (value) {
      return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999999999999999);
    });
    setInputFilter(document.getElementById("limit2"), function (value) {
      return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999999999999999);
    });
  </script>
  <script>
    function testInput(event) {
      var value = String.fromCharCode(event.which);
      var pattern = new RegExp(/[a-zåäö ]/i);
      return pattern.test(value);
    }
    $('#text-only').bind('keypress', testInput);
  </script>
</body>

</html>