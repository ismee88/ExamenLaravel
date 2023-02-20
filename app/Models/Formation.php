<?php

namespace App\Models;

use App\Models\Referentiel;
use App\Models\Candidat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $table = 'formations';
    protected $fillable = ['nom', 'duree', 'description', 'isStarted', 'date_debut'];

    public function candidats(){
        return $this->belongsToMany(Candidat::class);
    }

    public function referentiels(){
        return $this->belongsToMany('App\Models\referentiel')->withTimestamps();
    }
}
