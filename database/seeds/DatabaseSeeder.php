<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        DB::table('users')->insert([
            // [
            //     'name' => 'Alan',
            //     'email' => 'alan@alan.fr',
            //     'password' => '1234'
            // ],
            // [
            //     'name' => 'Alice',
            //     'email' => 'alice@alice.fr',
            //     'password' => '1234'
            // ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.fr',
                'password' => Hash::make( 'admin' )
            ],
            ]);
            
            // Création de 10 authors en utilisant la factory
            // la fonction factory de Laravel permet d'utiliser le facker définit
            factory(App\Author::class, 10)->create();
            $this->call(BookTableSeeder::class);
        }
    }
    