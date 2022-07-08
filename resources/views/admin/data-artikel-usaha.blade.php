<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('../skydash/template/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('../skydash/template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('../skydash/template/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('../skydash/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('../skydash/template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('./skydash/template/js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('../skydash/template/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  
    <!-- Favicons -->
  <link href="{{asset("../img/pnglogosje.png")}}" rel="icon">
  <link href="{{asset("../img/pnglogosje.png")}}" rel="apple-touch-icon">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <div class="navbar-brand brand-logo mr-5" ><img src="{{asset('../skydash/template/images/logo.png')}}" class="mr-2" alt="logo"/></div>
        <div class="navbar-brand brand-logo-mini"><img src="{{asset('../skydash/template/images/logo-dinas.jpg')}}" alt="logo"/></div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="badge badge-danger badge-counter">{{$CountNotif}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              @forelse ($dtNotif as $item)
              <a href="{{route('read-more-artikel-beranda', $item->id_artikel)}}" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="ti-comment-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal"><b>{{ Str::limit($item->nama_user, 8)}}</b> meninggalkan komentar di artikel <b>{{ Str::limit($item->judul, 8)}}</b></h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    {{ Str::limit($item->isi_komentar, 50)}}
                  </p>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}
                  </p>
                </div>
              </a>
              @empty
              <a href="" class="dropdown-item preview-item">
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Tidak Ada Notifikasi</h6>
                </div>
              </a>
              @endforelse
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('../skydash/template/images/faces/admin.jpg')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{route('logout')}}">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->

      <!-- sidebar -->
      <nav class="sidebar" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{route('dashboard-admin')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Data Beranda</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('data-beranda')}}">Kelola Galeri</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('data-tentang')}}">Kelola Tentang</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Data Akun</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('data-akun-pemilik-usaha-admin')}}">Akun Pemilik Usaha</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('data-akun-masyarakat-admin')}}">Akun Masyarakat</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Data Artikel</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{route('data-artikel-admin')}}">Artikel Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('data-artikel-usaha')}}">Artikel Usaha</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- end sidebar -->
      
      <!-- CONTENT -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="col-5">
                      <h4 class="card-title">Artikel Pemilik Usaha</h4>
                    </div>
                    <div class="col-1">
                      <a href="{{route('cetak-artikel-usaha')}}" target="_blank" class="btn btn-sm btn-outline-primary">
                      PDF</a>
                    </div>
                    <div class="col-1">
                      <a href="{{route('export-excel-artikel-usaha')}}" target="_blank" class="btn btn-sm btn-outline-dark">
                        Excel</a>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                        <form action="{{route('cari-artikel-usaha')}}" method="GET">
                          <div class="input-group">
                            <input type="text" name="cari" id="cari" class="form-control" placeholder="Masukkan Kata Kunci" value="{{ old('keyword') }}">
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="col-2">
                      <center><p><b>Cetak dari : </b></p></center>
                    </div>
                    <div class="col-3">
                      <input type="date" name="tglawal" class="form-control" id="tglawal">
                    </div>
                    <div class="col-1">
                      <center><p><b>s/d</b></p></center>
                    </div>
                    <div class="col-3">
                      <input type="date" name="tglakhir" class="form-control" id="tglakhir">
                    </div>
                    <div class="col-1">
                      <a href="" onclick="this.href='/cetak-artikel-usaha-custom/'+ document.getElementById('tglawal').value +
                      '/' + document.getElementById('tglakhir').value " target="_blank" class="btn btn-sm btn-outline-primary">
                      PDF</a>
                    </div>
                    {{-- <div class="col-1">
                      <a href="#" target="_blank" class="btn btn-sm btn-outline-dark">
                        Excel</a>
                    </div> --}}
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Judul</th>
                          <th>Gambar</th>
                          <th>Kategori</th>
                          <th>Penulis</th>
                          <th>Tanggal Dibuat</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1 ?>
                        @foreach ($dtArtikelPemilik as $item)
                        <tr>
                          <th>{{ $no++ }}</th>
                          <th>{{ Str::limit($item->judul, 25)}}</th>
                          <th width="20%">
                            <img src="{{asset('img/'.$item->gambar)}}" height="10%" width="80%" alt="" srcset="">
                          </th>
                          <th>{{$item->kategori}}</th>
                          <th>{{ Str::limit($item->penulis, 25)}}</th>
                          <th>{{ Str::limit($item->created_at, 25)}}</th>
                          <th>
                            <a href="{{route('detail-artikel-usaha',$item->id)}}" class="btn btn-success btn-sm">
                              <i class="ti-eye btn-icon-append"></i></a>
                            <a href="{{route('hapus-artikel-pemilik',$item->id)}}" class="btn btn-danger btn-sm delete" data-id="{{$item->id}}">
                              <i class="ti-trash btn-icon-append"></i></a>
                          </th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  {{ $dtArtikelPemilik->links() }}<br>
                  Halaman Saat Ini: {{ $dtArtikelPemilik->currentPage() }}<br>
                  Jumlah Data: {{ $dtArtikelPemilik->total() }}<br>
                  Data perhalaman: {{ $dtArtikelPemilik->perPage() }}<br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END CONTENT -->
        
        <!-- footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><a href="https://www.jombangkab.go.id/" target="_blank">DINAS KOPERASI DAN USAHA MIKRO KABUPATEN JOMBANG</a></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sistem Informasi Portal Usaha Mikro Kabupaten Jombang </span>
          </div>
        </footer>
        <!-- end footer -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('../skydash/template/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('../skydash/template/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('../skydash/template/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('../skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('../skydash/js/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('../skydash/template/js/off-canvas.js')}}"></script>
  <script src="{{asset('../skydash/template/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('../skydash/template/js/template.js')}}"></script>
  <script src="{{asset('../skydash/template/js/settings.js')}}"></script>
  <script src="{{asset('../skydash/template/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('../skydash/template/js/dashboard.js')}}"></script>
  <script src="{{asset('../skydash/template/js/Chart.roundedBarCharts.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- End custom js for this page-->
</body>
<script>
  $('.delete').click( function() {
    var idhapus = $(this).attr('data-id');
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda akan menghapus data ini, data yang sudah dihapus tidak dapat dipulihkan!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "hapus-artikel-usaha/"+idhapus+""
        swal("Data berhasil dihapus!", {
          icon: "success",
        });
      } else {
        swal("Data batal dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>
</html>