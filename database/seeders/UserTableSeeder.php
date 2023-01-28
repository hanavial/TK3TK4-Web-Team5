<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'User',
            'tempat_lahir'      => 'Malang',
            'tanggal_lahir'     => '2001-01-01',
            'jenis_kelamin'     => 'Perempuan',
            'alamat'			=> 'Jl. Malang',
            'ktp'			    => 'ktp.jpg',
            'email'             => 'user@gmail.com',
            'password'	        => bcrypt('user1234'),
            'remember_token'	=> NULL,
        ]);
    }
}
