@extends('layouts.master')

@section('title')
Page des books 
@endsection

@section('content')

{{-- pagination de Laravel --}}
{{ $books->links() }}
<h1>Tous les livres</h1>
<p>Moyenne générale des notes des livres : {{ $stat->avgGeneral() }}</p>
<p>Ecart type {{ $stat->std() }}</p>
<p>Max note {{ $stat->maxGen() }}</p>
<p>Min note {{ $stat->minGen() }}</p>
<ul class="list-group">
@forelse($books as $book)
    <li class="list-group-item">
        <h2><a href="{{ route('show_book', $book->id) }}">{{ $book->title }}</a></h2>
        @if( is_null($book->score) == false)
        <p>Score : {{ $book->score}}</p>
        <p>Moyenne : {{ $stat->avg ( $book->id ) }}</p>
        <p>Max : {{ $stat->maxNoteBook( $book->id ) }}</p>
        <p>Min : {{ $stat->minNoteBook( $book->id ) }}</p>
        @endif
        @if( is_null($book->picture) == false)
        <div class="row">
           <div class="col-xs-6 col-md-3">
                <a href="{{ route('show_book', $book->id) }}">
                    <img width="171" src="{{ asset('images/' . $book->picture->link ) }}" alt="{{ $book->picture->title }}" />
                </a>
           </div>
        </div>
        @endif

    </li>
@empty
@endforelse
</ul>

{{-- pagination de Laravel --}}
{{ $books->links() }}
@endsection


@section('sidebar')
@parent
<p>On ajoute quelque chose à la sidebar</p>
{{ "<script>alert('xss')</script>" }}
@endsection