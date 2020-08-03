<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Forgot password</title>

    <link rel="shortcut icon" href="css/cssAuth/images/lg.jpg">
    <link rel="stylesheet" href="css/cssAuth/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cssAuth/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/cssAuth/css/style.css"/>
</head>

<body>
<div class="container-fluid ">
    <div class="container ">
        <div class="row ">

            <div class="col-sm-10 login-box">
                <div class="row">
                    <div class="col-lg-8 col-md-7 log-det" style="flex: none;max-width: none">

                        <h2>Forgot Password</h2>
                        <div class="row">
                            <ul>
                                {{--<li><i class="fab fa-facebook-f"></i></li>--}}
                                {{--<li><i class="fab fa-twitter"></i></li>--}}
                                {{--<li><i class="fab fa-linkedin-in"></i></li>--}}
                            </ul>
                        </div>
                        <div class="row">
                            <p class="small-info"></p>
                        </div>

                        <form action="{{route('forgot_password')}}" method="POST">
                            {{ csrf_field() }}
                            {{--@csrf--}}
                            <div class="text-box-cont" style="max-width: 450px">
                                @if(session('error'))
                                    <div class="alert alert-success" role="alert" style="font-size: 14px;color: red">
                                        {{session('error')}}
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success" role="alert" style="font-size: 14px">
                                        {{session('success')}}
                                    </div>
                                @endif
                                <div class="input-group mb-3">
                                    <label style="margin: 8px">Nhập Email:</label>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                       <i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                           aria-describedby="basic-addon1" name="email" value="" required>
                                </div>

                                <div class="input-group center sup mb-3">
                                    <button class="btn btn-success btn-round">SUBMIT</button>
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


</html>
