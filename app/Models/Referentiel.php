<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referentiel extends Model
{
    use HasFactory;
    protected $table = 'referentiels';
    protected $fillable = ['libelle', 'validated', 'horaire'];

    public function type(){
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function formations(){
        return $this->belongsToMany(Formation::class);
    }
}
