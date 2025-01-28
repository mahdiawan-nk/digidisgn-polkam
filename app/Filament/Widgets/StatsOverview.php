<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Surat;

class StatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        return false;
    }
    protected function getColumns(): int
    {
        if (auth()->user()->hasRole('super-admin')) {
            return 4;
        } else {
            return 3;
        }
    }
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Surat Diajukan',
                static::countSuratDiajukan(),
            )
                ->description('berdasarkan log activity submited dan re-submited'),
            Stat::make(
                'Surat Disetujui',
                static::countSuratDisetujui(),
            )
                ->description('Surat Disetujui berdasarkan log activity'),
            Stat::make(
                'Surat Ditolak',
                static::countSuratDitolak(),
            )
                ->description('Surat Ditolak berdasarkan log activity'),
            Stat::make(
                'Pengguna',
                User::count(),
            )->extraAttributes([
                'class' => auth()->user()->hasRole('super-admin') ? 'block' : 'hidden',
            ]),

        ];
    }

    public static function countSuratDiajukan()
    {
        $user = auth()->user();

        if (!$user) {
            return 0; // Jika tidak ada user yang login, kembalikan 0
        }

        // Menghitung jumlah Surat berdasarkan relasi validation_steps dengan user_id
        $dataCount = Surat::whereHas('validation_logs', function ($query) use ($user) {
            $query->where('user_id', $user->id)->whereIn('action', ['submited', 're-submited']);
        })->count();

        return $dataCount;
    }

    public static function countSuratDisetujui()
    {
        $user = auth()->user();
        if (!$user) {
            return 0; // Jika tidak ada user yang login, kembalikan 0
        }

        // Menghitung jumlah Surat berdasarkan relasi validation_steps dengan user_id
        $dataCount = Surat::whereHas('validation_logs', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('action', 'approved');
        })->count();
        return $dataCount;
    }

    public static function countSuratDitolak()
    {
        $user = auth()->user();
        $dataCount = 0;

        if ($user) {
            $dataCount = Surat::whereHas('validation_steps', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('status', 'rejected');
            })->count();
        }

        return $dataCount;
    }
}
