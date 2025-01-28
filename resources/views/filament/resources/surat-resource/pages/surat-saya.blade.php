<x-filament::page>
    <div class="space-y-4">
        {{-- Search Form --}}
        <div class="mb-4">
            <input 
                type="text" 
                wire:model="search" 
                placeholder="Cari Nomor Surat..." 
                class="px-4 py-2 border border-gray-300 rounded-md w-full"
            />
        </div>

        {{-- Table --}}
        <table class="w-full divide-y divide-gray-200 border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nomor Surat</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($surats as $index => $surat)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $surat->nomor_surat }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $surat->status_pengajuan }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $surat->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $surats->links() }}
        </div>
    </div>
</x-filament::page>
