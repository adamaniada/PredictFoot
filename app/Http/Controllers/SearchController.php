<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Services\PredictionOptionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DateTime;

class SearchController extends Controller
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

    public function advanced() {
        $predictionsOptions = $this->predictionOptionsService->getAllOptions();
        return view('search.advance', compact('predictionsOptions'));
    }

    public function result(Request $request) {
        $startDateInput = $request->input('startDate');
        $endDateInput = $request->input('endDate');
        $predictionsOptions = $request->input('predictionsOptions');
        $predictionsPercent = floatval($request->input('predictionsPercent'));
        $predictionLabel = $request->input('predictionLabel');

        // Vérifiez si $predictionsPercent est une valeur valide
        if (!is_numeric($predictionsPercent)) {
            // Gérez le cas où $predictionsPercent n'est pas valide (par exemple, définissez une valeur par défaut ou affichez une erreur)
            return view('predictions.error', ['message' => 'Le pourcentage de prédictions n\'est pas valide.']);
        }

        // Convertir les chaînes de caractères en objets DateTime
        $startDate = new DateTime($startDateInput);
        $endDate = new DateTime($endDateInput);

        // Formater les dates au format "Y-m-d"
        $formattedStartDate = $startDate->format('Y-m-d');
        $formattedEndDate = $endDate->format('Y-m-d');

        if ($this->predictionOptionsService->optionExists($predictionsOptions)) {
            $predictionLabel = $this->predictionOptionsService->getOptionLabel($predictionsOptions);

            $url = "https://apiv3.apifootball.com/?action=get_predictions&from=$formattedStartDate&to=$formattedEndDate&APIkey={$this->APIkey}";

            // Récupérer les données JSON via l'API
            $api_json_data = $this->apiService->makeApiRequest($url);

            if (isset($api_json_data['error'])) {
                // Gérer l'erreur, afficher un message, etc.
                return view('predictions.error', ['message' => 'Échec de la récupération des données depuis l\'API : ' . $api_json_data['error']]);
            }

            /// Filtrer les données en fonction de l'option spécifiée et du pourcentage de prédictions
            $data = collect($api_json_data)->filter(function ($item) use ($predictionsOptions, $predictionsPercent) {
                return $item[$predictionsOptions] >= $predictionsPercent;
            })->all();

            $option = $predictionsOptions;

            return view('predictions.details', compact('option', 'predictionLabel', 'data'));
        } else {
            abort(404);
        }
    }
}
