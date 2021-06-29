<?php

namespace App\ZipCodes\Search\Models\Repositories;

use App\ZipCodes\Search\Models\ZipCode;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class ZipCodeRepository
 * @package App\ZipCodes\Models\Repositories
 */
class ZipCodeRepository implements ZipCodeRepositoryInterface
{
    /**
     * @param int $id
     * @return ZipCode|null
     */
    public function findById(int $id)
    {
        return ZipCode::withTrashed()
            ->findOrFail($id);
    }

    /**
     * @param string $data
     * @return ZipCode
     */
    public function findByZipCode(string $data)
    {
        return ZipCode::withTrashed()
            ->where('zip_code', $data);
    }

    /**
     * @param string $data
     * @return ZipCode
     */
    public function findByAddress(string $data)
    {
        return ZipCode::withTrashed()
            ->where('address', 'like', "%" . $data . "%");
    }

    /**
     * @return ZipCode[]
     */
    public function findAll()
    {
        return ZipCode::withTrashed()
            ->get();
    }

    /**
     * @param array $data
     * @return ZipCode
     */
    public function store(array $data)
    {
        $zipCode = new ZipCode;
        $zipCode->location_raw = $data['location_raw'] ?? null;
        $zipCode->zip_code = $data['zip_code'];
        $zipCode->address = $data['address'] ?? null;
        $zipCode->neighborhood = $data['neighborhood'] ?? null;
        $zipCode->city = $data['city'] ?? null;
        $zipCode->state = $data['state'] ?? null;
        $zipCode->save();
        return $zipCode;
    }

    /**
     * @param ZipCode $zipCode
     * @param array $data
     * @return ZipCode
     */
    public function update(ZipCode $zipCode, array $data)
    {
        $zipCode->location_raw = $data['location_raw'] ?? null;
        $zipCode->zip_code = $data['zip_code'];
        $zipCode->address = $data['address'] ?? null;
        $zipCode->neighborhood = $data['neighborhood'] ?? null;
        $zipCode->city = $data['city'] ?? null;
        $zipCode->state = $data['state'] ?? null;
        $zipCode->save();
        return $zipCode;
    }

    /**
     * @param ZipCode $zipCode
     * @return ZipCode
     */
    public function enable(ZipCode $zipCode)
    {
        $zipCode->restore();
        return $zipCode;
    }

    /**
     * @param ZipCode $zipCode
     * @return ZipCode
     */
    public function disable(ZipCode $zipCode)
    {
        $zipCode->delete();
        return $zipCode;
    }

    /**
     * @param ZipCode $zipCode
     * @return null
     */
    public function destroy(ZipCode $zipCode)
    {
        $zipCode->forceDelete();
        return null;
    }
}
