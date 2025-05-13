<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TANISMART</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/style.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.min.css">

    <style>
        /* Custom styles */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .content-section {
            display: none;
            min-height: 100vh;
            /* Full viewport height */
            position: relative;
            padding-bottom: 60px;
            /* Space for footer */
        }

        .active-section {
            display: block;
        }

        .navbar {
            background-color: #28a745;
            height: 60px;
            /* Explicitly define navbar height */
        }

        footer {
            background-color: rgba(3, 12, 24, 0.94);
            /* Match navbar color */
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            /* Match navbar height */
            display: flex;
            align-items: center;
            /* Center content vertically */
        }

        footer a {
            color: white;
        }

        .hero {
            height: calc(100vh - 60px);
            /* Full height minus footer */
            display: flex;
            align-items: center;
        }

        .about-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 140px);
            padding-top: 80px;
        }

        .section-content {
            padding-top: 80px;
            /* Space for navbar */
            min-height: calc(100vh - 60px);
            /* Full viewport height minus footer */
        }

        /* Add section title styling directly here to ensure consistency */
        .section-title {
            color: #3CB371;
            /* Green color matching button */
            font-weight: 600;
        }

        /* Container utama artikel */
        .article-container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 2rem;
        }

        /* Gambar unggulan artikel */
        .article-featured-image img {
            width: 100%;
            /* Tetap menyesuaikan lebar container */
            max-width: 700px;
            /* Kurangi lebar maksimal */
            height: auto;
            /* Pertahankan rasio asli gambar */
            object-fit: cover;
            border-radius: 8px;
            margin: 0 auto 1.5rem auto;
            /* Jarak bawah gambar */
            display: block;
            /* Pastikan gambar di tengah */
        }

        /* Header artikel */
        .article-header {
            margin-bottom: 2rem;
            text-align: center;
            padding: 1rem;
        }

        .article-title {
            color: #2c3e50;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .article-meta {
            color: #7f8c8d;
            font-size: 1rem;
            margin-top: 0.5rem;
            text-align: center;
        }

        /* Konten artikel */
        .article-content {
            text-align: justify;
            /* Rata kanan-kiri */
            max-width: 700px;
            /* Kurangi lebar maksimal */
            margin: 0 auto;
            /* Tengah-tengah */
            padding: 0 1rem;
            /* Jarak sisi kiri dan kanan */
            font-size: 16px;
            line-height: 1.8;
            /* Jarak antar baris */
        }

        /* Penomoran (ol) */
        .article-content ol {
            counter-reset: item;
            /* Reset counter untuk penomoran */
            list-style: none;
            /* Hilangkan list default */
            padding-left: 1.5rem;
            /* Ruang indentasi untuk nomor */
            margin-top: 1rem;
            /* Tambahkan margin atas */
            margin-bottom: 1rem;
            /* Tambahkan margin bawah */
        }

        .article-content ol li {
            counter-increment: item;
            /* Tingkatkan counter otomatis */
            margin-bottom: 1rem;
            /* Jarak antar nomor */
            text-indent: 0;
            /* Pastikan teks tidak ter-indent */
        }

        .article-content ol li::before {
            content: counter(item) ".";
            /* Tambahkan nomor otomatis */
            font-weight: bold;
            /* Nomor ditampilkan tebal */
            display: inline-block;
            /* Buat dalam satu baris */
            width: 2rem;
            /* Lebar area nomor */
        }

        /* Daftar poin (ul) */
        .article-content ul {
            list-style: none;
            /* Hilangkan list default */
            padding-left: 2rem;
            /* Ruang indentasi untuk poin */
            margin-top: 1rem;
            /* Tambahkan margin atas */
            margin-bottom: 1rem;
            /* Tambahkan margin bawah */
        }

        .article-content ul li {
            position: relative;
            margin-bottom: 0.5rem;
            /* Jarak antar poin */
            text-indent: -1rem;
            /* Indentasi negatif untuk tanda dash */
            padding-left: 1rem;
            /* Tambahkan padding untuk teks */
        }

        .article-content ul li::before {
            content: "-";
            /* Tambahkan tanda dash untuk poin */
            position: absolute;
            left: 0;
            /* Posisikan di kiri */
        }

        /* Gaya gambar dalam konten artikel */
        .article-content img {
            display: block;
            max-width: 80%;
            /* Maksimal lebar gambar 80% dari kontainer */
            margin: 20px auto;
            /* Tengahkan gambar dan beri jarak */
            border-radius: 8px;
            /* Berikan sudut tumpul pada gambar */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Tambahkan bayangan */
        }

        /* Paragraf */
        .article-content p {
            margin: 10px 0;
            /* Jarak antar paragraf */
            text-indent: 15px;
            /* Tambahkan indentasi untuk paragraf */
        }

        /* Blockquote */
        .article-content blockquote {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #ccc;
            font-style: italic;
            color: #555;
        }

        /* Tabel */
        .article-content table {
            width: 100%;
            /* Lebar penuh */
            border-collapse: collapse;
            margin: 20px 0;
            /* Jarak tabel dari elemen lain */
            text-align: left;
        }

        .article-content table th,
        .article-content table td {
            border: 1px solid #ddd;
            /* Tambahkan border */
            padding: 10px;
            /* Ruang dalam sel */
        }

        .article-content table th {
            background-color: #f4f4f4;
            /* Warna latar untuk header tabel */
            font-weight: bold;
            text-align: center;
        }

        /* Form komentar */
        .comment-form {
            margin-top: 3rem;
            padding: 1.5rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Tombol submit */
        .btn-submit {
            background-color: #28a745;
            color: white;
        }

        /* Komentar */
        .komentar {
            margin-bottom: 2rem;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        /* Balasan admin */
        .balasan-admin {
            background-color: #e9ecef;
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 8px;
        }

        /* Fix for home content visibility */
        #home-content {
            display: block;
            /* Make home content visible by default */
        }

        /* produkdetail */
        /* Navbar */
        .navbar {
            background-color: #1a2a3a !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-brand span {
            color: #3cb371;
        }

        .navbar .nav-link {
            color: #fff !important;
            font-weight: 500;
            font-size: 1rem;
        }

        .navbar .nav-link:hover {
            color: #3cb371 !important;
        }


        /* Container Detail Produk */
        .product-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 90%;
            /* Reduced from 100% to 90% */
            border-radius: 12px;
            display: block;
            margin: 0 auto;
        }

        .price-tag {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }

        .variant-button {
            margin: 5px;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-control button {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 18px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }

        .action-buttons a {
            width: auto;
            padding: 10px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            text-align: center;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-cart {
            background-color: #ffc107;
        }

        .btn-buy {
            background-color: #28a745;
        }

        .store-label {
            font-size: 22px;
            /* Increased from 18px to 22px */
            font-weight: bold;
            color: #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
            /* Increased from 8px to 10px */
            margin-bottom: 15px;
        }

        .store-label i {
            color: #28a745;
            font-size: 24px;
            /* Increased from default to 24px */
        }

        h2 {
            font-size: 22px;
        }

        p.text-muted {
            font-size: 16px;
        }

        /* Modal styling */
        .login-modal,
        .alert-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content,
        .alert-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 10px;
            text-align: center;
        }

        .modal-button,
        .alert-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            margin: 10px 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-modal {
            background-color: #6c757d;
        }

        /* Flying Image Animation */
        .flying-image {
            position: fixed;
            z-index: 1060;
            pointer-events: none;
            opacity: 0;
            transition: all 0.8s ease-in-out;
        }

        .flying-image img {
            width: 100px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">TANI<span style="color: #3CB371;">SMART</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                        $isRoot = request()->is('/');
                    ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e($isRoot ? 'active' : ''); ?>" href="<?php echo e($isRoot ? '#home' : url('/#home')); ?>"
                            data-target="home-content">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($isRoot ? '#about' : url('/#about')); ?>"
                            data-target="about-content">TENTANG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($isRoot ? '#artikel' : url('/#artikel')); ?>"
                            data-target="artikel-content">ARTIKEL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($isRoot ? '#tokotani' : url('/#tokotani')); ?>"
                            data-target="tokotani-content">TOKOTANI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($isRoot ? '#team' : url('/#team')); ?>"
                            data-target="team-content">TEAM</a>
                    </li>


                    <!-- Dropdown Registrasi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownRegistrasi" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo e(auth()->check() ? auth()->user()->name : 'REGISTRASI'); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownRegistrasi">
                            <?php if(auth()->check()): ?>
                                <li><a class="dropdown-item" href="<?php echo e(url('logout')); ?>">LOGOUT</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(url('login')); ?>">LOGIN</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <?php if(auth()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="<?php echo e(url('keranjang')); ?>" id="keranjang">
                                <i class="fas fa-shopping-cart"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo e(is_array(session('cart')) ? count(session('cart')) : 0); ?>

                                    <span class="visually-hidden">produk dalam keranjang</span>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Main Footer visible only on small screens -->
    <footer class="py-4 d-lg-none">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">&copy; 2025 TANISMART. Created by kelompok4</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Additional scripts for "flying" add to cart animation -->
    <script>
        function addToCart(productId, productImg) {
            // Create the flying image element
            var imgElement = document.createElement('div');
            imgElement.style.cssText =
                'position: fixed; z-index: 9999; width: 50px; height: 50px; border-radius: 50%; background-image: url("images/' +
                productImg +
                '"); background-size: cover; background-position: center; box-shadow: 0 3px 10px rgba(0,0,0,0.2);';
            document.body.appendChild(imgElement);

            // Get the positions
            var clickEvent = window.event;
            var startX = clickEvent.clientX - 25;
            var startY = clickEvent.clientY - 25;

            // Get cart position
            var cart = document.querySelector('.fa-shopping-cart');
            var cartRect = cart.getBoundingClientRect();
            var endX = cartRect.left;
            var endY = cartRect.top;

            // Set starting position
            imgElement.style.left = startX + 'px';
            imgElement.style.top = startY + 'px';

            // Add animation
            setTimeout(function() {
                imgElement.style.transition = 'all 0.8s ease-in-out';
                imgElement.style.left = endX + 'px';
                imgElement.style.top = endY + 'px';
                imgElement.style.opacity = '0';
                imgElement.style.transform = 'scale(0.3)';

                // Remove element after animation
                setTimeout(function() {
                    document.body.removeChild(imgElement);

                    // Send AJAX request
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'add_to_cart.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Update cart counter
                            updateCartCounter();
                        }
                    };
                    xhr.send('product_id=' + productId);
                }, 800);
            }, 10);
        }

        function updateCartCounter() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_cart_count.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var count = xhr.responseText;
                    document.querySelector('.badge').textContent = count;
                }
            };
            xhr.send();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js"></script>

    <script>
        $('#keranjang').on('click', function() {
            window.location.href = "<?php echo e(url('keranjang')); ?>";
        })
    </script>

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

    <!-- Custom JS for navigation without scrolling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Make sure Home is displayed by default
            document.getElementById('home-content').style.display = 'block';

            // Set "Home" link as active by default
            document.querySelector('a[data-target="home-content"]').classList.add('active');

            // Handle navigation click events
            document.querySelectorAll('.nav-link, .nav-btn').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get target section ID
                    const targetId = this.getAttribute('data-target');

                    if (targetId) {
                        // Hide all sections
                        document.querySelectorAll('.content-section').forEach(section => {
                            section.style.display = 'none';
                        });

                        // Show target section
                        document.getElementById(targetId).style.display = 'block';

                        // Close mobile navbar if open
                        const navbarCollapse = document.querySelector('.navbar-collapse');
                        if (navbarCollapse.classList.contains('show')) {
                            navbarCollapse.classList.remove('show');
                        }

                        // Update active state in navbar
                        document.querySelectorAll('.nav-link').forEach(navLink => {
                            navLink.classList.remove('active');
                        });

                        // If the click came from navbar (not a button inside a section)
                        if (this.classList.contains('nav-link')) {
                            this.classList.add('active');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
<?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/layouts/home.blade.php ENDPATH**/ ?>