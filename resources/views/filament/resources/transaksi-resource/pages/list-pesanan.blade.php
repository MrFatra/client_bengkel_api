<x-filament::page>
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">
                    Kode Transaksi:
                    <span class="font-semibold text-gray-700">#{{ $record->id }}</span>
                </p>
            </div>
        </div>

        {{-- Informasi Umum --}}
        <x-filament::card>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nama User</p>
                    <p class="font-medium">{{ $record->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p class="font-medium">{{ $record->tanggal }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">No. Polisi</p>
                    <p class="font-medium">{{ $record->no_polisi ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <x-filament::badge
                        color="{{ [
                            'pending' => 'gray',
                            'proses' => 'warning',
                            'selesai' => 'success',
                        ][$record->status] ?? 'gray' }}">
                        {{ ucfirst($record->status) }}
                    </x-filament::badge>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Bayar</p>
                    <p class="font-bold text-green-600">Rp{{ number_format($record->total_bayar, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p class="font-medium">{{ $record->alamat ?? '-' }}</p>
                </div>
            </div>
        </x-filament::card>

        {{-- Layanan --}}
        <x-filament::card>
            <h3 class="text-lg font-semibold mb-3">Layanan</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto text-sm border border-gray-400">
                    <thead class="text-left">
                        <tr>
                            <th class="p-2 border border-gray-400">Layanan</th>
                            <th class="p-2 border border-gray-400">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($record->detailLayanans as $layanan)
                            <tr>
                                <td
                                    class="p-2 border border-gray-400 hover:text-blue-600 transition-colors duration-200">
                                    {{ $layanan->layanan->nama_layanan ?? '-' }}
                                </td>
                                <td
                                    class="p-2 border border-gray-400 hover:text-blue-600 transition-colors duration-200">
                                    Rp{{ number_format($layanan->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-gray-500 p-2 border border-gray-400">
                                    Tidak ada layanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-filament::card>

        {{-- Sparepart --}}
        <x-filament::card>
            <h3 class="text-lg font-semibold mb-3">Sparepart</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto text-sm border border-gray-400">
                    <thead class="text-left">
                        <tr>
                            <th class="p-2 border border-gray-400">Sparepart</th>
                            <th class="p-2 border border-gray-400">Jumlah</th>
                            <th class="p-2 border border-gray-400">Harga Satuan</th>
                            <th class="p-2 border border-gray-400">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($record->detailSpareparts as $sparepart)
                            <tr>
                                <td
                                    class="p-2 border border-gray-400 hover:text-blue-600 transition-colors duration-200">
                                    {{ $sparepart->sparepart->nama_sparepart ?? '-' }}
                                </td>
                                <td
                                    class="p-2 border border-gray-400 hover:text-blue-600 transition-colors duration-200">
                                    {{ $sparepart->jumlah }}
                                </td>
                                <td
                                    class="p-2 border border-gray-400 hover:text-blue-600 transition-colors duration-200">
                                    Rp{{ number_format($sparepart->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td
                                    class="p-2 border border-gray-400 hover:text-blue-600 transition-colors duration-200">
                                    Rp{{ number_format($sparepart->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 p-2 border border-gray-400">
                                    Tidak ada sparepart.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-filament::card>
    </div>
</x-filament::page>
