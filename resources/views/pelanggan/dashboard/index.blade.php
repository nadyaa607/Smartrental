@extends('layouts.pelanggan')
@section('title', 'Dashboard')

@section('content')
<div class="card p-4">
    <div class="d-flex align-items-center gap-3 mb-2">
        <div class="rounded-circle d-flex align-items-center justify-content-center"
             style="width:56px;height:56px;background:linear-gradient(135deg,#0284C7,#38BDF8);">
            <i class="bi bi-person-check text-white fs-4"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-0">Halo, {{ auth()->user()->name }} 👋</h5>
            <p class="text-muted small mb-0">Login berhasil sebagai Pelanggan.</p>
        </div>
    </div>
    <hr>
    <p class="text-muted small mb-0">
        Ini adalah dashboard sementara untuk Tahap 1 (Login &amp; Role). Katalog barang, booking,
        status rental, dan riwayat akan dibangun lengkap mulai <strong>Tahap 9 — Dashboard Pelanggan</strong>.
    </p>
</div>
@endsection