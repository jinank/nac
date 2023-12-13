<?php

use App\Genere;
use Illuminate\Database\Seeder;

class GenereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            ['title' => "Drama"],
            ['title' => "Comedy"],
            ['title' => "Horror"],
            ['title' => "Kids"],
            ['title' => "Sports"],
            ['title' => "Gameshows"],
            ['title' => "Documentary"],
            ['title' => "Other"],


        ];
        foreach ($titles as $item) {
            Genere::create($item);
        }
    }
}
