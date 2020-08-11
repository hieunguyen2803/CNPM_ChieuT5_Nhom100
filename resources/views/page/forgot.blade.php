<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot</title>
</head>
<body>
<h3>Xin chào {{$user->first_name}} {{$user->last_name}}</h3>
<p>
    Quý khách đã yêu cầu đổi mật khẩu trên trang web Suckhoe.edu <br>
    Nếu thông tin trên là đúng, quý khách vui lòng xác nhận theo đường dẫn sau <br>
    Đường dẫn:
    <a href="{{asset('reset_password/'.$user->email.'/'.$key)}}">{{$user->key}}</a>
</p>

</body>
</html>