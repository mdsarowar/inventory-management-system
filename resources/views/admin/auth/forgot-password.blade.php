<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Pos admin template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}admin/assets/img/favicon.png">

    @include('admin.include.assets.css')

</head>
<body class="account-page">

<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset ">
                    <div class="login-logo">
                        <img src="{{asset('/')}}admin/assets/img/logo.png" alt="img">
                    </div>
                    <div class="login-userheading">
                        <h3>Forgot password?</h3>
                        <h4>Don’t warry! it happens. Please enter the address <br>
                            associated with your account.</h4>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="text" name="email" placeholder="Enter your email address">
                                <img src="{{asset('/')}}admin/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>
                        <div class="form-login">
                            <button class="btn btn-login" type="submit"> Submit</button>
{{--                            <a class="btn btn-login" href="signin.html">Submit</a>--}}
                        </div>
                    </form>

                </div>
            </div>
            <div class="login-img">
                <img src="{{asset('/')}}admin/assets/img/login.jpg" alt="img">
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->

@include('admin.include.assets.js')
</body>
</html>
