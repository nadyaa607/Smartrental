@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:48px;height:48px;background:linear-gradient(135deg,#0284C7,#38BDF8);">
                    <i class="bi bi-box-seam text-white fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Jumlah Barang</div>
                    <div class="fs-4 fw-bold">{{ $jumlahBarang }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:48px;height:48px;background:linear-gradient(135deg,#16A34A,#4ADE80);">
                    <i class="bi bi-people text-white fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Jumlah Pelanggan</div>
                    <div class="fs-4 fw-bold">{{ $jumlahPelanggan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:48px;height:48px;background:linear-gradient(135deg,#CA8A04,#FACC15);">
                    <i class="bi bi-receipt text-white fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Jumlah Transaksi</div>
                    <div class="fs-4 fw-bold">{{ $jumlahTransaksi }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:48px;height:48px;background:linear-gradient(135deg,#7E22CE,#C084FC);">
                    <i class="bi bi-cash-stack text-white fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Pendapatan</div>
                    <div class="fs-6 fw-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3">Quick Action</h6>
            <div class="d-grid gap-2">
                <a href="#" class="btn btn-primary text-white text-start" title="Akan tersedia di Tahap 3">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Barang
                </a>
                <a href="#" class="btn btn-outline-primary text-start" title="Akan tersedia di Tahap 4">
                    <i class="bi bi-person-plus me-2"></i> Tambah Pelanggan
                </a>
                <a href="#" class="btn btn-outline-primary text-start" title="Akan tersedia di Tahap 5">
                    <i class="bi bi-receipt-cutoff me-2"></i> Buat Transaksi
                </a>
                <a href="#" class="btn btn-outline-primary text-start" title="Akan tersedia di Tahap 8">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Lihat Laporan
                </a>
            </div>
            <p class="text-muted small mt-3 mb-0">
                <i class="bi bi-info-circle"></i> Tombol di atas akan aktif setelah modul terkait dibangun pada tahap selanjutnya.
            </p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row g-3 h-100">
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <h6 class="fw-bold mb-3">Grafik Penyewaan ({{ now()->year }})</h6>
                    <canvas id="chartPenyewaan" height="160"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <h6 class="fw-bold mb-3">Grafik Pendapatan ({{ now()->year }})</h6>
                    <canvas id="chartPendapatan" height="160"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card p-4">
            <h6 class="fw-bold mb-3">Rental Terbaru</h6>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Tgl Sewa</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse($rentalTerbaru as $r)
                        <tr>
                            <td>{{ $r->kode_transaksi }}</td>
                            <td>{{ $r->pelanggan->nama ?? '-' }}</td>
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
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card p-4">
            <h6 class="fw-bold mb-3">Barang Terbaru</h6>
            @forelse($barangTerbaru as $b)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <div class="fw-semibold small">{{ $b->nama_unit }}</div>
                        <div class="text-muted" style="font-size:.78rem">{{ $b->kategori->nama_kategori ?? '-' }} · Rp {{ number_format($b->harga_sewa,0,',','.') }}</div>
                    </div>
                    @php
                        $badgeB = match($b->status) {
                            'tersedia' => 'success', 'disewa' => 'warning', 'maintenance' => 'danger', default => 'light',
                        };
                    @endphp
                    <span class="badge text-bg-{{ $badgeB }} rounded-pill px-2 py-1 text-capitalize">{{ $b->status }}</span>
                </div>
            @empty
                <p class="text-muted small mb-0">Belum ada barang.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
const bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

new Chart(document.getElementById('chartPenyewaan'), {
    type: 'bar',
    data: {
        labels: bulanLabel,
        datasets: [{
            label: 'Jumlah Transaksi',
            data: {{ Js::from($chartPenyewaan) }},
            backgroundColor: '#38BDF8', borderRadius: 6,
        }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
});

new Chart(document.getElementById('chartPendapatan'), {
    type: 'line',
    data: {
        labels: bulanLabel,
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: {{ Js::from($chartPendapatan) }},
            borderColor: '#0284C7', backgroundColor: 'rgba(2,132,199,.1)',
            fill: true, tension: .35,
        }]
    },
    options: { plugins: { legend: { display: false } } }
});
</script>
@endpush