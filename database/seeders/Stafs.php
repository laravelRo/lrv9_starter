<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staf;

class Stafs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staf::truncate();
        //creem administratorul principal al sitului
        $staf = new Staf;
        $staf->name = 'Manager';
        $staf->email = 'manager@gmail.com';
        $staf->role = 'supervisor';
        $staf->password = bcrypt('password');
        $staf->email_verified_at = now();
        $staf->phone = '0766 754 625';
        $staf->save();
    }
}
