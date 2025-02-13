<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UrlShortenerController extends Controller
{
    protected $baseUrl = 'http://short.est/';

    public function encode(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $originalUrl = $request->input('url');
        $shortCode = substr(md5($originalUrl), 0, 6);


        Cache::put("short_url:{$shortCode}", $originalUrl, now()->addDays(30));

        return response()->json([
            'short_url' => $this->baseUrl . $shortCode
        ]);
    }

    public function decode(Request $request)
    {
        $request->validate([
            'short_url' => 'required|url'
        ]);

        $shortUrl = $request->input('short_url');
        $shortCode = str_replace($this->baseUrl, '', $shortUrl);
        
        $originalUrl = Cache::get("short_url:{$shortCode}");

        if (!$originalUrl) {
            return response()->json(['error' => 'Short URL not found'], 404);
        }

        return response()->json([
            'original_url' => $originalUrl
        ]);
    }
}
