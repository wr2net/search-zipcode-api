<?php

namespace App\ZipCodes\Search\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ZipCodes\Search\Models\ZipCode;
use App\ZipCodes\Search\Requests\ZipCodeRequest;
use App\ZipCodes\Search\Resources\ZipCodeResource;
use App\ZipCodes\Search\Services\ZipCodeService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ZipCodeController
 * @package App\ZipCodes\Controllers\Api
 */
class ZipCodeController extends Controller
{
    /**
     * @var ZipCodeService
     */
    private $service;

    /**
     * @param ZipCodeService $service
     */
    public function __construct(ZipCodeService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $list = $this->service->findAll();
        return ZipCodeResource::collection($list);
    }

    /**
     * @param ZipCodeRequest $request
     * @return JsonResponse
     */
    public function store(ZipCodeRequest $request)
    {
        $zipCode = $this->service->store($request->validated());
        return response()->json($zipCode, Response::HTTP_CREATED);
    }

    /**
     * @param ZipCode $zipCode
     * @return JsonResponse
     */
    public function show(ZipCode $zipCode)
    {
        return response()->json($zipCode, Response::HTTP_OK);
    }

    /**
     * @param ZipCodeRequest $request
     * @param ZipCode $zipCode
     * @return JsonResponse
     */
    public function update(ZipCodeRequest $request, ZipCode $zipCode)
    {
        $zipCode = $this->service->update($zipCode, $request->validated());
        return response()->json($zipCode, Response::HTTP_OK);
    }

    /**
     * @param ZipCode $zipCode
     * @return JsonResponse
     */
    public function enable(ZipCode $zipCode)
    {
        $zipCode = $this->service->enable($zipCode);
        return response()->json($zipCode, Response::HTTP_OK);
    }

    /**
     * @param ZipCode $zipCode
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function disable(ZipCode $zipCode)
    {
        $this->authorize('disable', $zipCode);
        $zipCode = $this->service->disable($zipCode);
        return response()->json($zipCode, Response::HTTP_OK);
    }

    /**
     * @param ZipCode $zipCode
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(ZipCode $zipCode)
    {
        $this->authorize('destroy', $zipCode);
        $this->service->destroy($zipCode);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchByZipCode(Request $request)
    {
        $search = $this->service->findByZipCode($request['search']);
        return response()->json($search, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchByAddress(Request $request)
    {
        $search = $this->service->findByAddress($request['search']);
        return response()->json($search, Response::HTTP_OK);
    }
}
