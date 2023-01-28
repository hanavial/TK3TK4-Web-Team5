<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'name'              => 'Staff',
            'jenis_kelamin'     => 'Laki-Laki',
            'email'             => 'staff@gmail.com',
            'password'	        => bcrypt('staff123'),
            'remember_token'	=> NULL,
        ]);
    }
}
