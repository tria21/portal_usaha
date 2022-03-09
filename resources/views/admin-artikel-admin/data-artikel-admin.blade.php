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
            <h1 class="m-0">Data Artikel Admin</h1>
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
            <a href="{{route('input-artikel-admin')}}" class="btn btn-success">Tambah Data  <i class="fas fa-plus-square"></i></a>
          </div>
        </div>

        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Gambar</th>
              <th>Caption Gambar</th>
              <th>Isi Konten</th>
              <th>Aksi</th>
            </tr>
            <?php $no = 1 ?>
            @foreach ($dtArtikelAdmin as $item)
            <tr>
              <th>{{ $no++ }}</th>
              <th>{{$item->judul}}</th>
              <th width="20%">
                {{-- <a href="{{asset('img/'.$item->image)}}" target="_blank" rel="">Lihat Gambar</a> --}}
                <img src="{{asset('img/'.$item->gambar)}}" height="10%" width="80%" alt="" srcset="">
                {{-- {{$item->image}} --}}
              </th>
              <th>{{$item->caption_gambar}}</th>
              <th>{{$item->isi_konten}}</th>
              <th>
                <a href=""><i class="fas fa-edit"></i></a> |
                <a href=""><i class="fas fa-trash-alt" style="color: red" onclick="return confirm('Apakah Yakin Akan Menghapus Data?')"></i></a>
              </th>
            </tr>
            @endforeach
          </table>
        </div>
      </div>

<!-- REQUIRED SCRIPTS -->
@include('template-admin.script')
</body>
</html>
