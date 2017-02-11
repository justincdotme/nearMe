<?php

class LocationServiceTest extends TestCase
{
    protected $geocoder;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->geocoder = $this->getMockBuilder(\Jcf\Geocode\Geocode::class)
            ->setMethods([
                'address',
                'latLng'
            ])->getMock();
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function it_returns_collection_for_address_method()
    {
        $googleLocationService = new \App\Src\GoogleLocationService($this->geocoder);
        $results = $googleLocationService->byAddress('123 Foobar St Bazville, BA');
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $results);
    }

    /**
     * @test
     */
    public function it_returns_collection_for_coordinates_method()
    {
        $googleLocationService = new \App\Src\GoogleLocationService($this->geocoder);
        $results = $googleLocationService->byCoordinates(100000.1, 20000.2);
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $results);
    }

    /**
     * @test
     */
    public function it_calls_address_on_geocoder()
    {
        $this->geocoder
            ->expects($this->once())
            ->method('address');
        $googleLocationService = new \App\Src\GoogleLocationService($this->geocoder);
        $googleLocationService->byAddress('123 Foobar St Bazville, BA');
    }

    /**
     * @test
     */
    public function it_calls_latLng_on_geocoder()
    {
        $this->geocoder
            ->expects($this->once())
            ->method('latLng');
        $googleLocationService = new \App\Src\GoogleLocationService($this->geocoder);
        $googleLocationService->byCoordinates(100000.1, 20000.2);
    }
}
