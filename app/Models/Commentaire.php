<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    public function publication(){
        return $this->belongsTo(Publication::class);
    }

    public function auteur(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
