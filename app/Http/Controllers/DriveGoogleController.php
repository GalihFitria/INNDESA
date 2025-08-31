<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Storage;

class DriveGoogleController extends Controller
{
    protected $client;

    public function __construct()
    {
        // Inisialisasi Google Client
        $this->client = new Client();
        $this->client->setApplicationName('LaravelApp');
        $this->client->setScopes(Drive::DRIVE_FILE);
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setAccessType('offline');

        // Gunakan refresh token dari .env
        $refreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');
        if ($refreshToken) {
            $this->client->setAccessToken(['refresh_token' => $refreshToken]);
        }

        // Refresh token jika kadaluarsa
        if ($this->client->isAccessTokenExpired()) {
            try {
                $newAccessToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                // Simpan token baru (opsional, untuk debugging)
                Storage::put('google_token.json', json_encode($newAccessToken));
            } catch (\Exception $e) {
                throw new \Exception('Gagal menginisialisasi Google Client: ' . $e->getMessage());
            }
        }
    }

    /**
     * Ekstrak ID folder dari link Google Drive
     */
    private function getFolderIdFromLink($link)
    {
        // Ekstrak ID dari link (misalnya: https://drive.google.com/drive/folders/{ID}?usp=sharing)
        preg_match('/folders\/([a-zA-Z0-9_-]+)/', $link, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Upload file ke Google Drive
     */
    public function upload(Request $request)
    {
        try {
            // Validasi file
            $request->validate([
                'file' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:2048', // Maks 2MB
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $filePath = $file->getPathname();

            // Inisialisasi Google Drive Service
            $driveService = new Drive($this->client);

            // Dapatkan ID folder dari link
            $folderId = $this->getFolderIdFromLink(env('GOOGLE_DRIVE_FOLDER_ID'));
            if (!$folderId) {
                return response()->json(['error' => 'ID folder tidak valid'], 400);
            }

            // Metadata file
            $fileMetadata = new \Google\Service\Drive\DriveFile([
                'name' => $fileName,
                'parents' => [$folderId],
            ]);

            // Upload file
            $content = file_get_contents($filePath);
            $uploadedFile = $driveService->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $file->getMimeType(),
                'uploadType' => 'multipart',
                'fields' => 'id, name, webViewLink',
            ]);

            // Berikan izin akses publik agar file bisa dilihat admin
            $permission = new \Google\Service\Drive\Permission([
                'type' => 'anyone',
                'role' => 'reader',
            ]);
            $driveService->permissions->create($uploadedFile->id, $permission);

            // Kembalikan data file untuk disimpan di database oleh controller lain
            return response()->json([
                'file_name' => $uploadedFile->name,
                'file_url' => $uploadedFile->webViewLink,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengunggah file: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Mendapatkan link file dari Google Drive berdasarkan nama file
     */
    public function show(string $fileName)
    {
        try {
            $driveService = new Drive($this->client);
            // Dapatkan ID folder dari link
            $folderId = $this->getFolderIdFromLink(env('GOOGLE_DRIVE_FOLDER_ID'));
            if (!$folderId) {
                return response()->json(['error' => 'ID folder tidak valid'], 400);
            }

            // Cari file berdasarkan nama di folder tertentu
            $query = "name = '$fileName' and '$folderId' in parents";
            $results = $driveService->files->listFiles([
                'q' => $query,
                'fields' => 'files(id, name, webViewLink)',
            ]);

            if (count($results->getFiles()) == 0) {
                return response()->json(['error' => 'File tidak ditemukan'], 404);
            }

            $file = $results->getFiles()[0];
            return response()->json(['file_url' => $file->webViewLink], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mendapatkan file: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Menghapus file dari Google Drive berdasarkan nama file
     */
    public function destroy(string $fileName)
    {
        try {
            $driveService = new Drive($this->client);
            // Dapatkan ID folder dari link
            $folderId = $this->getFolderIdFromLink(env('GOOGLE_DRIVE_FOLDER_ID'));
            if (!$folderId) {
                return response()->json(['error' => 'ID folder tidak valid'], 400);
            }

            // Cari file berdasarkan nama di folder tertentu
            $query = "name = '$fileName' and '$folderId' in parents";
            $results = $driveService->files->listFiles([
                'q' => $query,
                'fields' => 'files(id)',
            ]);

            if (count($results->getFiles()) == 0) {
                return response()->json(['error' => 'File tidak ditemukan'], 404);
            }

            $fileId = $results->getFiles()[0]->id;
            $driveService->files->delete($fileId);

            return response()->json(['message' => 'File berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus file: ' . $e->getMessage()], 500);
        }
    }
}
