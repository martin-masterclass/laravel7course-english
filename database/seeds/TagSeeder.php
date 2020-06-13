<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Sports' => 'primary', // blue
            'Relaxation' => 'secondary', // grey
            'Fun' => 'warning', // yellow
            'Nature' => 'success', // green
            'Inspiration' => 'light', // white grey
            'Friends' => 'info', // turquoise
            'Love' => 'danger', // red
            'Interest' => 'dark' // black-white
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'name' => $key,
                    'style' => $value
                ]
            );
            $tag->save();
        }

    }
}

