<?php

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'supino', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'barra', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'corda', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'esteira', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'bicicleta', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'aeróbico', 'created_at' => now(), 'updated_at' => now()]
        ];
        Exercise::insert($items);
    }
}
