<?php
    include "config/koneksi.php";
    error_reporting(E_ALL ^ (E_ALL));
    session_start();
    if (empty($_SESSION['username'])) {
      header("location:../login.php");
      exit(); 
    }
    $active2 = "active";
 ?>
<!DOCTYPE html>
<html lang="id" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Petani - Daftar Data Bahan Baku</title>
  <?php include "head.php"; ?>
  <style>
    .btn[class*='btn-'],
    .fc button[class*='btn-'] {
      margin-bottom: 0rem !important;
    }

    .table td {
      padding: 0.3rem;
    }
  </style>
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
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title-wrap bar-teal">
                      <h4 class="card-title" id="basic-layout-icons">Daftar Data Bahan Baku</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="px-3">
                      <div class="card-panel">
                        <div class="">
                          <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered zero-configuration dataTable"
                              cellspacing="0">
                              <thead>
                                <tr>
                                  <th width="5%">No</th>
                                  <th width="15%">Nama Bahan</th>
                                  <th>Stok (KG)</th>
                                  <th>Kebutuhan (KG)</th>
                                  <th>Tanggal</th>
                                  <th>Pilihan</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              $username      = $_SESSION['username'];
                              $query2        = "SELECT * FROM tbl_users WHERE username='".$username."'"; 
                              $sql2          = mysqli_query($connection, $query2); 
                              $data2         = mysqli_fetch_array($sql2);
                              //
                              $no            = 0;
                              $query         = "SELECT * FROM tbl_bahanbaku WHERE id_users='".$data2['id_users']."' order by id_bahanbaku desc"; 
                              $sql           = mysqli_query($connection, $query); 
                              while($data    = mysqli_fetch_array($sql)){ 
                              $no++;
                              
                              echo "<tr>
                                  <td>$no</td>
                                  <td>".$data['nama_bahan']."</td>
                                  <td>".$data['stok']." Kg</td>
                                  <td>".$data['kebutuhan']." Kg</td>
                                  <td>".$data['tanggal']."</td>
                                  ";

                              echo '
                                  <td>

                                  <a href="edit-bahanbaku.php?id_bahanbaku='.$data["id_bahanbaku"].'" data-toggle="tooltip" data-placement="top" title="Edit Data"
                                   class="btn btn-info btn-fab btn-sm"> <i class="icon-note"></i></a>

                                  <a href="config/hapus.php?id_bahanbaku='.$data["id_bahanbaku"].'" data-toggle="tooltip" data-placement="top" title="Hapus Data"
                                   class="btn btn-danger btn-fab btn-sm" onclick="return confirm(\'Yakin ingin menghapus '.$data["nama"].'?\');"> <i class="icon-trash"></i></a>

                                  </td>
                                  </tr>';
                              }
                            ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div><br>
                    </div>
                  </div>

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
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN CONVEX JS-->
  <script src="app-assets/js/app-sidebar.js"></script>
  <script src="app-assets/js/notification-sidebar.js"></script>
  <script src="app-assets/js/customizer.js"></script>
  <!-- END CONVEX JS-->
  <script src="app-assets/js/data-tables/datatable-basic.js"></script>
  <script src="app-assets/vendors/js/datatable/datatables.min.js"></script>
  <script src="app-assets/vendors/js/toastr.min.js"></script>
  <script src="app-assets/js/toastr.min.js"></script>
  <!-- END PAGE LEVEL JS-->
  <?php
          if($status=$_GET["status"]=="done") { ?>
  <script>
    toastr.success('Status Registrasi Diterima', 'Perubahan Tersimpan')
  </script>
  <?php } ?>
  <!-- END PAGE LEVEL JS-->
</body>

</html>