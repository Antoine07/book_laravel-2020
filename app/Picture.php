<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $fillable = [
        'link',
        'title'
    ];

    // belongsTo == clé étrangère
    public function book()
    {

        return $this->belongsTo(Book::class);
    }
}
