<?php

namespace App\Models;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $table = 'candidats';
    protected $fillable = ['nom', 'prenom', 'email', 'age', 'niveauEtude', 'sexe'];

    public function formations(){
        return $this->belongsToMany(Formation::class)->withTimestamps();
    }

    public static function countBySexe()
    {
        return self::selectRaw('sexe, count(*) as count')
                ->groupBy('sexe')
                ->get()
                ->toArray();
    }

}
