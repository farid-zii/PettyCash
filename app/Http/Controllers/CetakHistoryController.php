<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use App\Models\transaksi;
use PDF;
use Carbon\Carbon;
use DB;

class CetakHistoryController extends Controller
{
    public function cetakhistory()
    {
        // Ambil data dari input form jika ada
        $bulan = request('bulan');

        // Filter data transaksi berdasarkan tanggal jika start date dan end date ada
        if ($bulan) {
            $history = transaksi::whereYear('created_at', Carbon::parse($bulan)->year)
                ->whereMonth('created_at', Carbon::parse($bulan)->month)
                ->get();

            $pengajuan = Pengajuan::select(DB::raw('SUM(total) as totalPengajuan'))
                ->whereYear('created_at', Carbon::parse($bulan)->year)
                ->whereMonth('created_at', Carbon::parse($bulan)->month)
                ->first();
            $saldo = Saldo::select(DB::raw('SUM(saldo) as totalSaldo'))
                ->whereYear('created_at', Carbon::parse($bulan)->year)
                ->whereMonth('created_at', Carbon::parse($bulan)->month)
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
        $pdf = PDF::loadView('Admin.history.cetak', compact('history', 'pengajuan', 'saldo'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Laporan-History.pdf');
    }

    public function cetakpengajuan(Request $request)
    {
        $bulan = $request->input('bulan');
        $jenisPengajuan = 'Menunggu';

        $dataPengajuan = Pengajuan::where('approve', $jenisPengajuan);

        if ($request->has('bulan')) {
            $bulan = $request->input('bulan');
            $dataPengajuan->whereYear('created_at', Carbon::parse($bulan)->year)
                ->whereMonth('created_at', Carbon::parse($bulan)->month);
        }

        $pengajuan = $dataPengajuan->get();

        if ($pengajuan->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak tersedia.');
        }

        $pdf = PDF::loadView('Admin.pengajuan.cetak', compact('pengajuan'));
        return $pdf->stream('Laporan-Pengajuan.pdf');
    }
}
