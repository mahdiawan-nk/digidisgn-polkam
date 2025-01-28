<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Surat;
use Illuminate\Contracts\Encryption\DecryptException;

class DocumentSignController extends Controller
{
    public function sign($id)
    {
        try {
            // Mencoba mendekripsi ID
            $id = Crypt::decryptString($id);

            // Mencari data surat berdasarkan ID yang didekripsi
            $dataSurat = Surat::with(['validation_steps' => function ($query) {
                $query->with(['user:id,name','user.jabatan.jabatan'])->orderBy('step_order','desc')->first();
            }])->find($id);

            // Memeriksa jika surat ditemukan
            if (!$dataSurat) {
                abort(404);  // Mengembalikan halaman 404 jika surat tidak ditemukan
            }  

            // return response()->json($dataSurat);

            // Lanjutkan dengan proses tanda tangan atau logika lainnya
            return view('document_sign', ['data' => $dataSurat]);
        } catch (DecryptException $e) {
            // Jika dekripsi gagal
            abort(404);  // Mengembalikan halaman 404 jika dekripsi gagal
        }
    }
}
