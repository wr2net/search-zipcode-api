<?php

namespace App\ZipCodes\Status\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    /**
     * Show the API status
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function status()
    {
        $data = [
            'Server' => [
                'Url' => config('app.url'),
                'Env' => config('app.env'),
                'Debug' => config('app.debug'),
                'Local' => config('app.locale'),
            ],
            'Date' => (new Carbon())->format(\DateTime::ATOM),
            'Services' => [
                'Database' => null,
            ],
            'CORS' => config('cors')
        ];

        return response()->json($data);
    }
}
