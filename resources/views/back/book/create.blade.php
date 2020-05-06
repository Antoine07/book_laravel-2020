@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Créer un book</h1>
            <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" />
                        @if($errors->has('title')) <span class="error bg-warning">{{ $errors->first('title')}}</span> @endif
                    </div>
                </div>
                <div class="form">
                    <div class="form-group">
                        <label for="title">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                        @if($errors->has('description')) <span class="error bg-warning">{{ $errors->first('description')}}</span> @endif
                    </div>
                </div>
                <div class="form">
                    <div class="form-group">
                        <label for="title">Genre</label>
                        <select name="genre_id" id="genre">
                            @foreach($genres as $id=> $name)
                            <option {{ old('genre_id') == $id ? 'selected' : null }} value="{{$id}}">{{$name}}</option>
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
                    <input {{ old('authors') && in_array( $id, old('authors') ) === true ? 'checked' : null}} type="checkbox" name="authors[]" value="{{$id}}" id="author{{$id}}" />
                    @endforeach
                </div>
            </div>
            <div class="form">
                <div class="form-group">
                    <h2>Status</h2>
                    <input {{ old('status') === 'published' ? 'checked' : null }} type="radio" name="status" value="published" /> Publier <br />
                    <input {{ old('status') === 'unpublished' ? 'checked' : null }} type="radio" name="status" value="unpublished" /> Dépublier
                </div>
            </div>
            <div class="form">
                <div class="form-group">
                    <h2>Score</h2>
                    <select name="score" id="score">
                        @foreach([0,1,2,3,4,5] as $score)
                        <option {{ old('score') == $score ? 'selected' : null }} value="{{$score}}"> {{$score}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter un livre</button>
        </div>
    </div>
    </form>
</div>
@endsection