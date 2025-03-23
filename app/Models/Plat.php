<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;


class Plat extends Model
{
    /** @use HasFactory<\Database\Factories\PlatFactory> */

    use HasFactory;
    use Encryptable;

    protected $fillable = ['nom', 'recette', 'user_id', 'image'];

    protected $encryptable = ['recette'];

    public function createur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorisPar()
    {
        return $this->belongsToMany(User::class, 'favoris', 'plat_id', 'user_id')->withTimestamps();
    }
}
