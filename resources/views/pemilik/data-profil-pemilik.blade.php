<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Business Owner</title>
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
  {{-- <link rel="shortcut icon" href="{{asset('../skydash/template/images/favicon.png')}}" /> --}}
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
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{route('dashboard-pemilik-usaha')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('data-profil-pemilik')}}" >
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profil</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Data Artikel</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{route('data-artikel-pemilik')}}">Kelola Artikel</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="#">Kelola Komentar</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- end sidebar -->

      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                @csrf
                @foreach ($user as $item)
                <div class="card-body">
                  <h4 class="card-title">Informasi Akun</h4>
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-square" src="{{asset('img/'.$item->image)}}" alt="User profile picture" height="10%" width="50%">
                  </div>
                  <center><h4 class="card-title">{{$item->nama_usaha}}</h4></center>
                  <center>
                  <p class="card-description">
                    {{$item->name}}
                  </p></center>
                  <form class="forms-sample" action="{{route('update-profil-pemilik', $item->id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                      <label for="nama_usaha" class="col-sm-3 col-form-label">Nama Usaha</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" value="{{$item->nama_usaha}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Nama Pemilik</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" value="{{$item->name}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" value="{{$item->email}}" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="image" class="col-sm-3 col-form-label">Foto</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="image">
                      </div>
                    </div>
                    {{-- <div class="form-group row">
                      <img src="{{asset('img/'.$item->image)}}" height="10%" width="50%" alt="" srcset="">
                    </div> --}}
                    <div class="form-group row">
                      <label for="jenis_usaha" class="col-sm-3 col-form-label">Jenis Usaha</label>
                      <div class="col-sm-9">
                        <select name="jenis_usaha" class="form-control" id="jenis_usaha">
                          <option value="">--Pilih Kategori--</option>
                          <option value="Perdagangan" {{ $item->jenis_usaha == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                          <option value="Industri Pengolaha" {{ $item->jenis_usaha == 'Industri Pengolahan' ? 'selected' : '' }}>Industri Pengolahan</option>
                          <option value="Informasi dan Komunikasi" {{ $item->jenis_usaha == 'Informasi dan Komunikasi' ? 'selected' : '' }}>Informasi dan Komunikasi</option>
                          <option value="Makanan dan Minuman" {{ $item->jenis_usaha == 'Makanan dan Minuman' ? 'selected' : '' }}>Makanan dan Minuman</option>
                          <option value="Aktivitas Jasa" {{ $item->jenis_usaha == 'Aktivitas Jasa' ? 'selected' : '' }}>Aktivitas Jasa</option>
                          <option value="Lainnya" {{ $item->jenis_usaha == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="alamat_usaha" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat_usaha" name="alamat_usaha" value="{{$item->alamat_usaha}}">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="{{route('data-profil-pemilik')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
              @endforeach
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              @csrf
              @foreach ($user as $item)
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ubah Password</h4>
                  <form class="forms-sample" action="{{route('update-password-pemilik', $item->id)}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Konfrimasi Password Baru</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="{{route('data-profil-pemilik')}}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="col-10">
                      <h4 class="card-title">Data Sosial Media dan Google Maps</h4>
                    </div>
                    <div class="col-2">
                      <a href="{{route('input-sosmed')}}" class="btn btn-primary btn-sm">Tambah Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Sosial Media</th>
                          <th>Tautan Sosial Media</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1 ?>
                        @foreach ($dtSosmed as $item)
                        <tr>
                          <th>{{ $no++ }}</th>
                          <th>{{$item->nama_sosmed}}</th>
                          <th>{{$item->link_sosmed}}</th>
                          <th>
                            <a href="{{route('edit-sosmed',$item->id)}}" class="btn btn-info btn-sm">
                              <i class="ti-pencil btn-icon-append"></i></a>
                            <a href="{{route('hapus-sosmed',$item->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Yakin Akan Menghapus Data?')">
                              <i class="ti-trash btn-icon-append"></i></a>
                          </th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      </div>
        <!-- END CONTENT -->
      <div>
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
  <!-- End custom js for this page-->
</body>

</html>