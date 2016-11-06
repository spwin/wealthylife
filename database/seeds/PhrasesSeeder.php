<?php

use Illuminate\Database\Seeder;
use App\Phrases;

class PhrasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phrases')->delete();

        $phrase = new Phrases();
        $phrase->fill([
            'text' => '<Strong>Simplicity</Strong> is the keynote of all true elegance.',
            'author' => 'Coco Chanel',
            'enabled' => 1
        ]);
        $phrase->save();
    }
}
