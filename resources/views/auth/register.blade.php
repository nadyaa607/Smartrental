<x-guest-layout>
    <p class="text-center text-muted small mb-4">Buat akun pelanggan baru</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <div class="input-icon-group">
                <i class="bi bi-person-fill input-icon"></i>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       required autofocus placeholder="Nama sesuai identitas">
            </div>
            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-icon-group">
                <i class="bi bi-envelope-fill input-icon"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required autocomplete="username" placeholder="nama@email.com">
            </div>
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="no_identitas" class="form-label">No. Identitas (KTP)</label>
                <div class="input-icon-group">
                    <i class="bi bi-card-text input-icon"></i>
                    <input id="no_identitas" type="text" name="no_identitas" value="{{ old('no_identitas') }}"
                           class="form-control @error('no_identitas') is-invalid @enderror"
                           required inputmode="numeric" placeholder="16 digit NIK">
                </div>
                @error('no_identitas') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telepon" class="form-label">Nomor HP</label>
                <div class="input-icon-group">
                    <i class="bi bi-telephone-fill input-icon"></i>
                    <input id="telepon" type="text" name="telepon" value="{{ old('telepon') }}"
                           class="form-control @error('telepon') is-invalid @enderror"
                           required inputmode="numeric" placeholder="08xxxxxxxxxx">
                </div>
                @error('telepon') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <div class="input-icon-group">
                <i class="bi bi-geo-alt-fill input-icon"></i>
                <textarea id="alamat" name="alamat" rows="2" style="padding-left:2.75rem;"
                          class="form-control @error('alamat') is-invalid @enderror"
                          required placeholder="Alamat lengkap saat ini">{{ old('alamat') }}</textarea>
            </div>
            @error('alamat') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-icon-group">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input id="password" type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required autocomplete="new-password" placeholder="Min. 8 karakter">
                    <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <div class="input-icon-group">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="form-control" required autocomplete="new-password" placeholder="Ulangi password">
                    <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Tampilkan password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
        </div>

        <p class="small text-muted">
            <i class="bi bi-info-circle"></i>
            Akun yang dibuat lewat form ini otomatis berperan sebagai <strong>Pelanggan</strong>.
        </p>

        <button type="submit" class="btn btn-primary w-100 text-white">
            <i class="bi bi-person-plus-fill me-1"></i> Daftar
        </button>

        <p class="text-center small text-muted mt-4 mb-0">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
