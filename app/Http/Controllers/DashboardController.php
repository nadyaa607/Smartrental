<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\TransaksiSewa;
use App\Models\UnitRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return $this->admin();
        }

        return $this->pelanggan($user);
    }

    /**
     * Dashboard Admin — Tahap 2
     */
    protected function admin()
    {
        $jumlahBarang = UnitRental::count();
        $jumlahPelanggan = Pelanggan::count();
        $jumlahTransaksi = TransaksiSewa::count();
        $pendapatan = Pembayaran::where('status', 'Lunas')->sum('jumlah_bayar');

        // Grafik penyewaan per bulan (tahun berjalan)
        $penyewaanPerBulan = TransaksiSewa::whereYear('created_at', now()->year)
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Grafik pendapatan per bulan (tahun berjalan, hanya yang lunas)
        $pendapatanPerBulan = Pembayaran::where('status', 'Lunas')
            ->whereYear('tanggal_bayar', now()->year)
            ->select(DB::raw('MONTH(tanggal_bayar) as bulan'), DB::raw('SUM(jumlah_bayar) as total'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $chartPenyewaan = [];
        $chartPendapatan = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartPenyewaan[] = (int) ($penyewaanPerBulan[$i] ?? 0);
            $chartPendapatan[] = (float) ($pendapatanPerBulan[$i] ?? 0);
        }

        $rentalTerbaru = TransaksiSewa::with('pelanggan')
            ->latest()
            ->take(5)
            ->get();

        $barangTerbaru = UnitRental::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'jumlahBarang', 'jumlahPelanggan', 'jumlahTransaksi', 'pendapatan',
            'chartPenyewaan', 'chartPendapatan', 'rentalTerbaru', 'barangTerbaru'
        ));
    }

    /**
     * Dashboard Pelanggan — Tahap 9
     */
    protected function pelanggan($user)
    {
        $pelanggan = $user->pelanggan;

        $rentalAktif = null;
        $totalRiwayat = 0;
        $belumBayar = 0;
        $riwayatTerbaru = collect();

        if ($pelanggan) {
            $rentalAktif = TransaksiSewa::where('pelanggan_id', $pelanggan->id)
                ->whereIn('status', ['Menunggu', 'Berjalan'])
                ->with(['detailTransaksis.unitRental', 'pembayaran'])
                ->latest()
                ->first();

            $totalRiwayat = TransaksiSewa::where('pelanggan_id', $pelanggan->id)->count();

            $belumBayar = TransaksiSewa::where('pelanggan_id', $pelanggan->id)
                ->whereHas('pembayaran', fn ($q) => $q->where('status', 'Belum Lunas'))
                ->count();

            $riwayatTerbaru = TransaksiSewa::where('pelanggan_id', $pelanggan->id)
                ->with('detailTransaksis.unitRental')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('pelanggan.dashboard.index', compact(
            'pelanggan', 'rentalAktif', 'totalRiwayat', 'belumBayar', 'riwayatTerbaru'
        ));
    }
}