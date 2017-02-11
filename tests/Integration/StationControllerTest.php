<?php

class StationControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_correct_coordinates_for_address()
    {
        $this->post('/address', [
            'address' => '1 Letterman Dr, San Francisco, CA 94129, USA'
        ])->seeJson([
            'status' => 'success',
            'coords' => [
                'lat' => 37.7994535,
                'lng' => -122.4493776
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_returns_correct_address_for_coordinates()
    {
        $this->post('/coords/', [
            'lat' => 37.7994535,
            'lng' => -122.4493776
        ])->seeJson([
            'status' => 'success',
            'address' => '1 Letterman Dr, San Francisco, CA 94129, USA'
        ]);
    }
}
