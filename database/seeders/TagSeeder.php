<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            'SQL',
            'C++',
            'NoCode',
            'JavaScript',
            'Python',
            'Machine Learning',
            'Data Science',
            'Web Development',
            'Algorithms',
            'HTML/CSS'
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}
