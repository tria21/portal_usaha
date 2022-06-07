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
    
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}

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
                                    <h1>Login</h1>
                                </div>
                                <form action="{{route('login-user')}}" method="POST">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                    @endif
                                    @csrf
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
                                    {{-- <div>
                                    <input type="checkbox" class="form-checkbox"> Show password
                                    </div> --}}
                                    
                                    <div class="d-flex mb-5 align-items-center">
                                        <span class="ml-auto"><a href="registration" class="forgot-pass">Belum punya akun? Registrasi disini!</a></span> 
                                    </div>
                                    
                                    <button class="btn btn-block btn-primary" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{asset('templete/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('templete/js/popper.min.js')}}"></script>
    <script src="{{asset('templete/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('templete/js/main.js')}}"></script>
</html>