<?php

namespace App\Http\Controllers;

use App\Http\Requests\SunriseSunsetRequest;
use App\Models\City;
use App\Services\ApiService;
use GuzzleHttp\Exception\GuzzleException;

class SunriseSunsetController extends Controller
{
    const DEFAULT_DATE = 'today';

    /**
     * @var ApiService
     */
    protected $apiService;

    /**
     * SunriseSunsetController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     * @param SunriseSunsetRequest $request
     * @return array
     * @throws GuzzleException
     */
    public function index(SunriseSunsetRequest $request)
    {
        $latitude = $request->get('latitude', 0);
        $longitude = $request->get('longitude', 0);

        if ($request->get('name')) {
            $city = City::where('name', $request->get('name'))->first();
            if (!$city) {
                return response()->json('Non-existing city', 400);
            }
            $latitude = $city->latitude;
            $longitude = $city->longitude;
        }

        if (!$latitude || !$longitude) {
            return response()->json('Invalid ', 400);
        }

        $date = $request->get('date') ? self::DEFAULT_DATE : '';

        return $this->apiService->sendApi($latitude, $longitude, $date);
    }
}
