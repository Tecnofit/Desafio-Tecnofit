<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

        $items = [
            /**Instructor */
            ['name' => 'Instructor', 'email' => 'instructor@email.com', 'password' => $password, 'role' => 'instructor', 'created_at' => now(), 'updated_at' => now()],

            /**Customer */
            ['name' => 'John Doe', 'email' => 'customer@email.com', 'password' => $password, 'role' => 'customer', 'created_at' => now(), 'updated_at' => now()]
        ];

        User::insert($items);
        // factory(User::class, 10)->create();
    }
}
