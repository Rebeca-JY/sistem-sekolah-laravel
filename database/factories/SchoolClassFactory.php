<?php

namespace Database\Factories;

use App\Models\SchoolClass; // 1. Import Model SchoolClass
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    // 2. Hubungkan ke Model SchoolClass, bukan ke Factory itu sendiri
    protected $model = SchoolClass::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 3. Tambahkan minimal 2 nama kelas lagi agar jumlahnya 15 (sama/lebih dari seeder)
        $schoolClasses = [    
            '10 AKL',
            '11 AKL', 
            '12 AKL', 
            '10 TKJ 1', 
            '10 TKJ 2',
            '11 TKJ 1', 
            '11 TKJ 2', 
            '12 TKJ 1', 
            '12 TKJ 2', 
            '12 TKJ 3', 
            '10 BiD 1', 
            '10 BiD 2',
            '11 BiD',
            '12 BiD', 
        ];

        return [
            'name' => fake()->unique()->randomElement($schoolClasses),
        ];
    }
}