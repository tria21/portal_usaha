
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
            <h1 class="m-0">Input Data Artikel Admin</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="card card-info card-outline">
        <div class="card-body">
        <form action="{{route('input-proses-artikel-admin')}}" method="POST" enctype="multipart/form-data">
            
          {{ csrf_field() }}
          <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" placeholder="Masukkan Judul Artikel..." class="form-control">
          </div>
          <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" placeholder="" class="form-control">
          </div>
          <div class="form-group">
            <label>Caption Gambar</label>
            <textarea type="text" name="caption_gambar" placeholder="Tuliskan Caption Gambar..." class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Isi Konten</label>
            <textarea type="text" name="isi_konten" placeholder="Tuliskan Isi Konten..." class="form-control"></textarea>
          </div>
          <div class="form-group">
            <a href="{{route('data-artikel-admin')}}" class="btn btn-danger float-right">Batal</a>
            <input type="submit" class="btn btn-primary float-right"></button>
          </div>
        </form>
      </div>
    </div>
<!-- REQUIRED SCRIPTS -->
@include('template-admin.script')
</body>
</html>
