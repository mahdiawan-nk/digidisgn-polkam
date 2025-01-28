<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ValidasiSuratResource\Pages;
use App\Filament\Resources\ValidasiSuratResource\RelationManagers;
use App\Models\Surat as ValidasiSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Support\Enums\MaxWidth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use App\Models\SuratValidationStep;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class ValidasiSuratResource extends Resource
{
    protected static ?string $model = ValidasiSurat::class;
    protected static ?string $navigationGroup = 'Management Surat';
    protected static ?string $navigationLabel = 'Validasi Surat';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('validator-kabag') || auth()->user()?->hasRole('validator-wd') || auth()->user()?->hasRole('validator-direktur'); // Batasi akses berdasarkan permission
    }

    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        $userRoles = $user->getRoleNames()->toArray();  // Mendapatkan role pengguna

        // Menyusun role yang diperlukan berdasarkan role pengguna yang terdaftar
        $roleRequired = [];
        if (in_array('validator-kabag', $userRoles)) {
            $roleRequired[] = 'validator-kabag';
        }
        if (in_array('validator-wd', $userRoles)) {
            $roleRequired[] = 'validator-wd';
        }
        if (in_array('validator-direktur', $userRoles)) {
            $roleRequired[] = 'validator-direktur';
        }

        // Jika tidak ada role yang sesuai, langsung kembalikan 0
        if (empty($roleRequired)) {
            return 0;
        }

        // Membangun query untuk ValidasiSurat
        $query = ValidasiSurat::query();

        // Menambahkan kondisi berdasarkan role yang diperlukan
        $query->whereIn(
            'id',
            SuratValidationStep::where('user_id', $user->id)
                ->whereIn('role_required', $roleRequired)
                ->pluck('surat_id')
        );

        // Menambahkan kondisi status pengajuan
        $query->whereIn('status_pengajuan', ['in verification', 'in prosess', 'in validation']);

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
            ->recordUrl(
                null,
            )
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
                        'in validation' => 'in validation',
                        'returned' => 'returned',
                    ]),
                    // ->default(function () {
                    //     if (Auth::user()->hasRole('validator-kabag')) {
                    //         return 'in prosess';
                    //     }
                    //     if (Auth::user()->hasRole('validator-wd')) {
                    //         return 'in verification';
                    //     }
                    //     if (Auth::user()->hasRole('validator-direktur')) {
                    //         return 'in validation';
                    //     }
                    // }),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\Action::make('view') // Add View Action
                //     ->label('Lihat File') // Label for the View button
                //     ->icon('heroicon-s-eye') // Optional icon for the button
                //     ->modalHeading('Preview Surat') // Modal heading when clicking on the action
                //     ->modalButton('Verifikasi Surat') // Modal close button label
                //     ->action(function (ValidasiSurat $record): void {})
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
                //             ->action(function (ValidasiSurat $record) {
                //                 $updateStep = SuratValidationStep::where('surat_id', $record->id)->where('user_id', auth()->user()->id)->first();
                //                 $updateStep = SuratValidationStep::find($updateStep->id);
                //                 $updateStep->status = 'approved';
                //                 $updateStep->save();

                //                 ValidasiSurat::where('id', $record->id)->update([
                //                     'status_pengajuan' => 'finished',
                //                 ]);
                //                 static::generateQrCodes($record);
                //             })
                //             ->visible(function ($record) {
                //                 return $record->status_pengajuan == 'in verification';
                //             })
                //             ->requiresConfirmation(),
                //         Tables\Actions\Action::make('Reject')
                //             ->color('danger')
                //             ->icon('heroicon-s-x-mark')
                //             ->form([
                //                 Textarea::make('note')
                //                     ->required()
                //             ])
                //             ->visible(function ($record) {
                //                 return $record->status_pengajuan == 'in verification';
                //             })
                //             ->action(function (ValidasiSurat $record, array $data) {
                //                 $updateStep = SuratValidationStep::where('surat_id', $record->id)->where('user_id', auth()->user()->id)->first();
                //                 $updateStep = SuratValidationStep::find($updateStep->id);
                //                 $updateStep->status = 'rejected';
                //                 $updateStep->note = $data['note'];
                //                 $updateStep->save();

                //                 $record->status_pengajuan = 'returned';
                //                 $record->save();
                //             })
                //             ->requiresConfirmation()
                //     ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListValidasiSurats::route('/'),
            'create' => Pages\CreateValidasiSurat::route('/create'),
            'edit' => Pages\EditValidasiSurat::route('/{record}/edit'),
            'view' => Pages\ViewValidasiSurat::route('/{record}/view'),
        ];
    }

    public static function generateQrCodes($record)
    {
        // Mengenkripsi ID record
        $encryptedId = Crypt::encryptString($record->id);
        // $tanggalSurat = $record->tanggal_surat;
        // $nomorSurat = $record->nomor_surat;
        // $validatorUser = User::find($record->validator_id)->name;
        // $jabatanValidator = User::with('jabatan')->find($record->validator_id)->jabatan->nama_jabatan;
        $url = url('documents-sign/' . $encryptedId);
        // $tanggalSurat . '|' . $nomorSurat . '|' . $validatorUser . '|' . $jabatanValidator . '|' .
        // Membuat URL dengan ID yang terenkripsi
        $data =  $url; // Gantilah dengan URL atau data sesuai kebutuhan

        // Path logo yang akan ditambahkan
        $logoPath = public_path('logo.png'); // Gantilah dengan path logo yang sesuai

        // Generate QR Code dengan logo
        $qrCode = QrCode::format('png')
            ->size(300) // Ukuran QR Code
            ->margin(10)
            ->errorCorrection('H') // Tingkat koreksi kesalahan tinggi
            ->generate($data);
        // Generate nama file unik menggunakan UUID
        $filename = 'surat_' . Str::uuid() . '_qrcode.png'; // Menggunakan UUID untuk nama file unik
        // $path = public_path('uploads/qrcodes/' . $filename);
        $path = 'uploads/qrcodes/' . $filename;

        // Simpan QR Code ke file
        // file_put_contents($path, $qrCode);
        Storage::disk('public')->put($path, $qrCode);

        // Update record dengan path QR Code jika diperlukan
        $record->update([
            'qr_code_path' => $path, // Simpan path QR Code di field 'qr_code_path'
        ]);
    }
}
