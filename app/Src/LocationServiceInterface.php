<?php

namespace App\Src;

interface LocationServiceInterface {

    public function byAddress($address);

    public function byCoordinates($lat, $lng);
}