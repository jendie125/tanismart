<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengunjung TaniSmart</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            height: 100vh;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left-side {
            flex: 1;
            background-image: url('assets/img/tani-background.jpg');
            /* Ganti dengan path gambar sesuai keinginan */
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .leaf {
            position: absolute;
            width: 20px;
            height: 20px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%2327ae60"><path d="M17,8C8,10,5.9,16.17,3.82,21.34L5.71,22l1-2.3A4.49,4.49,0,0,0,8,20a4,4,0,0,0,4-4,4,4,0,0,0-4-4,4.28,4.28,0,0,0-1.34.24l3.68-8.56C13,5.3,16,7,17,8Z"/></svg>');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.6;
            animation: falling linear infinite;
        }

        @keyframes falling {
            0% {
                transform: translateY(-100px) rotate(0deg) scale(0.7);
                opacity: 0;
            }

            10% {
                opacity: 0.6;
            }

            90% {
                opacity: 0.6;
            }

            100% {
                transform: translateY(calc(100vh + 100px)) rotate(360deg) scale(1);
                opacity: 0;
            }
        }

        /* Cloud animation */
        .cloud {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            filter: blur(20px);
            animation: cloud-move linear infinite;
        }

        @keyframes cloud-move {
            0% {
                transform: translateX(-300px);
            }

            100% {
                transform: translateX(calc(100vw + 300px));
            }
        }

        /* Rain effect */
        .rain {
            position: absolute;
            width: 2px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.7));
            animation: rain linear infinite;
        }

        @keyframes rain {
            0% {
                transform: translateY(-100px);
            }

            100% {
                transform: translateY(calc(100vh + 100px));
            }
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 2rem;
            z-index: 2;
        }

        .site-info {
            text-align: center;
            max-width: 80%;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .site-info h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .site-info .brand {
            color: #2ecc71;
            /* Warna hijau untuk TaniSmart */
            font-weight: 700;
            text-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px rgba(46, 204, 113, 0.5);
            }

            to {
                text-shadow: 0 0 15px rgba(46, 204, 113, 0.8), 0 0 20px rgba(46, 204, 113, 0.5);
            }
        }

        .site-info p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
        }

        .login-container {
            width: 80%;
            max-width: 400px;
            padding: 2rem;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .login-header .brand {
            color: #2ecc71;
            /* Warna hijau untuk TaniSmart */
        }

        .login-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.2);
            outline: none;
        }

        .form-group .help-block {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .btn {
            width: 100%;
            padding: 0.8rem;
            background-color: #2ecc71;
            /* Warna hijau untuk button login */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background-color: #27ae60;
            /* Warna hijau yang lebih gelap saat hover */
        }

        .btn:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            20% {
                transform: scale(25, 25);
                opacity: 0.3;
            }

            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .register-link a {
            color: #2ecc71;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .register-link a:hover {
            color: #27ae60;
            text-decoration: underline;
        }

        .global-error {
            background-color: #ffecec;
            color: #e74c3c;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 0.9rem;
            animation: shake 0.5s linear;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .has-error input {
            border-color: #e74c3c;
        }

        .social-login {
            margin-top: 2rem;
            text-align: center;
        }

        .social-login p {
            position: relative;
            margin-bottom: 1.5rem;
            color: #999;
        }

        .social-login p:before,
        .social-login p:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #ddd;
        }

        .social-login p:before {
            left: 0;
        }

        .social-login p:after {
            right: 0;
        }

        /* Google Sign-In Button container */
        .google-signin-container {
            display: flex;
            justify-content: center;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-side {
                height: 30vh;
            }

            .site-info h1 {
                font-size: 2rem;
            }

            .site-info p {
                font-size: 1rem;
            }

            .login-container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <!-- Animated Background Elements -->
            <div class="animated-bg" id="animatedBg"></div>

            <div class="overlay">
                <div class="site-info">
                    <h1>Selamat Datang di <span class="brand">TaniSmart</span></h1>
                    <p>Platform digital untuk petani modern. Tingkatkan hasil panen dan kesejahteraan dengan teknologi
                        pertanian terkini.</p>
                </div>
            </div>
        </div>

        <div class="right-side">
            <div class="login-container">
                <div class="login-header">
                    <h2>Login Pengunjung <span class="brand">TaniSmart</span></h2>
                    <p>Masukkan informasi akun Anda</p>
                </div>

                <?php if (session('errors')): ?>
                <div class="global-error"><?php echo session('errors'); ?></div>
                <?php endif; ?>

                <form action="<?php echo e(url('loginproses')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Masukkan username">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Masukkan password">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn" value="Login">
                    </div>

                    <div class="register-link">
                        <p>Belum punya akun? <a href="<?php echo e(url('register')); ?>">Daftar di sini</a></p>
                    </div>
                </form>

                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js"></script>

    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "<?php echo e(session('success')); ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <script>
            Swal.fire({
                title: "Error!",
                text: "<?php echo e(session('error')); ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>

    <script>
        // Function to handle Google Authentication Response
        // function handleCredentialResponse(response) {
        //     // Send the ID token to your server
        //     const form = document.createElement('form');
        //     form.method = 'POST';
        //     form.action = 'google_callback.php';

        //     const hiddenField = document.createElement('input');
        //     hiddenField.type = 'hidden';
        //     hiddenField.name = 'credential';
        //     hiddenField.value = response.credential;

        //     form.appendChild(hiddenField);
        //     document.body.appendChild(form);
        //     form.submit();
        // }

        // Create animated background elements
        document.addEventListener('DOMContentLoaded', function() {
            const animatedBg = document.getElementById('animatedBg');

            // Create leaves
            for (let i = 0; i < 15; i++) {
                const leaf = document.createElement('div');
                leaf.classList.add('leaf');
                leaf.style.left = Math.random() * 100 + 'vw';
                leaf.style.animationDuration = (Math.random() * 5 + 5) + 's';
                leaf.style.animationDelay = Math.random() * 5 + 's';
                animatedBg.appendChild(leaf);
            }

            // Create clouds
            for (let i = 0; i < 5; i++) {
                const cloud = document.createElement('div');
                cloud.classList.add('cloud');
                cloud.style.width = Math.random() * 150 + 100 + 'px';
                cloud.style.height = Math.random() * 80 + 50 + 'px';
                cloud.style.top = Math.random() * 50 + '%';
                cloud.style.left = '-' + (Math.random() * 200 + 100) + 'px';
                cloud.style.animationDuration = (Math.random() * 20 + 20) + 's';
                animatedBg.appendChild(cloud);
            }

            // Create rain drops
            for (let i = 0; i < 50; i++) {
                const drop = document.createElement('div');
                drop.classList.add('rain');
                drop.style.left = Math.random() * 100 + 'vw';
                drop.style.height = Math.random() * 20 + 10 + 'px';
                drop.style.animationDuration = (Math.random() * 0.5 + 0.5) + 's';
                drop.style.animationDelay = Math.random() * 5 + 's';
                animatedBg.appendChild(drop);
            }
        });
    </script>
</body>

</html>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\tani-proyek\resources\views/login.blade.php ENDPATH**/ ?>