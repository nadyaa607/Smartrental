@extends('layouts.pelanggan')
@section('title', 'Dashboard')

@section('content')

<div class="card p-4 mb-4" style="background:linear-gradient(135deg,#0284C7,#38BDF8);">
    <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
             style="width:56px;height:56px;background:rgba(255,255,255,.25);">
            <i class="bi bi-person-check text-white fs-4"></i>
        </div>
        <div>
            <h5 class="fw-bold text-white mb-0">Halo, {{ auth()->user()->name }} 👋</h5>
            <p class="text-white-50 small mb-0">Selamat datang kembali di Smart Rental.</p>
        </div>
    </div>
</div>

@unless($pelanggan)
<div class="alert alert-warning rounded-3">
    Data profil pelanggan Anda belum lengkap. Silakan hubungi admin.
</div>
@endunless

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-4">
        <div class="card p-3 p-lg-4 h-100">
            <div class="text-muted small mb-1">Total Riwayat Sewa</div>
            <div class="fs-4 fw-bold">{{ $totalRiwayat }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card p-3 p-lg-4 h-100">
            <div class="text-muted small mb-1">Belum Dibayar</div>
            <div class="fs-4 fw-bold {{ $belumBayar > 0 ? 'text-danger' : '' }}">{{ $belumBayar }}</div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card p-3 p-lg-4 h-100">
            <div class="text-muted small mb-1">Status Rental Aktif</div>
            <div class="fs-6 fw-bold">
                @if($rentalAktif)
                    <span class="badge text-bg-info rounded-pill px-2 py-1">{{ $rentalAktif->status }}</span>
                @else
                    <span class="text-muted">Tidak ada rental aktif</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">Rental Aktif Saat Ini</h6>
            @if($rentalAktif)
                <p class="mb-1 small text-muted">Kode Transaksi</p>
                <p class="fw-semibold mb-3">{{ $rentalAktif->kode_transaksi }}</p>
                <p class="mb-1 small text-muted">Barang Disewa</p>
                <ul class="mb-3">
                    @foreach($rentalAktif->detailTransaksis as $d)
                        <li class="small">{{ $d->unitRental->nama_unit ?? '-' }} × {{ $d->jumlah }}</li>
                    @endforeach
                </ul>
                <p class="mb-1 small text-muted">Periode</p>
                <p class="fw-semibold mb-0">
                    {{ \Carbon\Carbon::parse($rentalAktif->tanggal_sewa)->format('d M Y') }}
                    —
                    {{ \Carbon\Carbon::parse($rentalAktif->tanggal_kembali)->format('d M Y') }}
                </p>
            @else
                <p class="text-muted small mb-3">Anda belum memiliki rental yang sedang berjalan.</p>
                <a href="#" class="btn btn-primary text-white" title="Akan tersedia di Tahap 9-10">
                    <i class="bi bi-grid me-1"></i> Lihat Katalog Barang
                </a>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">Akses Cepat</h6>
            <div class="d-grid gap-2">
                <a href="#" class="btn btn-outline-primary text-start" title="Akan tersedia di Tahap 9-10">
                    <i class="bi bi-grid me-2"></i> Katalog Barang
                </a>
                <a href="#" class="btn btn-outline-primary text-start" title="Akan tersedia di Tahap 12">
                    <i class="bi bi-clock-history me-2"></i> Riwayat Rental
                </a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-person-circle me-2"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card p-4">
    <h6 class="fw-bold mb-3">Riwayat Rental Terbaru</h6>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Kode</th><th>Barang</th><th>Tanggal Sewa</th><th>Status</th></tr></thead>
            <tbody>
            @forelse($riwayatTerbaru as $r)
                <tr>
                    <td>{{ $r->kode_transaksi }}</td>
                    <td>{{ $r->detailTransaksis->pluck('unitRental.nama_unit')->filter()->join(', ') ?: '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->tanggal_sewa)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $badge = match($r->status) {
                                'Menunggu' => 'warning', 'Berjalan' => 'info',
                                'Selesai' => 'success', 'Dibatalkan' => 'secondary', default => 'light',
                            };
                        @endphp
                        <span class="badge text-bg-{{ $badge }} rounded-pill px-2 py-1">{{ $r->status }}</span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada riwayat rental.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection