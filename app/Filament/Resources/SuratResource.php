<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratResource\Pages;
use App\Filament\Resources\SuratResource\RelationManagers;
use App\Models\Surat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratResource extends Resource
{
    protected static ?string $navigationGroup = 'Management Surat';
    protected static ?string $navigationLabel = 'Riwayat Surat';
    protected static ?string $model = Surat::class;
    protected static ?string $breadcrumb = 'Riwayat Surat';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        $title = 'tes';
        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('staff') || auth()->user()->hasRole('verifikator-kabag') || auth()->user()->hasRole('verifikator-wd') || auth()->user()->hasRole('validator-kabag') || auth()->user()->hasRole('validator-wd')) {
            $title = 'Riwayat Verifikasi & Validasi Surat';
        } else if (in_array(auth()->user()->hasRole('validator-direktur'), ['validator-direktur'])) {
            $title = 'Riwayat Validasi Surat';
        }
        return $title;
    }
    public static function canViewAny(): bool
    {
        return auth()->user()?->can('riwayat-surat-access'); // Batasi akses berdasarkan permission
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
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pengirim.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pengajuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'in prosess' => 'gray',
                        'in verification' => 'warning',
                        'in validation' => 'success',
                        'rejected' => 'danger',
                        'finished' => 'success',
                        're-submited' => 'gray',
                    })
                    // ->colors(['##FF9800' => 'in prosess', '#2196F3' => 'in verification', '#FFC107' => 'returned', '#4CAF50' => 'finished'])
                    ->label('Status Submited'),
                Tables\Columns\ViewColumn::make('validation_steps')
                    ->label('Status Verifikasi & Validasi')
                    ->view('filament.resources.table.note-verifikasi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                null
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
            'surat-saya' => Pages\SuratSaya::route('/surat-saya'),
        ];
    }
}
