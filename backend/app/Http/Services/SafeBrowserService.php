<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class SafeBrowserService
{
    public function checkUrlSecurity(string $url): bool
    {
        $safeBrowserUrl = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . env('GOOGLE_API_KEY');

        $response = Http::post($safeBrowserUrl, [
            'client' => [
                'clientId' => 'urlshortener',
                'clientVersion' => '1.5.2'
            ],
            'threatInfo' => [
                'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                'platformTypes' => ['WINDOWS'],
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [
                    'url' => $url
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return empty($data) ? true : false;
        }

        return false;
    }
}