<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Transaksi;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $slug = 'transaksi';
    protected static ?string $pluralModelLabel = 'Transaksi';
    protected static ?string $modelLabel = 'Transaksi';
    protected static ?string $navigationIcon = 'heroicon-c-shopping-cart';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pelanggan'),

                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Layanan Dipesan'),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i'),
                Tables\Columns\TextColumn::make('total_bayar')
                    ->label('Total Bayar')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('no_polisi')
                    ->label('No Polisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->label('Lokasi')
                    ->formatStateUsing(function ($record) {
                        if ($record->latitude && $record->longitude) {
                            $url = "https://www.google.com/maps?q={$record->latitude},{$record->longitude}";
                            return "<a href=\"{$url}\" target=\"_blank\">Lihat Lokasi</a>";
                        }
                        return $record->latitude;
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ActionsAction::make('lanjutkan')
                        ->label('Lanjutkan Proses')
                        ->action(function (Transaksi $record) {
                            $statusBaru = match ($record->status) {
                                'pending' => 'proses',
                                'proses' => 'selesai',
                                default => 'selesai',
                            };
                            $record->update(['status' => $statusBaru]);
                            return Notification::make('success', "Status berhasil diubah ke {$statusBaru}");
                        })
                        ->icon('heroicon-o-arrow-path')
                        ->visible(fn(Transaksi $record) => $record->status !== 'selesai'),

                    ActionsAction::make('lihat_pesanan')
                        ->label('Lihat Pesanan')
                        ->icon('heroicon-o-eye')
                        ->url(fn(Transaksi $record) => route('filament.admin.resources.transaksi.pesanan', ['record' => $record->getKey()]))
                        ->visible(fn(Transaksi $record) => [$record->detailSpareparts()->exists() || $record->layanan()->exists()]),
                ])
                    ->icon('heroicon-o-cog-6-tooth')
                    ->label('Aksi')
                    ->color('primary')
                    ->tooltip('Aksi'),
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
            'index' => Pages\ListTransaksis::route('/'),
            'pesanan' => Pages\ListPesanan::route('/{record}/pesanan')
        ];
    }
}
