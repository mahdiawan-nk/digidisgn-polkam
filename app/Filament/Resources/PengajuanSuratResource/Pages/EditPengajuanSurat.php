<?php

namespace App\Filament\Resources\PengajuanSuratResource\Pages;

use App\Filament\Resources\PengajuanSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DaftarSuratSayaResource as SuratResource;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratValidationStep;
use App\Models\SuratValidationLog;
use Barryvdh\Debugbar\Facades\Debugbar;
class EditPengajuanSurat extends EditRecord
{
    protected static string $resource = PengajuanSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return SuratResource::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $getValidationStep = SuratValidationStep::where('surat_id', $data['id'])->get();
        $data['verifikator_kabag'] = null;
        $data['verifikator_wd'] = null;
        $data['validator_wd'] = null;
        foreach ($getValidationStep as $item) {
            if ($item->role_required == 'verifikator-kabag') {
                $data['verifikator_kabag'] = $item->user_id;
            }
            if ($item->role_required == 'verifikator-wd') {
                $data['verifikator_wd'] = $item->user_id;
            }
            if($item->role_required == 'validator-wd'){
                $data['validator_wd'] = $item->user_id;
            }
        }
    
        return $data;
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {   
        $data['status_pengajuan'] = 're-submited';
        $record->update($data);

        self::updateSteps($record->id);
        // self::createLogs($record);
        return $record;
    }

    public static function updateSteps($surat_id){
        $steps = SuratValidationStep::where('surat_id', $surat_id)->update([
            'status' => 'pending',
        ]);
        
    }
    public static function createLogs($surat){
        SuratValidationLog::create([
            'surat_id' => $surat->id,
            'user_id' => auth()->user()->id,
            'validation_step' => '1',
            'action' => 're-submited',
            'note' => 'Mengajukan Ulang Surat',
        ]);
    }
}
