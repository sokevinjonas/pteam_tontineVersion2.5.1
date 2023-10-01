<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tontine;
use App\Models\Cotisation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participation extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [''];


    public function cotisations()
    {
        return $this->hasMany(Cotisation::class, 'participation_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tontine(){
        return $this->belongsTo(Tontine::class);
    }
}
