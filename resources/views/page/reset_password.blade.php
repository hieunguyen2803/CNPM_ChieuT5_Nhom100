{{--<!doctype html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--<meta charset="utf-8">--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--<title>Reset password</title>--}}

{{--<link rel="shortcut icon" href="css/cssAuth/images/lg.jpg">--}}
{{--<link rel="stylesheet" href="css/cssAuth/css/bootstrap.min.css">--}}
{{--<link rel="stylesheet" href="css/cssAuth/css/fontawsom-all.min.css">--}}
{{--<link rel="stylesheet" type="text/css" href="css/cssAuth/css/style.css"/>--}}
{{--</head>--}}

{{--<body>--}}
<style>
    .box-de{
        background-color: #167ce9;
    }
    .btn{
        background-color:#167ce9;
    }
    body{
        font-family: "mouse-300", Arial, Helvetica, sans-serif;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
        color: #7782aa;
    }
</style>
@extends('auth.massReset')
@section('reset')
    <div class="container-fluid ">
        <div class="container ">
            <div class="row ">

                <div class="col-sm-10 login-box">
                    <div class="row">
                        <div class="col-lg-8 col-md-7 log-det" style="flex: none;max-width: none">

                            <h2>Change Forgot Password</h2>
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

                            <form action="{{route('reset_password', [$user->email, 'key'=> $key])}}" method="post">
                                {{ csrf_field() }}
                                <div class="text-box-cont" style="max-width: 450px">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-user"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder=""
                                               aria-label="Username"
                                               name="email" aria-describedby="basic-addon1"
                                               value="{{$user->email}}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-lock"></i></i>
                                        </span>
                                        </div>
                                        <input id="password" type="password" class="form-control" placeholder="New password"
                                               aria-label="NewPassword" aria-describedby="basic-addon1"
                                               name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-lock" required></i></span>
                                        </div>
                                        <input id="confirm_password" type="password" class="form-control" placeholder="Confirm Password"
                                               aria-label="RePassword"
                                               aria-describedby="basic-addon1" name="repassword" required>
                                    </div>

                                    <div class="input-group center sup mb-3">
                                        <button class="btn btn-success btn-round" style="background-color: #167ce9;">SUBMIT</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
