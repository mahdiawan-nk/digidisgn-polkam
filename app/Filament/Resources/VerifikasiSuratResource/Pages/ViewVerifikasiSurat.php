<?php

namespace App\Filament\Resources\VerifikasiSuratResource\Pages;

use App\Filament\Resources\VerifikasiSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ViewEntry;
use Filament\Support\Enums\Alignment;
use Filament\Infolists\Components\Grid;
use App\Models\Surat;
use App\Models\Surat as VerifikasiSurat;
use App\Models\SuratValidationStep;
use Filament\Notifications\Notification;
use App\Models\SuratValidationLog;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Textarea;

class ViewVerifikasiSurat extends ViewRecord
{
    protected static string $resource = VerifikasiSuratResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('User Information & Surat Information')
                    ->schema([
                        TextEntry::make('pengirim')
                            ->formatStateUsing(function ($state) {
                                return $state->name . ' - (' . $state->jabatan->jabatan->nama_jabatan . ')';
                            }),
                        TextEntry::make('nomor_surat'),
                        TextEntry::make('perihal'),
                        TextEntry::make('tanggal_surat'),
                    ])
                    ->columns(4),
                ViewEntry::make('validation_logs')
                    ->view('filament.infolists.logs-activity', ['record' => $infolist->getRecord()])
                    ->columnSpanFull(),
                Section::make('Preview Surat Attachment')
                    ->schema([
                        ViewEntry::make('validation_logs')
                            ->view('filament.infolists.view-file', ['record' => $infolist->getRecord()]),
                    ])
                    ->columns(1),
                Grid::make(2)
                    ->schema([
                        \Filament\Infolists\Components\Actions::make([
                            \Filament\Infolists\Components\Actions\Action::make('Verifikasi Approve')
                                ->label('Approve')
                                ->color('success')
                                ->icon('heroicon-s-check')
                                ->requiresConfirmation()
                                ->requiresConfirmation()
                                ->action(function (VerifikasiSurat $record) {
                                    $updateStep = SuratValidationStep::where('surat_id', $record->id)->where('user_id', auth()->user()->id)->first();
                                    $updateStep = SuratValidationStep::find($updateStep->id);
                                    $updateStep->status = 'approved';
                                    $updateStep->save();

                                    VerifikasiSurat::where('id', $record->id)->update([
                                        'status_pengajuan' => Auth::user()->hasRole('verifikator-kabag') ? 'in verification' : 'in validation',
                                    ]);
                                    Notification::make()
                                        ->title('Verifikasi Berhasil')
                                        ->body('Data berhasil diverifikasi')
                                        ->success()
                                        ->send();
                                    
                                    return redirect('/admin/verifikasi-surats');
                                })
                                ->visible(function ($record) {
                                    if (Auth::user()->hasRole('verifikator-kabag')) {
                                        return in_array($record->status_pengajuan, ['in prosess', 're-submited']);
                                    }
                                    if (Auth::user()->hasRole('verifikator-wd')) {
                                        return $record->status_pengajuan == 'in verification';
                                    }
                                }),
                            \Filament\Infolists\Components\Actions\Action::make('Verifikasi Reject')
                                ->label('Reject')
                                ->color('danger')
                                ->icon('heroicon-s-x-mark')
                                ->form([
                                    Textarea::make('note')
                                        ->required()
                                ])
                                ->action(function (VerifikasiSurat $record, array $data) {
                                    $updateStep = SuratValidationStep::where('surat_id', $record->id)->where('user_id', auth()->user()->id)->first();
                                    $updateStep = SuratValidationStep::find($updateStep->id);
                                    $updateStep->status = 'rejected';
                                    $updateStep->note = $data['note'];
                                    $updateStep->save();

                                    VerifikasiSurat::where('id', $record->id)->update([
                                        'status_pengajuan' => 'returned'
                                    ]);
                                    Notification::make()
                                        ->title('Verifikasi Berhasil')
                                        ->body('Data berhasil diverifikasi')
                                        ->success()
                                        ->send();
                                        return redirect('/admin/verifikasi-surats');

                                })
                                ->visible(function ($record) {
                                    if (Auth::user()->hasRole('verifikator-kabag')) {
                                        return in_array($record->status_pengajuan, ['in prosess', 're-submited']);
                                    }
                                    if (Auth::user()->hasRole('verifikator-wd')) {
                                        return $record->status_pengajuan == 'in verification';
                                    }
                                }),
                            \Filament\Infolists\Components\Actions\Action::make('Kembali')
                                ->label('Kembali')
                                ->url(VerifikasiSuratResource::getUrl('index'))


                        ])->columnSpanFull(),
                    ])

            ]);
    }
    
}
