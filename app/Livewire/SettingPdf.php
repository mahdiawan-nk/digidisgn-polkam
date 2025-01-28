<?php

namespace App\Livewire;

use Livewire\Component;
use setasign\Fpdi\Fpdi;
use App\Models\Surat;

class SettingPdf extends Component
{
    public $positionX = 50;
    public $positionY = 100;
    public $marginBottom = 10;
    public $qrSize = 30;
    public $page = 1;
    public $surat_id;
    public $pdfBase64;
    public $dataSurat;
    public $selectedOption = null;
    public $jumlahPage = 0;
    public function mount()
    {
        $this->dataSurat = Surat::where('status_pengajuan', 'finished')->get();
    }
    public function render()
    {
        return view('livewire.setting-pdf');
    }

    public function loadSurat()
    {
        if (!$this->surat_id) {
            session()->flash('error', 'Silakan pilih surat terlebih dahulu.');
            return;
        }

        // Ambil data surat yang dipilih
        $this->generateQrCode();
    }

    public function generateQrCode()
    {
        // Validasi apakah surat dipilih
        if (!$this->surat_id) {
            session()->flash('error', 'Silakan pilih surat terlebih dahulu.');
            return;
        }

        // Ambil data surat yang dipilih
        $surat = Surat::find($this->surat_id);

        // Path ke file PDF yang ingin dimodifikasi
        $filePath = storage_path('app/public/' . $surat->file_surat);
        $qrCodePath = public_path('storage/uploads/qrcodes/surat_cb1d02b8-a58e-43b1-953c-ec0a658a17d6_qrcode.png');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Membaca file PDF menggunakan FPDI
        $pdf = new FPDI();
        $pdf->SetAutoPageBreak(true, 15); // Menambahkan pengaturan auto page break

        // Menentukan jumlah halaman PDF yang ada
        $pageCount = $pdf->setSourceFile($filePath);
        $this->jumlahPage = $pageCount;
        // Variabel dinamis untuk posisi QR Code
        $dynamicX = $this->positionX; // Posisi X (horizontal)
        $dynamicY = $this->positionY; // Posisi Y (vertikal)

        // Menentukan halaman tempat QR code ditambahkan
        $pageNumberToAddQRCode = $this->page; // Misalnya di halaman ke-2

        // Loop untuk memproses setiap halaman PDF
        for ($i = 1; $i <= $pageCount; $i++) {
            // Menambahkan halaman
            $pdf->AddPage();

            // Import halaman yang sesuai
            $tplIdx = $pdf->importPage($i);
            $pdf->useTemplate($tplIdx);

            // Menambahkan QR code ke halaman tertentu secara dinamis
            if ($i == $pageNumberToAddQRCode) {
                // Menghitung posisi dinamis untuk QR Code (bisa berdasarkan konten halaman atau faktor lainnya)
                // Misalnya, jika posisi QR code tergantung pada tinggi halaman
                $pageHeight = $pdf->getPageHeight(); // Mengambil tinggi halaman
                $dynamicY = $pageHeight - 60; // QR code diletakkan 50mm dari bawah halaman

                // Menambahkan gambar QR code pada posisi dinamis yang dihitung
                $pdf->Image($qrCodePath, $dynamicX, $dynamicY, $this->qrSize); // 30 adalah ukuran QR code
            }
        }

        // Output PDF ke string
        $pdfOutput = $pdf->Output('S'); // Output sebagai string

        // Mengonversi PDF menjadi base64 untuk ditampilkan dalam browser
        $this->pdfBase64 = base64_encode($pdfOutput);
    }
}
