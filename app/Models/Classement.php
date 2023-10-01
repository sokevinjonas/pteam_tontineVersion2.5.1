<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    use HasFactory,HasUuids;
    protected $fillable=[
        'rang',
        'montant_pris',
        'participation_id'
    ];
}
