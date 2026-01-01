<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreStage extends Model
{
    protected $fillable = [
        'entreprise_id',
        'titre',
        'description',
        'duree',
        'lieu',
        'type',
    ];
     // Relation : une offre appartient à une entreprise
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    // Relation : une offre peut recevoir plusieurs candidatures
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

}
