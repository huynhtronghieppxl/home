<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Exception;

class UploadController extends Controller
{
    public function uploadMedia(Request $request)
    {
        $file = $request->file('file');
        $client = new Client(['headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('TOKEN_API_UPLOAD'),
            'Content-Type' => 'application/json',
            'ProjectId' => 9007,
            'Method' => 1,
        ],]);
        $fileConvert = $this->convertFileUpload($file);
        $response = $client->request('POST', env('DOMAIN_UPLOAD') . '/api/v2/media/generate',
            [
                'http_errors' => false,
                'verify' => false,
                'json' => [
                    'medias' => [
                        ['name' => $fileConvert[0], 'type' => 0, 'size' => 100, 'is_keep' => 1],
                    ]
                ]
            ]);
        $response_avatar = json_decode($response->getBody(), true);
        $client->request('POST', env('DOMAIN_UPLOAD') . '/api/v2/media/upload', [
            'http_errors' => false,
            'verify' => false,
            'multipart' => [
                [
                    'name' => 'medias[0][file]',
                    'contents' => fopen($fileConvert[1], "r+"),
                ],
                [
                    'name' => 'medias[0][type]',
                    'contents' => 0,
                ],
                [
                    'name' => 'medias[0][media_id]',
                    'contents' => $response_avatar['data'][0]['media_id'],
                ]
            ]
        ]);
        unlink($fileConvert[1]);
        $short = $response_avatar['data'][0]['original']['url'];
        return [$short, env('DOMAIN_IMAGE')];
    }

    public function convertFileUpload($file)
    {
        $name = strtolower($file->getClientOriginalName());
        $name = 'web-' . time() . '-' . $name;
        $path = $file->move(public_path('images/upload/'), $name);
        return [$name, $path];
    }
}
