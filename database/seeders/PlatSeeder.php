<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\Plat;

class PlatSeeder extends Seeder
{
    public function run()
    {
        // $imageUrl = 'https://m.media-amazon.com/images/I/8126RXA1kiL.jpg';

        // $imageName = 'plat_' . time() . '.jpg';
        
        // $imageContents = file_get_contents($imageUrl);

        // Storage::disk('public')->put('Dish/' . $imageName, $imageContents);

        Plat::create([
            'nom' => 'Pizza Margherita',
            'recette' => 'Pomodoro, mozzarella, basilico.',
            'image' => 'https://m.media-amazon.com/images/I/8126RXA1kiL.jpg', 
            'user_id' => 1, 
        ]);
    }
}

