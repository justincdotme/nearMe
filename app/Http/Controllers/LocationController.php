<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jcf\Geocode\Geocode;
class LocationController extends Controller
{
    /**
     * Look up location by address.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function address(Request $request)
    {
        if (!$response = Geocode::make()->address($request->input('address'))) {
            $response = [
                'status' => 'error'
            ];
        } else {
            $response = [
                'status' => 'success',
                'coords' => [
                    'lat' => $response->latitude(),
                    'lng' => $response->longitude()
                ]
            ];
        }
        return response()->json($response);
    }

    /**
     * Look up location by coordinates.
     *
     * @param $lat
     * @param $lng
     * @return \Illuminate\Http\JsonResponse
     */
    public function coords($lat, $lng)
    {
        if (!$response = Geocode::make()->latLng($lat, $lng)) {
            $response = [
                'status' => 'error'
            ];
        } else {
            $response = [
                'status' => 'success',
                'address' => $response->formattedAddress()
            ];
        }
        return response()->json($response);
    }
}
