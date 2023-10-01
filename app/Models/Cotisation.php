<?php

namespace App\Models;

use App\Models\Participation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotisation extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [''];


    public function participation(){
        return $this->belongsTo(Participation::class);
    }
}
