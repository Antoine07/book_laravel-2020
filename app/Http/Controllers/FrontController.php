<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// L'import du namespace
use App\Book;
use App\Author;
use App\Genre;
use Cache;

use App\Services\Stat;

class FrontController extends Controller
{

    private $paginate = 5;
    private $paginateAuthor = 2;

    public function index(Stat $stat){

        $key = 'home' . ( request()->page ?? '1' );
        $minutes = 5 * 60;

        // pour nettoyer le cache on a la commande
        // php artisan cache:clear
        $books = Cache::remember( $key , $minutes, function(){

            return Book::with('picture', 'genre')->paginate($this->paginate);
        });

        // beaucoup de code ici ... Algorithme il faut mettre l'algorithme dans un service

        // Le premier paramètre c'est le nom de votre vue
        // le point désigne le fait que vous allez chercher un fichier se trouvant dans un dossier
        return view('front.index', [
            'books' => $books,
            'stat' => $stat
            ]);
    }

    // int permet de vérifier le type du paramètre de ma fonction
    // le paramètre $id est récupéré dans la route
    public function show(int $id){
        $book = Book::with('authors')->find($id);

        return view('front.show', ['book' => $book]);
    }

    // récupérer tous les livres d'un auteur
    public function showAuthor(int $id){
        // relation ManyToMany pour récupérer tous les livres d'un auteur
        // avec de la pagination 
        // $books = Author::find($id)->books // on récupère tous les livres d'un auteur

        // on récupère tous les livres d'un auteur avec la pagination
        $author = Author::find($id) ;
        $books = $author->books()->with('picture')->paginate( $this->paginateAuthor );

        return view('front.author', ['books' => $books, 'name' => $author->name]);
    }

    public function showGenre(int $id){

        $genre = Genre::find($id);

        $books = $genre->books()->with('picture')->paginate($this->paginate);

        return view('front.genre', [
            'books' => $books,
            'name' => $genre->name
            ]);
    }
}
