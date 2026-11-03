<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- 1. Import model User di sini

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTeacherEmail = 'james@ski.sch.id';
        $userStudentEmail = 'juhoon@ski.sch.id';

        // user teacher
        User::updateOrCreate( 
            ['email' => $userTeacherEmail],
            [
                'name' => 'James',
                'password' => bcrypt('password'),
                'role' => 'teacher'
            ]
        );

        // user student
        User::updateOrCreate(  
            ['email' => $userStudentEmail],
            [
                'name' => 'Juhoon',
                'password' => bcrypt('password'),
                'role' => 'student'
            ]
        );
    }
}