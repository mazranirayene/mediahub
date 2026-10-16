<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function publication(){
        return $this->hasMany(Publication::class);
    }
}
