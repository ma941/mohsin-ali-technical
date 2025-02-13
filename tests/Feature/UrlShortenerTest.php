<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    public function test_encode_valid_url()
    {
        $response = $this->postJson('/api/encode', ['url' => 'https://www.thisisalongdomain.com/']);

        $response->assertStatus(200)
                 ->assertJsonStructure(['short_url']);
    }

    public function test_encode_invalid_url()
    {
        $response = $this->postJson('/api/encode', ['url' => 'invalid-url']);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('url');
    }

    public function test_decode_valid_short_url()
    {
        $originalUrl = 'https://www.thisisalongdomain.com/';
        $shortCode = substr(md5($originalUrl), 0, 6);
        $shortUrl = "http://short.est/{$shortCode}";

        Cache::put("short_url:{$shortCode}", $originalUrl, now()->addDays(30));

        $response = $this->postJson('/api/decode', ['short_url' => $shortUrl]);

        $response->assertStatus(200)
                 ->assertJson(['original_url' => $originalUrl]);
    }

    public function test_decode_invalid_short_url()
    {
        $response = $this->postJson('/api/decode', ['short_url' => 'http://short.est/abcdef']);

        $response->assertStatus(404)
                 ->assertJson(['error' => 'Short URL not found']);
    }
}
