<?php

namespace App\Src;


use Justincdotme\OpenCharge\Interfaces\OpenChargeInterface;

class OpenChargeListService implements ChargeStationListInterface
{
    protected $listProvider;

    public function __construct(OpenChargeInterface $listProvider)
    {
        $this->listProvider = $listProvider;
    }

    /**
     * Get a list of charging locations.
     * Filter out unused data.
     *
     * @param $lat float - lattitude
     * @param $lng float - longitude
     * @param $filters array - URL Filters
     *
     * @return array
     */
    public function getList($lat, $lng, $filters = null)
    {
        //The array to return
        $filteredResults = [];

        //Get a list of stations and iterate over them
        $this->listProvider
            ->latitude($lat)
            ->longitude($lng)
            ->filters([
                'maxresults' => env('OPEN_CHARGE_API_MAX_RESULTS'),
                'distance' => env('OPEN_CHARGE_API_SEARCH_RADIUS')
            ])
            ->get()
            ->each(function ($item, $key) use (&$filteredResults) {

                $operatorInfo = $item->OperatorInfo;
                $addressInfo = $item->AddressInfo;
                $connections = $item->Connections;

                //1 location can (and usually do) have more than 1 charger
                $levels = [];
                $amperages = [];
                $voltages = [];
                $kilowatts = [];
                $fastChargeCapable = false;
                foreach ($connections as $connection) {
                    if (null != $connection->Level) {
                        if (!in_array($connection->Level->Title, $levels)) {
                            $levels[] = [
                                'id' => $connection->Level->ID,
                                'title' => $connection->Level->Title
                            ];
                        }

                        if ($connection->Level->IsFastChargeCapable) {
                            $fastChargeCapable = true;
                        }
                    }

                    //Create a range of available amperage
                    if (!in_array($connection->Amps, $amperages) && null != $connection->Amps) {
                        $amperages[] = $connection->Amps;
                    }
                    //Create a range of available voltage
                    if (!in_array($connection->Voltage, $voltages) && null != $connection->Voltage) {
                        $voltages[] = $connection->Voltage;
                    }
                    //Create a range of available kilowatts
                    if (!in_array($connection->PowerKW, $kilowatts) && null != $connection->PowerKW) {
                        $kilowatts[] = $connection->PowerKW;
                    }
                }


                $filteredResults[$key] = [
                    'operator' => [
                        'name' => (isset($operatorInfo->Title) ? $operatorInfo->Title : '-'),
                        'website' => (isset($operatorInfo->WebsiteURL) ? $operatorInfo->WebsiteURL: '-'),
                        'phone' => (isset($operatorInfo->PhonePrimaryContact) ? $operatorInfo->PhonePrimaryContact : '-'),
                        'email' => (isset($operatorInfo->ContactEmail) ? $operatorInfo->ContactEmail : '-')
                    ],
                    'location' => [
                        'street_address' => [
                            'line_1' => (isset($addressInfo->AddressLine1) ? $addressInfo->AddressLine1 : '-'),
                            'line_2' => (isset($addressInfo->AddressLine2) ? $addressInfo->AddressLine2 : '-'),
                            'city' => (isset($addressInfo->Town) ? $addressInfo->Town : '-'),
                            'state' => (isset($addressInfo->StateOrProvince) ? $addressInfo->StateOrProvince : '-'),
                            'zip' => (isset($addressInfo->Postcode) ? $addressInfo->Postcode : '-')
                        ],
                        'name' => (isset($addressInfo->Title) ? $addressInfo->Title : $addressInfo->AddressLine1),
                        'usage' => (null != $item->UsageType) ? $item->UsageType->Title : 'Unknown',
                        'distance' => (isset($addressInfo->Distance) ? round($addressInfo->Distance, 1) : '-'),
                        'lat' => (isset($addressInfo->Latitude) ? $addressInfo->Latitude : '-'),
                        'lng' => (isset($addressInfo->Longitude) ? $addressInfo->Longitude : '-'),
                        'connections' => [
                            'levels' => $levels,
                            'amperages' => $amperages,
                            'voltages' => $voltages,
                            'kilowatts' => $kilowatts,
                            'fast_charge_capable' => $fastChargeCapable,
                            'count' => count($connections)
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
