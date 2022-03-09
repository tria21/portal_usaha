<!DOCTYPE html>

<html lang="en">
<head>
  @include('template-admin.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('template-admin.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('template-admin.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Akun Pemilik Usaha</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="card card-info card-outline">
        <div class="card-header">
          <div class="card-tools">
            <a href="" class="btn btn-success">Tambah Data  <i class="fas fa-plus-square"></i></a>
          </div>
        </div>

        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>No</th>
              <th>Nama Pemilik</th>
              <th>Nama Usaha</th>
              <th>Foto</th>
              <th>Jenis Usaha</th>
              <th>Email</th>
              <th>Password</th>
              <th>Alamat</th>
              <th>Instagram</th>
              <th>Facebook</th>
              <th>Shopee</th>
              <th>Tokopedia</th>
              <th>Aksi</th>
            </tr>
          </table>
        </div>
      </div>

<!-- REQUIRED SCRIPTS -->
@include('template-admin.script')
</body>
</html>
