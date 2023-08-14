<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class VipController extends Controller
{
    private $apiService;
    private $APIkey;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->APIkey = Config::get('app.api_key');
    }

    public function options() {
        return view('vip.options');
    }

    public function victoire_ou_match_null(Request $request){
        $from = date('Y-m-d'); // Date par défaut: Aujourd'hui
        $to = date('Y-m-d'); // Date par défaut: Aujourd'hui

        // Utiliser la valeur du filtre provenant de la requête pour ajuster les dates
        $filter = $request->input('filter');
        switch ($filter) {
            case 'avant-hier':
                // Définir la date "avant hier"
                $from = date('Y-m-d', strtotime('-2 days'));
                $to = date('Y-m-d', strtotime('-2 days'));
                break;
            case 'hier':
                // Définir la date "hier"
                $from = date('Y-m-d', strtotime('-1 day'));
                $to = date('Y-m-d', strtotime('-1 day'));
                break;
            case 'aujourd-hui':
                // Définir la date "aujourd'hui"
                $from = date('Y-m-d');
                $to = date('Y-m-d');
                break;
            case 'demain':
                // Définir la date "demain"
                $from = date('Y-m-d', strtotime('+1 day'));
                $to = date('Y-m-d', strtotime('+1 day'));
                break;
        }

        $url = "https://apiv3.apifootball.com/?action=get_predictions&from=$from&to=$to&APIkey={$this->APIkey}";

        // Récupérer les données JSON via l'API
        $api_json_data = $this->apiService->makeApiRequest($url);

        if (isset($api_json_data['error'])) {
            // Gérer l'erreur, afficher un message, etc.
            return view('predictions.error', ['message' => 'Échec de la récupération des données depuis l\'API.']);
        }

        if (empty($api_json_data)) {
            return view('predictions.error', ['message' => 'Aucune donnée disponible pour les prédictions.']);
        }

        // Filtrer les données en fonction de l'option spécifiée
        $filteredData = collect($api_json_data)->filter(function ($item) {
            return $item['prob_HW'] >= 90.00 || $item['prob_D'] >= 50.00 || $item['prob_AW'] >= 90.00;
        })->all();

        $data = $filteredData;

        return view('vip.victoire_ou_match_null', compact('from', 'to', 'data'));
    }
}
