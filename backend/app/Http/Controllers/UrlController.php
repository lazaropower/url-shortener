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
            'originalUrl' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Retrieve the original url
        $originalUrl = $request->input('originalUrl');

        
        // Check if the url exists already in the database so we do not generate the hash and save it
        $url = Url::where('original_url', $originalUrl)->first();

        if ($url) {
            return response()->json(['hash' => $url->hash], 200);
        }

        // Generate hash
        $hash = $this->generateHash($originalUrl);

        // Save it in the database if does not exist yet
        Url::create([
            'original_url' => $originalUrl,
            'hash'=> $hash
        ]);

        return response()->json(['hash' => $hash], 200);
    }

    private function generateHash(string $url): string
    {
        $hashedUrl = md5($url);
        $result = substr($hashedUrl, 0, 6);

        return $result;
    }
}
