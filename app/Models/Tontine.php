<?php

namespace App\Models;

use App\Models\Participation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Tontine extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [''];

    public function participation()
    {
        return $this->hasMany(Participation::class);
    }

    //  cette relation signifie que chaque tontine est associer a un seul user specifique
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
     * Renvoi le nombre de participant courant de la tontine
     */
    public function currentMembersNumber()
    {

        $participant = $this->participation;

        if ($participant->count() == 0) {
            return 0;
        }

        $participantCurrentNumber = 0;

        foreach ($participant as $participant) {
            $participantCurrentNumber += $participant->nombre_bras;
        }

        return $participantCurrentNumber;
    }

    /*
     * Répond a la question
     * Est ce que si on ajoute un nouveau participant le tontine sera pleine ?
     * Renvoie vrai ou faux
     */
    public function hasFull(int $newParticipantPlaceOccuped): bool
    {

        return $this->number_of_members < $this->currentMembersNumber() + $newParticipantPlaceOccuped;
    }


    /*
     *   Répond a la question
     *   Est ce que la tontine est pleine ?
     */
    public function isFull(): bool
    {
        return $this->number_of_members == $this->currentMembersNumber();
    }


    /*
     * Renvoie le rand du prochaine partcipant
     */

    public function participationRank()
    {

        $participantsNumber = $this->participation->count();


        if ($participantsNumber == 0) {
            $rank = 1;
        } else {
            $rank = ++$participantsNumber;
        }

        return $rank;
    }
    // Méthode pour calculer la date de la prochaine prise
    protected $casts = [
        'date_debut' => 'date'
    ];
    protected $dates = ['date_debut', 'date_fin'];

    public function PrisesSuivantes()
    {
        $prises = [];

        // Récupère la date de début et la date de fin de la tontine
        $dateDebut = $this->date_debut->copy();
        $dateFin = $this->date_fin;

        // Calcule la première prise en fonction de la période
        if ($this->periode === 'day') {
            $dateDebut->addDays($this->delay);
        } elseif ($this->periode === 'week') {
            $dateDebut->addWeeks($this->delay);
        } elseif ($this->periode === 'month') {
            $dateDebut->addMonths($this->delay);
        } elseif ($this->periode === 'year') {
            $dateDebut->addYears($this->delay);
        } else {
            return 'Période non prise en charge.'; // Gérer d'autres cas de périodes si nécessaire
        }

        // Ajoute la première prise au tableau
        $prises[] = $dateDebut->isoFormat('Do MMMM YYYY');

        // Calcule les prises en fonction de la période et du délai
        while ($dateDebut->lte($dateFin)) {
            if ($this->periode === 'day') {
                $dateDebut->addDays($this->delay);
            } elseif ($this->periode === 'week') {
                $dateDebut->addWeeks($this->delay);
            } elseif ($this->periode === 'month') {
                $dateDebut->addMonths($this->delay);
            } elseif ($this->periode === 'year') {
                $dateDebut->addYears($this->delay);
            } else {
                return 'Période non prise en charge.'; // Gérer d'autres cas de périodes si nécessaire
            }
            // Vérifie si la date suivante est toujours dans la plage de dates
            if ($dateDebut->lte($dateFin)) {
                $prises[] = $dateDebut->isoFormat('Do MMMM YYYY');
            }
        }

        return $prises;
    }


    public function isStart()
    {
        return $this->status == 'actif';
    }

}