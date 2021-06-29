<?php

namespace App\ZipCodes\Search\Services;

use App\ZipCodes\Common\Helpers\Gateway;
use App\ZipCodes\Search\Models\ZipCode;
use App\ZipCodes\Search\Models\Repositories\ZipCodeRepositoryInterface as ZipCodeRepository;

/**
 * Class ZipCodeService
 * @package App\ZipCodes\Services
 */
class ZipCodeService
{
    /**
     * @var ZipCodeRepository
     */
    private $zipCodeRepository;

    /**
     * @var Gateway
     */
    private $gateway;

    /**
     * @param ZipCodeRepository $zipCodeRepository
     */
    public function __construct(
        ZipCodeRepository $zipCodeRepository,
        Gateway $gateway
    ) {
        $this->zipCodeRepository = $zipCodeRepository;
        $this->gateway = $gateway;
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->zipCodeRepository->findAll();
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function findByZipCode(string $data)
    {
        $response = $this->zipCodeRepository->findByZipCode($data);
        if (!isset($response->zip_code)) {
            $response = $this->handleZip(['zip_code' => $data]);
            return $this->store($response);
        }
        return $response;
    }

    /**
     * @param string $data
     * @return ZipCode
     */
    public function findByAddress(string $data)
    {
        return $this->zipCodeRepository->findByAddress($data);
    }

    /**
     * @param array $data
     * @return ZipCode
     */
    public function store(array $data): ZipCode
    {
        $data = $this->handleZip($data);
        return $this->zipCodeRepository->store($data);
    }

    /**
     * @param ZipCode $zipCode
     * @param array $data
     * @return ZipCode
     */
    public function update(ZipCode $zipCode, array $data): ZipCode
    {
        return $this->zipCodeRepository->update($zipCode, $data);
    }

    /**
     * @param ZipCode $zipCode
     * @return ZipCode
     */
    public function enable(ZipCode $zipCode): ZipCode
    {
        return $this->zipCodeRepository->enable($zipCode);
    }

    /**
     * @param ZipCode $zipCode
     * @return ZipCode
     */
    public function disable(ZipCode $zipCode): ZipCode
    {
        return $this->zipCodeRepository->disable($zipCode);
    }

    /**
     * @param ZipCode $zipCode
     * @return mixed
     */
    public function destroy(ZipCode $zipCode)
    {
        return $this->zipCodeRepository->destroy($zipCode);
    }

    public function handleZip(array $data)
    {
        /**
         * Process Zip Code in external API
         */
        if (isset($data['zip_code'])) {
            $location = $this->gateway->resolveLocation($data);
            if ($location) {
                $data['location_raw'] = $location['raw'];
                $data['address'] = $location['logradouro'] ?? null;
                $data['neighborhood'] = $location['bairro'] ?? null;
                $data['city'] = $location['cidade'];
                $data['state'] = $location['uf'];
            }
        }

        return $data;
    }
}
