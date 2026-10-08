<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commentaire;

class Publication extends Model
{
     use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'categorie_id',
        'utilisateur_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'publication_id');
    }
}
