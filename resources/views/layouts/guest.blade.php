<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rental</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Vite tetap dimuat agar komponen Breeze lama (x-text-input dkk di halaman
         forgot-password/reset-password/confirm-password/verify-email) tetap tampil rapi
         sampai halaman-halaman tersebut ikut dirombak ke Bootstrap 5. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --sr-primary: #2563EB;
            --sr-secondary: #3B82F6;
            --sr-success: #22C55E;
            --sr-danger: #EF4444;
            --sr-bg: #F8FAFC;
        }
        * { font-family: 'Poppins', sans-serif; }
        body {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: var(--sr-bg);
            background-image:
                radial-gradient(circle at 15% 15%, rgba(37,99,235,.18), transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(59,130,246,.18), transparent 45%),
                linear-gradient(135deg, var(--sr-primary) 0%, var(--sr-secondary) 100%);
            padding: 2rem 1rem;
        }
        .auth-card {
            width: 100%; max-width: 460px;
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(37,99,235,.30);
            padding: 2.5rem;
            border: 1px solid rgba(255,255,255,.5);
            animation: sr-fade-in .4s ease-out;
        }
        @keyframes sr-fade-in {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .auth-brand {
            font-weight: 800; font-size: 1.6rem; color: var(--sr-primary);
            text-align: center; margin-bottom: .25rem;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .auth-brand i { color: var(--sr-secondary); }
        .input-icon-group { position: relative; }
        .input-icon-group .form-control { padding-left: 2.75rem; }
        .input-icon-group .input-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            color: #94A3B8; pointer-events: none;
        }
        .input-icon-group .toggle-password {
            position: absolute; right: .9rem; top: 50%; transform: translateY(-50%);
            color: #94A3B8; cursor: pointer; background: none; border: none; padding: 0;
        }
        .input-icon-group .toggle-password:hover { color: var(--sr-primary); }
        .form-control {
            border-radius: 12px; padding: .65rem 1rem; border: 1px solid #E2E8F0;
            transition: box-shadow .2s ease, border-color .2s ease;
        }
        .form-control:focus { border-color: var(--sr-primary); box-shadow: 0 0 0 3px rgba(37,99,235,.15); }
        .form-control.is-invalid { border-color: var(--sr-danger); }
        .btn-primary {
            background: linear-gradient(135deg, var(--sr-primary), var(--sr-secondary)) !important;
            border: none !important; border-radius: 12px !important; padding: .7rem 1rem !important;
            font-weight: 600; transition: transform .15s ease, box-shadow .15s ease;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(37,99,235,.35); }
        a { color: var(--sr-primary); text-decoration: none; }
        a:hover { text-decoration: underline; }
        .form-label { font-weight: 500; font-size: .875rem; color: #334155; }
        .alert-success { background: rgba(34,197,94,.12); color: #15803D; border: 1px solid rgba(34,197,94,.3); }
        .alert-danger { background: rgba(239,68,68,.1); color: #B91C1C; border: 1px solid rgba(239,68,68,.3); }
        .invalid-feedback { font-size: .8rem; }
        @media (max-width: 480px) {
            .auth-card { padding: 1.75rem; border-radius: 18px; }
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-brand"><i class="bi bi-key-fill"></i> Smart Rental</div>
        {{ $slot }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-password').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const input = document.getElementById(btn.dataset.target);
                    if (!input) return;
                    const showing = input.type === 'text';
                    input.type = showing ? 'password' : 'text';
                    btn.querySelector('i').className = showing ? 'bi bi-eye' : 'bi bi-eye-slash';
                });
            });
        });
    </script>
</body>
</html>
