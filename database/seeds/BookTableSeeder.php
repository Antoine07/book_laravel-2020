<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class BookTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        App\Genre::insert([
            ['name' => 'science'],
            ['name' => 'maths'],
            ['name' => 'cookbook'],
        ]);

        // Supprimer toutes les images si elles existent dans le dossier images
        Storage::disk('local')->delete( Storage::allFiles() );

        factory(App\Book::class, 10)->create()->each(function($book){

            // Un objet hydraté par une ligne de la table books
            // dump($book->title);
            $names = ['science', 'maths', 'cookbook']; 
            // attention le where un retourne un tableau et nous on veut un objet
            // donc on utilise first qui récupère le premier objet du tableau
            $genre = App\Genre::where('name', $names[rand(0,2)])->first();

            // On demande au modèle de se mettre en relation avec le modèle Genre
            // Puis on associe un genre à book
            $book->genre()->associate($genre);

            // Puis on demande à sauvegarder cette association
            $book->save();

            // Gestion des images on maitrise le nom de l'image pour éviter les problèmes d'injection de script dans les noms 
            // des fichiers.
            $link = Str::random(40) . '.jpg' ;
            // on récupère les octets d'une image distante avec file_get_content
            $file = file_get_contents('https://picsum.photos/id/'.rand(1, 10).'/200/300');

            // On enregistre les octets récupérés dans un fichier on utilise la classe de Laravel Storage
            Storage::put($link, $file);

            // à partir du modèle book on invoque le modèle picture et on demande 
            // au modèle picture d'enregistrer une ligne dans sa table
            // en récupérant l'id du book
            // books pictures
            $book->picture()->create([
                'title' => 'Default',
                'link' => $link
            ]);
            
            /*
            $books->authors()->get(); // $book->authors; // accède aux authors dans
            $book->genre()->get(); // $book->genre;
            $book->picture(); // $book->picture;
            */

            // Plusieurs auteurs par livre on récupère 5 auteurs aléatoirement (shuffle méthode de Laravel sur une collection)
            // la méthode slice de Laravel permet de coupé 5 auteurs
            $authors = App\Author::pluck('id')->shuffle()->slice(0,5);

            $book->authors()->attach( $authors );

        });
    }
}
