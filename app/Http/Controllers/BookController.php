<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;
use App\Book;
use App\Author;

use Storage;

class BookController extends Controller
{

    private $paginate = 5;

    public function __construct()
    {

        // On remet ici les genres pour le menu dans le master.blade.php (layout)
        view()->composer('partials.menu', function ($view) {
            $genres = Genre::pluck('name', 'id');
            $view->with('genres', $genres);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate($this->paginate);

        // back.book.inde <=> back/book/index.blade.php dans Laravel
        return view('back.book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::pluck('name', 'id');
        $genres = Genre::pluck('name', 'id'); // ['id' => 'name']

        return view('back.book.create', [
            'authors' => $authors,
            'genres' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dump($request->all()); die;

        // pour les validations vous avez les rules
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'genre_id' => 'integer',
            'authors.*' => 'integer',
            'status' => 'in:published,unpublished',
            'score' => 'required|between:0,10' // plusieurs rules pour vérifier les champs d'un formulaire
        ]);


        // insert les données en base il faut préciser cela dans les fillables
        $book = Book::create($request->all());
        // une fois le book créé en base de données Laravel crée un objet book
        // la méthode authors()->attach permet d'associer dans la relation many to many des auteurs pour ce livre
        $book->authors()->attach($request->authors);

        if( $request->file('picture') ){

            // enregistre dans le store l'image et en même temps on récupère le
            // nom de l'image créé par Laravel, nom sécurisé
            // 1. Pas d'écrasement d'image avec le même nom.
            // 2. Pas d'injection de script dans le nom de l'image.
            $link= $request->file('picture')->store('') ;

            // créer une resource dans la table pictures

            $book->picture()->create([
                'link' => $link,
                'title' => ''
            ]);
        }

        return redirect()->route('book.index')->with('message', 'success creater book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * l'injection de dépandance Laravel instancie le livre avec l'id si 
     * vous préciser le type Book dans le paramètre de la méthode
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        
        $authors = Author::pluck('name', 'id');
        $genres = Genre::pluck('name', 'id'); // ['id' => 'name']

        return view('back.book.edit', [
            'book' => $book,
            'authors' => $authors,
            'genres' => $genres
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // $book = Book::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'genre_id' => 'integer',
            'authors.*' => 'integer',
            'status' => 'in:published,unpublished',
            'score' => 'required|between:0,10' // plusieurs rules pour vérifier les champs d'un formulaire
        ]);

        $book->update($request->all());

        // la méthode sync met à jour la table de liaison avec les auteurs
        $book->authors()->sync($request->authors);

        return redirect()->route('book.index')->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dump($id, 'destroy');

        $book = Book::find($id);

        $book->delete();

        return redirect()->route('book.index')->with('message', 'success delete');
    }

    
}
