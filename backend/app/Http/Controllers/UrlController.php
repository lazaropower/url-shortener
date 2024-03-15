<?php

namespace App\Http\Controllers;

use App\Http\Requests\fetchOriginalUrlRequest;
use App\Http\Requests\ShortenUrlRequest;
use App\Http\Services\SafeBrowserService;
use App\Http\Services\UrlService;
use App\Models\Url;
use Illuminate\Http\JsonResponse;

class UrlController extends Controller
{
    public function shortenUrl(
        ShortenUrlRequest $request,
        UrlService $urlService,
        SafeBrowserService $safeBrowserService): JsonResponse
    {
        $originalUrl = $request->input('originalUrl');
        $folder = $request->input('folder');

        if (!$safeBrowserService->checkUrlSecurity($originalUrl)) {
            return response()->json(['error' => 'The URL is not secure'], 422);
        }

        $url = $urlService->shortenUrl($originalUrl, $folder);

        if (!$url instanceof Url) {
            return response()->json(['error' => 'Failed to shorten URL'], 422);
        }
        return response()->json(['hash' => $url->hash, 'folder' => $url->folder], 200);
    }

    public function fetchOriginalUrl(fetchOriginalUrlRequest $request, UrlService $service): JsonResponse
    {
        $folder = $request->input('folder');
        $hash = $request->input('hash');

        $url = $service->fetchOriginalUrl($folder, $hash);

        if (!$url instanceof Url) {
            return response()->json(['error' => 'Url not found'], 404);
        }
        return response()->json(['originalUrl' => $url->original_url], 200);
    }
}
