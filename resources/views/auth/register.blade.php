<x-guest-layout>
    <p class="text-center text-muted small mb-4">Buat akun pelanggan baru</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" required autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror" required autocomplete="username">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="no_identitas" class="form-label">No. Identitas (KTP)</label>
                <input id="no_identitas" type="text" name="no_identitas" value="{{ old('no_identitas') }}"
                       class="form-control @error('no_identitas') is-invalid @enderror" required>
                @error('no_identitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telepon" class="form-label">No. Telepon</label>
                <input id="telepon" type="text" name="telepon" value="{{ old('telepon') }}"
                       class="form-control @error('telepon') is-invalid @enderror" required>
                @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" rows="2"
                      class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="form-control" required autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 text-white">Daftar</button>

        <p class="text-center small text-muted mt-4 mb-0">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>