<?php

namespace App\Filament\Resources\PengajuanSuratResource\Pages;

use App\Filament\Resources\PengajuanSuratResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\DaftarSuratSayaResource as SuratResource;
use App\Models\Surat;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratValidationStep;
use App\Models\User;
use App\Models\SuratValidationLog;
class CreatePengajuanSurat extends CreateRecord
{
    protected static string $resource = PengajuanSuratResource::class;

    protected function getRedirectUrl(): string
    {
        return SuratResource::getUrl('index');
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')->label('Ajukan Surat')->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Ambil verifikator kabag
        $data['qr_code_path'] = '';
        $data['pengirim_id'] = auth()->user()->id;

        // Buat surat
        $createSurat = Surat::create($data);

        // Tentukan langkah validasi berdasarkan aturan
        $validationRule = $createSurat->validation_rule;

        $dataStepValidate = [];

        if ($validationRule === 'Direktur') {

            $dataStepValidate = [
                [
                    'surat_id' => $createSurat->id,
                    'user_id' => $data['verifikator_kabag'],
                    'step_order' => 1,
                    'role_required' => 'verifikator-kabag',
                    'status' => 'pending',
                ],
                [
                    'surat_id' => $createSurat->id,
                    'user_id' => $data['verifikator_wd'],
                    'step_order' => 2,
                    'role_required' => 'verifikator-wd',
                    'status' => 'pending',
                ],
                [
                    'surat_id' => $createSurat->id,
                    'user_id' => User::role('validator-direktur')->first()->id,
                    'step_order' => 3,
                    'role_required' => 'validator-direktur',
                    'status' => 'pending',
                ]
            ];
        } elseif ($validationRule === 'Kabag') {

            $dataStepValidate = [
                [
                    'surat_id' => $createSurat->id,
                    'user_id' => $data['validator_kabag'],
                    'step_order' => 1,
                    'role_required' => 'validator-kabag',
                    'status' => 'pending',
                ],
            ];
        } elseif ($validationRule === 'WD') {

            $dataStepValidate = [
                [
                    'surat_id' => $createSurat->id,
                    'user_id' => $data['verifikator_kabag'],
                    'step_order' => 1,
                    'role_required' => 'verifikator-kabag',
                    'status' => 'pending',
                ],
                [
                    'surat_id' => $createSurat->id,
                    'user_id' => $data['validator_wd'],
                    'step_order' => 2,
                    'role_required' => 'validator-wd',
                    'status' => 'pending',
                ],

            ];
        }

        SuratValidationStep::insert($dataStepValidate);

        $dataSuratValidation = SuratValidationStep::where('surat_id', $createSurat->id)->first();
        
        self::createLogsValidation($dataSuratValidation);
        return $createSurat;
    }

    protected static function createLogsValidation($suratValidationStep){
        SuratValidationLog::create([
            'surat_id' => $suratValidationStep->surat_id,
            'user_id' => auth()->user()->id,
            'validation_step' => 0,
            'action' => 'submited',
            'note' => "Mengajukan Surat",
        ]);
    }

}
