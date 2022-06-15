<?php
namespace Equipal\CompaniesHouse\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CompaniesHouse
{
    protected $client;

    /**
     * Constructor
     *
     * Get config and and create new api
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('companieshouse.endpoint'),
            'auth'     => [config('companieshouse.key'), '']
        ]);
    }

    /**
     * Overload methods
     *
     * @param  string $name Method
     * @param  array  $arguments
     * @return object
     */
    public function __call($name, array $arguments)
    {
        try {
            $response = call_user_func_array([$this->client, $name], $arguments);
        }
        catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return json_decode(
            $response->getBody()->getContents()
        );
    }

    public static function __callStatic($name, array $arguments)
    {
        $i = new CompaniesHouse();
        return $i->$name(...$arguments);
    }
}
