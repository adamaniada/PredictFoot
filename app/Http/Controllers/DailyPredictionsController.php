<?php
// DailyPredictionsController.php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Services\PredictionOptionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DailyPredictionsController extends Controller
{
    private $apiService;
    private $APIkey;
    private $predictionOptionsService;

    public function __construct(ApiService $apiService, PredictionOptionsService $predictionOptionsService)
    {
        $this->apiService = $apiService;
        $this->APIkey = Config::get('app.api_key');
        $this->predictionOptionsService = $predictionOptionsService;
    }

    public function options() {
        $predictionsOptions = $this->predictionOptionsService->getAllOptions();
        return view('predictions.options', ['predictionsOptions' => $predictionsOptions]);
    }

    public function show(Request $request, $option)
    {
        if ($this->predictionOptionsService->optionExists($option)) {
            $predictionLabel = $this->predictionOptionsService->getOptionLabel($option);

            $from = date('Y-m-d'); // Today's date
            $to = date('Y-m-d'); // date('Y-m-d', strtotime('+1 day')); // Tomorrow's date

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
            $data = collect($api_json_data)->filter(function ($item) use ($option) {
                return $item[$option] >= 90.00;
            })->all();


            return view('predictions.details', compact('option', 'predictionLabel', 'data'));
        } else {
            abort(404);
        }
    }
}
