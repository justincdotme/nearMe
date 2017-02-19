<?php

namespace App\Http\Controllers;

use App\Src\ChargeStationListInterface;
use App\Src\LocationServiceInterface;
use Illuminate\Http\Request;
use Exception;

class StationController extends Controller
{
    protected $locationService;
    protected $stationListService;
    protected $request;

    public function __construct(
        LocationServiceInterface $locationService,
        ChargeStationListInterface $stationListService,
        Request $request
    )
    {
        $this->locationService = $locationService;
        $this->stationListService = $stationListService;
        $this->request = $request;

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
                $this->request, [
                    'address' => 'required'
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->validator->getMessageBag()
            ]);
        }

        $coords = $this->locationService->byAddress($this->request->address);
        if (!$coords->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'list' => $this->stationListService->getList(
                    $coords->get('lat'),
                    $coords->get('lng'),
                    [
                        'maxresults' => $this->request->input('limit'),
                        'distance' => $this->request->input('distance'),
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
                $this->request, [
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
            ]);
        }

        $lat = $this->request->input('lat');
        $lng = $this->request->input('lng');

        return response()->json([
            'status' => 'success',
            'list' => $this->stationListService->getList(
                $lat,
                $lng,
                [
                    'maxresults' => $this->request->input('limit'),
                    'distance' => $this->request->input('distance'),
                ]

            ),
            'address' => $this->locationService->byCoordinates($lat, $lng)->get('address')
        ]);
    }
}
