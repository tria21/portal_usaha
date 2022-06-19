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

    <title>Login</title>
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
                                    <h1>Lupa Password</h1>
                                </div>
                                <form action="forgot-password" method="POST">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                    @endif
                                    @csrf
                                    <div class="form-group last mb-4">
                                        <label for="email">Masukkan Email</label>
                                        <input type="email" name="email" value="{{old('email')}}" id="email"  class="form-control">
                                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                    </div>
                                    
                                    <div class="d-flex mb-5 align-items-center">
                                        <span><a href="login" class="forgot-pass">Kembali ke laman login</a></span> 
                                    </div> 
                                    
                                    <div>
                                        <button class="btn btn-block btn-primary" type="submit">Reset Password</button>
                                    </div>
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