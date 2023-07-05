<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Pengajuan;

class AutoNumberService
{
    public static function generateNumber()
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $lastRecord = Pengajuan::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRecord) {
            $lastNumber = intval(substr($lastRecord->kode, -3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $paddedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        $autoNumber = $currentYear . $currentMonth . $paddedNumber;

        return $autoNumber;
    }
}
