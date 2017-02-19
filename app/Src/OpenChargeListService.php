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

    public function getList($lat, $lng, $filters)
    {
        $results = $this->listProvider
            ->latitude($lat)
            ->longitude($lng)
            ->filters([
                'maxresults' => (null != $filters['maxresults'] ? $filters['maxresults'] : 10),
                'distance' => (null != $filters['distance'] ? $filters['distance'] : 5)
            ])
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
