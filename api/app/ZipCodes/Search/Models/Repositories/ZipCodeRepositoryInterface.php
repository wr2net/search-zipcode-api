<?php

namespace App\ZipCodes\Search\Models\Repositories;

use App\ZipCodes\Search\Models\ZipCode;

/**
 * Interface ZipCodeRepositoryInterface
 * @package App\ZipCodes\Models\Repositories
 */
interface ZipCodeRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findById(int $id);

    /**
     * @inheritDoc
     */
    public function findByZipCode(string $data);

    /**
     * @inheritDoc
     */
    public function findByAddress(string $data);

    /**
     * @inheritDoc
     */
    public function findAll();

    /**
     * @inheritDoc
     */
    public function store(array $data);

    /**
     * @inheritDoc
     */
    public function update(ZipCode $zipCode, array $data);

    /**
     * @inheritDoc
     */
    public function enable(ZipCode $zipCode);

    /**
     * @inheritDoc
     */
    public function disable(ZipCode $zipCode);

    /**
     * @inheritDoc
     */
    public function destroy(ZipCode $zipCode);
}
