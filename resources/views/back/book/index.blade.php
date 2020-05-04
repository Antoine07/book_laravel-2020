@extends('layouts.master')

@section('content')
<p><a><button type="button" class="btn btn-primary btn-lg">Ajouter un livre</button></a></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Authors</th>
            <th>Genre</th>
            <th>Date de publication</th>
            <th>Status</th>
            <th>Edition</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
   
@endsection 

@section('scripts')
    @parent
    
@endsection