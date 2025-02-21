<?php
$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
require_once '../app/views/authen/' . $data['page'] . '.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Đăng nhập hoặc Đăng ký</title>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link rel="stylesheet" href="<?php echo $path ?>css/authen.css">
</head>

<body>
    <h2></h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="<?php echo $path ?>authen/home/signup" method="post">
                <h1>Tạo tài khoản</h1>
                <div class="social-container">
                    <a href="#" class="social fb"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social gg"><i class="bi bi-google"></i></a>
                    <a href="#" class="social ld"><i class="bi bi-linkedin"></i></a>
                </div>
                <span>hoặc sử dụng email của bạn để đăng ký</span>
                <input type="text" placeholder="Tên tài khoản" name="username" required />
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Mật khẩu" name="password" required />
                <button type="submit" class="signup">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="<?php echo $path ?>authen/home/login" method="post">
                <h1>Đăng nhập</h1>
                <div class="social-container">
                    <a href="#" class="social fb"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social gg"><i class="bi bi-google"></i></a>
                    <a href="#" class="social ld"><i class="bi bi-linkedin"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn</span>
                <input type="text" placeholder="Email hoặc Tài khoản" name="username" required />
                <input type="password" placeholder="Mật khẩu" name="password" required />
                <button type="submit" class="login">Đăng nhập</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng bạn quay lại!</h1>
                    <p>Đăng nhập và trải nghiệm</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn đến với website!</h1>
                    <p>Để có thể nhận được những thông tin mới nhất vui lòng đăng ký tài khoản tại đây</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>