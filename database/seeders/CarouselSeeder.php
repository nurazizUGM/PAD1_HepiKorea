<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carousel::insert([
            [
                'title' => 'Carousel 1',
                'description' => 'Description 1',
                'media_type' => 'image',
                'media' => 'example/carousel.jpg',
            ],
            [
                'title' => 'Carousel 2',
                'description' => 'Description 2',
                'media_type' => 'video',
                'media' => 'example/carousel.mp4',
            ],
            [
                'title' => 'Carousel 3',
                'description' => 'Description 3',
                'media_type' => 'youtube',
                'media' => 'https://www.youtube.com/embed/3hPoEmlBQdY?autoplay=1&mute=1',
            ],
        ]);
    }
}
