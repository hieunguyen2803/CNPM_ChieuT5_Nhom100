<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Free Stylish Login Page Website Template | Smarteyeapps.com</title>

    <link rel="shortcut icon" href="css/cssAuth/images/lg.jpg">
    <link rel="stylesheet" href="css/cssAuth/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cssAuth/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/cssAuth/css/style.css"/>
    <!--<link rel="shortcut icon" href="assets/images/fav.jpg">-->
<!--<link rel="stylesheet" type="text/css" href="{{asset('cssAuth/css/bootstrap.min.css')}}">-->
<!--<link rel="stylesheet" type="text/css" href="{{asset('cssAuth/css/fontawsom-all.min.css')}}">-->
<!--<link rel="stylesheet" type="text/css" href="{{asset('cssAuth/css/style.css')}}"/>-->
</head>

<body>
<div class="container-fluid ">
    <div class="container ">
        <div class="row ">
            <div class="col-sm-10 login-box">
                <div class="row">
                    <div class="col-lg-8 col-md-7 log-det">
                        <div class="small-logo">
                            <i class="fab fa-asymmetrik"></i> Style Login
                        </div>
                        <h2>Sign in to Smarteyeapps</h2>
                        <div class="row">
                            <ul>
                                <li><a href="{{route('redirect')}}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{route('redirect')}}"><i class="fab fa-google"></i></a></li>
                                <li><i class="fab fa-linkedin-in"></i></li>
                            </ul>
                        </div>
                        <div class="row">
                            <p class="small-info">or use your email account</p>
                        </div>

                        <form action="{{route('login')}}" method="POST">
                            @csrf
                        <div class="text-box-cont">
                            @if(session('mess'))
                            <div class="alert alert-success" role="alert" style="font-size: 13px">
                                {{session('mess')}}
                            </div>
                            @endif
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Email" aria-label="Username" required title=""
                                     name="email"  aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" aria-label="Username"
                                    name="password"   aria-describedby="basic-addon1">
                            </div>
                            <div class="row">
                                <p class="forget-p">Forget Password ?</p>
                            </div>
                            <div class="input-group center mb-3">
                                <button class="btn btn-success btn-round">SIGN IN</button>
                            </div>
                        </div>
                        </form>


                    </div>
                    <div class="col-lg-4 col-md-5 box-de">
                        <div class="ditk-inf">
                            <h2 class="w-100">Din't Have an Account </h2>
                            <p>Simply Create your account by clicking the Signup Button</p>
                            <a href="signup.html">
                                <button type="button" class="btn btn-outline-light">SIGN UP</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="css/cssAuth/js/jquery-3.2.1.min.js"></script>
<script src="css/cssAuth/js/popper.min.js"></script>
<script src="css/cssAuth/js/bootstrap.min.js"></script>
<script src="css/cssAuth/js/script.js"></script>


</html>
