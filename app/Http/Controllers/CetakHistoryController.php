<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use App\Models\transaksi;
use PDF;
use DB;

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

            $pengajuan= Pengajuan::select(DB::raw('SUM(total) as totalPengajuan'))
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->first();
            $saldo= Saldo::select(DB::raw('SUM(saldo) as totalSaldo'))
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->first();

        } else {
            // Jika tidak ada start date dan end date, ambil semua data
            $history = transaksi::get();
            $pengajuan = Pengajuan::select(DB::raw('SUM(total) as totalPengajuan'))
            // ->whereDate('created_at', '>=', $startDate)
            // ->whereDate('created_at', '<=', $endDate)
            ->first();
            $saldo = Saldo::select(DB::raw('SUM(saldo) as totalSaldo'))
            ->first();;
        }

        // Buat laporan PDF
        $pdf = PDF::loadView('Admin.history.cetak', compact('history','pengajuan','saldo'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('Laporan-History.pdf');

    }
    public function cetakPengajuan()
    {
        // Ambil data dari input form jika ada
        $bulan = request('bulan');
        $tahun = request('tahun');

        // Filter data transaksi berdasarkan tanggal jika start date dan end date ada
        if ($bulan && $tahun) {
            $history = transaksi::whereDate('created_at', '>=', $bulan)
            ->whereDate('created_at', '<=', $tahun)
            ->get();

            $pengajuan= Pengajuan::select(DB::raw('SUM(total) as totalPengajuan'))
            ->whereDate('created_at', '>=', $bulan)
            ->whereDate('created_at', '<=', $tahun)
            ->first();
            $saldo= Saldo::select(DB::raw('SUM(saldo) as totalSaldo'))
            ->whereDate('created_at', '>=', $bulan)
            ->whereDate('created_at', '<=', $tahun)
            ->first();

        } else {
            // Jika tidak ada start date dan end date, ambil semua data
            $history = transaksi::get();
            $pengajuan = Pengajuan::select(DB::raw('SUM(total) as totalPengajuan'))
            // ->whereDate('created_at', '>=', $bulan)
            // ->whereDate('created_at', '<=', $tahun)
            ->first();
            $saldo = Saldo::select(DB::raw('SUM(saldo) as totalSaldo'))
            ->first();;
        }

        // Buat laporan PDF
        $pdf = PDF::loadView('Admin.pengajuan.cetak', compact('pengajuan'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('Laporan-Pengajuan.pdf');

    }
}
