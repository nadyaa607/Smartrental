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
        * { font-family: 'Poppins', sans-serif; }
        body {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #075985 0%, #0284C7 45%, #38BDF8 100%);
            padding: 2rem 1rem;
        }
        .auth-card {
            width: 100%; max-width: 440px;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(16px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(2,132,199,.25);
            padding: 2.5rem;
            border: 1px solid rgba(255,255,255,.4);
        }
        .auth-brand { font-weight: 800; font-size: 1.5rem; color: #075985; text-align:center; margin-bottom: 1.5rem; }
        .form-control { border-radius: 12px; padding: .65rem 1rem; border: 1px solid #E2E8F0; }
        .form-control:focus { border-color: #0284C7; box-shadow: 0 0 0 3px rgba(2,132,199,.15); }
        .btn-primary {
            background: linear-gradient(135deg, #0284C7, #38BDF8) !important;
            border: none !important; border-radius: 12px !important; padding: .65rem 1rem !important; font-weight: 600;
        }
        a { color: #0284C7; }
        .form-label { font-weight: 500; font-size: .875rem; color: #334155; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-brand"><i class="bi bi-key-fill"></i> Smart Rental</div>
        {{ $slot }}
    </div>
</body>
</html>