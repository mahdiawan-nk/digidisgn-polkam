<?php

namespace App\Livewire;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\DataJabatan;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use App\Models\Surat;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use App\Models\SuratValidationLog;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratValidationStep;
class CardStatistikValidasiVerifikasi extends Widget
{
    protected static string $view = 'livewire.card-statistik-validasi-verifikasi';
    protected ?string $heading = 'Statistik';
    protected static ?string $pollingInterval = '10s';
    protected int | string | array $columnSpan = 'full';
    public $isRoles;
    public $grid = 3;
    public $totalSurat = [
        'diajukan' => 0,
        'finished' => 0,
    ];
    public $countAdminStatisitik = [
        'penngguna' => 0,
        'roles' => 0,
        'jabatan' => 0
    ];
    public $showAndGrid = [
        'showStatistikAdmin' => false,
        'gridStatistikSurat' => 3,
        'showStatistikSuratAdminStaff' => false
    ];
    public $statistikSuratVerifikasi = [
        'submited' => 0,
        're-submited' => 0,
        'approved' => 0,
        'rejected' => 0
    ];

    public $statistikSuratValidasi = [
        'submited' => 0,
        're-submited' => 0,
        'approved' => 0,
        'rejected' => 0
    ];


    public function mount()
    {

        $getRoles = auth()->user()->getRoleNames()->toArray();
        $this->isRoles = $getRoles;
        $this->setUpGridAndShow();
        $this->countTotalSurat();
        $this->countStatistikAdmin();
        $this->statistikSuratVerifikasi();
    }
    public function setUpGridAndShow()
    {
        if (in_array('super-admin', $this->isRoles)) {
            $this->showAndGrid['showStatistikAdmin'] = true;
            $this->showAndGrid['gridStatistikSurat'] = 3;
            $this->showAndGrid['showStatistikSuratAdminStaff'] = true;
        }
        if (array_intersect(['validator-wd', 'verifikator-wd'], $this->isRoles)) {
            $this->showAndGrid['showStatistikAdmin'] = false;
            $this->showAndGrid['gridStatistikSurat'] = 1;
            $this->showAndGrid['showStatistikSuratAdminStaff'] = false;
        }
        if (array_intersect(['validator-kabag', 'verifikator-kabag'], $this->isRoles)) {
            $this->showAndGrid['showStatistikAdmin'] = false;
            $this->showAndGrid['gridStatistikSurat'] = 1;
            $this->showAndGrid['showStatistikSuratAdminStaff'] = false;
        }
        if (in_array('validator-direktur', $this->isRoles)) {
            $this->showAndGrid['showStatistikAdmin'] = false;
            $this->showAndGrid['gridStatistikSurat'] = 1;
            $this->showAndGrid['showStatistikSuratAdminStaff'] = false;
        }
        if (in_array('staff', $this->isRoles)) {
            $this->showAndGrid['showStatistikAdmin'] = false;
            $this->showAndGrid['gridStatistikSurat'] = 3;
            $this->showAndGrid['showStatistikSuratAdminStaff'] = true;
        }
    }

    public function countTotalSurat()
    {
        // dd($this->isRoles);
        if (in_array('super-admin', $this->isRoles)) {
            $this->totalSurat['diajukan'] = Surat::count();
            $this->totalSurat['finished'] = Surat::whereIn('status_pengajuan', ['finished'])->count();
        }

        if (in_array('staff', $this->isRoles)) {
            $this->totalSurat['diajukan'] = Surat::count();
            $this->totalSurat['finished'] = Surat::whereIn('status_pengajuan', ['finished'])->count();
        }
    }

    public function countStatistikAdmin()
    {
        $this->countAdminStatisitik['pengguna'] = User::count();
        $this->countAdminStatisitik['roles'] = Role::count();
        $this->countAdminStatisitik['jabatan'] = DataJabatan::count();
    }

    public function statistikSuratVerifikasi()
    {

        if (array_intersect(['validator-wd', 'verifikator-wd','staff','validator-direktur','verifikator-kabag','validator-kabag'], $this->isRoles)) {
            
            $idSurat = SuratValidationLog::where('user_id', Auth::user()->id)->groupBy('surat_id')->pluck('surat_id');
        }
        if (in_array('super-admin', $this->isRoles)) {
            $sumStatistik = Surat::all(); // Mengambil semua data Surat
            $idSurat = $sumStatistik->pluck('id')->toArray();
        }
        // Mengambil ID surat

        $logs = SuratValidationLog::whereIn('surat_id', $idSurat)
            ->select('action', DB::raw('COUNT(*) as total')) // Menghitung total per action
            ->whereIn('action', ['submited', 're-submited', 'approved', 'rejected'])
            ->groupBy('action') // Mengelompokkan berdasarkan action
            ->get();

        foreach ($logs as $item) {
            $this->statistikSuratVerifikasi[$item->action]=$item->total;
        }

    }
}
