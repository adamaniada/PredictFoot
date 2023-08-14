<?php
// PredictionOptionsService.php

namespace App\Services;

class PredictionOptionsService
{
    public function getAllOptions()
    {
        return [
            'prob_HW' => 'Victoire de l\'équipe à domicile',
            'prob_D' => 'Match nul',
            'prob_AW' => 'Victoire de l\'équipe à l\'extérieur',
            'prob_HW_D' => 'Double chance (victoire de l\'équipe à domicile ou match nul)',
            'prob_AW_D' => 'Double chance (victoire de l\'équipe à l\'extérieur ou match nul)',
            'prob_HW_AW' => 'Victoire de l\'équipe à domicile ou à l\'extérieur',
            'prob_O' => 'Plus de 2.5 buts dans le match',
            'prob_U' => 'Moins de 2.5 buts dans le match',
            'prob_O_1' => 'Plus de 1.5 buts dans le match',
            'prob_U_1' => 'Moins de 1.5 buts dans le match',
            'prob_O_3' => 'Plus de 3.5 buts dans le match',
            'prob_U_3' => 'Moins de 3.5 buts dans le match',
            'prob_bts' => 'Les deux équipes marquent',
            'prob_ots' => 'Une seule équipe marque',
        ];
    }

    public function optionExists($option)
    {
        return array_key_exists($option, $this->getAllOptions());
    }

    public function getOptionLabel($option)
    {
        $options = $this->getAllOptions();
        return $options[$option] ?? null;
    }
}
