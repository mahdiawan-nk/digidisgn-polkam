<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerifikasiSuratResource\Pages;
use App\Filament\Resources\VerifikasiSuratResource\RelationManagers;
use App\Models\Surat as VerifikasiSurat;
use App\Models\SuratValidationLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\SuratValidationStep;
use App\Models\Surat;
use Filament\Actions\Modal\Actions\Action;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ViewEntry;
use Filament\Support\Enums\Alignment;
use Filament\Infolists\Components\Grid;
use Filament\Resources\Pages\Page;
class VerifikasiSuratResource extends Resource
{
    protected static ?string $model = VerifikasiSurat::class;
    protected static ?string $pollingInterval = '5s';
    protected static ?string $navigationGroup = 'Management Surat';
    protected static ?string $navigationLabel = 'Verifikasi Surat';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('verifikator-kabag') || auth()->user()?->hasRole('verifikator-wd'); // Batasi akses berdasarkan permission
    }

    
    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        $userRoles = $user->getRoleNames()->toArray();  // Mendapatkan role pengguna

        // Menyusun role yang diperlukan berdasarkan role pengguna yang terdaftar
        $roleRequired = [];
        if (in_array('verifikator-kabag', $userRoles)) {
            $roleRequired[] = 'verifikator-kabag';
        }
        if (in_array('verifikator-wd', $userRoles)) {
            $roleRequired[] = 'verifikator-wd';
        }

        // Jika tidak ada role yang sesuai, langsung kembalikan 0
        if (empty($roleRequired)) {
            return 0;
        }

        // Membangun query untuk Surat
        $query = Surat::query();

        // Menambahkan kondisi berdasarkan role yang diperlukan
        $query->whereIn(
            'id',
            SuratValidationStep::where('user_id', $user->id)
                ->whereIn('role_required', $roleRequired)
                ->pluck('surat_id')
        );

        if (in_array('verifikator-kabag', $userRoles)) {
            $query->whereIn('status_pengajuan', ['in prosess','re-submited']);
        }
        if (in_array('verifikator-wd', $userRoles)) {
            $query->where('status_pengajuan', 'in verification');
        }

        // Menghitung jumlah data yang sesuai
        return $query->count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_surat')
                    ->searchable()
                    ->label('Tgl. Pengajuan')
                    ->dateTime('d-m-Y'),
                Tables\Columns\TextColumn::make('nomor_surat'),
                Tables\Columns\TextColumn::make('perihal'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('status_pengajuan'),
                Tables\Columns\ViewColumn::make('validation_steps')
                    ->label('Status Verifikasi & Validasi')
                    ->view('filament.resources.table.note-verifikasi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status_pengajuan')
                    ->label('Status Pengajuan')
                    ->options([
                        'in prosess' => 'in prosess',
                        'in verification' => 'in verification',
                        'returned' => 'returned',
                    ]),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make('View')
                    ->slideOver(),
                // Tables\Actions\Action::make('view') // Add View Action
                //     ->label('Lihat File') // Label for the View button
                //     ->icon('heroicon-s-eye') // Optional icon for the button
                //     ->modalHeading('Preview Surat') // Modal heading when clicking on the action
                //     ->modalButton('Verifikasi Surat') // Modal close button label
                //     ->action(function (VerifikasiSurat $record): void {})
                //     ->modalContent(function ($record) {
                //         // Return the data from the record to display in the modal view
                //         return view('components.view-file', [
                //             'record' => $record, // Pass the record to the view
                //         ]);
                //     })
                //     ->modalWidth(MaxWidth::Large)
                //     ->slideOver()
                //     ->modalSubmitAction(false)
                //     ->extraModalFooterActions([
                //         Tables\Actions\Action::make('Aprove')
                //             ->color('success')
                //             ->icon('heroicon-s-check')
                //             ->action(function (VerifikasiSurat $record) {
                //                 $updateStep = SuratValidationStep::where('surat_id', $record->id)->where('user_id', auth()->user()->id)->first();
                //                 $updateStep = SuratValidationStep::find($updateStep->id);
                //                 $updateStep->status = 'approved';
                //                 $updateStep->save();

                //                 VerifikasiSurat::where('id', $record->id)->update([
                //                     'status_pengajuan' => 'in verification'
                //                 ]);
                //                 Notification::make()
                //                     ->title('Verifikasi Berhasil')
                //                     ->body('Data berhasil diverifikasi')
                //                     ->success()
                //                     ->send();
                //             })
                //             ->visible(function ($record) {
                //                 if (Auth::user()->hasRole('verifikator-kabag')) {
                //                     return $record->status_pengajuan == 'in prosess';
                //                 }
                //                 if (Auth::user()->hasRole('verifikator-wd')) {
                //                     return $record->status_pengajuan == 'in verification';
                //                 }
                //             })
                //             ->requiresConfirmation(),
                //         Tables\Actions\Action::make('Reject')
                //             ->color('danger')
                //             ->icon('heroicon-s-x-mark')
                //             ->form([
                //                 Textarea::make('note')
                //                     ->required()
                //             ])
                //             ->action(function (VerifikasiSurat $record, array $data) {
                //                 $updateStep = SuratValidationStep::where('surat_id', $record->id)->where('user_id', auth()->user()->id)->first();
                //                 $updateStep = SuratValidationStep::find($updateStep->id);
                //                 $updateStep->status = 'rejected';
                //                 $updateStep->note = $data['note'];
                //                 $updateStep->save();

                //                 VerifikasiSurat::where('id', $record->id)->update([
                //                     'status_pengajuan' => 'returned'
                //                 ]);
                //             })
                //             ->requiresConfirmation()
                //     ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerifikasiSurats::route('/'),
            'create' => Pages\CreateVerifikasiSurat::route('/create'),
            'edit' => Pages\EditVerifikasiSurat::route('/{record}/edit'),
            'view' => Pages\ViewVerifikasiSurat::route('/{record}/view'),
        ];
    }
}
