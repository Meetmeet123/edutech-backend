<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class awardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $award = new Award();
        $award->name = 'Employee of the Month';
        $award->description = 'Awarded to the employee of the month';
        $award->image = 'https://i.imgur.com/3Lm2Wwv.png';
        $award->save();

        $award = new Award();
        $award->name = 'Employee of the Year';
        $award->description = 'Awarded to the employee of the year';
        $award->image = 'https://i.imgur.com/3Lm2Wwv.png';
        $award->save();
    }
}
