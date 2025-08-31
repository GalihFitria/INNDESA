<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;

class GoogleDriveService
{
    protected Drive $service;

    public function __construct()
    {
        $client = new Client();

        // OAuth Client dari .env
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->addScope(Drive::DRIVE_FILE);
        $client->setAccessType('offline'); // Supaya bisa pakai refresh token

        // Set refresh token dengan format yang benar
        $client->setAccessToken([
            'access_token' => '',  // kosong, akan di-refresh otomatis
            'refresh_token' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'expires_in' => 3600,
            'created' => time(),
        ]);

        // Pakai refresh token untuk dapat access token baru
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

        // Timeout lebih panjang untuk aman di hosting/Windows
        $client->setHttpClient(new \GuzzleHttp\Client([
            'timeout' => 60,
            'connect_timeout' => 30,
        ]));

        $this->service = new Drive($client);
    }

    /**
     * Upload file ke Google Drive
     *
     * @param string $filePath Path file lokal
     * @param string $fileName Nama file di Drive
     * @param string|null $folderId Folder ID di Drive
     * @return string File ID di Drive
     * @throws \Exception
     */
    public function uploadFile(string $filePath, string $fileName, ?string $folderId = null): string
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File tidak ditemukan: $filePath");
        }

        $fileMetadata = new DriveFile([
            'name' => $fileName,
            'parents' => $folderId ? [$folderId] : [],
        ]);

        $content = file_get_contents($filePath);

        $file = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($filePath) ?: 'application/octet-stream',
            'uploadType' => 'multipart',
        ]);

        // Set file bisa diakses publik
        $this->service->permissions->create($file->id, new Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]));

        return $file->id;
    }

    /**
     * Mendapatkan URL file publik
     */
    public function getFileUrl(string $fileId): string
    {
        return "https://drive.google.com/file/d/$fileId/view";
    }
}
