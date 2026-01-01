<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Entreprise extends Model
{
protected $fillable = [
        'user_id',
        'nom_entreprise',
        'adresse',
        'domaine',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function offres()
{
    return $this->hasMany(OffreStage::class);
}
}
