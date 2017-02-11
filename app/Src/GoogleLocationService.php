<?php

namespace App\Src;

use Jcf\Geocode\Geocode;

class GoogleLocationService implements LocationServiceInterface
{
    protected $geocoder;

    public function __construct(Geocode $geocoder)
    {
        $this->geocoder = $geocoder;
    }

    /**
     * Look up location by address.
     *
     * @param $address
     * @return \Illuminate\Support\Collection
     */
    public function byAddress($address)
    {
        if (!$addressResult = $this->geocoder->address($address)) {
            return collect([]);
        }

        return  collect([
            'lat' => $addressResult->latitude(),
            'lng' => $addressResult->longitude()
        ]);
    }

    /**
     * Look up location by coordinates.
     *
     * @param $lat
     * @param $lng
     * @return \Illuminate\Support\Collection
     */
    public function byCoordinates($lat, $lng)
    {
        if (!$coordResult = $this->geocoder->latLng($lat, $lng)) {
            return collect([]);
        }

        return collect([
            'address' => $coordResult->formattedAddress()
        ]);
    }
}
