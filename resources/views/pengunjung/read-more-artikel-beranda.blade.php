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
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="{{route('tampil-artikel')}}">Artikel</a></li>
          <li><a class="nav-link scrollto" href="{{route('tampil-usaha')}}">Usaha Mikro</a></li>
          <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Pengaturan Akun</a></li>
              <li><a href="{{route('logout')}}">Logout</a></li>
            </ul>
          </li>
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
                <!-- recent start -->
                <div class="left-blog">
                  <h4>Artikel Terbaru</h4>
                  <div class="recent-post">
                    <!-- start single post -->
                    @foreach ($dtArtikelBeranda as $item)
                    <div class="recent-single-post">
                      <div class="post-img">
                        <a href="{{route('read-more-artikel-beranda', $item->id)}}">
                          <img src="{{asset('img/'.$item->gambar)}}" alt="">
                        </a>
                      </div>
                      <div class="pst-content">
                        <p><a href="{{route('read-more-artikel-beranda', $item->id)}}"> {{$item->judul}}</a></p>
                      </div>
                    </div>
                    @endforeach
                    <!-- End single post -->
                  </div>
                </div>
                <!-- recent end -->
              </div>
              <div class="single-blog-page">
                <div class="left-blog">
                  <h4>Kategori</h4>
                  <ul>
                    <li>
                      @php $kategori = 'Produk' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Produk</a>
                    </li>
                    <li>
                      @php $kategori = 'Teknologi' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Teknologi</a>
                    </li>
                    <li>
                      @php $kategori = 'Pelatihan' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Pelatihan</a>
                    </li>
                    <li>
                      @php $kategori = 'Lomba' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Lomba</a>
                    </li>
                    <li>
                      @php $kategori = 'Bantuan' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Bantuan</a>
                    </li>
                    <li>
                      @php $kategori = 'Tips' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Tips</a>
                    </li>
                    <li>
                      @php $kategori = 'Lainnya' @endphp
                      <a href="{{route('tampil-artikel-kategori', $kategori)}}">Lainnya</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- End left sidebar -->
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- single-blog start -->
                <article class="blog-post-wrapper">
                  @foreach ($dtArtikelID as $item)
                  <div class="post-thumbnail">
                    <img src="{{asset('img/'.$item->gambar)}}" alt="" />
                  </div>
                  <div class="post-information">
                    <h2>{{$item->judul}}</h2>
                    <div class="entry-meta">
                      <span class="author-meta"><i class="bi bi-person"></i> <a href="#">{{$item->penulis}}</a></span>
                      <span><i class="bi bi-clock"></i>{{$item->created_at}}</span>
                      <span class="tag-meta">
                        <i class="bi bi-tags"></i>
                        <a href="#">{{$item->kategori}}</a>
                      </span>
                    </div>
                    <div class="entry-content">
                      <p>{!!$item->isi_artikel!!}</p>
                    </div>
                  </div>
                  @endforeach
                </article>
                <div class="clear"></div>
                <div class="single-post-comments">
                  <div class="comments-area">
                    <div class="comments-heading">
                      <h3>6 comments</h3>
                    </div>
                    <div class="comments-list">
                      <ul>
                        <li class="threaded-comments">
                          <div class="comments-details">
                            <div class="comments-list-img">
                              <img src="{{asset("../newsroom/assets/img/blog/b02.jpg")}}" alt="post-author">
                            </div>
                            <div class="comments-content-wrap">
                              <span>
                                <b><a href="#">demo</a></b>
                                Post author
                                <span class="post-time">October 6, 2014 at 4:25 pm</span>
                                <a href="#">Reply</a>
                              </span>
                              <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="comments-details">
                            <div class="comments-list-img">
                              <img src="{{asset("../newsroom/assets/img/blog/b02.jpg")}}" alt="post-author">
                            </div>
                            <div class="comments-content-wrap">
                              <span>
                                <b><a href="#">admin</a></b>
                                Post author
                                <span class="post-time">October 6, 2014 at 6:18 pm </span>
                                <a href="#">Reply</a>
                              </span>
                              <p>Quisque orci nibh, porta vitae sagittis sit amet, vehicula vel mauris. Aenean at justo dolor. Fusce ac sapien bibendum, scelerisque libero nec</p>
                            </div>
                          </div>
                        </li>
                        <li class="threaded-comments">
                          <div class="comments-details">
                            <div class="comments-list-img">
                              <img src="{{asset("../newsroom/assets/img/blog/b02.jpg")}}" alt="post-author">
                            </div>
                            <div class="comments-content-wrap">
                              <span>
                                <b><a href="#">demo</a></b>
                                Post author
                                <span class="post-time">October 6, 2014 at 7:25 pm</span>
                                <a href="#">Reply</a>
                              </span>
                              <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="comment-respond">
                    <h3 class="comment-reply-title">Leave a Reply </h3>
                    <span class="email-notes">Your email address will not be published. Required fields are marked *</span>
                    <form action="#">
                      <div class="row">
                        <div class="col-lg-4 col-md-4">
                          <p>Name *</p>
                          <input type="text" />
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <p>Email *</p>
                          <input type="email" />
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <p>Website</p>
                          <input type="text" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 comment-form-comment">
                          <p>Website</p>
                          <textarea id="message-box" cols="30" rows="10"></textarea>
                          <input type="submit" value="Post Comment" />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
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

</html>