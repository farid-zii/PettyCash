<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use PDF;

class CetakHistoryController extends Controller
{
    public function cetakhistory()
    {
        // Ambil data dari input form jika ada
        $startDate = request('start_date');
        $endDate = request('end_date');

        // Filter data transaksi berdasarkan tanggal jika start date dan end date ada
        if ($startDate && $endDate) {
            $history = transaksi::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();
        } else {
            // Jika tidak ada start date dan end date, ambil semua data
            $history = transaksi::get();
        }

        // Buat laporan PDF
        $pdf = PDF::loadView('Admin.history.cetak', compact('history'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('Laporan-History.pdf');

    }
}
