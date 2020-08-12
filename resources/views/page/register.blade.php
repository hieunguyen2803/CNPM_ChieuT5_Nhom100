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
    <style>
        .box-de{
            background-color: #167ce9;
        }
        .btn{
            background-color: #167ce9
        }
    </style>

</head>
{{--<script>--}}
{{--    var password = document.getElementById("password")--}}
{{--        , confirm_password = document.getElementById("confirm_password");--}}

{{--    function validatePassword(){--}}
{{--        if(password.value != confirm_password.value) {--}}
{{--            confirm_password.setCustomValidity("Passwords Don't Match");--}}
{{--        } else {--}}
{{--            confirm_password.setCustomValidity('');--}}
{{--        }--}}
{{--    }--}}
{{--    password.onload = validatePassword;--}}
{{--    confirm_password.onkeyup = validatePassword;--}}

{{--</script>--}}
<body>
<div class="container-fluid ">
    <div class="container ">
        <div class="row ">

            <div class="col-sm-10 login-box">
                <div class="row">
                    <div class="col-lg-4 col-md-5 box-de">
                        <div class="small-logo">
                            <i class="fab fa-asymmetrik"></i> Group 06
                        </div>
                        <div class="ditk-inf sup-oi">
                            <h2 class="w-100">Already Have an Account </h2>
                            <p>Simply login to your account by clicking the login Button</p>
                            <a href="{{asset('login')}}">
                                <button type="button" class="btn btn-outline-light">SIGN IN</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 log-det">

                        <h2>Create Account</h2>
                        <div class="row">
                            <ul>
{{--                                route fb gg--}}
                               <li><a href="auth/facebook"><i class="fab fa-facebook-f"></i></a></li>
                               <li><a href="auth/google"><i class="fab fa-google"></i></a></li>
                                <li><i class="fab fa-linkedin-in"></i></li>
                            </ul>
                        </div>
                        <div class="row">
                            <p class="small-info">or use your email account</p>
                        </div>
{{--                        route form reg--}}
                        <form action="{{route('register')}} "method="POST">
{{--                            thông báo trả về--}}
                        @csrf
                        <div class="text-box-cont">
                            @if(session('mess'))
                                <div class="alert alert-danger" role="alert" style="font-size: 13px">
                                    {{session('mess')}}
                                </div>
                            @endif
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-user"></i></span>
                                </div>
                                <input type="" class="form-control" placeholder="First Name" aria-label="Username"
                                       aria-describedby="basic-addon1" name="firstname"required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-user"></i></span>
                                </div>
                                <input type="" class="form-control" placeholder="Last Name" aria-label="Username"
                                       aria-describedby="basic-addon1" name="lastname"required>
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-envelope"></i>
                                        </span>
                                </div>

                                <input type="email" class="form-control" placeholder="Email Address"
                                       aria-label="" aria-describedby="basic-addon1" required name="email">
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control" placeholder="Password" aria-label="Username"
                                       aria-describedby="basic-addon1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" required></i></span>
                                </div>
                                <input id="confirm_password" type="password" class="form-control" placeholder="Confirm Password" aria-label="Username"
                                       aria-describedby="basic-addon1" name="repassword" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="" class="form-control" placeholder="Phone Number" aria-label="Username"
                                       aria-describedby="basic-addon1" pattern="(\+84|0)\d{9,10}"
                                       required name="phone">
                            </div>

                                <input type="radio" id="male" name="gender" value="male" required>
                                <label for="male">Male</label>
                                <input type="radio" id="female" name="gender" value="female" required>
                                <label for="female">Female</label>
                                <input type="radio" id="other" name="gender" value="other" required>
                                <label for="other">Other</label>





                            <div class="input-group center sup mb-3">
                                <button class="btn btn-success btn-round">SIGN UP</button>
                            </div>
                        </div>
                        </form>

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
<script src="{{asset('js/newJS/confirmpassJS.js')}}"></script>


</html>
