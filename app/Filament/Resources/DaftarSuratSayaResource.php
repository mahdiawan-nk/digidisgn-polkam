<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarSuratSayaResource\Pages;
use App\Filament\Resources\DaftarSuratSayaResource\RelationManagers;
use App\Models\Surat as DaftarSuratSaya;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Resources\PengajuanSuratResource;
use App\Models\SuratValidationLog;
use Filament\Support\Enums\FontWeight;

class DaftarSuratSayaResource extends Resource
{
    protected static ?string $model = DaftarSuratSaya::class;
    protected static ?string $navigationGroup = 'Management Surat';
    protected static ?string $navigationLabel = 'Daftar Surat Saya';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 2;
    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('staff') && auth()->user()->hasPermissionTo('surat-access'); // Batasi akses berdasarkan permission
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_surat')->required(),
                Forms\Components\TextInput::make('perihal')->required(),
                Forms\Components\DatePicker::make('tanggal_surat')
                    ->label('Tanggal Pengajuan')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->placeholder('Masukkan deskripsi...')
                    ->required(),
                Forms\Components\FileUpload::make('file_surat')
                    ->label('Upload File Surat')
                    ->maxFiles(1)
                    ->acceptedFileTypes(['application/pdf']) // Mengaktifkan mode unggah gambar
                    ->directory('uploads/dokumen') // Folder penyimpanan di storage
                    ->required(),
                Forms\Components\Select::make('verifikator_id')
                    ->label('di tujukan ke')
                    ->required()
                    ->relationship('verifikator', 'name'),


            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s')
            ->defaultSort('tanggal_surat', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->rowIndex(isFromZero: false),
                Tables\Columns\TextColumn::make('tanggal_surat')
                    ->label('Tanggal Pengajuan')
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pengajuan')
                    ->weight(FontWeight::Bold)
                    ->color(fn(string $state): string => match ($state) {
                        'in prosess' => 'gray',
                        'in verification' => 'warning',
                        'in validation' => 'success',
                        'rejected' => 'danger',
                        'finished' => 'success',
                        're-submited' => 'gray',
                        'returned' => 'danger',
                    })
                    ->label('Status Submited'),
                // Tables\Columns\ViewColumn::make('validation_steps')
                //     ->label('Status Verifikasi')
                //     ->view('filament.resources.table.step-verifikasi'),
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
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->url(fn(DaftarSuratSaya $record): string => PengajuanSuratResource::getUrl('edit', ['record' => $record->id]))
                        ->icon('heroicon-s-pencil')
                        ->visible(fn(DaftarSuratSaya $record): bool => $record->status_pengajuan == 'pending' || $record->status_pengajuan == 'returned' || $record->status_pengajuan == 're-submited'),
                    Tables\Actions\Action::make('download')
                        ->label('Download QR Code')
                        ->icon('heroicon-o-archive-box-arrow-down')
                        ->visible(fn(DaftarSuratSaya $record): bool => $record->status_pengajuan == 'finished')
                        ->url(fn(DaftarSuratSaya $record): string => asset('storage/' . $record->qr_code_path)),
                    Tables\Actions\Action::make('view_logs')
                        ->label('Lihat Log')
                        ->icon('heroicon-s-eye')
                        ->modalHeading('Log Pengajuan Surat')
                        ->modalButton('Tutup')
                        ->modalContent(function (DaftarSuratSaya $record) {
                            $dataLogs = SuratValidationLog::with('user:id,name')->where('surat_id', $record->id)->orderBy('created_at', 'desc')->get();
                            return view('filament.resources.surat-resource.pages.view-logs', ['record' => $dataLogs]);
                        })
                        ->modalWidth(MaxWidth::Large)
                        ->slideOver(),
                    Tables\Actions\Action::make('view') // Add View Action
                        ->label('Lihat File') // Label for the View button
                        ->icon('heroicon-s-eye') // Optional icon for the button
                        ->modalHeading('Preview Surat') // Modal heading when clicking on the action
                        ->modalButton('Tutup') // Modal close button label
                        ->action(function (DaftarSuratSaya $record): void {
                            // if (!in_array($record->status, ['diverifikasi', 'ditolak'])) {
                            //     $record->status = 'pending'; // Atur status menjadi 'pending' jika tidak 'diverifikasi' atau 'ditolak'
                            //     $record->save(); // Simpan perubahan
                            // }
                        })
                        ->modalContent(function ($record) {
                            // Return the data from the record to display in the modal view
                            return view('components.view-file', [
                                'record' => $record, // Pass the record to the view
                            ]);
                        })
                        ->modalWidth(MaxWidth::Large)
                        ->slideOver(), // Aksi untuk menghapus
                ])
                ->button(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                false
            );
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
            'index' => Pages\ListDaftarSuratSayas::route('/'),
            'create' => Pages\CreateDaftarSuratSaya::route('/create'),
            'edit' => Pages\EditDaftarSuratSaya::route('/{record}/edit'),

        ];
    }

    private static function badgeStatus(string $status): string
    {
        return match ($status) {
            'pending' => 'inline-flex items-center rounded-md bg-yellow-500 px-2 py-1 text-xs font-medium text-black-800 ',
            'approved' => 'inline-flex items-center rounded-md bg-green-500 px-2 py-1 text-xs font-medium text-black-800',
            'rejected' => 'inline-flex items-center rounded-md bg-red-500 px-2 py-1 text-xs font-medium text-black-800',
            default => 'inline-flex items-center rounded-md bg-blue-500 px-2 py-1 text-xs font-medium text-black-800',
        };
    }
}
