<?php

namespace App\Http\Services;

use App\Models\Url;

class UrlService
{
    public function shortenUrl(string $originalUrl, string $folder): Url
    {
        // Check if the url exists already in the database so we do not generate the hash and save it
        $url = Url::where('original_url', $originalUrl)
        ->where('folder', $folder)
        ->first();

        if ($url) {
            return $url;
        }

        // Generate hash
        $hash = $this->generateHash($originalUrl);

        // Save it in the database if does not exist yet
        $newUrl = Url::create([
            'original_url' => $originalUrl,
            'folder' => $folder,
            'hash'=> $hash
        ]);

        return $newUrl;
    }

    public function fetchOriginalUrl(string $folder, string $hash): Url|null
    {
        $url = Url::where('folder', $folder)
        ->where('hash', $hash)
        ->first();

        if ($url) {
            return $url;
        }

        return null;
    }
    
    private function generateHash(string $url): string
    {
        $hashedUrl = md5($url);
        $result = substr($hashedUrl, 0, 6);

        return $result;
    }
}