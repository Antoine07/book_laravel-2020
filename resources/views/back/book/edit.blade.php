@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Créer un book</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <p>Vérifier le formulaire il comporte des erreurs !</p>
            </div>
            @endif
            {{--
                route + method => Laravel connecte à la bonne action dans le contrôleur de ressource 
            --}}
            <form action="{{route('book.update', $book->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="form-control" id="title" />
                        @if($errors->has('title')) <span class="error bg-warning">{{ $errors->first('title')}}</span> @endif
                    </div>
                </div>
                <div class="form">
                    <div class="form-group">
                        <label for="title">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10">{{ $book->description }}</textarea>
                        @if($errors->has('description')) <span class="error bg-warning">{{ $errors->first('description')}}</span> @endif
                    </div>
                </div>
                <div class="form">
                    <div class="form-group">
                        <label for="title">Genre</label>
                        <select name="genre_id" id="genre">
                            @foreach($genres as $id=> $name)
                            <option {{ $book->genre_id == $id ? 'selected' : null }} value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
            <div class="form">
                <div class="form-group">
                    <label for="title">Authors</label>
                    @foreach($authors as $id => $name)
                    <label for="author{{$id}}">{{$name}}</label>
                    {{--
                        $book->authors()->pluck('id') renvoie un objet sur lequel tu peux itérer
                        $book->authors()->pluck('id')->all() renvoie un array
                     --}}
                    <input {{ $book->authors && in_array( $id, $book->authors()->pluck('id')->all() ) === true ? 'checked' : null}} type="checkbox" name="authors[]" value="{{$id}}" id="author{{$id}}" />
                    @endforeach
                </div>
            </div>
            <div class="form">
                <div class="form-group">
                    <h2>Status</h2>
                    <input {{ $book->status === 'published' ? 'checked' : null }} type="radio" name="status" value="published" /> Publier <br />
                    <input {{ $book->status === 'unpublished' ? 'checked' : null }} type="radio" name="status" value="unpublished" /> Dépublier
                </div>
            </div>
            <div class="form">
                <div class="form-group">
                    <h2>Score</h2>
                    <select name="score" id="score">
                        @foreach([0,1,2,3,4,5] as $score)
                        <option {{ $book->score == $score ? 'selected' : null }} value="{{$score}}"> {{$score}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form">
                <div class="form-group">
                    <h2>Fichier</h2>
                    <label for="file">Image</label>
                    <input type="file" name="picture">
                    @if($errors->has('picture')) <span class="error bg-warning">{{ $errors->first('picture')}}</span> @endif
                </div>
            </div>
            @if($book->picture)
            <div class="form">
                <div class="form-group">
                    <img width="300" src="{{ asset('images/' . $book->picture->link ) }}" />
                    <p class="delete_picture">
                        Cocher pour supprimer l'image :<input type="checkbox" name="delete_picture" value="delete_picture" />
                    </p>
                </div>
            </div>
            @endif
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </div>
    </form>
</div>
@endsection