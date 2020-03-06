<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiService
{
    const API_URL = 'https://api.sunrise-sunset.org/json';

    /**
     * @var Client
     */
    protected $client;

    /**
     * ApiService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param string $date
     * @return array
     * @throws GuzzleException
     */
    public function sendApi(float $latitude, float $longitude, string $date)
    {
        $response = $this->client->request('GET', self::API_URL, [
            'query' => [
                'lat' => $latitude,
                'lng' => $longitude,
                'date' => $date,
                'formatted' => 0
            ]
        ]);

        $responseData = json_decode($response->getBody(), true);

        return $responseData['results'];
    }
}