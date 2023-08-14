<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class ApiService
{
    public function makeApiRequest($url)
    {
        $curl_options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false, // Désactiver la vérification SSL (NON RECOMMANDÉ)
        );

        $curl = curl_init();
        curl_setopt_array($curl, $curl_options);
        $result = curl_exec($curl);

        if ($result === false) {
            // Gérer les erreurs de cURL
            $error = curl_error($curl);
            curl_close($curl);

            // Return the error message
            return ['error' => 'Failed to retrieve data from API.'];
        }

        curl_close($curl);

        $data = json_decode($result, true); // Decode JSON as associative array

        return $data;
    }
}
