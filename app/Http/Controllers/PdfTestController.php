<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class PdfTestController extends Controller
{

    public function index()
    {
        $filePath = Storage::disk('public')->path('uploads/dokumen/surat-izin.pdf');
        $qrCodePath = public_path('storage/uploads/qrcodes/surat_cb1d02b8-a58e-43b1-953c-ec0a658a17d6_qrcode.png');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Membaca file PDF menggunakan FPDI
        $pdf = new FPDI();
        $pdf->SetAutoPageBreak(true, 15); // Menambahkan pengaturan auto page break

        // Menentukan jumlah halaman PDF yang ada
        $pageCount = $pdf->setSourceFile($filePath);

        // Variabel dinamis untuk posisi QR Code
        $dynamicX = 140; // Posisi X (horizontal)
        $dynamicY = 80; // Posisi Y (vertikal)

        // Menentukan halaman tempat QR code ditambahkan
        $pageNumberToAddQRCode = 1; // Misalnya di halaman ke-2

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
                $pdf->Image($qrCodePath, $dynamicX, $dynamicY, 20); // 30 adalah ukuran QR code
            }
        }

        // Output file PDF langsung ke browser
        return $pdf->Output('I', 'surat_dengan_qrcode.pdf');
    }
}
