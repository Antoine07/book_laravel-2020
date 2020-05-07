<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = [
        'title',
        'description',
        'genre_id',
        'status',
        'score'
    ];

    // One to Many inverse
    // Un livre a un genre au plus
    // entité qui possède la clé étrangère
    public function genre()
    {

        return $this->belongsTo(Genre::class);
    }

    // Many to Many
    // Un livre peut avoir plusieurs auteurs
    public function authors()
    {

        return $this->belongsToMany(Author::class);
    }

    // One to One
    // un livre a une image au plus
    public function picture()
    {
        return $this->hasOne(Picture::class);
    }

    // One to One
    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }
}
