<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('templete/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('templete/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('templete/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('templete/css/style.css')}}">
  
    <!-- Favicons -->
  <link href="{{asset("../img/pnglogosje.png")}}" rel="icon">
  <link href="{{asset("../img/pnglogosje.png")}}" rel="apple-touch-icon">

    <title>Registrasi Pemilik Usaha Mikro</title>
  </head>
  <body>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('templete/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6 contents">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h1>Registrasi Pemilik Usaha Mikro</h1>
                                </div>
                                <div class="mb-4">
                                    <span class="ml-auto"><a href="registration" class="forgot-pass">Registrasi sebagai pengunjung disini!</a></span>
                                </div>
                                <form action="{{route('register-owner')}}" method="POST">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                    @endif
                                    @csrf
                                    <div class="form-group first">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control">
                                        <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group first">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{old('email')}}" id="email"  class="form-control">
                                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" value="{{old('password')}}" id="password" class="form-control">
                                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group first">
                                        <span id="captcha-img">
                                            {!!captcha_img()!!}
                                        </span>
                                        {{-- <span id="reload" class="btn">Reload</button> --}}
                                    </div>
                                    <div class="form-group last mb-4"> 
                                        <label for="captcha">Hasil Captcha</label>
                                        <input type="text" name="captcha" class="form-control">
                                    </div>
                                    <div class="d-flex mb-5 align-items-center">
                                        <span class="ml-auto"><a href="login" class="forgot-pass">Sudah punya akun? Login disini!</a></span> 
                                    </div>
                                    
                                    <button class="btn btn-block btn-primary" type="submit">Registrasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('templete/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('templete/js/popper.min.js')}}"></script>
    <script src="{{asset('templete/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('templete/js/main.js')}}"></script>
</html>