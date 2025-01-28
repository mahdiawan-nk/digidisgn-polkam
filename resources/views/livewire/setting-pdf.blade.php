<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Kolom pertama: Form Input sebagai Card -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-6">Generate QR Code for PDF</h2>
        <form wire:submit.prevent="generateQrCode">
            <div class="mb-4">
                <label for="surat_id" class="block text-sm font-medium text-gray-700">Pilih Surat</label>
                <select id="surat_id" wire:model="surat_id" wire:change="loadSurat" class="mt-1 p-2 border rounded w-full">
                    <option value="">Pilih Surat</option>
                    @foreach ($dataSurat as $surat)
                        <option value="{{ $surat->id }}">{{ $surat->nomor_surat }} - {{ $surat->perihal }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="positionX" class="block text-sm font-medium text-gray-700">Posisi X (Horizontal)</label>
                <input type="number" id="positionX" wire:model="positionX" wire:change="loadSurat" class="mt-1 p-2 border rounded w-full" />
            </div>

            <div class="mb-4">
                <label for="positionY" class="block text-sm font-medium text-gray-700">Posisi Y (Vertikal)</label>
                <input type="number" id="positionY" wire:model="positionY" wire:change="loadSurat" class="mt-1 p-2 border rounded w-full" />
            </div>

            <div class="mb-4">
                <label for="marginBottom" class="block text-sm font-medium text-gray-700">Margin dari Halaman
                    Bawah</label>
                <input type="number" id="marginBottom" wire:model="marginBottom" wire:change="loadSurat"
                    class="mt-1 p-2 border rounded w-full" />
            </div>

            <div class="mb-4">
                <label for="qrSize" class="block text-sm font-medium text-gray-700">Ukuran QR Code</label>
                <input type="number" id="qrSize" wire:model="qrSize" wire:change="loadSurat" class="mt-1 p-2 border rounded w-full" />
            </div>

            <div class="mb-4">
                <label for="page" class="block text-sm font-medium text-gray-700">Posisi Halaman</label>
                <select id="surat_id" wire:model="page" wire:change="loadSurat" class="mt-1 p-2 border rounded w-full">
                    @php
                        $jml = range(1,$jumlahPage)
                    @endphp
                    @for ($i = 0; $i < $jumlahPage; $i++)
                    <option value="{{ $i+1 }}">{{ $i+1 }}</option>
                        
                    @endfor
                    
                </select>
                {{-- <input type="number" id="page" wire:model="page" wire:change="loadSurat" class="mt-1 p-2 border rounded w-full" /> --}}
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded w-full">Generate PDF with QR
                Code</button>
        </form>
    </div>

    <!-- Kolom kedua: Preview PDF -->
    <div>
        @if ($pdfBase64)
            <div class="">
                <h3 class="text-lg font-semibold">Preview PDF:</h3>
                <iframe src="data:application/pdf;base64,{{ $pdfBase64 }}#zoom=50" width="100%" height="600px" ></iframe>
            </div>
        @endif
    </div>
</div>
