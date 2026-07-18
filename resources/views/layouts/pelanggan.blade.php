<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Smart Rental</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --primary: #0284C7; --primary-light: #38BDF8; }
        * { font-family: 'Poppins', sans-serif; }
        body { background: #F0F9FF; }
        .navbar { background: rgba(255,255,255,.85); backdrop-filter: blur(12px); box-shadow: 0 2px 12px rgba(2,132,199,.08); }
        .navbar .brand { font-weight: 800; color: #075985; }
        .nav-link { font-weight: 500; color: #334155 !important; }
        .nav-link.active { color: var(--primary) !important; }
        .card { border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(2,132,199,.06); }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-light)); border: none; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top py-3 mb-4">
        <div class="container">
            <a class="navbar-brand brand" href="{{ route('dashboard') }}"><i class="bi bi-key-fill"></i> Smart Rental</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#" title="Akan tersedia di Tahap 9">Katalog Barang</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#" title="Akan tersedia di Tahap 12">Riwayat</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">Profil</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary ms-lg-2 mt-2 mt-lg-0">Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>Swal.fire({ icon: 'success', title: 'Berhasil', text: @json(session('success')), confirmButtonColor: '#0284C7' });</script>
    @endif
    @stack('scripts')
</body>
</html>