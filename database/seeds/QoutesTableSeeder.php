<?php

use Illuminate\Database\Seeder;
use App\Qoute;

class QoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qoute::create([
            'qoute' => 'Don\'t cry because it\'s over, smile because it happened.',
            'author_name' => 'Dr. Seuss',
            ]);	
            
        Qoute::create([
            'qoute' => 'I do not fear computers. I fear lack of them.',
            'author_name' => 'Isaac Asimov',
            ]);	

        Qoute::create([
            'qoute' => 'A computer once beat me at chess, but it was no match for me at kick boxing.',
            'author_name' => 'Emo Philips',
            ]);	

    }
}
