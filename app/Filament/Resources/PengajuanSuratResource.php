<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Filament\Resources\PengajuanSuratResource\RelationManagers;
use App\Models\Surat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuratResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use App\Models\User;
// use Filament\Forms\Components\Actions\CreateAction;
class PengajuanSuratResource extends Resource
{
    protected static ?string $model = Surat::class;
    protected static ?string $navigationGroup = 'Management Surat';
    protected static ?string $navigationLabel = 'Pengajuan Surat';
    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?int $navigationSort = 1;
    public static function getNavigationUrl(): string
    {
        return static::getUrl('create');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('staff') && auth()->user()->hasPermissionTo('surat-access'); // Batasi akses berdasarkan permission
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Section::make('Pengajuan Surat')
                        ->schema([
                            Grid::make(3)->schema([
                                Forms\Components\TextInput::make('nomor_surat')->required(),
                                Forms\Components\TextInput::make('perihal')->required(),
                                Forms\Components\DatePicker::make('tanggal_surat')
                                    ->label('Tanggal Pengajuan')
                                    ->displayFormat('Y-m-d')
                                    ->default(now()->format('Y-m-d'))
                                    ->readOnly()
                                    ->required(),

                            ]),
                            Grid::make(1)->schema([
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->placeholder('Masukkan deskripsi...')
                                    ->rows(10)
                                    ->required(),
                                Forms\Components\FileUpload::make('file_surat')
                                    ->label('Upload File Surat')
                                    ->maxFiles(1)
                                    ->acceptedFileTypes(['application/pdf']) // Mengaktifkan mode unggah gambar
                                    ->directory('uploads/dokumen') // Folder penyimpanan di storage
                                    ->maxSize(6455)
                                    ->required(),

                            ])

                        ])->columnSpan(8),
                    Section::make('Validation Signature')
                        ->schema([
                            Forms\Components\Select::make('validation_rule')
                                ->label('Validasi Akhir')
                                ->reactive()
                                ->live(debounce: 100)
                                ->options([
                                    'Kabag' => 'Kabag',
                                    'WD' => 'WD',
                                    'Direktur' => 'Direktur',
                                ])
                                ->required(),
                            Forms\Components\Select::make('verifikator_kabag')
                                ->label('Verifikasi Kabag')
                                ->required(fn($get) =>  $get('validation_rule') === 'WD' || $get('validation_rule') === 'Direktur')
                                ->visible(fn($get) => $get('validation_rule') === 'WD' || $get('validation_rule') === 'Direktur')
                                ->options(User::role('verifikator-kabag')->pluck('name', 'id')->toArray()),
                            Forms\Components\Select::make('verifikator_wd')
                                ->label('Verifikasi WD')
                                ->required(fn($get) => $get('validation_rule') === 'Direktur')
                                ->visible(fn($get) =>  $get('validation_rule') === 'Direktur')
                                ->options(User::role('verifikator-wd')->pluck('name', 'id')->toArray()),
                            Forms\Components\Select::make('validator_kabag')
                                ->label('Validasi Kabag')
                                ->required(fn($get) =>  $get('validation_rule') === 'Kabag')
                                ->visible(fn($get) =>  $get('validation_rule') === 'Kabag')
                                ->options(User::role('validator-kabag')->pluck('name', 'id')->toArray()),
                            Forms\Components\Select::make('validator_wd')
                                ->label('Validasi WD')
                                ->required(fn($get) =>  $get('validation_rule') === 'WD')
                                ->visible(fn($get) =>  $get('validation_rule') === 'WD')
                                ->options(User::role('validator-wd')->pluck('name', 'id')->toArray()),

                        ])->columnSpan(4),
                ]),


            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPengajuanSurats::route('/'),
            'create' => Pages\CreatePengajuanSurat::route('/create'),
            'edit' => Pages\EditPengajuanSurat::route('/{record}/edit'),
        ];
    }
}
