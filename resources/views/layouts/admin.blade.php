<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
        }

        .navbar {
            background-color: #2c3e50;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: #ecf0f1;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #ecf0f1;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #27ae60;
            /* Hijau sawah */
        }

        .container {
            padding-top: 2rem;
        }

        h1 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        h2 {
            color: #34495e;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card h3 {
            color: #27ae60;
            /* Hijau sawah */
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .dashboard-card p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .dashboard-icon {
            font-size: 2.5rem;
            color: #27ae60;
            /* Hijau sawah */
            margin-bottom: 1rem;
        }

        .btn-logout {
            background-color: #e74c3c;
            border: none;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .btn-hijau {
            background-color: #28a745;
            /* Warna hijau */
            border-color: #28a745;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-hijau:hover {
            background-color: #218838;
            /* Hijau lebih gelap untuk efek hover */
            border-color: #218838;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/artikel') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/komentar') }}">Komentar</a>
                        <!-- Ubah 'contact.php' menjadi 'komentar.php' -->
                    </li>
                </ul>
                <a class="btn btn-outline-light ms-auto" href="{{ url('logout') }}">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    @yield('script')
</body>

</html>
