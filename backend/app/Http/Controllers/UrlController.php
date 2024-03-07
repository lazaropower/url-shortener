<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UrlController extends Controller
{
    public function shortenUrl(Request $request): JsonResponse
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'originalUrl' => 'required|url|max:255',
            'folder' => 'required|string|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Retrieve the original url
        $originalUrl = $request->input('originalUrl');
        $folder = $request->input('folder');
        
        // Check if the url exists already in the database so we do not generate the hash and save it
        $url = Url::where('original_url', $originalUrl)
            ->where('folder', $folder)
            ->first();

        if ($url) {
            return response()->json(['hash' => $url->hash], 200);
        }

        // Generate hash
        $hash = $this->generateHash($originalUrl);

        // Save it in the database if does not exist yet
        Url::create([
            'original_url' => $originalUrl,
            'folder' => $folder,
            'hash'=> $hash
        ]);

        return response()->json(['hash' => $hash], 200);
    }

    public function fetchOriginalUrl(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'hash' => 'required|max:6|string',
            'folder' => 'required|string|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $folder = $request->input('folder');
        $hash = $request->input('hash');

        $url = Url::where('folder', $folder)
            ->where('hash', $hash)
            ->first();
        
        if ($url) {
            return response()->json(['originalUrl' => $url->original_url], 200);
        }
        return response()->json(['error' => 'Url not found'], 404);
    }

    private function generateHash(string $url): string
    {
        $hashedUrl = md5($url);
        $result = substr($hashedUrl, 0, 6);

        return $result;
    }
}
