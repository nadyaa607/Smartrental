<x-guest-layout>
    <p class="text-center text-muted small mb-4">Masuk ke akun Smart Rental Anda</p>

    @if(session('status'))
        <div class="alert alert-success rounded-3 small">{{ session('status') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-3 small">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-icon-group">
                <i class="bi bi-envelope-fill input-icon"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required autofocus autocomplete="username" placeholder="nama@email.com">
            </div>
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-icon-group">
                <i class="bi bi-lock-fill input-icon"></i>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required autocomplete="current-password" placeholder="••••••••">
                <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label small text-muted" for="remember_me">Ingat saya</label>
            </div>
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 text-white">
            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>

        <p class="text-center small text-muted mt-4 mb-0">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sebagai Pelanggan</a>
        </p>
    </form>
</x-guest-layout>
