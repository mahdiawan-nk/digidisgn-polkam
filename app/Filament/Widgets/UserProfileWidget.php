<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class UserProfileWidget extends Widget
{
    protected static string $view = 'filament.widgets.user-profile-widget';
    protected int | string | array $columnSpan = 2;
    public static function getSort(): int
    {
        return 2;
    }

    public function getViewData(): array
    {
        $user = Auth::user();
        // dd($user->roles->pluck('name')->toArray());
        return [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => asset('profile.png'), // Default avatar placeholder
            'position' => $user->jabatan->nama_jabatan ?? 'Unknown Position', // Jabatan dari tabel relasi
            'roles' => $user->roles->pluck('name')->toArray(), // Roles
        ];
    }
}
