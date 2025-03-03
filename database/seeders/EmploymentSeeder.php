<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\EmploymentStatus;

class EmploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $employment = new EmploymentStatus();
        $employment->name = 'Intern';
        $employment->colourValue = '#00FF00';
        $employment->description = 'Intern';
        $employment->save();

        $employment = new EmploymentStatus();
        $employment->name = 'Permanent';
        $employment->colourValue = '#FF0000';
        $employment->description = 'Permanent';
        $employment->save();

        $employment = new EmploymentStatus();
        $employment->name = 'Staff';
        $employment->colourValue = '#FFFF00';
        $employment->description = 'Staff';
        $employment->save();

        $employment = new EmploymentStatus();
        $employment->name = 'Terminated';
        $employment->colourValue = '#00FFFF';
        $employment->description = 'Terminated';
        $employment->save();
    }
}
