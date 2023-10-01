<?php

namespace App\Models;

use App\Models\Participation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tontine extends Model
{
    use HasFactory, HasUuids ;

    protected $guarded = [''];

    public function participation(){
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
    public function currentMembersNumber () {

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
    public function hasFull(int $newParticipantPlaceOccuped) : bool {

        return $this->number_of_members < $this->currentMembersNumber() + $newParticipantPlaceOccuped;
    }


    /*
    *   Répond a la question
    *   Est ce que la tontine est pleine ?
    */
    public function isFull (): bool {
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

    public function isStart() {
        return $this->status == 'actif';
    }

}
