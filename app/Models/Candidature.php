<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
      protected $table = 'candidatures';
     protected $fillable = [
        'etudiant_id',
        'offre_stage_id',
        'cv',
        'description',
        'statut',
    ];
      protected $appends = ['cv_url']; // ← Ajoute cet attribut au JSON

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function offre()
    {
        return $this->belongsTo(OffreStage::class, 'offre_stage_id');
    }
    // URL publique du CV
    public function getCvUrlAttribute()
    {
        return asset('storage/cvs/' . $this->cv);
    }
}
