<?php

namespace App\Http\Controllers;

use App\Src\LocationServiceInterface;
use Illuminate\Http\Request;
use Justincdotme\OpenCharge\Facades\OpenCharge;
use Exception;

class StationController extends Controller
{
    protected $locationService;
    protected $request;
    protected $filters;

    public function __construct(LocationServiceInterface $locationService, Request $request)
    {
        $this->locationService = $locationService;
        $this->request = $request;

        $this->filters = [
            //TODO - Set a hard high limit (likely 25, default to something digestable like 10 (multiples of 2)
            'maxresults' => $this->request->input('limit'),
            'distance' => $this->request->input('distance')
        ];
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
                'list' => $this->getList(
                    $coords->get('lat'),
                    $coords->get('lng')
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
            'list' => $this->getList($lat, $lng),
            'address' => $this->locationService->byCoordinates($lat, $lng)->get('address')
        ]);
    }

    /**
     * Remove unnecessary data from station list.
     *
     * @param $lat string latitude
     * @param $lng string longitude
     * @return array
     */
    protected function getList($lat, $lng)
    {
        $results = OpenCharge::latitude($lat)
            ->longitude($lng)
            ->filters($this->filters)
            ->get();

        $filteredResults = [];

        $results->each(function ($item, $key) use (&$filteredResults) {
            $operatorInfo = $item->OperatorInfo;
            $addressInfo = $item->AddressInfo;
            $connection = $item->Connections[0];

            $filteredResults[$key] = [
                'operator' => [
                    'name' => (isset($operatorInfo->Title) ? $operatorInfo->Title : null),
                    'website' => (isset($operatorInfo->WebsiteURL) ? $operatorInfo->WebsiteURL : null),
                    'phone' => (isset($operatorInfo->PhonePrimaryContact) ? $operatorInfo->PhonePrimaryContact : null),
                    'email' => (isset($operatorInfo->ContactEmail) ? $operatorInfo->ContactEmail : null)
                ],
                'location' => [
                    'street_address' => [
                        'line_1' => (isset($addressInfo->AddressLine1) ? $addressInfo->AddressLine1 : null),
                        'line_2' => (isset($addressInfo->AddressLine2) ? $addressInfo->AddressLine2 : null),
                        'city' => (isset($addressInfo->Town) ? $addressInfo->Town : null),
                        'state' => (isset($addressInfo->StateOrProvince) ? $addressInfo->StateOrProvince : null)
                    ],
                    'name' => (isset($addressInfo->Title) ? $addressInfo->Title : $addressInfo->AddressLine1),
                    'distance' => (isset($addressInfo->Distance) ? $addressInfo->Distance : null),
                    'lat' => (isset($addressInfo->Latitude) ? $addressInfo->Latitude : null),
                    'lng' => (isset($addressInfo->Longitude) ? $addressInfo->Longitude : null),
                    'connection' => [
                        'level' => (isset($connection->Level->Title) ? $connection->Level->Title : null),
                        'amperage' => (isset($connection->Amps) ? $connection->Amps : null),
                        'voltage' => (isset($connection->Voltage) ? $connection->Voltage : null),
                        'kilowatts' => (isset($connection->PowerKW) ? $connection->PowerKW : null),
                        'fast_charge_capable' => (
                        isset($connection->Level->isFastChargeCapable) ?
                            $connection->Level->isFastChargeCapable :
                            null
                        )
                    ]
                ]
            ];


            $address = $filteredResults[$key]['location']['street_address'];

            $googleAddressString = urlencode(
                $address['line_1'] . $address['city'] . $address['state']
            );
            $filteredResults[$key]['google_map_link'] = "http://maps.google.com/?daddr={$googleAddressString}";

            $appleAddressString = urlencode(
                $address['line_1'] . ',' . $address['city'] . $address['state']
            );
            $filteredResults[$key]['apple_map_link'] = "http://maps.apple.com/?daddr={$appleAddressString}";

        });

        return $filteredResults;
    }
}
