<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class PredictionsController extends Controller
{
    private $apiService;
    private $APIkey;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->APIkey = Config::get('app.api_key');
    }

    public function show($matchId)
    {
        $url = "https://apiv3.apifootball.com/?action=get_predictions&match_id={$matchId}&APIkey={$this->APIkey}";
        $predictionsByCountry = $this->apiService->makeApiRequest($url);

        if (isset($data['error'])) {
            // Handle the error, display a message, etc.
            return view('predictions.error', ['message' => 'Failed to retrieve data from API.']);
        }

        if (empty($data)) {
            return view('predictions.error', ['message' => 'No data available for this match.']);
        }

        return view('predictions.show', compact('data'));
    }
}
