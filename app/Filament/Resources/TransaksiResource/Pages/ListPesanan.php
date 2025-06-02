<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use App\Filament\Resources\TransaksiResource;
use App\Models\Transaksi;
use Filament\Resources\Pages\Page;

class ListPesanan extends Page
{
    protected static string $resource = TransaksiResource::class;

    protected static string $view = 'filament.resources.transaksi-resource.pages.list-pesanan';

    public $record;

    public function mount($record): void
    {
        $this->record = Transaksi::with(['user', 'detailLayanans', 'detailSpareparts'])->findOrFail($record);
    }
}
