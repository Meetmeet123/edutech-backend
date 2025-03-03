<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Shift;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $shift = new Shift();
        $shift->name = 'Morning';
        $shift->startTime = '2023-04-02T09:00:00';
        $shift->endTime = '2023-04-02T15:00:00';
        $shift->workHour = '8';
        $shift->save();

        $shift = new Shift();
        $shift->name = 'Afternoon';
        $shift->startTime = '2023-04-02T16:00';
        $shift->endTime = '2023-04-02T00:00';
        $shift->workHour = '8';
        $shift->save();

        $shift = new Shift();
        $shift->name = 'Night';
        $shift->startTime = '2023-04-02T00:00:00';
        $shift->endTime = '2023-04-02T08:00:00';
        $shift->workHour = '8';
        $shift->save();
    }
}
