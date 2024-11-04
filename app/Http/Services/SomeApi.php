<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class SomeApi
{

    /**
     * Execution a request to the api with sending data
     * @param array $data
     * @return array
     */
    public static function mockRequestCheck(array $data): array
    {

        $responses = [
            ['message' => 'order successfully booked'],
            ['error' => 'barcode already exists']
        ];

        return self::randomResponse($responses);
    }

    /**
     * Execution of request to api and order confirmation
     *
     * @param string $barcode
     * @return array
     */
    public static function mockRequestApprove(string $barcode): array
    {
        $responses = [
            ['message' => 'order successfully aproved'],
            ['error' => 'event cancelled'],
            ['error' => 'no tickets'],
            ['error' => 'no seats'],
            ['error' => 'fan removed']
        ];

        return self::randomResponse($responses);
    }



    private static function randomResponse(array $responses): array
    {
        return $responses[array_rand($responses)];
    }
}
