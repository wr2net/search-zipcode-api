<?php

namespace App\ZipCodes\Common\Helpers;

use Gateway\Gateways\Location\VIACEPGatewayImpl as Location;
use Illuminate\Support\Facades\Log;

/**
 * Class Gateway
 * @package App\ZipCodes\Common\Helpers
 */
class Gateway
{
    /**
     * @var Location
     */
    private $location;

    /**
     * Gateway constructor.
     */
    public function __construct()
    {
        $this->location = new Location();
    }

    /**
     * @param  array  $data
     * @return array
     */
    public function resolveLocation(array $data)
    {
        $location = $this->findLocation($data['zip_code']);

        if ($location->error) {
            Log::warning("Failed to fetch Zip Code: {$data['zip_code']}");
            return null;
        }

        return [
            "raw" => json_encode($location),
            "logradouro" => empty($location->logradouro) ? null : $location->logradouro,
            "complemento" => empty($location->complemento) ? null : $location->complemento,
            "bairro" => empty($location->bairro) ? null : $location->bairro,
            "cidade" => empty($location->localidade) ? null : $location->localidade,
            "uf" => empty($location->uf) ? null : $location->uf,
        ];
    }

    /**
     * @param  string  $zipCode
     * @return mixed
     */
    public function findLocation(string $zipCode)
    {
        $data = $this->location->fetchLocation($zipCode);
        return json_decode($data);
    }
}
