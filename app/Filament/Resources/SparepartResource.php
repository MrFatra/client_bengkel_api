<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SparepartResource\Pages;
use App\Filament\Resources\SparepartResource\RelationManagers;
use App\Models\Sparepart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SparepartResource extends Resource
{
    protected static ?string $model = Sparepart::class;
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Sparepart';
    protected static ?string $slug = 'master-data/sparepart';
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?string $pluralModelLabel = 'Spareparts';
    protected static ?string $modelLabel = 'Sparepart';
    protected static ?string $modelLabelPlural = 'Spareparts';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Sparepart')
                    ->description('Masukkan detail sparepart di bawah ini.')
                    ->icon('heroicon-o-cube')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('kategori_kendaraan_id')
                            ->label('Kategori Kendaraan')
                            ->relationship('kategori_kendaraan', 'nama_kategori')
                            ->required()
                            ->icon('heroicon-o-truck'),
                        Forms\Components\TextInput::make('nama_sparepart')
                            ->label('Nama Sparepart')
                            ->maxLength(100)
                            ->required()
                            ->icon('heroicon-o-identification'),
                        Forms\Components\TextInput::make('merk')
                            ->label('Merk')
                            ->maxLength(50)
                            ->required()
                            ->icon('heroicon-o-tag'),
                        Forms\Components\TextInput::make('stok')
                            ->label('Stok')
                            ->numeric()
                            ->required()
                            ->icon('heroicon-o-archive-box'),
                        Forms\Components\TextInput::make('harga')
                            ->label('Harga')
                            ->numeric()
                            ->required()
                            ->icon('heroicon-o-currency-dollar'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('KategoriKendaraan.nama_kategori')
                    ->label('Kategori Kendaraan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_sparepart')
                    ->label('Nama Sparepart')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('merk')
                    ->label('Merk')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_kendaraan_id')
                    ->label('Kategori Kendaraan')
                    ->relationship('kategoriKendaraan', 'nama_kategori')
                    ->searchable()
                    ->options(function (Builder $query) {
                        return $query->pluck('nama_kategori', 'id');
                    }),
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
            'index' => Pages\ListSpareparts::route('/'),
            'create' => Pages\CreateSparepart::route('/create'),
            'edit' => Pages\EditSparepart::route('/{record}/edit'),
        ];
    }
}
