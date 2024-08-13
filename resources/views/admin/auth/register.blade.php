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
                <div class="login-userset">
                    <div class="login-logo logo-normal">
                       <img src="{{asset('/')}}admin/assets/img/logo.png" alt="img">
                    </div>
                    <a href="index.html" class="login-logo logo-white">
                       <img src="{{asset('/')}}admin/assets/img/logo-white.png"  alt="">
                    </a>
                    <div class="login-userheading">
                        <h3>Create an Account</h3>
                        <h4>Continue where you left off</h4>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-login">
                            <label>Full Name</label>
                            <div class="form-addons">
                                <input type="text" name="name" placeholder="Enter your full name">
                               <img src="{{asset('/')}}admin/assets/img/icons/users1.svg" alt="img">
                            </div>
                        </div>
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="text" name="email" placeholder="Enter your email address">
                               <img src="{{asset('/')}}admin/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>
                        <div class="form-login">
                            <label>Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="pass-input" placeholder="Enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <label>Password Confirmation</label>
                            <div class="pass-group">
                                <input type="password"  name="password_confirmation" class="pass-input" placeholder="Enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Sign Up</button>
{{--                            <a type="submit" class="btn btn-login">Sign Up</a>--}}
                        </div>
                    </form>
                    <div class="signinform text-center">
                        <h4>Already a user? <a href="{{route('login')}}" class="hover-a">Sign In</a></h4>
                    </div>
                    <div class="form-setlogin">
                        <h4>Or sign up with</h4>
                    </div>
                    <div class="form-sociallink">
                        <ul>
                            <li>
                                <a href="javascript:void(0);">
                                   <img src="{{asset('/')}}admin/assets/img/icons/google.png" class="me-2" alt="google">
                                    Sign Up using Google
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                   <img src="{{asset('/')}}admin/assets/img/icons/facebook.png" class="me-2" alt="google">
                                    Sign Up using Facebook
                                </a>
                            </li>
                        </ul>
                    </div>
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
