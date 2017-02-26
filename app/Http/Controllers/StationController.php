<?php

namespace App\Http\Controllers;

use App\Src\ChargeStationListInterface;
use App\Src\LocationServiceInterface;
use Exception;

class StationController extends Controller
{
    protected $locationService;
    protected $stationListService;
    protected $request;

    public function __construct(
        LocationServiceInterface $locationService,
        ChargeStationListInterface $stationListService
    )
    {
        $this->locationService = $locationService;
        $this->stationListService = $stationListService;

    }

    /**
     * Find nearby stations by address.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchByAddress()
    {
        try {
            $this->validate(
                request(), [
                    'address' => 'required'
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->validator->getMessageBag()
            ], 422);
        }

        $coords = $this->locationService->byAddress(
            request('address')
        );

        if (!$coords->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'list' => $this->stationListService->getList(
                    $coords->get('lat'),
                    $coords->get('lng'),
                    [
                        'maxresults' => request('limit'),
                        'distance' => request('distance'),
                    ]
                ),
                'coords' => $coords
            ]);
        }

        return response()->json([
            'status' => 'error',
            'errors' => [
                'address' => [
                    'Could not find a location matching that address. Please try again with a different address.'
                ]
            ]
        ]);
    }

    /**
     * Find nearby stations by coordinates.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchByCoords()
    {
        try {
            $this->validate(
                request(), [
                    'lat' => 'required',
                    'lng' => 'required'
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'address' => [
                        'Could not get location from browser. Please enter an address and try again.'
                    ]
                ]
            ], 422);
        }

        $lat = request('lat');
        $lng = request('lng');

        return response()->json([
            'status' => 'success',
            'list' => $this->stationListService->getList(
                $lat,
                $lng,
                [
                    'maxresults' => request('limit'),
                    'distance' => request('distance'),
                ]

            ),
            'address' => $this->locationService->byCoordinates($lat, $lng)->get('address')
        ]);
    }
}
