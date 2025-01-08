<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Exception;

class ApiService
{
    /**
     * Make an API request.
     *
     * @param string $url
     * @return array
     * @throws Exception
     */
    public function makeApiRequest(string $url): array
    {
        $curl_options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false, // Désactiver la vérification SSL (NON RECOMMANDÉ)
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $curl_options);

        $result = curl_exec($curl);

        if ($result === false) {
            // Gérer les erreurs de cURL
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception('Failed to retrieve data from API: ' . $error);
        }

        curl_close($curl);

        $data = json_decode($result, true); // Decode JSON as associative array

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to decode JSON response: ' . json_last_error_msg());
        }

        return $data;
    }
}
