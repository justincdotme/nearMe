<?php

namespace App\Src;

interface ChargeStationListInterface {
    public function getList($lat, $lng, $filters);
}