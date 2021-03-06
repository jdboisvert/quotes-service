<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class QuotesTableSeeder extends Seeder
{
    /**
     * Used to seed the quotes table
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotes')->insert([
            'quote' => 'Don\'t cry because it\'s over, smile because it happened.',
            'author_name' => 'Dr. Seuss',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);	
            
        DB::table('quotes')->insert([
            'quote' => 'I do not fear computers. I fear lack of them.',
            'author_name' => 'Isaac Asimov',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);	

        DB::table('quotes')->insert([
            'quote' => 'A computer once beat me at chess, but it was no match for me at kick boxing.',
            'author_name' => 'Emo Philips',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);	

        DB::table('quotes')->insert([
            'quote' => 'The greatest glory in living lies not in never falling, but in rising every time we fall.',
            'author_name' => 'Nelson Mandela',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);	

        DB::table('quotes')->insert([
            'quote' => 'Life is what happens when you\'re busy making other plans.',
            'author_name' => 'John Lennon',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);	

        DB::table('quotes')->insert([
            'quote' => 'Always remember that you are absolutely unique. Just like everyone else',
            'author_name' => 'Margaret Mead',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);	
    }
}
