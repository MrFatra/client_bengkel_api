<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriKendaraanResource\Pages;
use App\Filament\Resources\KategoriKendaraanResource\RelationManagers;
use App\Models\KategoriKendaraan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriKendaraanResource extends Resource
{
    protected static ?string $model = KategoriKendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kategori Kendaraan';
    protected static ?string $slug = 'master-data/kategori-kendaraan';
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?string $pluralModelLabel = 'Kategori Kendaraan';
    protected static ?string $modelLabel = 'Kategori Kendaraan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("Informasi Kategori Kendaraan")
                    ->description("Detail informasi kategori kendaraan")
                    ->collapsible()
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('nama_kategori')
                            ->label('Nama Kategori Kendaraan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('tipe')
                            ->label('Tipe Kendaraan')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar Kategori Kendaraan')
                            ->image()
                            ->disk('public')
                            ->directory('kategori-kendaraan')
                            ->nullable(),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Nonaktif',
                            ])
                            ->default('aktif')
                            ->required(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Placeholder::make('info')
                    ->label('Informasi')
                    ->content('Pastikan data kategori kendaraan diisi dengan benar.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Nama Kategori Kendaraan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipe')
                    ->label('Tipe Kendaraan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar Kategori Kendaraan')
                    ->disk('public')
                    ->size(50)
                    ->circular(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color(fn ($state) => $state === 'aktif' ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
           ->actions([
                 ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
                ->icon('heroicon-o-cog-6-tooth')
                ->label('Aksi')
                ->color('primary')
                ->tooltip('Aksi')
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
            'index' => Pages\ListKategoriKendaraans::route('/'),
            'create' => Pages\CreateKategoriKendaraan::route('/create'),
            'edit' => Pages\EditKategoriKendaraan::route('/{record}/edit'),
        ];
    }
}
