<?php

namespace App\Http\Controllers\Api;

use App\Services\Interfaces\SPAPIServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmazonController extends Controller
{
    protected $spapiService;

    /**
     * Bind the SPAPIService through the constructor.
     */
    public function __construct(SPAPIServiceInterface $spapiService)
    {
        $this->spapiService = $spapiService;
    }

    /**
     * Retrieve product listing information using the Amazon Listings API.
     *
     * @param string $sellerId Seller ID
     * @param string $sku Product SKU
     * @return Illuminate\Http\JsonResponse
     */
    public function getListings(Request $request, string $sellerId, string $sku)
    {
        try {
            $data = $this->spapiService->makeRequest('GET', "listings/2021-08-01/items/{$sellerId}/{$sku}", [
                'marketplaceIds' => $request->query('marketplaceIds', 'ATVPDKIKX0DER'),
            ]);

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
