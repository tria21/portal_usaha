<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>eBusiness Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset("../newsroom/assets/img/favicon.png")}}" rel="icon">
  <link href="{{asset("../newsroom/assets/img/apple-touch-icon.png")}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset("../newsroom/assets/vendor/animate.css/animate.min.css")}}" rel="stylesheet">
  <link href="{{asset("../newsroom/assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
  <link href="{{asset("../newsroom/assets/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
  <link href="{{asset("../newsroom/assets/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
  <link href="{{asset("../newsroom/assets/vendor/glightbox/css/glightbox.min.css")}}" rel="stylesheet">
  <link href="{{asset("../newsroom/assets/vendor/swiper/swiper-bundle.min.css")}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset("../newsroom/assets/css/style.css")}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness - v4.7.0
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <img src="{{asset('../skydash/template/images/logo-putih.png')}}" alt="logo"/>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="{{route('dashboard-pengunjung')}}">Beranda</a></li>
          <li><a class="nav-link scrollto" href="{{route('tampil-tentang')}}">Tentang</a></li>
          <li><a class="nav-link scrollto" href="{{route('tampil-artikel')}}">Artikel</a></li>
          <li><a class="nav-link scrollto active" href="{{route('tampil-artikel')}}">Usaha Mikro</a></li>
          @if(session('loginRole') =='2') 
          <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('edit-akun-pengunjung')}}">Pengaturan Akun</a></li>
              <li><a href="{{route('logout')}}">Logout</a></li>
            </ul>
          </li>
          @elseif(session('loginRole') =='3')
          <li><a class="nav-link scrollto" href="{{route('dashboard-admin')}}">Dashboard Admin</a></li>
          @elseif(session('loginRole') =='1')
          <li><a class="nav-link scrollto" href="{{route('dashboard-pemilik-usaha')}}">Dashboard Usaha</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active" style="background-image: url({{asset("../newsroom/assets/img/slide/dinkoprame.jpg")}})">
            <div class="carousel-container">
              <div class="container">
                <h2 class="animate__animated animate__fadeInDown">Dinas Koperasi dan Usaha Mikro Kabupaten Jombang</h2>
                <p class="animate__animated animate__fadeInUp">Portal Usaha Mikro Kabupaten Jombang</p>
              </div>
            </div>
          </div>

          <div class="carousel-item" style="background-image: url({{asset("../newsroom/assets/img/slide/dinkopworsop.jpg")}})">
            <div class="carousel-container">
              <div class="container">
                <h2 class="animate__animated animate__fadeInDown">Dinas Koperasi dan Usaha Mikro Kabupaten Jombang</h2>
                <p class="animate__animated animate__fadeInUp">Portal Usaha Mikro Kabupaten Jombang</p>
                {{-- <a href="#about" class="btn-get-started scrollto animate__animated animate__fadeInUp">Get Started</a> --}}
              </div>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="page-head-blog">
              <div class="single-blog-page">
                <div class="left-blog">
                  <h4>Kategori</h4>
                  <ul>
                    <li>
                      @php $kategori = 'Perdagangan' @endphp
                      <a href="#">Perdagangan</a>
                    </li>
                    <li>
                      @php $kategori = 'Industri Pengolahan' @endphp
                      <a href="#">Industri Pengolahan</a>
                    </li>
                    <li>
                      @php $kategori = 'Informasi dan Komunikasi' @endphp
                      <a href="#">Informasi dan Komunikasi</a>
                    </li>
                    <li>
                      @php $kategori = 'Makanan dan Minuman' @endphp
                      <a href="#">Makanan dan Minuman</a>
                    </li>
                    <li>
                      @php $kategori = 'Aktivitas Jasa' @endphp
                      <a href="#">Aktivitas Jasa</a>
                    </li>
                    <li>
                      @php $kategori = 'Lainnya' @endphp
                      <a href="#">Lainnya</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-blog-page">
                    <!-- search option start -->
                    <form action="{{route('cari-usaha')}}" method="GET">
                    <div class="search-option">
                      <input type="text" name="cari" id="cari" placeholder="Masukkan Kata Kunci" value="{{ old('keyword') }}">
                      <button class="button" type="submit">
                        <i class="bi bi-search"></i>
                        </button>
                    </div>
                    </form>
                    <!-- search option end -->
                </div>
                </div>
            </div>
            <div class="row">
                <!-- Start Left Blog -->
                @foreach ($TampilUsaha as $item)
                <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="single-blog">
                    <div class="testimonial-item">
                        <img src="{{asset('img/'.$item->image)}}" class="testimonial-img" alt="">
                    </div>
                    <div class="blog-text">
                    <h4>
                        <a href="#">{{ Str::limit($item->nama_usaha, 25)}}</a>
                    </h4>
                    </div>
                    <span>
                        <a href="{{route('profil-usaha', $item->id)}}" class="ready-btn">Kunjungi</a>
                    </span>
                </div>
                <!-- Start single blog -->
                </div>
                @endforeach
            </div>
            <center>
            {{ $TampilUsaha->links() }}<br>
            </center>
          </div>
        </div>
      </div>
    </div><!-- End Blog Page -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="footer-content">
              <div class="footer-head">
                <div class="footer-logo">
                  <img src="{{asset('../skydash/template/images/logo.png')}}" alt="logo"/>
                </div>

                <p>Jl. Presiden KH. Abdurrahman Wahid No.132, Candi Mulyo, Kec. Jombang, Kabupaten Jombang, Jawa Timur 61419</p>
                <div class="footer-contacts">
                  <p><span>Telepon:</span> (0321) 861494</p>
                  <p><span>Jam Kerja:</span> 07.00 - 15.00</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
  </footer>
  <!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset("../newsroom/assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{asset("../newsroom/assets/vendor/glightbox/js/glightbox.min.js")}}"></script>
  <script src="{{asset("../newsroom/assets/vendor/isotope-layout/isotope.pkgd.min.js")}}"></script>
  <script src="{{asset("../newsroom/assets/vendor/swiper/swiper-bundle.min.js")}}"></script>
  <script src="{{asset("../newsroom/assets/vendor/php-email-form/validate.js")}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset("../newsroom/assets/js/main.js")}}"></script>

</body>

</html>