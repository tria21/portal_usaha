<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portal Usaha Mikro Kabupaten Jombang</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset("../img/pnglogosje.png")}}" rel="icon">
  <link href="{{asset("../img/pnglogosje.png")}}" rel="apple-touch-icon">

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
  
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}

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
          <li><a class="nav-link scrollto" href="{{route('tampil-usaha')}}">Usaha Mikro</a></li>
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
          @else
          <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
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
          <!-- Start single blog -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- single-blog start -->
                <article class="blog-post-wrapper">
                    <h3 class="mb-30 title_color">Edit Akun</h3>
                    @foreach ($dtAkun as $item)
                    <form action="{{route('edit-proses-akun-pengunjung', $item->id)}}" method="POST">
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="form-group first">
                            <label for="name">Nama</label>
                            <input type="text" name="name" value="{{$item->name}}" id="name" readonly class="form-control">
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group first">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{$item->email}}" id="email"  readonly class="form-control">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group last mb-4">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                        {{-- <div>
                          <input type="checkbox" class="form-checkbox"> Show password
                          </div> --}}
                        <div class="button-group-area">
                            <input type="submit" class="genric-btn success"></button>
                        </div>
                    </form>
                    @endforeach
                </article>
                <div class="clear"></div>
                <!-- single-blog end -->
              </div>
            </div>
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
                  <p><span>Telepon: </span> (0321) 861494</p>
                  <p><span>Jam Kerja: </span> 07.00 - 15.00</p>
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
{{-- <script type="text/javascript">
  $(document).ready(function(){		
      $('.form-checkbox').click(function(){
          if($(this).is(':checked')){
              $('.form-control').attr('type','text');
          }else{
              $('.form-control').attr('type','password');
          }
      });
  });
</script> --}}

</html>