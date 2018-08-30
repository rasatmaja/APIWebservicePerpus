<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Webservice Perputakaan Pusat Universitas Brawijaya</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/images/fav.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../assets/partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a class="navbar-brand brand-logo" href="../assets/index.html">
              <img style="width:75%;" src="../assets/images/logo.png" alt="logo" />
            </a>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link">
              <span class="profile-text">Hello, Administrator</span>
            </a>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link">
              <span class="profile-text">Logout</span>
              <span class="mdi mdi-logout"></span>
            </a>
          </li>
        </ul>
        <a style="" class="navbar-toggler navbar-toggler-right d-lg-none align-left">
          Hello Administrator
        </a>
        <a style="" class="navbar-toggler navbar-toggler-right d-lg-none align-left">
          Logout
          <span class="mdi mdi-exit-to-app"></span>
        </a>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Data API Key</h4>
              <div class="row">
                <div class="col-12 row">
                  <style>
                    .table th {
                      padding-left: 12px; //vertical-align: middle;
                      //border-top: 1px solid #f2f2f2;
                    }

                    .table td {
                      padding: 2px 2px 2px 12px;
                      vertical-align: middle;
                      border-top: 1px solid #f2f2f2;
                    }
                  </style>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="order-listing">
                      <div class="col-sm-12 col-md-6" style="margin:0px 0px 11px 0px;">
                        <button data-toggle="modal" data-target="#tambahAPU" class="btn btn-outline-primary">
                          <span class="mdi mdi-plus-circle"></span> TAMBAH API</button>
                      </div>

                      <div class="modal fade" id="tambahAPU" tabindex="-1" role="dialog" aria-labelledby="tambahAPU" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="tambahAPU">Tambah API</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <!-- <form action="http://localhost:8123/API_Webservice_Perpus/api-management/" method="POST"> -->
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="namaunitkerja">Nama Unit Kerja</label>
                                  <input type="namaunitkerja" class="form-control" id="namaunitkerja" name="namaunitkerja" placeholder="Nama Unit Kerja">
                                </div>
                                <div class="form-group">
                                  <label for="ipaddress1">IP Address</label>
                                  <input type="ipaddress1" class="form-control" id="ipaddress1" name="ipaddress1" placeholder="IP Address">
                                </div>
                                <div class="form-group">
                                  <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" id="cek"> Apakah IP Range?
                                      <i class="input-helper"></i>
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group" id="ipaddress2form">
                                  <label for="ipaddress2">IP Address</label>
                                  <input type="ipaddress2" class="form-control" id="ipaddress2" name="ipaddress2" placeholder="IP Address">
                                </div>
                              </div>

                              <div class="modal-footer">
                                <input id="create_api" type="submit" class="btn btn-success" value="Simpan">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                              </div>
                            <!-- </form> -->

                          </div>
                        </div>
                      </div>




                      <thead>
                        <tr>
                          <th style="width:10px;">No.</th>
                          <th>Nama</th>
                          <th>API Key</th>
                          <th>IP Server</th>
                          <th style="width:40px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                      $no=0;
                      foreach($api_data as $a_d){
                       $no++;   
                        ?>
                        <tr>
                          <td>
                            <?php echo $no; ?>
                          </td>
                          <td contenteditable class="nama" data-id1="<?php echo $a_d->id; ?>">
                            <?php echo $a_d->nama; ?>
                          </td>
                          <td contenteditable class="api_key" data-id2="<?php echo $a_d->id; ?>">
                            <?php echo $a_d->api_key; ?>
                          </td>
                          <td>
                            <button id="tampilkan_button" data-id3="<?php echo $a_d->api_key; ?>" data-toggle="modal" data-target="#tampilkanIP" class="btn btn-xs btn-info text-white">
                              Tampilkan IP Adress</button>
                          </td>
                          <td>
                            <button id="delete_button" data-id4="<?php echo $a_d->api_key; ?>" class="btn btn-xs btn-danger text-white">Hapus</button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="modal fade" id="tampilkanIP" tabindex="-1" role="dialog" aria-labelledby="tampilkanIP" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="tampilkanIP">Daftar AP Address</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p id="daftar_ip">Daftar IP Address
                          </p>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                <a href="">Tim PKL Filkom</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/data-table.js"></script>
    <script src="../assets/js/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.css">

    <script>
      $(document).ready(function () {
        $("#ipaddress2form").hide();

        $("#cek").click(function () {
          if ($("#cek").is(":checked"))
            $("#ipaddress2form").show();
          else {
            $("#ipaddress2form").hide();
          }
        });
      });
    </script>


    <script type="text/javascript">
      $(document).ready(function () {
        function edit_data(id, text, column_name) {
          $.ajax({
            url: "http://localhost:8123/API_Webservice_Perpus/api-management/",
            method: "PUT",
            data: {
              id: id,
              text: text,
              column_name: column_name
            },
            dataType: "text",
            success: function (data) {
              swal("Update Success!", "Data API berhasil diperbaharui!", "success");
            }
          });
        }

        function delete_data(id) {
          $.ajax({
            url: "http://localhost:8123/API_Webservice_Perpus/api-management/",
            method: "DELETE",
            data: {
              api_key: id
            },
            dataType: "text",
            success: function (data) {
              swal({
                title: "Delete Success",
                text: "Data API berhasil dihapus",
                type: "success"
              }, function () {
                window.location = "http://localhost:8123/API_Webservice_Perpus/api-management/";
              });
            }
          });
        }

        function show_ip(id) {
          var url = 'http://localhost:8123/API_Webservice_Perpus/api-management/ip/' + id + '/';
          $.ajax({
            url: url,
            type: 'GET',
            datatype: 'json',
            success: function (data) {
              $('#daftar_ip').empty()
              $.each(data, function (i, item) {
                $("<span>" + item.ip + "</span></br>").appendTo("#daftar_ip");
              });
            }
          })
        }

        function create_api() {
          var nama = $('#namaunitkerja').val();
          var ip1 =$('#ipaddress1').val();
          var ip2 = $('#ipaddress2').val();
          
          $.ajax({
            url: "http://localhost:8123/API_Webservice_Perpus/api-management/",
            method: "POST",
            data: {
              namaunitkerja: nama,
              ipaddress1 : ip1,
              ipaddress2 : ip2
            },
            dataType: "text",
            success: function (data) {
              swal({
                title: "Create Success",
                text: "Data API berhasil ditambahkan",
                type: "success"
              }, function () {
                window.location = "http://localhost:8123/API_Webservice_Perpus/api-management/";
              });
            }
          });
        }

        $(document).on('blur', '.nama', function () {
          var id = $(this).data("id1");
          var nama = $(this).text();
          edit_data(id, nama, "nama");
        });
        $(document).on('blur', '.api_key', function () {
          var id = $(this).data("id2");
          var api_key = $(this).text();
          edit_data(id, api_key, "api_key");
        });

        $(document).on('click', '#tampilkan_button', function () {
          var id = $(this).data("id3");
          show_ip(id);
        });

        $(document).on('click', '#delete_button', function () {
          var id = $(this).data("id4");
          delete_data(id);
        });

        $(document).on('click', '#create_api', function () {
          create_api();
        });

      });
    </script>
</body>

</html>