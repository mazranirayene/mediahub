<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     protected $fillable = [
        'nom',
        'slug',
    ];
    public function publications(){
        return $this->hasMany(Publication::class, 'categorie_id');
    }
}
