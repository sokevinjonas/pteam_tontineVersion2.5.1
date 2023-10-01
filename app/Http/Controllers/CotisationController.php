<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use Illuminate\Http\Request;
use App\Models\Participation;

class CotisationController extends Controller
{
    public function cotiser($participationId)
    {
        // Logique de traitement pour la cotisation
        // Mettez à jour le nombre de cotisations, etc.

        // Exemple : Mettez à jour le nombre de cotisations dans la participation
        $participation = Participation::find($participationId);
        $participation->nbr_cotisations = $participation->nbr_cotisations + 1;
        $participation->save();

        // Exemple : Créez un enregistrement de cotisation
        Cotisation::create([
            'participation_id' => $participationId,
            'periode' => date('Y-m-d'), // Période actuelle (aujourd'hui)
            'montant' => 100, // Montant de la cotisation (à adapter selon votre logique)
        ]);

        // Réponse JSON (si nécessaire)
        return response()->json(['success' => true, 'message' => 'Cotisation effectuée avec succès']);
    }
}
