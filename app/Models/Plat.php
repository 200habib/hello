<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
use Illuminate\Support\Facades\Storage;

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


    public function setImageAttribute($value)
    {
        if ($value && is_file($value)) {
            $this->attributes['image'] = $value->store('images', 'public');
            return;
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $imageContents = file_get_contents($value);
            $imageName = 'plat_' . time() . '.jpg';
            Storage::disk('public')->put('images/' . $imageName, $imageContents);
            $this->attributes['image'] = 'images/' . $imageName;
        } else {
            $this->attributes['image'] = $value; 
        }
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
