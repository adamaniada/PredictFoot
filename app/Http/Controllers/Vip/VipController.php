<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class VipController extends Controller
{
    private $apiService;
    private $APIkey;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->APIkey = Config::get('app.api_key');
    }

    private function getDateRange($filter)
    {
        $today = Carbon::today();
        switch ($filter) {
            case 'avant-hier':
                return [$today->subDays(2)->toDateString(), $today->subDays(2)->toDateString()];
            case 'hier':
                return [$today->subDays(1)->toDateString(), $today->subDays(1)->toDateString()];
            case 'aujourd-hui':
                return [$today->toDateString(), $today->toDateString()];
            case 'demain':
                return [$today->addDays(1)->toDateString(), $today->addDays(1)->toDateString()];
            case 'apres-demain':
                return [$today->addDays(2)->toDateString(), $today->addDays(2)->toDateString()];
            default:
                return [$today->toDateString(), $today->toDateString()];
        }
    }

    private function handleApiError($api_json_data)
    {
        if (isset($api_json_data['error'])) {
            return view('predictions.error', ['message' => 'Échec de la récupération des données depuis l\'API.']);
        }
        if (empty($api_json_data)) {
            return view('predictions.error', ['message' => 'Aucune donnée disponible pour les prédictions.']);
        }
        return null;
    }

    private function filterPredictions($api_json_data, $filters)
    {
        return collect($api_json_data)->filter(function ($item) use ($filters) {
            foreach ($filters as $filter) {
                if ($item[$filter['key']] >= $filter['value']) {
                    return true;
                }
            }
            return false;
        })->all();
    }

    public function options()
    {
        return view('vip.options');
    }

    public function victoire_ou_match_null(Request $request)
    {
        $filter = $request->input('filter');
        list($from, $to) = $this->getDateRange($filter);
        $url = "https://apiv3.apifootball.com/?action=get_predictions&from=$from&to=$to&APIkey={$this->APIkey}";

        $api_json_data = $this->apiService->makeApiRequest($url);
        $errorView = $this->handleApiError($api_json_data);
        if ($errorView) {
            return $errorView;
        }

        $filters = [
            ['key' => 'prob_HW', 'value' => 90.00],
            ['key' => 'prob_D', 'value' => 50.00],
            ['key' => 'prob_AW', 'value' => 90.00],
        ];

        $data = $this->filterPredictions($api_json_data, $filters);

        return view('vip.victoire_ou_match_null', compact('from', 'to', 'data'));
    }

    public function total(Request $request)
    {
        $filter = $request->input('filter');
        list($from, $to) = $this->getDateRange($filter);
        $url = "https://apiv3.apifootball.com/?action=get_predictions&from=$from&to=$to&APIkey={$this->APIkey}";

        $api_json_data = $this->apiService->makeApiRequest($url);
        $errorView = $this->handleApiError($api_json_data);
        if ($errorView) {
            return $errorView;
        }

        $filters = [
            ['key' => 'prob_U_1', 'value' => 90.00],
            ['key' => 'prob_O_1', 'value' => 90.00],
            ['key' => 'prob_U', 'value' => 90.00],
            ['key' => 'prob_O', 'value' => 90.00],
            ['key' => 'prob_U_3', 'value' => 90.00],
            ['key' => 'prob_O_3', 'value' => 90.00],
        ];

        $data = $this->filterPredictions($api_json_data, $filters);

        return view('vip.total', compact('from', 'to', 'data'));
    }
}
