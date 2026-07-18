<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Smart Rental Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0284C7; --primary-light: #38BDF8; --primary-dark: #075985;
            --bg-soft: #F0F9FF;
        }
        * { font-family: 'Poppins', sans-serif; }
        body { background: var(--bg-soft); }

        .sidebar {
            width: 264px; min-height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 55%, var(--primary-light) 100%);
            padding: 1.5rem 1rem; z-index: 1030;
            transition: transform .25s ease;
        }
        .sidebar .brand { color: #fff; font-weight: 800; font-size: 1.2rem; display: flex; align-items: center; gap: .5rem; margin-bottom: 1.75rem; padding: 0 .4rem; }
        .sidebar .nav-link { color: rgba(255,255,255,.85); border-radius: 10px; padding: .6rem 1rem; margin-bottom: .25rem; display: flex; align-items: center; gap: .65rem; font-size: .89rem; font-weight: 500; transition: all .2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,.18); color: #fff; }
        .sidebar .nav-section { color: rgba(255,255,255,.55); font-size: .7rem; text-transform: uppercase; letter-spacing: .05em; margin: 1rem .5rem .35rem; font-weight: 600; }

        .main-content { margin-left: 264px; padding: 1.75rem 2rem; min-height: 100vh; }
        .topbar { background: #fff; border-radius: 16px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 12px rgba(2,132,199,.06); display: flex; justify-content: space-between; align-items: center; }
        .card { border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(2,132,199,.06); }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-light)); border: none; }
        .page-title { font-weight: 700; color: #0F172A; }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div class="brand"><i class="bi bi-key-fill"></i> Smart Rental</div>
        <div class="nav-section">Menu Utama</div>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="#" class="nav-link disabled" tabindex="-1" aria-disabled="true" title="Akan tersedia di Tahap 3">
                <i class="bi bi-box-seam"></i> Manajemen Barang
            </a>
            <a href="#" class="nav-link disabled" tabindex="-1" aria-disabled="true" title="Akan tersedia di Tahap 4">
                <i class="bi bi-people"></i> Manajemen Pelanggan
            </a>
            <a href="#" class="nav-link disabled" tabindex="-1" aria-disabled="true" title="Akan tersedia di Tahap 5">
                <i class="bi bi-receipt"></i> Transaksi Rental
            </a>
            <a href="#" class="nav-link disabled" tabindex="-1" aria-disabled="true" title="Akan tersedia di Tahap 6">
                <i class="bi bi-cash-coin"></i> Pembayaran
            </a>
            <a href="#" class="nav-link disabled" tabindex="-1" aria-disabled="true" title="Akan tersedia di Tahap 7">
                <i class="bi bi-arrow-return-left"></i> Pengembalian
            </a>
            <a href="#" class="nav-link disabled" tabindex="-1" aria-disabled="true" title="Akan tersedia di Tahap 8">
                <i class="bi bi-bar-chart-line"></i> Laporan
            </a>
            <div class="nav-section">Akun</div>
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0 page-title">@yield('title', 'Dashboard')</h5>
            </div>
            <div class="text-end">
                <div class="fw-semibold small">{{ auth()->user()->name ?? '-' }}</div>
                <small class="text-muted">Admin</small>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'Berhasil', text: @json(session('success')), confirmButtonColor: '#0284C7' });
    </script>
    @endif
    @if(session('error'))
    <script>
        Swal.fire({ icon: 'error', title: 'Gagal', text: @json(session('error')), confirmButtonColor: '#0284C7' });
    </script>
    @endif
    @stack('scripts')
</body>
</html>