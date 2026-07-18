<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Redirect dashboard sesuai role user yang login.
     * Konten dashboard admin & pelanggan yang sesungguhnya akan
     * dibangun di Tahap 2 (Admin) dan Tahap 9 (Pelanggan).
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return view('admin.dashboard.index');
        }

        return view('pelanggan.dashboard.index');
    }
}